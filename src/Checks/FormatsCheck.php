<?php

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * S4: values are in the format search engines read: full URLs, ISO 8601 dates, prices as plain numbers, ISO 4217 currencies.
 */
class FormatsCheck implements SchemaCheck
{
    public const array URLS = ['url', 'logo', 'image', 'item', 'sameAs', 'contentUrl', 'thumbnailUrl', 'embedUrl'];

    public const array DATES = ['datePublished', 'dateModified', 'dateCreated', 'startDate', 'endDate', 'priceValidUntil', 'uploadDate', 'validFrom', 'validThrough', 'birthDate'];

    public const array PRICES = ['price', 'lowPrice', 'highPrice'];

    /** Problems listed in the report; the rest are counted only. */
    private const int SHOWN = 10;

    public const string SNIPPET = <<<'TEXT'
        "url": "https://example.com/page",
        "datePublished": "2026-11-14T09:30:00+02:00",
        "price": "1499.00",
        "priceCurrency": "UAH"
        TEXT;

    public function run(Snapshot $site): Check
    {
        if ($site->items === []) {
            return Check::skip('S4', 10, 'no_items');
        }

        $problems = [];
        foreach ($site->allItems() as $item) {
            foreach ($item->properties as $property => $values) {
                foreach ($values as $value) {
                    if (is_string($value) && $this->isWrong($property, trim($value))) {
                        $problems[] = "{$item->label()} · {$property}: \"{$value}\"";
                    }
                }
            }
        }

        if ($problems === []) {
            return Check::pass('S4', 10, 'ok');
        }

        return Check::warn('S4', 5, 10, 'problems', ['count' => count($problems)], array_slice($problems, 0, self::SHOWN), self::SNIPPET);
    }

    private function isWrong(string $property, string $value): bool
    {
        return match (true) {
            in_array($property, self::URLS, true) => !preg_match('~^https?://~i', $value),
            in_array($property, self::DATES, true) => !preg_match('/^\d{4}-\d{2}-\d{2}([T ]\d{2}:\d{2}(:\d{2}(\.\d+)?)?(Z|[+-]\d{2}:?\d{2})?)?$/', $value),
            in_array($property, self::PRICES, true) => !preg_match('/^\d+(\.\d+)?$/', $value),
            $property === 'priceCurrency' => !preg_match('/^[A-Z]{3}$/', $value),
            default => false,
        };
    }
}
