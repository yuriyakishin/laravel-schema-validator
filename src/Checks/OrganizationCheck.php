<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R1: the organisation or the local business (company knowledge panel, local search). Only top-level items:
 * an Organization inside an article is its publisher, not the business of the site.
 */
class OrganizationCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R1';
    }

    protected function types(): array
    {
        return ['Organization'];
    }

    protected function includesNested(): bool
    {
        return false;
    }

    protected function missing(Item $item): array
    {
        if ($this->isA($item, 'LocalBusiness')) {
            return [
                $this->absent($item, ['name', 'address']),
                $this->absent($item, ['telephone', 'url', 'image', 'openingHoursSpecification|openingHours', 'geo']),
            ];
        }

        return [
            $this->absent($item, ['name', 'url']),
            $this->absent($item, ['logo', 'sameAs', 'contactPoint|telephone|email']),
        ];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "Organization",
              "name": "Your company",
              "url": "https://example.com",
              "logo": "https://example.com/logo.png",
              "sameAs": ["https://www.facebook.com/yourcompany", "https://www.linkedin.com/company/yourcompany"],
              "contactPoint": { "@type": "ContactPoint", "telephone": "+380 44 123 4567", "contactType": "customer service" }
            }
            JSON;
    }
}
