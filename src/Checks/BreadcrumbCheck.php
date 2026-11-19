<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R3: breadcrumbs shown in the search result instead of the bare address.
 * Every step needs a position and a name; every step but the last needs the address it leads to.
 */
class BreadcrumbCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R3';
    }

    protected function types(): array
    {
        return ['BreadcrumbList'];
    }

    protected function missing(Item $item): array
    {
        $steps = array_values(array_filter($item->values('itemListElement'), fn ($step): bool => $step instanceof Item));

        if ($steps === []) {
            return [['itemListElement'], []];
        }

        $missing = [];
        foreach ($steps as $i => $step) {
            $fields = $i < count($steps) - 1 ? ['position', 'name|item.name', 'item'] : ['position', 'name|item.name'];

            foreach ($this->absent($step, $fields) as $field) {
                $missing[] = 'itemListElement['.($i + 1).'].'.$field;
            }
        }

        return [$missing, []];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "BreadcrumbList",
              "itemListElement": [
                { "@type": "ListItem", "position": 1, "name": "Catalogue", "item": "https://example.com/catalogue" },
                { "@type": "ListItem", "position": 2, "name": "Roses", "item": "https://example.com/catalogue/roses" },
                { "@type": "ListItem", "position": 3, "name": "Red roses" }
              ]
            }
            JSON;
    }
}
