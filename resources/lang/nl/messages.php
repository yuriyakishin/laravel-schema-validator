<?php

return [
    'form' => [
        'label' => 'Adres van de pagina',
        'button' => 'Controleren',
        'hint' => 'Gratis · zonder registratie · tot :count controles per uur',
    ],
    'loading' => [
        'page' => 'De pagina laden',
        'markup' => 'JSON-LD en microdata lezen',
        'checks' => 'Vergelijken met de eisen voor rich results van Google',
    ],
    'verdicts' => [
        'ready' => 'De gestructureerde gegevens zijn in orde',
        'almost' => 'De gestructureerde gegevens zijn bijna in orde',
        'partly' => 'De gestructureerde gegevens moeten beter',
        'not_ready' => 'Gestructureerde gegevens ontbreken of zijn kapot',
    ],
    'rich' => [
        'title' => 'Rich results waarvoor de pagina opmaak heeft',
        'pass' => 'Klaar',
        'warn' => 'Klaar, kan beter',
        'fail' => 'Bevat fouten',
        'none' => 'De pagina heeft geen opmaak voor een van de rich results die hier worden gecontroleerd.',
    ],
    'tree' => [
        'title' => 'Alles wat op de pagina is gevonden (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Is de opmaak leesbaar?', 'text' => 'Geldige JSON, het Schema.org-vocabulaire, echte typen, waardeformaten'],
        'R' => ['title' => 'Rich results van Google', 'text' => 'De velden die Google vraagt voor elk type dat op de pagina staat'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'Heeft de pagina gestructureerde gegevens?',
            'text' => 'Leesbare JSON-LD of microdata',
            'fix' => 'Voeg een blok <script type="application/ld+json"> toe met een beschrijving van de pagina in het Schema.org-vocabulaire. Controleer dat het geldige JSON is: geen komma na het laatste element, alleen dubbele aanhalingstekens, geen commentaar.',
            'notes' => [
                'ok' => 'Gevonden JSON-LD-items: :json_ld, microdata-items: :microdata.',
                'none' => 'De pagina heeft geen gestructureerde gegevens: zoekmachines en AI-assistenten moeten raden waar ze over gaat.',
                'invalid' => 'Gevonden JSON-LD-blokken: :count, maar geen enkele is geldige JSON, dus zoekmachines negeren ze.',
                'some_invalid' => 'JSON-LD-blokken met ongeldige JSON: :count. Zoekmachines negeren ze.',
            ],
        ],
        'S2' => [
            'title' => 'Is het vocabulaire Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Zet "@context": "https://schema.org" in elk JSON-LD-blok en in microdata een itemtype dat begint met https://schema.org/.',
            'notes' => [
                'ok' => 'Alle items gebruiken het Schema.org-vocabulaire.',
                'wrong' => 'Sommige items hebben geen @context of gebruiken een ander vocabulaire.',
                'no_items' => 'Er zijn geen gestructureerde gegevens om te controleren.',
            ],
        ],
        'S3' => [
            'title' => 'Bestaan de typen echt?',
            'text' => 'Elk @type bestaat in Schema.org',
            'fix' => 'Verbeter de spelling van de typen: Schema.org-namen zijn hoofdlettergevoelig en in Amerikaans Engels, bijvoorbeeld Organization en niet Organisation. De pijl toont het dichtstbijzijnde echte type.',
            'notes' => [
                'ok' => 'Alle typen bestaan in Schema.org.',
                'unknown' => 'Sommige typen bestaan niet in Schema.org: zoekmachines slaan die items over.',
                'untyped' => 'Items zonder @type: :count. Zoekmachines weten niet wat ze beschrijven.',
                'no_items' => 'Er zijn geen gestructureerde gegevens om te controleren.',
            ],
        ],
        'S4' => [
            'title' => 'Hebben de waarden het juiste formaat?',
            'text' => 'Volledige URL\'s, ISO 8601-datums, prijzen als getallen',
            'fix' => 'Schrijf adressen volledig met https://, datums als 2026-11-14 of 2026-11-14T09:30:00+02:00, prijzen als gewoon getal met een punt (1499.00, zonder spaties of valutateken) en de valuta als code van 3 letters (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'URL\'s, datums, prijzen en valuta hebben het juiste formaat.',
                'problems' => 'Waarden in een verkeerd formaat: :count.',
                'no_items' => 'Er zijn geen gestructureerde gegevens om te controleren.',
            ],
        ],
        'R1' => [
            'title' => 'Is de organisatie beschreven?',
            'text' => 'Organization of LocalBusiness',
            'fix' => 'Beschrijf het bedrijf: naam en adres van de website; voor een bedrijf met kantoor of winkel ook het postadres, telefoon en openingstijden. Voeg het logo en de links naar sociale profielen toe in sameAs: Google gebruikt ze in het kennisvenster.',
            'notes' => [
                'ok' => 'Gevonden organisaties: :count, met alle verplichte en aanbevolen velden.',
                'required' => 'Verplichte velden ontbreken.',
                'recommended' => 'De verplichte velden zijn er; aanbevolen velden ontbreken.',
                'absent' => 'Er staat geen Organization of LocalBusiness op de pagina.',
            ],
        ],
        'R2' => [
            'title' => 'Is de sitenaam ingesteld?',
            'text' => 'WebSite met name en url',
            'fix' => 'Voeg WebSite toe met de naam van de website en het adres van de homepage, het liefst op de homepage. Google toont deze naam boven het zoekresultaat in plaats van het domein.',
            'notes' => [
                'ok' => 'De sitenaam is ingesteld.',
                'required' => 'Verplichte velden ontbreken.',
                'recommended' => 'De verplichte velden zijn er; alternateName, een korte of alternatieve naam, ontbreekt.',
                'absent' => 'Er staat geen WebSite op de pagina.',
            ],
        ],
        'R3' => [
            'title' => 'Is het kruimelpad opgemaakt?',
            'text' => 'BreadcrumbList',
            'fix' => 'Elke stap van het kruimelpad heeft een positie (1, 2, 3…) en een naam nodig; elke stap behalve de laatste heeft in item het adres nodig waar hij naartoe leidt.',
            'notes' => [
                'ok' => 'Gevonden kruimelpaden: :count, alle stappen zijn ingevuld.',
                'required' => 'Sommige stappen missen een positie, een naam of een adres.',
                'recommended' => 'Enkele aanbevolen velden ontbreken.',
                'absent' => 'Er staat geen kruimelpad op de pagina.',
            ],
        ],
        'R4' => [
            'title' => 'Is het product klaar voor Google?',
            'text' => 'Product met aanbod, review of beoordeling',
            'fix' => 'Een product heeft een naam nodig en minstens een van offers, review of aggregateRating. Een aanbod heeft price en priceCurrency nodig. Voeg afbeelding, beschrijving, merk, artikelnummer of barcode (gtin) en beschikbaarheid toe: Google toont ze in de zoekresultaten en in Shopping.',
            'notes' => [
                'ok' => 'Gevonden producten: :count, met alle verplichte en aanbevolen velden.',
                'required' => 'Verplichte velden ontbreken: Google toont het product niet als rich result.',
                'recommended' => 'De verplichte velden zijn er; aanbevolen velden ontbreken.',
                'absent' => 'Er staat geen Product op de pagina.',
            ],
        ],
        'R5' => [
            'title' => 'Worden de beoordelingssterren getoond?',
            'text' => 'Review of AggregateRating',
            'fix' => 'Een beoordeling heeft ratingValue en het aantal beoordelingen nodig (ratingCount of reviewCount); een review een auteur en reviewRating. Een beoordeling buiten een product moet in itemReviewed zeggen wat ze beoordeelt. Google toont geen sterren voor reviews die een bedrijf over zichzelf schrijft.',
            'notes' => [
                'ok' => 'Gevonden reviews en beoordelingen: :count, correct ingevuld.',
                'required' => 'Verplichte velden ontbreken: er komen geen sterren.',
                'recommended' => 'De verplichte velden zijn er; aanbevolen velden ontbreken.',
                'absent' => 'Er staan geen reviews of beoordelingen op de pagina.',
            ],
        ],
        'R6' => [
            'title' => 'Is het artikel beschreven?',
            'text' => 'Article, NewsArticle of BlogPosting',
            'fix' => 'Geef het artikel een kop, een afbeelding, de publicatie- en wijzigingsdatum en een auteur met naam. Google gebruikt ze in Topverhalen, Discover en de zoekresultaten.',
            'notes' => [
                'ok' => 'Gevonden artikelen: :count, met alle aanbevolen velden.',
                'required' => 'De kop ontbreekt.',
                'recommended' => 'De kop is er; aanbevolen velden ontbreken.',
                'absent' => 'Er staat geen artikel op de pagina.',
            ],
        ],
        'R7' => [
            'title' => 'Zijn vragen en antwoorden opgemaakt?',
            'text' => 'FAQPage',
            'fix' => 'Elke vraag in mainEntity heeft de tekst nodig in name en een antwoord in acceptedAnswer.text. Sinds 2023 toont Google FAQ-rich results alleen op bekende overheids- en gezondheidswebsites, maar de opmaak helpt nog steeds andere zoekmachines en AI-assistenten.',
            'notes' => [
                'ok' => 'De FAQ-opmaak is correct. Houd er rekening mee dat Google die alleen voor overheids- en gezondheidswebsites als rich result toont.',
                'required' => 'Sommige vragen missen de tekst of het antwoord.',
                'recommended' => 'Enkele aanbevolen velden ontbreken.',
                'absent' => 'Er staat geen FAQPage op de pagina.',
            ],
        ],
        'R8' => [
            'title' => 'Is het evenement klaar voor Google?',
            'text' => 'Event met datum en plaats',
            'fix' => 'Een evenement heeft een naam nodig, een startdatum met tijd en een plaats met adres (of VirtualLocation voor een online evenement). Voeg einddatum, status, afbeelding, beschrijving, tickets en organisator toe.',
            'notes' => [
                'ok' => 'Gevonden evenementen: :count, met alle verplichte en aanbevolen velden.',
                'required' => 'Verplichte velden ontbreken: Google toont het evenement niet.',
                'recommended' => 'De verplichte velden zijn er; aanbevolen velden ontbreken.',
                'absent' => 'Er staat geen Event op de pagina.',
            ],
        ],
    ],
];
