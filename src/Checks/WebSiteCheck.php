<?php

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R2: the site name Google shows above the search result.
 */
class WebSiteCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R2';
    }

    protected function types(): array
    {
        return ['WebSite'];
    }

    protected function includesNested(): bool
    {
        return false;
    }

    protected function missing(Item $item): array
    {
        return [$this->absent($item, ['name', 'url']), $this->absent($item, ['alternateName'])];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "WebSite",
              "name": "Your company",
              "alternateName": "YC",
              "url": "https://example.com/"
            }
            JSON;
    }
}
