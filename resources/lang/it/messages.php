<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Indirizzo della pagina',
        'button' => 'Verifica',
        'hint' => 'Gratis · senza registrazione · fino a :count verifiche all\'ora',
    ],
    'loading' => [
        'page' => 'Carico la pagina',
        'markup' => 'Leggo JSON-LD e microdati',
        'checks' => 'Confronto con i requisiti dei risultati multimediali di Google',
    ],
    'verdicts' => [
        'ready' => 'I dati strutturati sono in ordine',
        'almost' => 'I dati strutturati sono quasi in ordine',
        'partly' => 'I dati strutturati vanno migliorati',
        'not_ready' => 'I dati strutturati mancano o sono rotti',
    ],
    'rich' => [
        'title' => 'Risultati multimediali per cui la pagina ha il markup',
        'pass' => 'Pronto',
        'warn' => 'Pronto, migliorabile',
        'fail' => 'Ha errori',
        'none' => 'La pagina non ha markup per nessuno dei risultati multimediali verificati qui.',
    ],
    'tree' => [
        'title' => 'Tutto ciò che è stato trovato nella pagina (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Il markup è leggibile?', 'text' => 'JSON valido, vocabolario Schema.org, tipi reali, formati dei valori'],
        'R' => ['title' => 'Risultati multimediali di Google', 'text' => 'I campi che Google richiede per ogni tipo trovato nella pagina'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'La pagina ha dati strutturati?',
            'text' => 'JSON-LD o microdati leggibili',
            'fix' => 'Aggiungete un blocco <script type="application/ld+json"> con una descrizione della pagina nel vocabolario Schema.org. Controllate che sia JSON valido: niente virgola dopo l\'ultimo elemento, solo virgolette doppie, niente commenti.',
            'notes' => [
                'ok' => 'Elementi JSON-LD trovati: :json_ld, elementi di microdati: :microdata.',
                'none' => 'La pagina non ha dati strutturati: motori di ricerca e assistenti IA devono indovinare di cosa parla.',
                'invalid' => 'Blocchi JSON-LD trovati: :count, ma nessuno è JSON valido, quindi i motori di ricerca li ignorano.',
                'some_invalid' => 'Blocchi JSON-LD con JSON non valido: :count. I motori di ricerca li ignorano.',
            ],
        ],
        'S2' => [
            'title' => 'Il vocabolario è Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Indicate "@context": "https://schema.org" in ogni blocco JSON-LD e, nei microdati, un itemtype che inizi con https://schema.org/.',
            'notes' => [
                'ok' => 'Tutti gli elementi usano il vocabolario Schema.org.',
                'wrong' => 'Alcuni elementi non hanno @context o usano un altro vocabolario.',
                'no_items' => 'Non ci sono dati strutturati da verificare.',
            ],
        ],
        'S3' => [
            'title' => 'I tipi esistono?',
            'text' => 'Ogni @type esiste in Schema.org',
            'fix' => 'Correggete l\'ortografia dei tipi: i nomi Schema.org distinguono maiuscole e minuscole e sono in inglese americano, ad esempio Organization, non Organisation. La freccia indica il tipo reale più vicino.',
            'notes' => [
                'ok' => 'Tutti i tipi esistono in Schema.org.',
                'unknown' => 'Alcuni tipi non esistono in Schema.org: i motori di ricerca saltano questi elementi.',
                'untyped' => 'Elementi senza @type: :count. I motori di ricerca non sanno cosa descrivono.',
                'no_items' => 'Non ci sono dati strutturati da verificare.',
            ],
        ],
        'S4' => [
            'title' => 'I valori hanno il formato giusto?',
            'text' => 'URL completi, date ISO 8601, prezzi in numeri',
            'fix' => 'Scrivete gli indirizzi per intero con https://, le date come 2026-11-14 o 2026-11-14T09:30:00+02:00, i prezzi come numero semplice con il punto (1499.00, senza spazi né simbolo di valuta) e la valuta con un codice di 3 lettere (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'URL, date, prezzi e valute hanno il formato giusto.',
                'problems' => 'Valori nel formato sbagliato: :count.',
                'no_items' => 'Non ci sono dati strutturati da verificare.',
            ],
        ],
        'R1' => [
            'title' => 'L\'organizzazione è descritta?',
            'text' => 'Organization o LocalBusiness',
            'fix' => 'Descrivete l\'azienda: nome e indirizzo del sito; per un\'attività con ufficio o negozio anche indirizzo postale, telefono e orari. Aggiungete il logo e i link ai profili social in sameAs: Google li usa nel pannello informativo.',
            'notes' => [
                'ok' => 'Organizzazioni trovate: :count, con tutti i campi obbligatori e consigliati.',
                'required' => 'Mancano campi obbligatori.',
                'recommended' => 'I campi obbligatori ci sono; mancano campi consigliati.',
                'absent' => 'Nella pagina non c\'è Organization né LocalBusiness.',
            ],
        ],
        'R2' => [
            'title' => 'Il nome del sito è impostato?',
            'text' => 'WebSite con name e url',
            'fix' => 'Aggiungete WebSite con il nome del sito e l\'indirizzo della home page, meglio sulla home page. Google mostra questo nome sopra il risultato di ricerca al posto del dominio.',
            'notes' => [
                'ok' => 'Il nome del sito è impostato.',
                'required' => 'Mancano campi obbligatori.',
                'recommended' => 'I campi obbligatori ci sono; manca alternateName, un nome breve o alternativo.',
                'absent' => 'Nella pagina non c\'è WebSite.',
            ],
        ],
        'R3' => [
            'title' => 'Il percorso di navigazione è marcato?',
            'text' => 'BreadcrumbList',
            'fix' => 'Ogni passo del percorso di navigazione ha bisogno di una posizione (1, 2, 3…) e di un nome; ogni passo tranne l\'ultimo ha bisogno in item dell\'indirizzo a cui porta.',
            'notes' => [
                'ok' => 'Percorsi di navigazione trovati: :count, tutti i passi sono compilati.',
                'required' => 'Ad alcuni passi mancano la posizione, il nome o l\'indirizzo.',
                'recommended' => 'Mancano alcuni campi consigliati.',
                'absent' => 'Nella pagina non c\'è un percorso di navigazione.',
            ],
        ],
        'R4' => [
            'title' => 'Il prodotto è pronto per Google?',
            'text' => 'Product con offerta, recensione o valutazione',
            'fix' => 'Un prodotto ha bisogno di un nome e di almeno uno tra offers, review o aggregateRating. Un\'offerta ha bisogno di price e priceCurrency. Aggiungete immagine, descrizione, marca, codice articolo o codice a barre (gtin) e disponibilità: Google li mostra nei risultati e in Shopping.',
            'notes' => [
                'ok' => 'Prodotti trovati: :count, con tutti i campi obbligatori e consigliati.',
                'required' => 'Mancano campi obbligatori: Google non mostrerà il prodotto come risultato multimediale.',
                'recommended' => 'I campi obbligatori ci sono; mancano campi consigliati.',
                'absent' => 'Nella pagina non c\'è Product.',
            ],
        ],
        'R5' => [
            'title' => 'Si vedranno le stelle di valutazione?',
            'text' => 'Review o AggregateRating',
            'fix' => 'Una valutazione ha bisogno di ratingValue e del numero di voti (ratingCount o reviewCount); una recensione di un autore e di reviewRating. Una valutazione fuori da un prodotto deve indicare in itemReviewed cosa valuta. Google non mostra stelle per le recensioni che un\'azienda scrive su sé stessa.',
            'notes' => [
                'ok' => 'Recensioni e valutazioni trovate: :count, compilate correttamente.',
                'required' => 'Mancano campi obbligatori: le stelle non si vedranno.',
                'recommended' => 'I campi obbligatori ci sono; mancano campi consigliati.',
                'absent' => 'Nella pagina non ci sono recensioni né valutazioni.',
            ],
        ],
        'R6' => [
            'title' => 'L\'articolo è descritto?',
            'text' => 'Article, NewsArticle o BlogPosting',
            'fix' => 'Date all\'articolo un titolo, un\'immagine, le date di pubblicazione e di aggiornamento e un autore con nome. Google li usa in Notizie principali, Discover e nei risultati di ricerca.',
            'notes' => [
                'ok' => 'Articoli trovati: :count, con tutti i campi consigliati.',
                'required' => 'Manca il titolo.',
                'recommended' => 'Il titolo c\'è; mancano campi consigliati.',
                'absent' => 'Nella pagina non c\'è un articolo.',
            ],
        ],
        'R7' => [
            'title' => 'Domande e risposte sono marcate?',
            'text' => 'FAQPage',
            'fix' => 'Ogni domanda in mainEntity ha bisogno del testo in name e di una risposta in acceptedAnswer.text. Dal 2023 Google mostra le FAQ come risultato multimediale solo su siti governativi e sanitari noti, ma il markup aiuta comunque altri motori di ricerca e gli assistenti IA.',
            'notes' => [
                'ok' => 'Il markup FAQ è corretto. Tenete presente che Google lo mostra come risultato multimediale solo per siti governativi e sanitari.',
                'required' => 'Ad alcune domande mancano il testo o la risposta.',
                'recommended' => 'Mancano alcuni campi consigliati.',
                'absent' => 'Nella pagina non c\'è FAQPage.',
            ],
        ],
        'R8' => [
            'title' => 'L\'evento è pronto per Google?',
            'text' => 'Event con data e luogo',
            'fix' => 'Un evento ha bisogno di un nome, di data e ora di inizio e di un luogo con indirizzo (o VirtualLocation per un evento online). Aggiungete data di fine, stato, immagine, descrizione, biglietti e organizzatore.',
            'notes' => [
                'ok' => 'Eventi trovati: :count, con tutti i campi obbligatori e consigliati.',
                'required' => 'Mancano campi obbligatori: Google non mostrerà l\'evento.',
                'recommended' => 'I campi obbligatori ci sono; mancano campi consigliati.',
                'absent' => 'Nella pagina non c\'è Event.',
            ],
        ],
    ],
];
