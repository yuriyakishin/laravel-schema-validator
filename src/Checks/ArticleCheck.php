<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R6: an article, a news story or a blog post: the headline, the picture, the dates and the author in Google.
 */
class ArticleCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R6';
    }

    protected function types(): array
    {
        return ['Article'];
    }

    protected function missing(Item $item): array
    {
        return [$this->absent($item, ['headline']), $this->absent($item, ['image', 'datePublished', 'dateModified', 'author.name'])];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "BlogPosting",
              "headline": "How to choose a bouquet for a birthday",
              "image": "https://example.com/blog/bouquet.jpg",
              "datePublished": "2026-11-01T09:00:00+02:00",
              "dateModified": "2026-11-10T14:30:00+02:00",
              "author": { "@type": "Person", "name": "Olena K.", "url": "https://example.com/about" }
            }
            JSON;
    }
}
