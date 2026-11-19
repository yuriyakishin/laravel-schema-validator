<?php

declare(strict_types=1);

namespace Yu\SchemaValidator\Checks;

use Yu\SchemaValidator\Data\Item;

/**
 * R7: questions and answers. Since August 2023 Google shows them as a rich result only on
 * well-known government and health sites; the markup still helps other search engines and AI assistants.
 */
class FaqCheck extends RichResultCheck
{
    protected function code(): string
    {
        return 'R7';
    }

    protected function types(): array
    {
        return ['FAQPage'];
    }

    protected function missing(Item $item): array
    {
        $questions = array_values(array_filter($item->values('mainEntity'), fn ($question): bool => $question instanceof Item));

        if ($questions === []) {
            return [['mainEntity'], []];
        }

        $missing = [];
        foreach ($questions as $i => $question) {
            foreach ($this->absent($question, ['name', 'acceptedAnswer.text']) as $field) {
                $missing[] = 'mainEntity['.($i + 1).'].'.$field;
            }
        }

        return [$missing, []];
    }

    protected function snippet(): string
    {
        return <<<'JSON'
            {
              "@context": "https://schema.org",
              "@type": "FAQPage",
              "mainEntity": [{
                "@type": "Question",
                "name": "How fast is the delivery?",
                "acceptedAnswer": { "@type": "Answer", "text": "Within two hours across the city." }
              }]
            }
            JSON;
    }
}
