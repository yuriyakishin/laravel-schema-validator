<?php

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;
use Yu\SchemaValidator\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * S1: the page has structured data and every JSON-LD block is valid JSON.
 */
class SyntaxCheck implements SchemaCheck
{
    public const string SNIPPET = <<<'HTML'
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "Your company",
          "url": "https://example.com",
          "logo": "https://example.com/logo.png"
        }
        </script>
        HTML;

    public function run(Snapshot $site): Check
    {
        $items = $site->items;
        $invalid = $site->invalidBlocks;

        if ($items === [] && $invalid === []) {
            return Check::fail('S1', 10, 'none', snippet: self::SNIPPET);
        }

        if ($invalid !== []) {
            return $items === []
                ? Check::fail('S1', 10, 'invalid', ['count' => count($invalid)], $invalid)
                : Check::warn('S1', 5, 10, 'some_invalid', ['count' => count($invalid)], $invalid);
        }

        $sources = array_count_values(array_map(fn (Item $item): string => $item->source, $items));

        return Check::pass('S1', 10, 'ok', [
            'json_ld' => $sources['json-ld'] ?? 0,
            'microdata' => $sources['microdata'] ?? 0,
        ], array_map(fn (Item $item): string => $item->label(), $items));
    }
}
