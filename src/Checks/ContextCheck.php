<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;
use Yu\SchemaValidator\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * S2: every item says it uses the Schema.org vocabulary: "@context" in JSON-LD, the itemtype address in microdata.
 */
class ContextCheck implements SchemaCheck
{
    public const string SNIPPET = '"@context": "https://schema.org"';

    public function run(Snapshot $site): Check
    {
        if ($site->items === []) {
            return Check::skip('S2', 5, 'no_items');
        }

        $wrong = array_values(array_filter($site->items, fn (Item $item): bool => !$this->isSchemaOrg($item->context)));

        return $wrong === []
            ? Check::pass('S2', 5, 'ok')
            : Check::fail('S2', 5, 'wrong', evidence: array_map(
                fn (Item $item): string => $item->label().': '.($item->context ?? '—'),
                $wrong,
            ), snippet: self::SNIPPET);
    }

    private function isSchemaOrg(?string $context): bool
    {
        return $context !== null && preg_match('~^https?://(www\.)?schema\.org/?$~i', trim($context)) === 1;
    }
}
