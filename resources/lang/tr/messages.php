<?php

return [
    'form' => [
        'label' => 'Sayfa adresi',
        'button' => 'Kontrol et',
        'hint' => 'Ücretsiz · kayıt yok · saatte en fazla :count kontrol',
    ],
    'loading' => [
        'page' => 'Sayfa yükleniyor',
        'markup' => 'JSON-LD ve mikro veriler okunuyor',
        'checks' => 'Google zengin sonuç gereksinimleriyle karşılaştırılıyor',
    ],
    'verdicts' => [
        'ready' => 'Yapılandırılmış veriler düzgün',
        'almost' => 'Yapılandırılmış veriler neredeyse düzgün',
        'partly' => 'Yapılandırılmış verilerin iyileştirilmesi gerekiyor',
        'not_ready' => 'Yapılandırılmış veriler yok ya da bozuk',
    ],
    'rich' => [
        'title' => 'Sayfada işaretlemesi olan zengin sonuçlar',
        'pass' => 'Hazır',
        'warn' => 'Hazır, iyileştirilebilir',
        'fail' => 'Hatalar var',
        'none' => 'Sayfada burada kontrol edilen zengin sonuçların hiçbiri için işaretleme yok.',
    ],
    'tree' => [
        'title' => 'Sayfada bulunan her şey (:count)',
    ],
    'groups' => [
        'S' => ['title' => 'İşaretleme okunabiliyor mu?', 'text' => 'Geçerli JSON, Schema.org sözlüğü, gerçek türler, değer biçimleri'],
        'R' => ['title' => 'Google zengin sonuçları', 'text' => 'Google\'ın sayfada bulunan her tür için istediği alanlar'],
    ],
    'checks' => [
        'S1' => [
            'title' => 'Sayfada yapılandırılmış veri var mı?',
            'text' => 'Okunabilen JSON-LD ya da mikro veri',
            'fix' => 'Sayfayı Schema.org sözlüğüyle tanımlayan bir <script type="application/ld+json"> bloğu ekleyin. Geçerli JSON olduğunu kontrol edin: son öğeden sonra virgül yok, yalnızca çift tırnak, yorum yok.',
            'notes' => [
                'ok' => 'Bulunan JSON-LD öğeleri: :json_ld, mikro veri öğeleri: :microdata.',
                'none' => 'Sayfada yapılandırılmış veri yok: arama motorları ve yapay zekâ asistanları sayfanın ne hakkında olduğunu tahmin etmek zorunda.',
                'invalid' => 'Bulunan JSON-LD blokları: :count, ama hiçbiri geçerli JSON değil, bu yüzden arama motorları onları yok sayıyor.',
                'some_invalid' => 'Geçersiz JSON içeren JSON-LD blokları: :count. Arama motorları onları yok sayıyor.',
            ],
        ],
        'S2' => [
            'title' => 'Sözlük Schema.org mu?',
            'text' => '"@context": "https://schema.org"',
            'fix' => 'Her JSON-LD bloğunda "@context": "https://schema.org", mikro veride ise https://schema.org/ ile başlayan bir itemtype belirtin.',
            'notes' => [
                'ok' => 'Tüm öğeler Schema.org sözlüğünü kullanıyor.',
                'wrong' => 'Bazı öğelerde @context yok ya da başka bir sözlük kullanılıyor.',
                'no_items' => 'Kontrol edilecek yapılandırılmış veri yok.',
            ],
        ],
        'S3' => [
            'title' => 'Türler gerçek mi?',
            'text' => 'Her @type Schema.org\'da var',
            'fix' => 'Türlerin yazımını düzeltin: Schema.org adları büyük-küçük harfe duyarlıdır ve Amerikan İngilizcesiyle yazılır, örneğin Organisation değil Organization. Ok en yakın gerçek türü gösterir.',
            'notes' => [
                'ok' => 'Tüm türler Schema.org\'da var.',
                'unknown' => 'Bazı türler Schema.org\'da yok: arama motorları bu öğeleri atlıyor.',
                'untyped' => '@type olmayan öğeler: :count. Arama motorları neyi tanımladıklarını bilmiyor.',
                'no_items' => 'Kontrol edilecek yapılandırılmış veri yok.',
            ],
        ],
        'S4' => [
            'title' => 'Değerler doğru biçimde mi?',
            'text' => 'Tam URL\'ler, ISO 8601 tarihler, sayı olarak fiyatlar',
            'fix' => 'Adresleri https:// ile tam yazın, tarihleri 2026-11-14 veya 2026-11-14T09:30:00+02:00 şeklinde, fiyatları noktalı düz sayı olarak (1499.00, boşluk ve para birimi işareti olmadan) ve para birimini 3 harfli kodla (UAH, EUR, USD) yazın.',
            'notes' => [
                'ok' => 'URL\'ler, tarihler, fiyatlar ve para birimleri doğru biçimde.',
                'problems' => 'Yanlış biçimdeki değerler: :count.',
                'no_items' => 'Kontrol edilecek yapılandırılmış veri yok.',
            ],
        ],
        'R1' => [
            'title' => 'Kuruluş tanımlanmış mı?',
            'text' => 'Organization veya LocalBusiness',
            'fix' => 'Şirketi tanımlayın: adı ve site adresi; ofisi ya da mağazası olan bir işletme için posta adresi, telefon ve çalışma saatleri de. Logoyu ve sosyal medya profillerinin bağlantılarını sameAs içine ekleyin: Google bunları bilgi panelinde kullanır.',
            'notes' => [
                'ok' => 'Bulunan kuruluşlar: :count, tüm zorunlu ve önerilen alanlarla.',
                'required' => 'Zorunlu alanlar eksik.',
                'recommended' => 'Zorunlu alanlar var; önerilen alanlar eksik.',
                'absent' => 'Sayfada Organization veya LocalBusiness yok.',
            ],
        ],
        'R2' => [
            'title' => 'Site adı ayarlanmış mı?',
            'text' => 'name ve url içeren WebSite',
            'fix' => 'Site adını ve ana sayfa adresini içeren bir WebSite ekleyin, tercihen ana sayfaya. Google bu adı arama sonucunun üstünde alan adı yerine gösterir.',
            'notes' => [
                'ok' => 'Site adı ayarlanmış.',
                'required' => 'Zorunlu alanlar eksik.',
                'recommended' => 'Zorunlu alanlar var; kısa ya da alternatif ad olan alternateName eksik.',
                'absent' => 'Sayfada WebSite yok.',
            ],
        ],
        'R3' => [
            'title' => 'İçerik haritası işaretlenmiş mi?',
            'text' => 'BreadcrumbList',
            'fix' => 'İçerik haritasının her adımı bir konum (1, 2, 3…) ve bir ad ister; sonuncusu dışındaki her adım, götürdüğü adresi item içinde ister.',
            'notes' => [
                'ok' => 'Bulunan içerik haritaları: :count, tüm adımlar dolu.',
                'required' => 'Bazı adımlarda konum, ad ya da adres eksik.',
                'recommended' => 'Bazı önerilen alanlar eksik.',
                'absent' => 'Sayfada içerik haritası yok.',
            ],
        ],
        'R4' => [
            'title' => 'Ürün Google için hazır mı?',
            'text' => 'Teklif, yorum veya puan içeren Product',
            'fix' => 'Bir ürün bir ad ve offers, review ya da aggregateRating alanlarından en az birini ister. Bir teklif price ve priceCurrency ister. Görseli, açıklamayı, markayı, stok kodunu ya da barkodu (gtin) ve stok durumunu ekleyin: Google bunları arama sonuçlarında ve Alışveriş\'te gösterir.',
            'notes' => [
                'ok' => 'Bulunan ürünler: :count, tüm zorunlu ve önerilen alanlarla.',
                'required' => 'Zorunlu alanlar eksik: Google ürünü zengin sonuç olarak göstermez.',
                'recommended' => 'Zorunlu alanlar var; önerilen alanlar eksik.',
                'absent' => 'Sayfada Product yok.',
            ],
        ],
        'R5' => [
            'title' => 'Puan yıldızları görünecek mi?',
            'text' => 'Review veya AggregateRating',
            'fix' => 'Bir puan ratingValue ve puan sayısını (ratingCount veya reviewCount), bir yorum ise yazar ve reviewRating ister. Bir ürünün dışındaki puan, neyi puanladığını itemReviewed içinde belirtmelidir. Google, bir işletmenin kendisi hakkında yazdığı yorumlar için yıldız göstermez.',
            'notes' => [
                'ok' => 'Bulunan yorumlar ve puanlar: :count, doğru doldurulmuş.',
                'required' => 'Zorunlu alanlar eksik: yıldızlar görünmeyecek.',
                'recommended' => 'Zorunlu alanlar var; önerilen alanlar eksik.',
                'absent' => 'Sayfada yorum ya da puan yok.',
            ],
        ],
        'R6' => [
            'title' => 'Makale tanımlanmış mı?',
            'text' => 'Article, NewsArticle veya BlogPosting',
            'fix' => 'Makaleye bir başlık, bir görsel, yayın ve güncelleme tarihleri ve adıyla bir yazar verin. Google bunları Önemli haberler, Discover ve arama sonuçlarında kullanır.',
            'notes' => [
                'ok' => 'Bulunan makaleler: :count, tüm önerilen alanlarla.',
                'required' => 'Başlık eksik.',
                'recommended' => 'Başlık var; önerilen alanlar eksik.',
                'absent' => 'Sayfada makale yok.',
            ],
        ],
        'R7' => [
            'title' => 'Sorular ve cevaplar işaretlenmiş mi?',
            'text' => 'FAQPage',
            'fix' => 'mainEntity içindeki her soru, metnini name içinde ve bir cevabı acceptedAnswer.text içinde ister. Google 2023\'ten beri SSS zengin sonuçlarını yalnızca tanınmış devlet ve sağlık sitelerinde gösteriyor, ama işaretleme diğer arama motorlarına ve yapay zekâ asistanlarına yine de yardımcı olur.',
            'notes' => [
                'ok' => 'SSS işaretlemesi doğru. Google\'ın bunu zengin sonuç olarak yalnızca devlet ve sağlık sitelerinde gösterdiğini unutmayın.',
                'required' => 'Bazı sorularda metin ya da cevap eksik.',
                'recommended' => 'Bazı önerilen alanlar eksik.',
                'absent' => 'Sayfada FAQPage yok.',
            ],
        ],
        'R8' => [
            'title' => 'Etkinlik Google için hazır mı?',
            'text' => 'Tarihi ve yeri olan Event',
            'fix' => 'Bir etkinlik bir ad, başlangıç tarihi ve saati ve adresi olan bir yer (çevrim içi etkinlik için VirtualLocation) ister. Bitiş tarihini, durumu, görseli, açıklamayı, biletleri ve düzenleyeni ekleyin.',
            'notes' => [
                'ok' => 'Bulunan etkinlikler: :count, tüm zorunlu ve önerilen alanlarla.',
                'required' => 'Zorunlu alanlar eksik: Google etkinliği göstermez.',
                'recommended' => 'Zorunlu alanlar var; önerilen alanlar eksik.',
                'absent' => 'Sayfada Event yok.',
            ],
        ],
    ],
];
