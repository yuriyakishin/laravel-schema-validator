<?php

return [
    'form' => [
        'label' => 'Dirección de la página',
        'button' => 'Comprobar',
        'hint' => 'Gratis · sin registro · hasta :count comprobaciones por hora',
    ],
    'loading' => [
        'page' => 'Cargando la página',
        'markup' => 'Leyendo JSON-LD y microdatos',
        'checks' => 'Comparando con los requisitos de los resultados enriquecidos de Google',
    ],
    'verdicts' => [
        'ready' => 'Los datos estructurados están en orden',
        'almost' => 'Los datos estructurados están casi en orden',
        'partly' => 'Los datos estructurados necesitan mejoras',
        'not_ready' => 'Faltan datos estructurados o están rotos',
    ],
    'rich' => [
        'title' => 'Resultados enriquecidos para los que la página tiene marcado',
        'pass' => 'Listo',
        'warn' => 'Listo, se puede mejorar',
        'fail' => 'Tiene errores',
        'none' => 'La página no tiene marcado para ninguno de los resultados enriquecidos que se comprueban aquí.',
    ],
    'tree' => [
        'title' => 'Todo lo encontrado en la página (:count)',
    ],
    'groups' => [
        'S' => ['title' => '¿Se puede leer el marcado?', 'text' => 'JSON válido, vocabulario Schema.org, tipos reales, formatos de valores'],
        'R' => ['title' => 'Resultados enriquecidos de Google', 'text' => 'Los campos que Google exige para cada tipo encontrado en la página'],
    ],
    'checks' => [
        'S1' => [
            'title' => '¿Tiene la página datos estructurados?',
            'text' => 'JSON-LD o microdatos que se puedan leer',
            'fix' => 'Añada un bloque <script type="application/ld+json"> con una descripción de la página en el vocabulario Schema.org. Compruebe que es JSON válido: sin coma tras el último elemento, solo comillas dobles, sin comentarios.',
            'notes' => [
                'ok' => 'Elementos JSON-LD encontrados: :json_ld, elementos de microdatos: :microdata.',
                'none' => 'La página no tiene datos estructurados: los buscadores y los asistentes de IA tienen que adivinar de qué trata.',
                'invalid' => 'Bloques JSON-LD encontrados: :count, pero ninguno es JSON válido, así que los buscadores los ignoran.',
                'some_invalid' => 'Bloques JSON-LD con JSON no válido: :count. Los buscadores los ignoran.',
            ],
        ],
        'S2' => [
            'title' => '¿El vocabulario es Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Ponga "@context": "https://schema.org" en cada bloque JSON-LD y, en microdatos, un itemtype que empiece por https://schema.org/.',
            'notes' => [
                'ok' => 'Todos los elementos usan el vocabulario Schema.org.',
                'wrong' => 'Algunos elementos no tienen @context o usan otro vocabulario.',
                'no_items' => 'No hay datos estructurados que comprobar.',
            ],
        ],
        'S3' => [
            'title' => '¿Son reales los tipos?',
            'text' => 'Cada @type existe en Schema.org',
            'fix' => 'Corrija la ortografía de los tipos: los nombres de Schema.org distinguen mayúsculas y están en inglés americano, por ejemplo Organization, no Organisation. La flecha muestra el tipo real más cercano.',
            'notes' => [
                'ok' => 'Todos los tipos existen en Schema.org.',
                'unknown' => 'Algunos tipos no existen en Schema.org: los buscadores omiten esos elementos.',
                'untyped' => 'Elementos sin @type: :count. Los buscadores no saben qué describen.',
                'no_items' => 'No hay datos estructurados que comprobar.',
            ],
        ],
        'S4' => [
            'title' => '¿Tienen los valores el formato correcto?',
            'text' => 'URL completas, fechas ISO 8601, precios en números',
            'fix' => 'Escriba las direcciones completas con https://, las fechas como 2026-11-14 o 2026-11-14T09:30:00+02:00, los precios como número simple con punto (1499.00, sin espacios ni símbolo de moneda) y la moneda con un código de 3 letras (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'Las URL, fechas, precios y monedas tienen el formato correcto.',
                'problems' => 'Valores con formato incorrecto: :count.',
                'no_items' => 'No hay datos estructurados que comprobar.',
            ],
        ],
        'R1' => [
            'title' => '¿Está descrita la organización?',
            'text' => 'Organization o LocalBusiness',
            'fix' => 'Describa la empresa: nombre y dirección del sitio; para un negocio con oficina o tienda, también la dirección postal, el teléfono y el horario. Añada el logotipo y los enlaces a redes sociales en sameAs: Google los usa en el panel de conocimiento.',
            'notes' => [
                'ok' => 'Organizaciones encontradas: :count, con todos los campos obligatorios y recomendados.',
                'required' => 'Faltan campos obligatorios.',
                'recommended' => 'Los campos obligatorios están; faltan campos recomendados.',
                'absent' => 'No hay Organization ni LocalBusiness en la página.',
            ],
        ],
        'R2' => [
            'title' => '¿Está definido el nombre del sitio?',
            'text' => 'WebSite con name y url',
            'fix' => 'Añada WebSite con el nombre del sitio y la dirección de la página de inicio, idealmente en la página de inicio. Google muestra este nombre encima del resultado de búsqueda en lugar del dominio.',
            'notes' => [
                'ok' => 'El nombre del sitio está definido.',
                'required' => 'Faltan campos obligatorios.',
                'recommended' => 'Los campos obligatorios están; falta alternateName, un nombre corto o alternativo.',
                'absent' => 'No hay WebSite en la página.',
            ],
        ],
        'R3' => [
            'title' => '¿Están marcadas las migas de pan?',
            'text' => 'BreadcrumbList',
            'fix' => 'Cada paso de las migas de pan necesita una posición (1, 2, 3…) y un nombre; cada paso salvo el último necesita en item la dirección a la que lleva.',
            'notes' => [
                'ok' => 'Migas de pan encontradas: :count, todos los pasos están completos.',
                'required' => 'A algunos pasos les falta la posición, el nombre o la dirección.',
                'recommended' => 'Faltan algunos campos recomendados.',
                'absent' => 'No hay migas de pan en la página.',
            ],
        ],
        'R4' => [
            'title' => '¿Está listo el producto para Google?',
            'text' => 'Product con oferta, reseña o valoración',
            'fix' => 'Un producto necesita un nombre y al menos uno de offers, review o aggregateRating. Una oferta necesita price y priceCurrency. Añada la imagen, la descripción, la marca, la referencia o el código de barras (gtin) y la disponibilidad: Google los muestra en los resultados y en Shopping.',
            'notes' => [
                'ok' => 'Productos encontrados: :count, con todos los campos obligatorios y recomendados.',
                'required' => 'Faltan campos obligatorios: Google no mostrará el producto como resultado enriquecido.',
                'recommended' => 'Los campos obligatorios están; faltan campos recomendados.',
                'absent' => 'No hay Product en la página.',
            ],
        ],
        'R5' => [
            'title' => '¿Se mostrarán las estrellas de valoración?',
            'text' => 'Review o AggregateRating',
            'fix' => 'Una valoración necesita ratingValue y el número de valoraciones (ratingCount o reviewCount); una reseña necesita un autor y reviewRating. Una valoración fuera de un producto debe indicar en itemReviewed qué valora. Google no muestra estrellas para las reseñas que una empresa escribe sobre sí misma.',
            'notes' => [
                'ok' => 'Reseñas y valoraciones encontradas: :count, bien completadas.',
                'required' => 'Faltan campos obligatorios: no se mostrarán estrellas.',
                'recommended' => 'Los campos obligatorios están; faltan campos recomendados.',
                'absent' => 'No hay reseñas ni valoraciones en la página.',
            ],
        ],
        'R6' => [
            'title' => '¿Está descrito el artículo?',
            'text' => 'Article, NewsArticle o BlogPosting',
            'fix' => 'Dé al artículo un titular, una imagen, las fechas de publicación y de actualización y un autor con nombre. Google los usa en Noticias destacadas, Discover y los resultados de búsqueda.',
            'notes' => [
                'ok' => 'Artículos encontrados: :count, con todos los campos recomendados.',
                'required' => 'Falta el titular.',
                'recommended' => 'El titular está; faltan campos recomendados.',
                'absent' => 'No hay ningún artículo en la página.',
            ],
        ],
        'R7' => [
            'title' => '¿Están marcadas las preguntas y respuestas?',
            'text' => 'FAQPage',
            'fix' => 'Cada pregunta de mainEntity necesita su texto en name y una respuesta en acceptedAnswer.text. Desde 2023 Google muestra las FAQ como resultado enriquecido solo en sitios conocidos de gobierno y salud, pero el marcado sigue ayudando a otros buscadores y a los asistentes de IA.',
            'notes' => [
                'ok' => 'El marcado FAQ es correcto. Tenga en cuenta que Google solo lo muestra como resultado enriquecido en sitios de gobierno y salud.',
                'required' => 'A algunas preguntas les falta el texto o la respuesta.',
                'recommended' => 'Faltan algunos campos recomendados.',
                'absent' => 'No hay FAQPage en la página.',
            ],
        ],
        'R8' => [
            'title' => '¿Está listo el evento para Google?',
            'text' => 'Event con fecha y lugar',
            'fix' => 'Un evento necesita un nombre, una fecha y hora de inicio y un lugar con dirección (o VirtualLocation para un evento en línea). Añada la fecha de fin, el estado, una imagen, una descripción, las entradas y el organizador.',
            'notes' => [
                'ok' => 'Eventos encontrados: :count, con todos los campos obligatorios y recomendados.',
                'required' => 'Faltan campos obligatorios: Google no mostrará el evento.',
                'recommended' => 'Los campos obligatorios están; faltan campos recomendados.',
                'absent' => 'No hay Event en la página.',
            ],
        ],
    ],
];
