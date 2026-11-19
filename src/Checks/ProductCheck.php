<?php

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R4: a product with its price, availability and rating in the search result.
 * Google needs the name and one of offers, review or aggregateRating; an offer needs a price and a currency.
 */
class ProductCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R4';
    }

    protected function types(): array
    {
        return ['Product'];
    }

    protected function missing(Item $item): array
    {
        $required = $this->absent($item, ['name', 'offers|review|aggregateRating']);
        $recommended = $this->absent($item, ['image', 'description', 'brand', 'sku|gtin|gtin8|gtin12|gtin13|gtin14|mpn']);

        foreach ($item->values('offers') as $offer) {
            if (!$offer instanceof Item) {
                continue;
            }

            $fields = $this->isA($offer, 'AggregateOffer') ? ['lowPrice', 'priceCurrency'] : ['price|priceSpecification.price', 'priceCurrency|priceSpecification.priceCurrency'];
            array_push($required, ...array_map(fn (string $field): string => 'offers.'.$field, $this->absent($offer, $fields)));
            array_push($recommended, ...array_map(fn (string $field): string => 'offers.'.$field, $this->absent($offer, ['availability'])));
        }

        return [array_values(array_unique($required)), array_values(array_unique($recommended))];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "Product",
              "name": "Red roses, 25 pcs",
              "image": "https://example.com/roses.jpg",
              "description": "A bouquet of 25 red roses with delivery in two hours",
              "brand": { "@type": "Brand", "name": "Flower shop" },
              "sku": "RR-25",
              "offers": {
                "@type": "Offer",
                "price": "1499.00",
                "priceCurrency": "UAH",
                "availability": "https://schema.org/InStock",
                "url": "https://example.com/red-roses"
              }
            }
            JSON;
    }
}
