<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => '页面地址',
        'button' => '检查',
        'hint' => '免费 · 无需注册 · 每小时最多 :count 次',
    ],
    'loading' => [
        'page' => '正在加载页面',
        'markup' => '正在读取 JSON-LD 和微数据',
        'checks' => '正在对照 Google 富媒体搜索结果的要求',
    ],
    'verdicts' => [
        'ready' => '结构化数据没有问题',
        'almost' => '结构化数据基本没有问题',
        'partly' => '结构化数据需要改进',
        'not_ready' => '缺少结构化数据或数据已损坏',
    ],
    'rich' => [
        'title' => '页面已有标记的富媒体结果',
        'pass' => '已就绪',
        'warn' => '已就绪，可改进',
        'fail' => '有错误',
        'none' => '页面没有这里检查的任何一种富媒体结果的标记。',
    ],
    'tree' => [
        'title' => '页面上找到的全部内容（:count）',
    ],
    'groups' => [
        'S' => ['title' => '标记能被读取吗？', 'text' => '有效的 JSON、Schema.org 词汇、真实存在的类型、值的格式'],
        'R' => ['title' => 'Google 富媒体结果', 'text' => 'Google 对页面上每种类型要求的字段'],
    ],
    'checks' => [
        'S1' => [
            'title' => '页面有结构化数据吗？',
            'text' => '可读取的 JSON-LD 或微数据',
            'fix' => '添加一个 <script type="application/ld+json"> 块，用 Schema.org 词汇描述页面。确认它是有效的 JSON：最后一个元素后没有逗号，只用双引号，没有注释。',
            'notes' => [
                'ok' => '找到 JSON-LD 项目：:json_ld 个，微数据项目：:microdata 个。',
                'none' => '页面没有结构化数据：搜索引擎和 AI 助手只能猜测它的内容。',
                'invalid' => '找到 JSON-LD 块：:count 个，但没有一个是有效的 JSON，因此搜索引擎会忽略它们。',
                'some_invalid' => 'JSON 无效的 JSON-LD 块：:count 个。搜索引擎会忽略它们。',
            ],
        ],
        'S2' => [
            'title' => '词汇是 Schema.org 吗？',
            'text' => '"@context": "https://schema.org"',
            'fix' => '在每个 JSON-LD 块中设置 "@context": "https://schema.org"，在微数据中使用以 https://schema.org/ 开头的 itemtype。',
            'notes' => [
                'ok' => '所有项目都使用 Schema.org 词汇。',
                'wrong' => '部分项目没有 @context 或使用了其他词汇。',
                'no_items' => '没有可检查的结构化数据。',
            ],
        ],
        'S3' => [
            'title' => '类型真实存在吗？',
            'text' => '每个 @type 都存在于 Schema.org',
            'fix' => '修正类型的拼写：Schema.org 名称区分大小写，并使用美式拼写，例如 Organization 而不是 Organisation。箭头指向最接近的真实类型。',
            'notes' => [
                'ok' => '所有类型都存在于 Schema.org。',
                'unknown' => '部分类型在 Schema.org 中不存在：搜索引擎会跳过这些项目。',
                'untyped' => '没有 @type 的项目：:count 个。搜索引擎不知道它们描述的是什么。',
                'no_items' => '没有可检查的结构化数据。',
            ],
        ],
        'S4' => [
            'title' => '值的格式正确吗？',
            'text' => '完整的 URL、ISO 8601 日期、数字价格',
            'fix' => '地址以 https:// 开头写完整，日期写成 2026-11-14 或 2026-11-14T09:30:00+02:00，价格写成带小数点的纯数字（1499.00，不带空格和货币符号），货币用 3 个字母的代码（CNY、USD、EUR）。',
            'notes' => [
                'ok' => 'URL、日期、价格和货币的格式都正确。',
                'problems' => '格式错误的值：:count 个。',
                'no_items' => '没有可检查的结构化数据。',
            ],
        ],
        'R1' => [
            'title' => '组织信息描述了吗？',
            'text' => 'Organization 或 LocalBusiness',
            'fix' => '描述公司：名称和网站地址；有办公室或门店的商家还需要地址、电话和营业时间。在 sameAs 中添加徽标和社交账号链接：Google 会在知识面板中使用它们。',
            'notes' => [
                'ok' => '找到组织：:count 个，必需字段和推荐字段齐全。',
                'required' => '缺少必需字段。',
                'recommended' => '必需字段齐全，但缺少推荐字段。',
                'absent' => '页面上没有 Organization 或 LocalBusiness。',
            ],
        ],
        'R2' => [
            'title' => '设置了网站名称吗？',
            'text' => '带 name 和 url 的 WebSite',
            'fix' => '添加带网站名称和首页地址的 WebSite，最好放在首页。Google 会在搜索结果上方用这个名称代替域名。',
            'notes' => [
                'ok' => '已设置网站名称。',
                'required' => '缺少必需字段。',
                'recommended' => '必需字段齐全，但缺少 alternateName（简称或别名）。',
                'absent' => '页面上没有 WebSite。',
            ],
        ],
        'R3' => [
            'title' => '面包屑导航有标记吗？',
            'text' => 'BreadcrumbList',
            'fix' => '面包屑的每一步都需要位置（1、2、3…）和名称；除最后一步外，每一步还需要在 item 中给出它指向的地址。',
            'notes' => [
                'ok' => '找到面包屑：:count 个，所有步骤都已填写。',
                'required' => '部分步骤缺少位置、名称或地址。',
                'recommended' => '缺少部分推荐字段。',
                'absent' => '页面上没有面包屑。',
            ],
        ],
        'R4' => [
            'title' => '商品适合 Google 展示吗？',
            'text' => '带报价、评价或评分的 Product',
            'fix' => '商品需要名称，以及 offers、review 或 aggregateRating 中的至少一项。报价需要 price 和 priceCurrency。请补充图片、描述、品牌、SKU 或条形码（gtin）以及库存状态：Google 会在搜索结果和购物中展示它们。',
            'notes' => [
                'ok' => '找到商品：:count 个，必需字段和推荐字段齐全。',
                'required' => '缺少必需字段：Google 不会把商品显示为富媒体结果。',
                'recommended' => '必需字段齐全，但缺少推荐字段。',
                'absent' => '页面上没有 Product。',
            ],
        ],
        'R5' => [
            'title' => '会显示评分星级吗？',
            'text' => 'Review 或 AggregateRating',
            'fix' => '评分需要 ratingValue 和评分数量（ratingCount 或 reviewCount）；评价需要作者和 reviewRating。商品之外的评分必须在 itemReviewed 中说明评价的对象。对于商家给自己写的评价，Google 不显示星级。',
            'notes' => [
                'ok' => '找到评价和评分：:count 个，填写正确。',
                'required' => '缺少必需字段：不会显示星级。',
                'recommended' => '必需字段齐全，但缺少推荐字段。',
                'absent' => '页面上没有评价或评分。',
            ],
        ],
        'R6' => [
            'title' => '文章描述了吗？',
            'text' => 'Article、NewsArticle 或 BlogPosting',
            'fix' => '为文章提供标题、图片、发布和更新日期，以及带姓名的作者。Google 会在头条新闻、Discover 和搜索结果中使用它们。',
            'notes' => [
                'ok' => '找到文章：:count 篇，推荐字段齐全。',
                'required' => '缺少标题。',
                'recommended' => '有标题，但缺少推荐字段。',
                'absent' => '页面上没有文章。',
            ],
        ],
        'R7' => [
            'title' => '问答有标记吗？',
            'text' => 'FAQPage',
            'fix' => 'mainEntity 中的每个问题都需要在 name 中写问题文本，在 acceptedAnswer.text 中写答案。自 2023 年起，Google 只在知名的政府和健康类网站上显示 FAQ 富媒体结果，但这些标记仍对其他搜索引擎和 AI 助手有帮助。',
            'notes' => [
                'ok' => 'FAQ 标记正确。请注意，Google 只对政府和健康类网站将其显示为富媒体结果。',
                'required' => '部分问题缺少问题文本或答案。',
                'recommended' => '缺少部分推荐字段。',
                'absent' => '页面上没有 FAQPage。',
            ],
        ],
        'R8' => [
            'title' => '活动适合 Google 展示吗？',
            'text' => '带日期和地点的 Event',
            'fix' => '活动需要名称、开始日期和时间，以及带地址的地点（线上活动使用 VirtualLocation）。请补充结束日期、状态、图片、描述、门票和主办方。',
            'notes' => [
                'ok' => '找到活动：:count 个，必需字段和推荐字段齐全。',
                'required' => '缺少必需字段：Google 不会显示该活动。',
                'recommended' => '必需字段齐全，但缺少推荐字段。',
                'absent' => '页面上没有 Event。',
            ],
        ],
    ],
];
