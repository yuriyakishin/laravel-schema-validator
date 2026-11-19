<?php

return [
    'form' => [
        'label' => 'Adresse der Seite',
        'button' => 'Prüfen',
        'hint' => 'Kostenlos · ohne Anmeldung · bis zu :count Prüfungen pro Stunde',
    ],
    'loading' => [
        'page' => 'Lade die Seite',
        'markup' => 'Lese JSON-LD und Microdata',
        'checks' => 'Vergleiche mit den Anforderungen für Google-Rich-Results',
    ],
    'verdicts' => [
        'ready' => 'Die strukturierten Daten sind in Ordnung',
        'almost' => 'Die strukturierten Daten sind fast in Ordnung',
        'partly' => 'Die strukturierten Daten müssen verbessert werden',
        'not_ready' => 'Strukturierte Daten fehlen oder sind fehlerhaft',
    ],
    'rich' => [
        'title' => 'Rich Results, für die es Markup gibt',
        'pass' => 'Bereit',
        'warn' => 'Bereit, verbesserbar',
        'fail' => 'Hat Fehler',
        'none' => 'Die Seite hat kein Markup für eines der hier geprüften Rich Results.',
    ],
    'tree' => [
        'title' => 'Alles, was auf der Seite gefunden wurde (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Ist das Markup lesbar?', 'text' => 'Gültiges JSON, das Schema.org-Vokabular, echte Typen, Werteformate'],
        'R' => ['title' => 'Google-Rich-Results', 'text' => 'Die Felder, die Google für jeden gefundenen Typ verlangt'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'Hat die Seite strukturierte Daten?',
            'text' => 'Lesbares JSON-LD oder Microdata',
            'fix' => 'Fügen Sie einen Block <script type="application/ld+json"> mit einer Beschreibung der Seite im Schema.org-Vokabular hinzu. Prüfen Sie, dass es gültiges JSON ist: kein Komma nach dem letzten Element, nur doppelte Anführungszeichen, keine Kommentare.',
            'notes' => [
                'ok' => 'Gefundene JSON-LD-Elemente: :json_ld, Microdata-Elemente: :microdata.',
                'none' => 'Die Seite hat keine strukturierten Daten: Suchmaschinen und KI-Assistenten müssen raten, worum es geht.',
                'invalid' => 'Gefundene JSON-LD-Blöcke: :count, aber keiner ist gültiges JSON, daher ignorieren Suchmaschinen sie.',
                'some_invalid' => 'JSON-LD-Blöcke mit ungültigem JSON: :count. Suchmaschinen ignorieren sie.',
            ],
        ],
        'S2' => [
            'title' => 'Ist das Vokabular Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Setzen Sie "@context": "https://schema.org" in jedem JSON-LD-Block und in Microdata einen itemtype, der mit https://schema.org/ beginnt.',
            'notes' => [
                'ok' => 'Alle Elemente nutzen das Schema.org-Vokabular.',
                'wrong' => 'Einige Elemente haben keinen @context oder nutzen ein anderes Vokabular.',
                'no_items' => 'Es gibt keine strukturierten Daten zu prüfen.',
            ],
        ],
        'S3' => [
            'title' => 'Sind die Typen echt?',
            'text' => 'Jeder @type existiert in Schema.org',
            'fix' => 'Korrigieren Sie die Schreibweise der Typen: Schema.org-Namen unterscheiden Groß- und Kleinschreibung und sind amerikanisch geschrieben, z. B. Organization, nicht Organisation. Der Pfeil zeigt den nächsten echten Typ.',
            'notes' => [
                'ok' => 'Alle Typen existieren in Schema.org.',
                'unknown' => 'Einige Typen gibt es in Schema.org nicht: Suchmaschinen überspringen diese Elemente.',
                'untyped' => 'Elemente ohne @type: :count. Suchmaschinen wissen nicht, was sie beschreiben.',
                'no_items' => 'Es gibt keine strukturierten Daten zu prüfen.',
            ],
        ],
        'S4' => [
            'title' => 'Haben die Werte das richtige Format?',
            'text' => 'Vollständige URLs, ISO-8601-Daten, Preise als Zahlen',
            'fix' => 'Schreiben Sie Adressen vollständig mit https://, Daten als 2026-11-14 oder 2026-11-14T09:30:00+02:00, Preise als reine Zahl mit Punkt (1499.00, ohne Leerzeichen und Währungszeichen) und die Währung als dreibuchstabigen Code (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'URLs, Daten, Preise und Währungen haben das richtige Format.',
                'problems' => 'Werte im falschen Format: :count.',
                'no_items' => 'Es gibt keine strukturierten Daten zu prüfen.',
            ],
        ],
        'R1' => [
            'title' => 'Ist die Organisation beschrieben?',
            'text' => 'Organization oder LocalBusiness',
            'fix' => 'Beschreiben Sie das Unternehmen: Name und Website-Adresse, bei einem Geschäft mit Büro oder Laden auch Anschrift, Telefon und Öffnungszeiten. Fügen Sie das Logo und die Links zu Social-Media-Profilen in sameAs hinzu: Google nutzt sie im Knowledge Panel.',
            'notes' => [
                'ok' => 'Gefundene Organisationen: :count, mit allen Pflicht- und empfohlenen Feldern.',
                'required' => 'Pflichtfelder fehlen.',
                'recommended' => 'Die Pflichtfelder sind da; empfohlene fehlen.',
                'absent' => 'Auf der Seite gibt es keine Organization oder LocalBusiness.',
            ],
        ],
        'R2' => [
            'title' => 'Ist der Website-Name gesetzt?',
            'text' => 'WebSite mit name und url',
            'fix' => 'Fügen Sie WebSite mit dem Namen der Website und der Adresse der Startseite hinzu, am besten auf der Startseite. Google zeigt diesen Namen über dem Suchergebnis statt der Domain.',
            'notes' => [
                'ok' => 'Der Website-Name ist gesetzt.',
                'required' => 'Pflichtfelder fehlen.',
                'recommended' => 'Die Pflichtfelder sind da; alternateName, ein kurzer oder alternativer Name, fehlt.',
                'absent' => 'Auf der Seite gibt es kein WebSite.',
            ],
        ],
        'R3' => [
            'title' => 'Sind die Breadcrumbs ausgezeichnet?',
            'text' => 'BreadcrumbList',
            'fix' => 'Jeder Schritt der Breadcrumbs braucht eine Position (1, 2, 3 …) und einen Namen; jeder Schritt außer dem letzten braucht in item die Adresse, zu der er führt.',
            'notes' => [
                'ok' => 'Gefundene Breadcrumbs: :count, alle Schritte sind ausgefüllt.',
                'required' => 'Einigen Schritten fehlt Position, Name oder Adresse.',
                'recommended' => 'Einige empfohlene Felder fehlen.',
                'absent' => 'Auf der Seite gibt es keine Breadcrumbs.',
            ],
        ],
        'R4' => [
            'title' => 'Ist das Produkt bereit für Google?',
            'text' => 'Product mit Angebot, Bewertung oder Rating',
            'fix' => 'Ein Produkt braucht einen Namen und mindestens eines von offers, review oder aggregateRating. Ein Angebot braucht price und priceCurrency. Ergänzen Sie Bild, Beschreibung, Marke, Artikelnummer oder Barcode (gtin) und Verfügbarkeit: Google zeigt sie im Suchergebnis und in Shopping.',
            'notes' => [
                'ok' => 'Gefundene Produkte: :count, mit allen Pflicht- und empfohlenen Feldern.',
                'required' => 'Pflichtfelder fehlen: Google zeigt das Produkt nicht als Rich Result.',
                'recommended' => 'Die Pflichtfelder sind da; empfohlene fehlen.',
                'absent' => 'Auf der Seite gibt es kein Product.',
            ],
        ],
        'R5' => [
            'title' => 'Werden die Bewertungssterne angezeigt?',
            'text' => 'Review oder AggregateRating',
            'fix' => 'Ein Rating braucht ratingValue und die Anzahl der Bewertungen (ratingCount oder reviewCount), eine Rezension einen Autor und reviewRating. Ein Rating außerhalb eines Produkts muss in itemReviewed angeben, was bewertet wird. Google zeigt keine Sterne für Bewertungen, die ein Unternehmen über sich selbst schreibt.',
            'notes' => [
                'ok' => 'Gefundene Rezensionen und Ratings: :count, korrekt ausgefüllt.',
                'required' => 'Pflichtfelder fehlen: Es werden keine Sterne angezeigt.',
                'recommended' => 'Die Pflichtfelder sind da; empfohlene fehlen.',
                'absent' => 'Auf der Seite gibt es keine Rezensionen oder Ratings.',
            ],
        ],
        'R6' => [
            'title' => 'Ist der Artikel beschrieben?',
            'text' => 'Article, NewsArticle oder BlogPosting',
            'fix' => 'Geben Sie dem Artikel eine Überschrift, ein Bild, das Veröffentlichungs- und Änderungsdatum und den Autor mit Namen. Google nutzt sie in Top-Stories, Discover und im Suchergebnis.',
            'notes' => [
                'ok' => 'Gefundene Artikel: :count, mit allen empfohlenen Feldern.',
                'required' => 'Die Überschrift fehlt.',
                'recommended' => 'Die Überschrift ist da; empfohlene Felder fehlen.',
                'absent' => 'Auf der Seite gibt es keinen Artikel.',
            ],
        ],
        'R7' => [
            'title' => 'Sind Fragen und Antworten ausgezeichnet?',
            'text' => 'FAQPage',
            'fix' => 'Jede Frage in mainEntity braucht ihren Text in name und eine Antwort in acceptedAnswer.text. Seit 2023 zeigt Google FAQ-Rich-Results nur auf bekannten Behörden- und Gesundheitswebsites, doch das Markup hilft weiterhin anderen Suchmaschinen und KI-Assistenten.',
            'notes' => [
                'ok' => 'Das FAQ-Markup ist korrekt. Beachten Sie, dass Google es nur für Behörden- und Gesundheitswebsites als Rich Result zeigt.',
                'required' => 'Einigen Fragen fehlt der Text oder die Antwort.',
                'recommended' => 'Einige empfohlene Felder fehlen.',
                'absent' => 'Auf der Seite gibt es keine FAQPage.',
            ],
        ],
        'R8' => [
            'title' => 'Ist die Veranstaltung bereit für Google?',
            'text' => 'Event mit Datum und Ort',
            'fix' => 'Eine Veranstaltung braucht einen Namen, Startdatum mit Uhrzeit und einen Ort mit Anschrift (oder VirtualLocation für eine Online-Veranstaltung). Ergänzen Sie Enddatum, Status, Bild, Beschreibung, Tickets und Veranstalter.',
            'notes' => [
                'ok' => 'Gefundene Veranstaltungen: :count, mit allen Pflicht- und empfohlenen Feldern.',
                'required' => 'Pflichtfelder fehlen: Google zeigt die Veranstaltung nicht.',
                'recommended' => 'Die Pflichtfelder sind da; empfohlene fehlen.',
                'absent' => 'Auf der Seite gibt es kein Event.',
            ],
        ],
    ],
];
