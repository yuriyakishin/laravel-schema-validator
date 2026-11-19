<?php

return [
    'form' => [
        'label' => 'Page address',
        'button' => 'Check',
        'hint' => 'Free · no sign-up · up to :count checks per hour',
    ],
    'loading' => [
        'page' => 'Loading the page',
        'markup' => 'Reading JSON-LD and microdata',
        'checks' => 'Checking against Google rich results',
    ],
    'verdicts' => [
        'ready' => 'The structured data is in order',
        'almost' => 'The structured data is almost in order',
        'partly' => 'The structured data needs work',
        'not_ready' => 'The structured data is missing or broken',
    ],
    'rich' => [
        'title' => 'Rich results the page has markup for',
        'pass' => 'Ready',
        'warn' => 'Ready, can be improved',
        'fail' => 'Has errors',
        'none' => 'The page has no markup for any of the rich results checked here.',
    ],
    'tree' => [
        'title' => 'Everything found on the page (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Is the markup readable?', 'text' => 'Valid JSON, the Schema.org vocabulary, real types, value formats'],
        'R' => ['title' => 'Google rich results', 'text' => 'The fields Google needs for each type found on the page'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'Does the page have structured data?',
            'text' => 'JSON-LD or microdata that can be read',
            'fix' => 'Add a <script type="application/ld+json"> block with a description of the page in the Schema.org vocabulary. Check that it is valid JSON: no trailing commas, double quotes only, no comments.',
            'notes' => [
                'ok' => 'Found JSON-LD items: :json_ld, microdata items: :microdata.',
                'none' => 'The page has no structured data: search engines and AI assistants have to guess what it is about.',
                'invalid' => 'JSON-LD blocks found: :count, but none is valid JSON, so search engines ignore them.',
                'some_invalid' => 'JSON-LD blocks that are not valid JSON: :count. Search engines ignore them.',
            ],
        ],
        'S2' => [
            'title' => 'Is the vocabulary Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Set "@context": "https://schema.org" in every JSON-LD block, and an itemtype starting with https://schema.org/ in microdata.',
            'notes' => [
                'ok' => 'Every item uses the Schema.org vocabulary.',
                'wrong' => 'Some items have no @context or use another vocabulary.',
                'no_items' => 'There is no structured data to check.',
            ],
        ],
        'S3' => [
            'title' => 'Are the types real?',
            'text' => 'Every @type exists in Schema.org',
            'fix' => 'Fix the spelling of the types: Schema.org names are case-sensitive and use American spelling, e.g. Organization, not Organisation. The arrow shows the closest real type.',
            'notes' => [
                'ok' => 'Every type exists in Schema.org.',
                'unknown' => 'Some types do not exist in Schema.org: search engines skip these items.',
                'untyped' => 'Items without @type: :count. Search engines do not know what they describe.',
                'no_items' => 'There is no structured data to check.',
            ],
        ],
        'S4' => [
            'title' => 'Are the values in the right format?',
            'text' => 'Full URLs, ISO 8601 dates, plain-number prices',
            'fix' => 'Write addresses in full with https://, dates as 2026-11-14 or 2026-11-14T09:30:00+02:00, prices as plain numbers with a dot (1499.00, without spaces or a currency sign) and the currency as a 3-letter code (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'URLs, dates, prices and currencies are in the right format.',
                'problems' => 'Values in a wrong format: :count.',
                'no_items' => 'There is no structured data to check.',
            ],
        ],
        'R1' => [
            'title' => 'Is the organisation described?',
            'text' => 'Organization or LocalBusiness',
            'fix' => 'Describe the company: name and site address; for a business with an office or shop also the address, phone and opening hours. Add the logo and the links to social profiles in sameAs: Google uses them in the knowledge panel.',
            'notes' => [
                'ok' => 'Organisations found: :count, with every required and recommended field.',
                'required' => 'Required fields are missing.',
                'recommended' => 'The required fields are there; recommended ones are missing.',
                'absent' => 'There is no Organization or LocalBusiness on the page.',
            ],
        ],
        'R2' => [
            'title' => 'Is the site name set?',
            'text' => 'WebSite with name and url',
            'fix' => 'Add WebSite with the name of the site and the address of the home page, ideally on the home page. Google shows this name above the search result instead of the domain.',
            'notes' => [
                'ok' => 'The site name is set.',
                'required' => 'Required fields are missing.',
                'recommended' => 'The required fields are there; alternateName, a short or alternative name, is missing.',
                'absent' => 'There is no WebSite on the page.',
            ],
        ],
        'R3' => [
            'title' => 'Are the breadcrumbs marked up?',
            'text' => 'BreadcrumbList',
            'fix' => 'Every step of the breadcrumbs needs a position (1, 2, 3…) and a name; every step but the last needs the address it leads to in item.',
            'notes' => [
                'ok' => 'Breadcrumbs found: :count, every step is filled in.',
                'required' => 'Some steps lack a position, a name or an address.',
                'recommended' => 'Some recommended fields are missing.',
                'absent' => 'There are no breadcrumbs on the page.',
            ],
        ],
        'R4' => [
            'title' => 'Is the product ready for Google?',
            'text' => 'Product with an offer, a review or a rating',
            'fix' => 'A product needs a name and at least one of offers, review or aggregateRating. An offer needs price and priceCurrency. Add the picture, description, brand, SKU or barcode (gtin) and the availability: Google shows them in the search result and in Shopping.',
            'notes' => [
                'ok' => 'Products found: :count, with every required and recommended field.',
                'required' => 'Required fields are missing: Google will not show the product as a rich result.',
                'recommended' => 'The required fields are there; recommended ones are missing.',
                'absent' => 'There is no Product on the page.',
            ],
        ],
        'R5' => [
            'title' => 'Will the rating stars show?',
            'text' => 'Review or AggregateRating',
            'fix' => 'A rating needs ratingValue and the number of ratings (ratingCount or reviewCount); a review needs an author and reviewRating. A rating outside a product must say what it rates in itemReviewed. Google does not show stars for reviews a business writes about itself.',
            'notes' => [
                'ok' => 'Reviews and ratings found: :count, filled in correctly.',
                'required' => 'Required fields are missing: the stars will not show.',
                'recommended' => 'The required fields are there; recommended ones are missing.',
                'absent' => 'There are no reviews or ratings on the page.',
            ],
        ],
        'R6' => [
            'title' => 'Is the article described?',
            'text' => 'Article, NewsArticle or BlogPosting',
            'fix' => 'Give the article a headline, a picture, the publication and update dates and the author with a name. Google uses them in Top stories, Discover and the search result.',
            'notes' => [
                'ok' => 'Articles found: :count, with every recommended field.',
                'required' => 'The headline is missing.',
                'recommended' => 'The headline is there; recommended fields are missing.',
                'absent' => 'There is no article on the page.',
            ],
        ],
        'R7' => [
            'title' => 'Are the questions and answers marked up?',
            'text' => 'FAQPage',
            'fix' => 'Every question in mainEntity needs its text in name and an answer in acceptedAnswer.text. Since 2023 Google shows FAQ rich results only on well-known government and health sites, but the markup still helps other search engines and AI assistants.',
            'notes' => [
                'ok' => 'The FAQ markup is correct. Keep in mind that Google shows it as a rich result only for government and health sites.',
                'required' => 'Some questions lack the text or the answer.',
                'recommended' => 'Some recommended fields are missing.',
                'absent' => 'There is no FAQPage on the page.',
            ],
        ],
        'R8' => [
            'title' => 'Is the event ready for Google?',
            'text' => 'Event with a date and a place',
            'fix' => 'An event needs a name, a start date with time and a place with an address (or VirtualLocation for an online event). Add the end date, status, picture, description, tickets and organiser.',
            'notes' => [
                'ok' => 'Events found: :count, with every required and recommended field.',
                'required' => 'Required fields are missing: Google will not show the event.',
                'recommended' => 'The required fields are there; recommended ones are missing.',
                'absent' => 'There is no Event on the page.',
            ],
        ],
    ],
];
