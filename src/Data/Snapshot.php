<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Data;

use Yu\SchemaValidator\Services\Vocabulary;

/**
 * The structured data of a page: the top-level items and the JSON-LD blocks that are not valid JSON.
 */
final readonly class Snapshot
{
    /**
     * @param  list<Item>  $items
     * @param  list<string>  $invalidBlocks  the beginning of each JSON-LD block that could not be read
     */
    public function __construct(
        public string $url,
        public array $items = [],
        public array $invalidBlocks = [],
    ) {}

    /**
     * Every item, nested ones included.
     *
     * @return list<Item>
     */
    public function allItems(): array
    {
        return array_merge([], ...array_map(fn (Item $item): array => $item->withNested(), $this->items));
    }

    /**
     * Items of the given types or of their subtypes, nested ones included.
     *
     * @param  list<string>  $types
     * @return list<Item>
     */
    public function find(array $types, Vocabulary $vocabulary): array
    {
        return array_values(array_filter(
            $this->allItems(),
            fn (Item $item): bool => array_any($item->types, fn (string $type): bool => $vocabulary->isA($type, $types)),
        ));
    }
}
