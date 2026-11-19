<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Endereço da página',
        'button' => 'Verificar',
        'hint' => 'Grátis · sem registo · até :count verificações por hora',
    ],
    'loading' => [
        'page' => 'A carregar a página',
        'markup' => 'A ler JSON-LD e microdados',
        'checks' => 'A comparar com os requisitos dos resultados avançados do Google',
    ],
    'verdicts' => [
        'ready' => 'Os dados estruturados estão em ordem',
        'almost' => 'Os dados estruturados estão quase em ordem',
        'partly' => 'Os dados estruturados precisam de melhorias',
        'not_ready' => 'Os dados estruturados faltam ou estão partidos',
    ],
    'rich' => [
        'title' => 'Resultados avançados para os quais a página tem marcação',
        'pass' => 'Pronto',
        'warn' => 'Pronto, pode melhorar',
        'fail' => 'Tem erros',
        'none' => 'A página não tem marcação para nenhum dos resultados avançados verificados aqui.',
    ],
    'tree' => [
        'title' => 'Tudo o que foi encontrado na página (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'A marcação é legível?', 'text' => 'JSON válido, vocabulário Schema.org, tipos reais, formatos dos valores'],
        'R' => ['title' => 'Resultados avançados do Google', 'text' => 'Os campos que o Google exige para cada tipo encontrado na página'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'A página tem dados estruturados?',
            'text' => 'JSON-LD ou microdados legíveis',
            'fix' => 'Adicione um bloco <script type="application/ld+json"> com uma descrição da página no vocabulário Schema.org. Confirme que é JSON válido: sem vírgula depois do último elemento, só aspas duplas, sem comentários.',
            'notes' => [
                'ok' => 'Elementos JSON-LD encontrados: :json_ld, elementos de microdados: :microdata.',
                'none' => 'A página não tem dados estruturados: os motores de busca e os assistentes de IA têm de adivinhar do que trata.',
                'invalid' => 'Blocos JSON-LD encontrados: :count, mas nenhum é JSON válido, por isso os motores de busca ignoram-nos.',
                'some_invalid' => 'Blocos JSON-LD com JSON inválido: :count. Os motores de busca ignoram-nos.',
            ],
        ],
        'S2' => [
            'title' => 'O vocabulário é Schema.org?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Indique "@context": "https://schema.org" em cada bloco JSON-LD e, nos microdados, um itemtype que comece por https://schema.org/.',
            'notes' => [
                'ok' => 'Todos os elementos usam o vocabulário Schema.org.',
                'wrong' => 'Alguns elementos não têm @context ou usam outro vocabulário.',
                'no_items' => 'Não há dados estruturados para verificar.',
            ],
        ],
        'S3' => [
            'title' => 'Os tipos existem?',
            'text' => 'Cada @type existe no Schema.org',
            'fix' => 'Corrija a ortografia dos tipos: os nomes Schema.org distinguem maiúsculas e estão em inglês americano, por exemplo Organization e não Organisation. A seta mostra o tipo real mais próximo.',
            'notes' => [
                'ok' => 'Todos os tipos existem no Schema.org.',
                'unknown' => 'Alguns tipos não existem no Schema.org: os motores de busca ignoram esses elementos.',
                'untyped' => 'Elementos sem @type: :count. Os motores de busca não sabem o que descrevem.',
                'no_items' => 'Não há dados estruturados para verificar.',
            ],
        ],
        'S4' => [
            'title' => 'Os valores estão no formato certo?',
            'text' => 'URLs completos, datas ISO 8601, preços em números',
            'fix' => 'Escreva os endereços completos com https://, as datas como 2026-11-14 ou 2026-11-14T09:30:00+02:00, os preços como número simples com ponto (1499.00, sem espaços nem símbolo de moeda) e a moeda com um código de 3 letras (UAH, EUR, USD).',
            'notes' => [
                'ok' => 'URLs, datas, preços e moedas estão no formato certo.',
                'problems' => 'Valores no formato errado: :count.',
                'no_items' => 'Não há dados estruturados para verificar.',
            ],
        ],
        'R1' => [
            'title' => 'A organização está descrita?',
            'text' => 'Organization ou LocalBusiness',
            'fix' => 'Descreva a empresa: nome e endereço do site; para um negócio com escritório ou loja, também a morada, o telefone e o horário. Adicione o logótipo e as ligações às redes sociais em sameAs: o Google usa-os no painel de informações.',
            'notes' => [
                'ok' => 'Organizações encontradas: :count, com todos os campos obrigatórios e recomendados.',
                'required' => 'Faltam campos obrigatórios.',
                'recommended' => 'Os campos obrigatórios estão lá; faltam campos recomendados.',
                'absent' => 'Não há Organization nem LocalBusiness na página.',
            ],
        ],
        'R2' => [
            'title' => 'O nome do site está definido?',
            'text' => 'WebSite com name e url',
            'fix' => 'Adicione WebSite com o nome do site e o endereço da página inicial, de preferência na página inicial. O Google mostra este nome por cima do resultado de pesquisa em vez do domínio.',
            'notes' => [
                'ok' => 'O nome do site está definido.',
                'required' => 'Faltam campos obrigatórios.',
                'recommended' => 'Os campos obrigatórios estão lá; falta alternateName, um nome curto ou alternativo.',
                'absent' => 'Não há WebSite na página.',
            ],
        ],
        'R3' => [
            'title' => 'A navegação estrutural está marcada?',
            'text' => 'BreadcrumbList',
            'fix' => 'Cada passo da navegação estrutural precisa de uma posição (1, 2, 3…) e de um nome; cada passo, exceto o último, precisa em item do endereço para onde leva.',
            'notes' => [
                'ok' => 'Navegações estruturais encontradas: :count, todos os passos estão preenchidos.',
                'required' => 'A alguns passos falta a posição, o nome ou o endereço.',
                'recommended' => 'Faltam alguns campos recomendados.',
                'absent' => 'Não há navegação estrutural na página.',
            ],
        ],
        'R4' => [
            'title' => 'O produto está pronto para o Google?',
            'text' => 'Product com oferta, avaliação ou classificação',
            'fix' => 'Um produto precisa de um nome e de pelo menos um de offers, review ou aggregateRating. Uma oferta precisa de price e priceCurrency. Adicione a imagem, a descrição, a marca, a referência ou o código de barras (gtin) e a disponibilidade: o Google mostra-os nos resultados e no Shopping.',
            'notes' => [
                'ok' => 'Produtos encontrados: :count, com todos os campos obrigatórios e recomendados.',
                'required' => 'Faltam campos obrigatórios: o Google não vai mostrar o produto como resultado avançado.',
                'recommended' => 'Os campos obrigatórios estão lá; faltam campos recomendados.',
                'absent' => 'Não há Product na página.',
            ],
        ],
        'R5' => [
            'title' => 'As estrelas de classificação vão aparecer?',
            'text' => 'Review ou AggregateRating',
            'fix' => 'Uma classificação precisa de ratingValue e do número de classificações (ratingCount ou reviewCount); uma avaliação precisa de um autor e de reviewRating. Uma classificação fora de um produto tem de indicar em itemReviewed o que avalia. O Google não mostra estrelas para avaliações que uma empresa escreve sobre si própria.',
            'notes' => [
                'ok' => 'Avaliações e classificações encontradas: :count, bem preenchidas.',
                'required' => 'Faltam campos obrigatórios: as estrelas não vão aparecer.',
                'recommended' => 'Os campos obrigatórios estão lá; faltam campos recomendados.',
                'absent' => 'Não há avaliações nem classificações na página.',
            ],
        ],
        'R6' => [
            'title' => 'O artigo está descrito?',
            'text' => 'Article, NewsArticle ou BlogPosting',
            'fix' => 'Dê ao artigo um título, uma imagem, as datas de publicação e de atualização e um autor com nome. O Google usa-os em Notícias principais, Discover e nos resultados de pesquisa.',
            'notes' => [
                'ok' => 'Artigos encontrados: :count, com todos os campos recomendados.',
                'required' => 'Falta o título.',
                'recommended' => 'O título está lá; faltam campos recomendados.',
                'absent' => 'Não há nenhum artigo na página.',
            ],
        ],
        'R7' => [
            'title' => 'As perguntas e respostas estão marcadas?',
            'text' => 'FAQPage',
            'fix' => 'Cada pergunta em mainEntity precisa do texto em name e de uma resposta em acceptedAnswer.text. Desde 2023 o Google só mostra FAQ como resultado avançado em sites governamentais e de saúde conhecidos, mas a marcação continua a ajudar outros motores de busca e os assistentes de IA.',
            'notes' => [
                'ok' => 'A marcação FAQ está correta. Tenha em conta que o Google só a mostra como resultado avançado em sites governamentais e de saúde.',
                'required' => 'A algumas perguntas falta o texto ou a resposta.',
                'recommended' => 'Faltam alguns campos recomendados.',
                'absent' => 'Não há FAQPage na página.',
            ],
        ],
        'R8' => [
            'title' => 'O evento está pronto para o Google?',
            'text' => 'Event com data e local',
            'fix' => 'Um evento precisa de um nome, de data e hora de início e de um local com morada (ou VirtualLocation para um evento online). Adicione a data de fim, o estado, uma imagem, uma descrição, os bilhetes e o organizador.',
            'notes' => [
                'ok' => 'Eventos encontrados: :count, com todos os campos obrigatórios e recomendados.',
                'required' => 'Faltam campos obrigatórios: o Google não vai mostrar o evento.',
                'recommended' => 'Os campos obrigatórios estão lá; faltam campos recomendados.',
                'absent' => 'Não há Event na página.',
            ],
        ],
    ],
];
