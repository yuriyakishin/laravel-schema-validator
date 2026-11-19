<?php

namespace Yu\SchemaValidator\Data;

/**
 * One Schema.org item from JSON-LD or microdata: its types, its properties and where it came from.
 * A property value is text or a nested item.
 */
final readonly class Item
{
    /**
     * @param  list<string>  $types  short type names, e.g. "Product", without the schema.org prefix
     * @param  array<string, list<Item|string>>  $properties
     * @param  string  $source  "json-ld" or "microdata"
     * @param  string|null  $context  the vocabulary of a top-level item: the JSON-LD @context or the itemtype host
     * @param  bool  $nested  the item is the value of another item's property
     */
    public function __construct(
        public array $types,
        public array $properties,
        public string $source,
        public ?string $context = null,
        public bool $nested = false,
    ) {}

    /**
     * @return list<Item|string>
     */
    public function values(string $property): array
    {
        return $this->properties[$property] ?? [];
    }

    public function first(string $property): Item|string|null
    {
        return $this->values($property)[0] ?? null;
    }

    /**
     * The first text of a property, or the name of a nested item.
     */
    public function text(string $property): ?string
    {
        $value = $this->first($property);

        return $value instanceof self ? $value->text('name') : $value;
    }

    /**
     * Whether a property has a value that is not empty.
     */
    public function has(string $property): bool
    {
        foreach ($this->values($property) as $value) {
            if ($value instanceof self || trim($value) !== '') {
                return true;
            }
        }

        return false;
    }

    /**
     * A short label for the report: the type and the name, e.g. "Product «Red roses»".
     */
    public function label(): string
    {
        $type = $this->types === [] ? '?' : implode(', ', $this->types);
        $name = $this->text('name') ?? $this->text('headline');

        return $name === null ? $type : $type.' «'.mb_strimwidth($name, 0, 60, '…').'»';
    }

    /**
     * The item and every item nested in it, depth first.
     *
     * @return list<Item>
     */
    public function withNested(): array
    {
        $items = [$this];

        foreach ($this->properties as $values) {
            foreach ($values as $value) {
                if ($value instanceof self) {
                    array_push($items, ...$value->withNested());
                }
            }
        }

        return $items;
    }

    /**
     * The tree shown on the page: values cut to 120 characters, nesting to 4 levels.
     *
     * @return array{types: list<string>, source: string, properties: array<string, list<mixed>>}
     */
    public function toArray(int $depth = 0): array
    {
        $properties = [];

        foreach ($this->properties as $name => $values) {
            $properties[$name] = array_map(fn (Item|string $value): array|string => $value instanceof self
                ? ($depth < 3 ? $value->toArray($depth + 1) : ['types' => $value->types, 'source' => $value->source, 'properties' => []])
                : mb_strimwidth($value, 0, 120, '…'), $values);
        }

        return ['types' => $this->types, 'source' => $this->source, 'properties' => $properties];
    }
}
