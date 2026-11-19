<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Services;

use Dom\Element;
use Dom\HTMLDocument;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver;
use Yu\SchemaValidator\Data\Item;
use Yu\SchemaValidator\Data\Snapshot;

/**
 * Reads the Schema.org items of a page from JSON-LD blocks and from microdata.
 * JSON-LD references like {"@id": "#org"} are replaced by the node with that @id when the page has one.
 */
class StructuredDataParser
{
    /** Deeper nesting is cut: real markup is a few levels deep, loops of @id references are not. */
    private const int MAX_DEPTH = 8;

    /** @var array<string, array<string, mixed>> JSON-LD nodes by @id */
    private array $nodes = [];

    public function parse(string $html, string $url, ?string $charset = null): Snapshot
    {
        $this->nodes = [];
        $document = HTMLDocument::createFromString($html, LIBXML_NOERROR, $charset);
        [$jsonLd, $invalid] = $this->jsonLd($document);

        return new Snapshot($url, [...$jsonLd, ...$this->microdata($document, $url)], $invalid);
    }

    /**
     * @return array{0: list<Item>, 1: list<string>}
     */
    private function jsonLd(HTMLDocument $document): array
    {
        $blocks = [];
        $invalid = [];

        foreach ($document->querySelectorAll('script[type="application/ld+json" i]') as $script) {
            $text = trim($script->textContent);
            $data = json_decode($text, true);

            if (is_array($data)) {
                $blocks[] = $data;
            } else {
                $invalid[] = mb_strimwidth(preg_replace('/\s+/', ' ', $text), 0, 200, '…');
            }
        }

        // A block may be one node, a list of nodes or a @graph; the context of a list item or a graph is the block's
        $roots = [];
        foreach ($blocks as $block) {
            $context = $block['@context'] ?? null;
            $nodes = array_is_list($block) ? $block : (isset($block['@graph']) && is_array($block['@graph']) ? $block['@graph'] : [$block]);

            foreach ($nodes as $node) {
                if (is_array($node) && !array_is_list($node)) {
                    $roots[] = [$node, $this->context($node['@context'] ?? $context)];
                    $this->remember($node);
                }
            }
        }

        $items = [];
        foreach ($roots as [$node, $context]) {
            $items[] = $this->node($node, $context, nested: false, depth: 0);
        }

        return [$items, $invalid];
    }

    /**
     * Keeps every node with an @id, nested ones too, so that references to it can be followed.
     *
     * @param  array<string, mixed>  $node
     */
    private function remember(array $node, int $depth = 0): void
    {
        if ($depth > self::MAX_DEPTH) {
            return;
        }

        if (is_string($node['@id'] ?? null) && count($node) > 1) {
            $this->nodes[$node['@id']] ??= $node;
        }

        foreach ($node as $value) {
            if (is_array($value)) {
                foreach (array_is_list($value) ? $value : [$value] as $child) {
                    if (is_array($child) && !array_is_list($child)) {
                        $this->remember($child, $depth + 1);
                    }
                }
            }
        }
    }

    /**
     * @param  array<string, mixed>  $node
     */
    private function node(array $node, ?string $context, bool $nested, int $depth): Item
    {
        // A bare reference: take the full node it points to
        if (count($node) === 1 && is_string($node['@id'] ?? null) && isset($this->nodes[$node['@id']])) {
            $node = $this->nodes[$node['@id']];
        }

        $properties = [];

        foreach ($node as $name => $value) {
            if (str_starts_with((string) $name, '@') || $depth >= self::MAX_DEPTH) {
                continue;
            }

            foreach (is_array($value) && array_is_list($value) ? $value : [$value] as $single) {
                $converted = $this->value($single, $depth);

                if ($converted !== null) {
                    $properties[$this->shortName((string) $name)][] = $converted;
                }
            }
        }

        return new Item($this->types($node['@type'] ?? []), $properties, 'json-ld', $nested ? null : $context, $nested);
    }

    private function value(mixed $value, int $depth): Item|string|null
    {
        return match (true) {
            is_string($value) => $value,
            is_bool($value) => $value ? 'true' : 'false',
            is_int($value), is_float($value) => (string) $value,
            is_array($value) && array_key_exists('@value', $value) => is_scalar($value['@value']) ? (string) $value['@value'] : null,
            is_array($value) && !array_is_list($value) => $this->node($value, null, nested: true, depth: $depth + 1),
            default => null,
        };
    }

    /**
     * The vocabulary of a JSON-LD @context: a URL, a list with a URL, or an object with @vocab.
     */
    private function context(mixed $context): ?string
    {
        if (is_string($context)) {
            return $context;
        }

        if (is_array($context)) {
            foreach (array_is_list($context) ? $context : [$context] as $part) {
                $vocabulary = is_string($part) ? $part : (is_array($part) ? ($part['@vocab'] ?? null) : null);

                if (is_string($vocabulary)) {
                    return $vocabulary;
                }
            }
        }

        return null;
    }

    /**
     * @return list<Item>
     */
    private function microdata(HTMLDocument $document, string $url): array
    {
        $items = [];

        foreach ($document->querySelectorAll('[itemscope]:not([itemprop])') as $element) {
            $items[] = $this->microdataItem($element, $url, nested: false, depth: 0);
        }

        return $items;
    }

    private function microdataItem(Element $scope, string $url, bool $nested, int $depth): Item
    {
        $properties = [];

        foreach ($scope->querySelectorAll('[itemprop]') as $element) {
            // A property belongs to the nearest item around it, not to every item above
            if ($element->parentElement?->closest('[itemscope]') !== $scope) {
                continue;
            }

            $value = $element->hasAttribute('itemscope')
                ? ($depth < self::MAX_DEPTH ? $this->microdataItem($element, $url, nested: true, depth: $depth + 1) : null)
                : $this->microdataValue($element, $url);

            if ($value === null) {
                continue;
            }

            foreach (preg_split('/\s+/', trim($element->getAttribute('itemprop'))) as $name) {
                if ($name !== '') {
                    $properties[$this->shortName($name)][] = $value;
                }
            }
        }

        $itemtype = trim((string) $scope->getAttribute('itemtype'));
        $types = $itemtype === '' ? [] : preg_split('/\s+/', $itemtype);
        $context = $types === [] ? null : preg_replace('~/[^/]*$~', '', $types[0]);

        return new Item($this->types($types), $properties, 'microdata', $nested ? null : $context, $nested);
    }

    /**
     * The value of a microdata property by the element, as in the HTML specification.
     */
    private function microdataValue(Element $element, string $url): string
    {
        $attribute = match (strtolower($element->localName)) {
            'meta' => 'content',
            'a', 'area', 'link' => 'href',
            'img', 'audio', 'video', 'source', 'iframe', 'embed', 'track' => 'src',
            'object' => 'data',
            'data', 'meter' => 'value',
            'time' => $element->hasAttribute('datetime') ? 'datetime' : null,
            default => null,
        };

        if ($attribute === null) {
            return trim(preg_replace('/\s+/', ' ', $element->textContent));
        }

        $value = trim((string) $element->getAttribute($attribute));

        return $attribute === 'href' || $attribute === 'src' || $attribute === 'data'
            ? (string) UriResolver::resolve(new Uri($url), new Uri($value))
            : $value;
    }

    /**
     * Short type names: "https://schema.org/Product" and "schema:Product" become "Product".
     *
     * @return list<string>
     */
    private function types(mixed $types): array
    {
        $names = [];

        foreach ((array) $types as $type) {
            if (is_string($type) && trim($type) !== '') {
                $names[] = $this->shortName(trim($type));
            }
        }

        return $names;
    }

    private function shortName(string $name): string
    {
        return preg_replace('~^(?:https?://(?:www\.)?schema\.org/|schema:)~i', '', $name);
    }
}
