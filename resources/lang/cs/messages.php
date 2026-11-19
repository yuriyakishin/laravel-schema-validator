<?php

return [
    'form' => [
        'label' => 'Adresa stránky',
        'button' => 'Zkontrolovat',
        'hint' => 'Zdarma · bez registrace · až :count kontrol za hodinu',
    ],
    'loading' => [
        'page' => 'Načítám stránku',
        'markup' => 'Čtu JSON-LD a mikrodata',
        'checks' => 'Porovnávám s požadavky na rozšířené výsledky Google',
    ],
    'verdicts' => [
        'ready' => 'Strukturovaná data jsou v pořádku',
        'almost' => 'Strukturovaná data jsou téměř v pořádku',
        'partly' => 'Strukturovaná data je třeba zlepšit',
        'not_ready' => 'Strukturovaná data chybí nebo jsou rozbitá',
    ],
    'rich' => [
        'title' => 'Rozšířené výsledky, pro které má stránka značky',
        'pass' => 'Připraveno',
        'warn' => 'Připraveno, lze zlepšit',
        'fail' => 'Obsahuje chyby',
        'none' => 'Stránka nemá značky pro žádný z rozšířených výsledků, které se tu kontrolují.',
    ],
    'tree' => [
        'title' => 'Vše, co se na stránce našlo (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Dají se značky přečíst?', 'text' => 'Platný JSON, slovník Schema.org, skutečné typy, formáty hodnot'],
        'R' => ['title' => 'Rozšířené výsledky Google', 'text' => 'Pole, která Google vyžaduje pro každý typ nalezený na stránce'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'Má stránka strukturovaná data?',
            'text' => 'JSON-LD nebo mikrodata, která jdou přečíst',
            'fix' => 'Přidejte blok <script type="application/ld+json"> s popisem stránky ve slovníku Schema.org. Ověřte, že jde o platný JSON: bez čárky za posledním prvkem, jen dvojité uvozovky, bez komentářů.',
            'notes' => [
                'ok' => 'Nalezené položky JSON-LD: :json_ld, položky mikrodat: :microdata.',
                'none' => 'Stránka nemá strukturovaná data: vyhledávače a AI asistenti musí hádat, o čem je.',
                'invalid' => 'Nalezené bloky JSON-LD: :count, ale žádný není platný JSON, takže je vyhledávače ignorují.',
                'some_invalid' => 'Bloky JSON-LD s neplatným JSON: :count. Vyhledávače je ignorují.',
            ],
        ],
        'S2' => [
            'title' => 'Je slovník Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Uveďte "@context": "https://schema.org" v každém bloku JSON-LD a v mikrodatech itemtype začínající https://schema.org/.',
            'notes' => [
                'ok' => 'Všechny položky používají slovník Schema.org.',
                'wrong' => 'Některé položky nemají @context nebo používají jiný slovník.',
                'no_items' => 'Nejsou tu strukturovaná data ke kontrole.',
            ],
        ],
        'S3' => [
            'title' => 'Jsou typy skutečné?',
            'text' => 'Každý @type existuje v Schema.org',
            'fix' => 'Opravte pravopis typů: názvy Schema.org rozlišují velká a malá písmena a jsou v americké angličtině, například Organization, ne Organisation. Šipka ukazuje nejbližší skutečný typ.',
            'notes' => [
                'ok' => 'Všechny typy v Schema.org existují.',
                'unknown' => 'Některé typy v Schema.org neexistují: vyhledávače tyto položky přeskakují.',
                'untyped' => 'Položky bez @type: :count. Vyhledávače nevědí, co popisují.',
                'no_items' => 'Nejsou tu strukturovaná data ke kontrole.',
            ],
        ],
        'S4' => [
            'title' => 'Mají hodnoty správný formát?',
            'text' => 'Celé URL, data ISO 8601, ceny jako čísla',
            'fix' => 'Pište adresy celé s https://, data jako 2026-11-14 nebo 2026-11-14T09:30:00+02:00, ceny jako prosté číslo s tečkou (1499.00, bez mezer a symbolu měny) a měnu třípísmenným kódem (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'Adresy, data, ceny a měny mají správný formát.',
                'problems' => 'Hodnoty ve špatném formátu: :count.',
                'no_items' => 'Nejsou tu strukturovaná data ke kontrole.',
            ],
        ],
        'R1' => [
            'title' => 'Je organizace popsaná?',
            'text' => 'Organization nebo LocalBusiness',
            'fix' => 'Popište firmu: název a adresu webu, u podniku s kanceláří nebo obchodem také poštovní adresu, telefon a otevírací dobu. Přidejte logo a odkazy na sociální sítě do sameAs: Google je používá v panelu znalostí.',
            'notes' => [
                'ok' => 'Nalezené organizace: :count, se všemi povinnými i doporučenými poli.',
                'required' => 'Chybí povinná pole.',
                'recommended' => 'Povinná pole jsou; chybí doporučená.',
                'absent' => 'Na stránce není Organization ani LocalBusiness.',
            ],
        ],
        'R2' => [
            'title' => 'Je nastavený název webu?',
            'text' => 'WebSite s name a url',
            'fix' => 'Přidejte WebSite s názvem webu a adresou úvodní stránky, nejlépe na úvodní stránce. Google zobrazuje tento název nad výsledkem vyhledávání místo domény.',
            'notes' => [
                'ok' => 'Název webu je nastavený.',
                'required' => 'Chybí povinná pole.',
                'recommended' => 'Povinná pole jsou; chybí alternateName, krátký nebo alternativní název.',
                'absent' => 'Na stránce není WebSite.',
            ],
        ],
        'R3' => [
            'title' => 'Je drobečková navigace označená?',
            'text' => 'BreadcrumbList',
            'fix' => 'Každý krok drobečkové navigace potřebuje pozici (1, 2, 3…) a název; každý krok kromě posledního potřebuje v item adresu, kam vede.',
            'notes' => [
                'ok' => 'Nalezená drobečková navigace: :count, všechny kroky jsou vyplněné.',
                'required' => 'Některým krokům chybí pozice, název nebo adresa.',
                'recommended' => 'Chybí některá doporučená pole.',
                'absent' => 'Na stránce není drobečková navigace.',
            ],
        ],
        'R4' => [
            'title' => 'Je produkt připravený pro Google?',
            'text' => 'Product s nabídkou, recenzí nebo hodnocením',
            'fix' => 'Produkt potřebuje název a alespoň jedno z offers, review nebo aggregateRating. Nabídka potřebuje price a priceCurrency. Přidejte obrázek, popis, značku, kód zboží nebo čárový kód (gtin) a dostupnost: Google je zobrazuje ve výsledcích i v Nákupech.',
            'notes' => [
                'ok' => 'Nalezené produkty: :count, se všemi povinnými i doporučenými poli.',
                'required' => 'Chybí povinná pole: Google produkt nezobrazí jako rozšířený výsledek.',
                'recommended' => 'Povinná pole jsou; chybí doporučená.',
                'absent' => 'Na stránce není Product.',
            ],
        ],
        'R5' => [
            'title' => 'Zobrazí se hvězdičky hodnocení?',
            'text' => 'Review nebo AggregateRating',
            'fix' => 'Hodnocení potřebuje ratingValue a počet hodnocení (ratingCount nebo reviewCount), recenze autora a reviewRating. Hodnocení mimo produkt musí v itemReviewed uvést, co hodnotí. Google nezobrazuje hvězdičky u recenzí, které firma píše sama o sobě.',
            'notes' => [
                'ok' => 'Nalezené recenze a hodnocení: :count, vyplněné správně.',
                'required' => 'Chybí povinná pole: hvězdičky se nezobrazí.',
                'recommended' => 'Povinná pole jsou; chybí doporučená.',
                'absent' => 'Na stránce nejsou recenze ani hodnocení.',
            ],
        ],
        'R6' => [
            'title' => 'Je článek popsaný?',
            'text' => 'Article, NewsArticle nebo BlogPosting',
            'fix' => 'Uveďte u článku titulek, obrázek, datum zveřejnění a aktualizace a autora se jménem. Google je používá v Hlavních zprávách, Discover a výsledcích vyhledávání.',
            'notes' => [
                'ok' => 'Nalezené články: :count, se všemi doporučenými poli.',
                'required' => 'Chybí titulek.',
                'recommended' => 'Titulek je; chybí doporučená pole.',
                'absent' => 'Na stránce není článek.',
            ],
        ],
        'R7' => [
            'title' => 'Jsou otázky a odpovědi označené?',
            'text' => 'FAQPage',
            'fix' => 'Každá otázka v mainEntity potřebuje text v name a odpověď v acceptedAnswer.text. Od roku 2023 Google zobrazuje FAQ jako rozšířený výsledek jen na známých vládních a zdravotnických webech, značky ale dál pomáhají jiným vyhledávačům a AI asistentům.',
            'notes' => [
                'ok' => 'Značky FAQ jsou správné. Počítejte s tím, že Google je jako rozšířený výsledek zobrazuje jen u vládních a zdravotnických webů.',
                'required' => 'Některým otázkám chybí text nebo odpověď.',
                'recommended' => 'Chybí některá doporučená pole.',
                'absent' => 'Na stránce není FAQPage.',
            ],
        ],
        'R8' => [
            'title' => 'Je akce připravená pro Google?',
            'text' => 'Event s datem a místem',
            'fix' => 'Akce potřebuje název, datum a čas začátku a místo s adresou (nebo VirtualLocation pro online akci). Přidejte datum konce, stav, obrázek, popis, vstupenky a pořadatele.',
            'notes' => [
                'ok' => 'Nalezené akce: :count, se všemi povinnými i doporučenými poli.',
                'required' => 'Chybí povinná pole: Google akci nezobrazí.',
                'recommended' => 'Povinná pole jsou; chybí doporučená.',
                'absent' => 'Na stránce není Event.',
            ],
        ],
    ],
];
