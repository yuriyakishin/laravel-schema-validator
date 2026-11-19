<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R5: reviews and ratings (stars in the search result). A rating inside a product is about that product;
 * a rating on its own must say what it reviews.
 */
class ReviewCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R5';
    }

    protected function types(): array
    {
        return ['Review', 'AggregateRating'];
    }

    protected function missing(Item $item): array
    {
        $reviewed = $item->nested ? [] : ['itemReviewed'];

        if ($this->isA($item, 'AggregateRating')) {
            return [$this->absent($item, ['ratingValue', 'ratingCount|reviewCount', ...$reviewed]), $this->absent($item, ['bestRating'])];
        }

        return [
            $this->absent($item, ['author.name', 'reviewRating.ratingValue', ...$reviewed]),
            $this->absent($item, ['datePublished']),
        ];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            "aggregateRating": {
              "@type": "AggregateRating",
              "ratingValue": "4.8",
              "bestRating": "5",
              "reviewCount": "127"
            },
            "review": {
              "@type": "Review",
              "author": { "@type": "Person", "name": "Olena K." },
              "datePublished": "2026-10-02",
              "reviewRating": { "@type": "Rating", "ratingValue": "5", "bestRating": "5" }
            }
            JSON;
    }
}
