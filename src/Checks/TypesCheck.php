<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;
use Yu\SchemaValidator\Data\Snapshot;
use Yu\SchemaValidator\Services\Vocabulary;
use Yu\WebToolsCore\Checklist\Check;

/**
 * S3: every type is a real Schema.org type, so a typo like "Organisation" does not hide the item from search engines.
 */
class TypesCheck implements SchemaCheck
{
    public function __construct(private Vocabulary $vocabulary) {}

    public function run(Snapshot $site): Check
    {
        if ($site->items === []) {
            return Check::skip('S3', 10, 'no_items');
        }

        $unknown = [];
        foreach ($site->allItems() as $item) {
            foreach ($item->types as $type) {
                if (!$this->vocabulary->exists($type)) {
                    $suggestion = $this->vocabulary->suggest($type);
                    $unknown[$type] = $suggestion === null ? $type : "{$type} → {$suggestion}";
                }
            }
        }

        if ($unknown !== []) {
            return Check::fail('S3', 10, 'unknown', evidence: array_values($unknown));
        }

        $untyped = array_values(array_filter($site->items, fn (Item $item): bool => $item->types === []));

        return $untyped === []
            ? Check::pass('S3', 10, 'ok')
            : Check::warn('S3', 5, 10, 'untyped', ['count' => count($untyped)]);
    }
}
