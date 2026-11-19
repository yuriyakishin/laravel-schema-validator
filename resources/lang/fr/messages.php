<?php

return [
    'form' => [
        'label' => 'Adresse de la page',
        'button' => 'Vérifier',
        'hint' => 'Gratuit · sans inscription · jusqu\'à :count vérifications par heure',
    ],
    'loading' => [
        'page' => 'Chargement de la page',
        'markup' => 'Lecture du JSON-LD et des microdonnées',
        'checks' => 'Comparaison avec les exigences des résultats enrichis Google',
    ],
    'verdicts' => [
        'ready' => 'Les données structurées sont en ordre',
        'almost' => 'Les données structurées sont presque en ordre',
        'partly' => 'Les données structurées sont à améliorer',
        'not_ready' => 'Les données structurées manquent ou sont cassées',
    ],
    'rich' => [
        'title' => 'Résultats enrichis pour lesquels la page a un balisage',
        'pass' => 'Prêt',
        'warn' => 'Prêt, peut être amélioré',
        'fail' => 'Contient des erreurs',
        'none' => 'La page n\'a de balisage pour aucun des résultats enrichis vérifiés ici.',
    ],
    'tree' => [
        'title' => 'Tout ce qui a été trouvé sur la page (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'Le balisage est-il lisible ?', 'text' => 'JSON valide, vocabulaire Schema.org, types réels, formats des valeurs'],
        'R' => ['title' => 'Résultats enrichis Google', 'text' => 'Les champs que Google exige pour chaque type trouvé sur la page'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'La page a-t-elle des données structurées ?',
            'text' => 'Du JSON-LD ou des microdonnées lisibles',
            'fix' => 'Ajoutez un bloc <script type="application/ld+json"> décrivant la page dans le vocabulaire Schema.org. Vérifiez que c\'est du JSON valide : pas de virgule après le dernier élément, uniquement des guillemets doubles, pas de commentaires.',
            'notes' => [
                'ok' => 'Éléments JSON-LD trouvés : :json_ld, éléments de microdonnées : :microdata.',
                'none' => 'La page n\'a pas de données structurées : les moteurs de recherche et les assistants IA doivent deviner de quoi elle parle.',
                'invalid' => 'Blocs JSON-LD trouvés : :count, mais aucun n\'est du JSON valide, donc les moteurs de recherche les ignorent.',
                'some_invalid' => 'Blocs JSON-LD au JSON invalide : :count. Les moteurs de recherche les ignorent.',
            ],
        ],
        'S2' => [
            'title' => 'Le vocabulaire est-il Schema.org ?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Indiquez "@context": "https://schema.org" dans chaque bloc JSON-LD et, dans les microdonnées, un itemtype qui commence par https://schema.org/.',
            'notes' => [
                'ok' => 'Tous les éléments utilisent le vocabulaire Schema.org.',
                'wrong' => 'Certains éléments n\'ont pas de @context ou utilisent un autre vocabulaire.',
                'no_items' => 'Il n\'y a pas de données structurées à vérifier.',
            ],
        ],
        'S3' => [
            'title' => 'Les types existent-ils ?',
            'text' => 'Chaque @type existe dans Schema.org',
            'fix' => 'Corrigez l\'orthographe des types : les noms Schema.org sont sensibles à la casse et écrits à l\'américaine, par exemple Organization et non Organisation. La flèche indique le type réel le plus proche.',
            'notes' => [
                'ok' => 'Tous les types existent dans Schema.org.',
                'unknown' => 'Certains types n\'existent pas dans Schema.org : les moteurs de recherche ignorent ces éléments.',
                'untyped' => 'Éléments sans @type : :count. Les moteurs de recherche ne savent pas ce qu\'ils décrivent.',
                'no_items' => 'Il n\'y a pas de données structurées à vérifier.',
            ],
        ],
        'S4' => [
            'title' => 'Les valeurs sont-elles au bon format ?',
            'text' => 'URL complètes, dates ISO 8601, prix en nombres',
            'fix' => 'Écrivez les adresses en entier avec https://, les dates sous la forme 2026-11-14 ou 2026-11-14T09:30:00+02:00, les prix en nombre simple avec un point (1499.00, sans espaces ni symbole monétaire) et la devise en code à 3 lettres (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'Les URL, dates, prix et devises sont au bon format.',
                'problems' => 'Valeurs au mauvais format : :count.',
                'no_items' => 'Il n\'y a pas de données structurées à vérifier.',
            ],
        ],
        'R1' => [
            'title' => 'L\'organisation est-elle décrite ?',
            'text' => 'Organization ou LocalBusiness',
            'fix' => 'Décrivez l\'entreprise : nom et adresse du site ; pour un commerce avec bureau ou boutique, aussi l\'adresse postale, le téléphone et les horaires. Ajoutez le logo et les liens vers les réseaux sociaux dans sameAs : Google les utilise dans le panneau de connaissances.',
            'notes' => [
                'ok' => 'Organisations trouvées : :count, avec tous les champs obligatoires et recommandés.',
                'required' => 'Des champs obligatoires manquent.',
                'recommended' => 'Les champs obligatoires sont là ; des champs recommandés manquent.',
                'absent' => 'Il n\'y a pas d\'Organization ni de LocalBusiness sur la page.',
            ],
        ],
        'R2' => [
            'title' => 'Le nom du site est-il défini ?',
            'text' => 'WebSite avec name et url',
            'fix' => 'Ajoutez WebSite avec le nom du site et l\'adresse de la page d\'accueil, idéalement sur la page d\'accueil. Google affiche ce nom au-dessus du résultat de recherche à la place du domaine.',
            'notes' => [
                'ok' => 'Le nom du site est défini.',
                'required' => 'Des champs obligatoires manquent.',
                'recommended' => 'Les champs obligatoires sont là ; il manque alternateName, un nom court ou alternatif.',
                'absent' => 'Il n\'y a pas de WebSite sur la page.',
            ],
        ],
        'R3' => [
            'title' => 'Le fil d\'Ariane est-il balisé ?',
            'text' => 'BreadcrumbList',
            'fix' => 'Chaque étape du fil d\'Ariane a besoin d\'une position (1, 2, 3…) et d\'un nom ; chaque étape sauf la dernière a besoin, dans item, de l\'adresse vers laquelle elle mène.',
            'notes' => [
                'ok' => 'Fils d\'Ariane trouvés : :count, toutes les étapes sont remplies.',
                'required' => 'Il manque à certaines étapes une position, un nom ou une adresse.',
                'recommended' => 'Certains champs recommandés manquent.',
                'absent' => 'Il n\'y a pas de fil d\'Ariane sur la page.',
            ],
        ],
        'R4' => [
            'title' => 'Le produit est-il prêt pour Google ?',
            'text' => 'Product avec une offre, un avis ou une note',
            'fix' => 'Un produit a besoin d\'un nom et d\'au moins un élément parmi offers, review ou aggregateRating. Une offre a besoin de price et priceCurrency. Ajoutez l\'image, la description, la marque, la référence ou le code-barres (gtin) et la disponibilité : Google les affiche dans les résultats et dans Shopping.',
            'notes' => [
                'ok' => 'Produits trouvés : :count, avec tous les champs obligatoires et recommandés.',
                'required' => 'Des champs obligatoires manquent : Google n\'affichera pas le produit en résultat enrichi.',
                'recommended' => 'Les champs obligatoires sont là ; des champs recommandés manquent.',
                'absent' => 'Il n\'y a pas de Product sur la page.',
            ],
        ],
        'R5' => [
            'title' => 'Les étoiles de notation s\'afficheront-elles ?',
            'text' => 'Review ou AggregateRating',
            'fix' => 'Une note a besoin de ratingValue et du nombre de notes (ratingCount ou reviewCount) ; un avis a besoin d\'un auteur et de reviewRating. Une note hors d\'un produit doit indiquer dans itemReviewed ce qu\'elle évalue. Google n\'affiche pas d\'étoiles pour les avis qu\'une entreprise écrit sur elle-même.',
            'notes' => [
                'ok' => 'Avis et notes trouvés : :count, correctement remplis.',
                'required' => 'Des champs obligatoires manquent : les étoiles ne s\'afficheront pas.',
                'recommended' => 'Les champs obligatoires sont là ; des champs recommandés manquent.',
                'absent' => 'Il n\'y a ni avis ni note sur la page.',
            ],
        ],
        'R6' => [
            'title' => 'L\'article est-il décrit ?',
            'text' => 'Article, NewsArticle ou BlogPosting',
            'fix' => 'Donnez à l\'article un titre, une image, les dates de publication et de mise à jour et un auteur avec son nom. Google les utilise dans À la une, Discover et les résultats de recherche.',
            'notes' => [
                'ok' => 'Articles trouvés : :count, avec tous les champs recommandés.',
                'required' => 'Le titre manque.',
                'recommended' => 'Le titre est là ; des champs recommandés manquent.',
                'absent' => 'Il n\'y a pas d\'article sur la page.',
            ],
        ],
        'R7' => [
            'title' => 'Les questions et réponses sont-elles balisées ?',
            'text' => 'FAQPage',
            'fix' => 'Chaque question de mainEntity a besoin de son texte dans name et d\'une réponse dans acceptedAnswer.text. Depuis 2023, Google n\'affiche les FAQ en résultat enrichi que sur des sites gouvernementaux et de santé connus, mais le balisage aide toujours les autres moteurs et les assistants IA.',
            'notes' => [
                'ok' => 'Le balisage FAQ est correct. Notez que Google ne l\'affiche en résultat enrichi que pour les sites gouvernementaux et de santé.',
                'required' => 'Il manque à certaines questions le texte ou la réponse.',
                'recommended' => 'Certains champs recommandés manquent.',
                'absent' => 'Il n\'y a pas de FAQPage sur la page.',
            ],
        ],
        'R8' => [
            'title' => 'L\'événement est-il prêt pour Google ?',
            'text' => 'Event avec une date et un lieu',
            'fix' => 'Un événement a besoin d\'un nom, d\'une date et heure de début et d\'un lieu avec une adresse (ou VirtualLocation pour un événement en ligne). Ajoutez la date de fin, le statut, une image, une description, les billets et l\'organisateur.',
            'notes' => [
                'ok' => 'Événements trouvés : :count, avec tous les champs obligatoires et recommandés.',
                'required' => 'Des champs obligatoires manquent : Google n\'affichera pas l\'événement.',
                'recommended' => 'Les champs obligatoires sont là ; des champs recommandés manquent.',
                'absent' => 'Il n\'y a pas d\'Event sur la page.',
            ],
        ],
    ],
];
