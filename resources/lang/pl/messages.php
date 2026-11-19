<?php

return [
    'form' => [
        'label' => 'Adres strony',
        'button' => 'Sprawdź',
        'hint' => 'Za darmo · bez rejestracji · do :count sprawdzeń na godzinę',
    ],
    'loading' => [
        'page' => 'Pobieram stronę',
        'markup' => 'Odczytuję JSON-LD i mikrodane',
        'checks' => 'Porównuję z wymaganiami wyników rozszerzonych Google',
    ],
    'verdicts' => [
        'ready' => 'Dane strukturalne są w porządku',
        'almost' => 'Dane strukturalne są prawie w porządku',
        'partly' => 'Dane strukturalne trzeba poprawić',
        'not_ready' => 'Brak danych strukturalnych albo są uszkodzone',
    ],
    'rich' => [
        'title' => 'Wyniki rozszerzone, dla których strona ma znaczniki',
        'pass' => 'Gotowe',
        'warn' => 'Gotowe, można poprawić',
        'fail' => 'Są błędy',
        'none' => 'Strona nie ma znaczników dla żadnego z wyników rozszerzonych sprawdzanych tutaj.',
    ],
    'tree' => [
        'title' => 'Wszystko, co znaleziono na stronie (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Czy znaczniki da się odczytać?', 'text' => 'Poprawny JSON, słownik Schema.org, prawdziwe typy, formaty wartości'],
        'R' => ['title' => 'Wyniki rozszerzone Google', 'text' => 'Pola, których Google wymaga dla każdego typu znalezionego na stronie'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'Czy strona ma dane strukturalne?',
            'text' => 'JSON-LD lub mikrodane, które da się odczytać',
            'fix' => 'Dodaj blok <script type="application/ld+json"> z opisem strony w słowniku Schema.org. Sprawdź, czy to poprawny JSON: bez przecinka po ostatnim elemencie, tylko podwójne cudzysłowy, bez komentarzy.',
            'notes' => [
                'ok' => 'Znalezione elementy JSON-LD: :json_ld, elementy mikrodanych: :microdata.',
                'none' => 'Strona nie ma danych strukturalnych: wyszukiwarki i asystenci AI muszą zgadywać, o czym jest.',
                'invalid' => 'Znalezione bloki JSON-LD: :count, ale żaden nie jest poprawnym JSON, więc wyszukiwarki je pomijają.',
                'some_invalid' => 'Bloki JSON-LD z błędnym JSON: :count. Wyszukiwarki je pomijają.',
            ],
        ],
        'S2' => [
            'title' => 'Czy słownik to Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Ustaw "@context": "https://schema.org" w każdym bloku JSON-LD, a w mikrodanych itemtype zaczynający się od https://schema.org/.',
            'notes' => [
                'ok' => 'Wszystkie elementy używają słownika Schema.org.',
                'wrong' => 'Część elementów nie ma @context albo używa innego słownika.',
                'no_items' => 'Nie ma danych strukturalnych do sprawdzenia.',
            ],
        ],
        'S3' => [
            'title' => 'Czy typy są prawdziwe?',
            'text' => 'Każdy @type istnieje w Schema.org',
            'fix' => 'Popraw pisownię typów: nazwy Schema.org rozróżniają wielkość liter i są w amerykańskim angielskim, na przykład Organization, a nie Organisation. Strzałka pokazuje najbliższy prawdziwy typ.',
            'notes' => [
                'ok' => 'Wszystkie typy istnieją w Schema.org.',
                'unknown' => 'Części typów nie ma w Schema.org: wyszukiwarki pomijają te elementy.',
                'untyped' => 'Elementy bez @type: :count. Wyszukiwarki nie wiedzą, co opisują.',
                'no_items' => 'Nie ma danych strukturalnych do sprawdzenia.',
            ],
        ],
        'S4' => [
            'title' => 'Czy wartości mają właściwy format?',
            'text' => 'Pełne adresy URL, daty ISO 8601, ceny jako liczby',
            'fix' => 'Pisz adresy w całości z https://, daty jako 2026-11-14 lub 2026-11-14T09:30:00+02:00, ceny jako zwykłą liczbę z kropką (1499.00, bez spacji i znaku waluty), a walutę trzyliterowym kodem (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'Adresy, daty, ceny i waluty mają właściwy format.',
                'problems' => 'Wartości w złym formacie: :count.',
                'no_items' => 'Nie ma danych strukturalnych do sprawdzenia.',
            ],
        ],
        'R1' => [
            'title' => 'Czy organizacja jest opisana?',
            'text' => 'Organization lub LocalBusiness',
            'fix' => 'Opisz firmę: nazwę i adres strony, a dla firmy z biurem lub sklepem także adres pocztowy, telefon i godziny otwarcia. Dodaj logo i linki do profili społecznościowych w sameAs: Google używa ich w panelu wiedzy.',
            'notes' => [
                'ok' => 'Znalezione organizacje: :count, ze wszystkimi wymaganymi i zalecanymi polami.',
                'required' => 'Brakuje wymaganych pól.',
                'recommended' => 'Wymagane pola są; brakuje zalecanych.',
                'absent' => 'Na stronie nie ma Organization ani LocalBusiness.',
            ],
        ],
        'R2' => [
            'title' => 'Czy nazwa witryny jest ustawiona?',
            'text' => 'WebSite z name i url',
            'fix' => 'Dodaj WebSite z nazwą witryny i adresem strony głównej, najlepiej na stronie głównej. Google pokazuje tę nazwę nad wynikiem wyszukiwania zamiast domeny.',
            'notes' => [
                'ok' => 'Nazwa witryny jest ustawiona.',
                'required' => 'Brakuje wymaganych pól.',
                'recommended' => 'Wymagane pola są; brakuje alternateName, krótkiej lub alternatywnej nazwy.',
                'absent' => 'Na stronie nie ma WebSite.',
            ],
        ],
        'R3' => [
            'title' => 'Czy menu nawigacyjne (okruszki) jest oznaczone?',
            'text' => 'BreadcrumbList',
            'fix' => 'Każdy krok okruszków potrzebuje pozycji (1, 2, 3…) i nazwy, a każdy krok poza ostatnim — adresu w item, do którego prowadzi.',
            'notes' => [
                'ok' => 'Znalezione okruszki: :count, wszystkie kroki są wypełnione.',
                'required' => 'Części kroków brakuje pozycji, nazwy lub adresu.',
                'recommended' => 'Brakuje niektórych zalecanych pól.',
                'absent' => 'Na stronie nie ma okruszków.',
            ],
        ],
        'R4' => [
            'title' => 'Czy produkt jest gotowy dla Google?',
            'text' => 'Product z ofertą, opinią lub oceną',
            'fix' => 'Produkt potrzebuje nazwy i co najmniej jednego z offers, review lub aggregateRating. Oferta potrzebuje price i priceCurrency. Dodaj zdjęcie, opis, markę, kod produktu lub kod kreskowy (gtin) i dostępność: Google pokazuje je w wynikach wyszukiwania i w Zakupach.',
            'notes' => [
                'ok' => 'Znalezione produkty: :count, ze wszystkimi wymaganymi i zalecanymi polami.',
                'required' => 'Brakuje wymaganych pól: Google nie pokaże produktu jako wyniku rozszerzonego.',
                'recommended' => 'Wymagane pola są; brakuje zalecanych.',
                'absent' => 'Na stronie nie ma Product.',
            ],
        ],
        'R5' => [
            'title' => 'Czy pokażą się gwiazdki ocen?',
            'text' => 'Review lub AggregateRating',
            'fix' => 'Ocena potrzebuje ratingValue i liczby ocen (ratingCount lub reviewCount), opinia — autora i reviewRating. Ocena poza produktem musi wskazać w itemReviewed, co ocenia. Google nie pokazuje gwiazdek dla opinii, które firma pisze sama o sobie.',
            'notes' => [
                'ok' => 'Znalezione opinie i oceny: :count, wypełnione poprawnie.',
                'required' => 'Brakuje wymaganych pól: gwiazdki się nie pokażą.',
                'recommended' => 'Wymagane pola są; brakuje zalecanych.',
                'absent' => 'Na stronie nie ma opinii ani ocen.',
            ],
        ],
        'R6' => [
            'title' => 'Czy artykuł jest opisany?',
            'text' => 'Article, NewsArticle lub BlogPosting',
            'fix' => 'Podaj dla artykułu nagłówek, zdjęcie, daty publikacji i aktualizacji oraz autora z imieniem. Google używa ich w Najważniejszych artykułach, Discover i wynikach wyszukiwania.',
            'notes' => [
                'ok' => 'Znalezione artykuły: :count, ze wszystkimi zalecanymi polami.',
                'required' => 'Brakuje nagłówka.',
                'recommended' => 'Nagłówek jest; brakuje zalecanych pól.',
                'absent' => 'Na stronie nie ma artykułu.',
            ],
        ],
        'R7' => [
            'title' => 'Czy pytania i odpowiedzi są oznaczone?',
            'text' => 'FAQPage',
            'fix' => 'Każde pytanie w mainEntity potrzebuje tekstu w name i odpowiedzi w acceptedAnswer.text. Od 2023 roku Google pokazuje FAQ jako wynik rozszerzony tylko na znanych stronach rządowych i medycznych, ale znaczniki nadal pomagają innym wyszukiwarkom i asystentom AI.',
            'notes' => [
                'ok' => 'Znaczniki FAQ są poprawne. Pamiętaj, że Google pokazuje je jako wynik rozszerzony tylko dla stron rządowych i medycznych.',
                'required' => 'Części pytań brakuje tekstu lub odpowiedzi.',
                'recommended' => 'Brakuje niektórych zalecanych pól.',
                'absent' => 'Na stronie nie ma FAQPage.',
            ],
        ],
        'R8' => [
            'title' => 'Czy wydarzenie jest gotowe dla Google?',
            'text' => 'Event z datą i miejscem',
            'fix' => 'Wydarzenie potrzebuje nazwy, daty i godziny rozpoczęcia oraz miejsca z adresem (lub VirtualLocation dla wydarzenia online). Dodaj datę zakończenia, status, zdjęcie, opis, bilety i organizatora.',
            'notes' => [
                'ok' => 'Znalezione wydarzenia: :count, ze wszystkimi wymaganymi i zalecanymi polami.',
                'required' => 'Brakuje wymaganych pól: Google nie pokaże wydarzenia.',
                'recommended' => 'Wymagane pola są; brakuje zalecanych.',
                'absent' => 'Na stronie nie ma Event.',
            ],
        ],
    ],
];
