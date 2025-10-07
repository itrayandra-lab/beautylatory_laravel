<img src="https://r2cdn.perplexity.ai/pplx-full-logo-primary-dark%402x.png" style="height:64px;margin-right:32px"/>

# [https://github.com/itrayandra-lab/beautylatory_laravel](https://github.com/itrayandra-lab/beautylatory_laravel) gua mau nambahin fitur article yang seo friendly

Untuk menambahkan fitur artikel yang SEO friendly di project Laravel [https://github.com/itrayandra-lab/beautylatory_laravel], langkah utamanya adalah membuat struktur URL yang jelas (slug), mengelola meta tags, optimasi heading tag, dan bisa memakai package Laravel SEO supaya otomatis.[^1_1][^1_2][^1_3][^1_4]

### Langkah Utama SEO Friendly Article di Laravel

- Buat tabel dan model untuk `articles` beserta field seperti `title`, `slug`, `content`, `meta_description`, dan `meta_keywords` untuk optimasi SEO.[^1_5][^1_6]
- Buat slug unik dari judul menggunakan package seperti `eloquent-sluggable` agar URL-nya pendek dan mudah dibaca, misal `domain.com/article/judul-artikel`.[^1_7][^1_8][^1_9]
- Implementasikan package SEO seperti `ralphjsmit/laravel-seo` atau `SEO tools` untuk generate meta tag, OpenGraph, dan schema secara otomatis dari model article.[^1_2][^1_3][^1_4][^1_10][^1_1]
- Tambahkan setting meta tag dinamis di setiap halaman artikel dengan konten dari database, dan pastikan setiap artikel punya meta title, description, dan keywords yang relevan.[^1_11][^1_6]

```
- Struktur konten dengan heading `<h1>`, `<h2>`, dan sebagainya, serta gunakan semantic HTML5 seperti `<article>`, `<header>`, dan `<section>` agar mudah diindeks crawler Google.[^1_6][^1_5]
```

- Internal linking ke artikel lain yang relevan dan gunakan anchor text deskriptif untuk menjelaskan isi link.[^1_5]
- Optimasi gambar dengan alt text deskriptif dan ukuran yang telah dikompres.[^1_6]


### Contoh Implementasi Slug \& SEO Metadata

- Install package `eloquent-sluggable` untuk otomatis buat slug di model article:

```bash
composer require cviebrock/eloquent-sluggable
```

- Tambah method di model Artikel:

```php
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
```

- Install SEO package seperti `ralphjsmit/laravel-seo`:

```bash
composer require ralphjsmit/laravel-seo
```

- Tambahkan meta tag dinamis di Blade `article.blade.php`:

```php
<head>
    {!! seo()->for($article) !!}
</head>
```

- Tambahkan field dan method SEO di model:

```php
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Article extends Model
{
    use HasSEO;
    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: $this->meta_description,
            image: $this->image
        );
    }
}
```

```
- Pastikan struktur konten di Blade menggunakan tag `<h1>` untuk judul artikel, `<h2>` untuk subjudul, dan set alt text pada semua gambar.
```


### Best Practice Tambahan

- Buat sitemap XML secara otomatis dan konfigurasikan robots.txt di root Laravel.[^1_12][^1_13]
- Perhatikan kecepatan website dengan optimasi cache dan kompresi.
- Pastikan artikel mobile-friendly serta punya loading cepat.

Dengan menerapkan langkah tersebut, fitur artikel project Laravel akan jadi SEO friendly, mudah dioptimasi untuk Google dan search engine lain.[^1_11][^1_5][^1_6]
<span style="display:none">[^1_14][^1_15][^1_16][^1_17][^1_18][^1_19]</span>

<div align="center">⁂</div>

[^1_1]: https://github.com/ralphjsmit/laravel-seo

[^1_2]: https://laravel-news.com/laravel-seo

[^1_3]: https://madewithlaravel.com/laravel-seo

[^1_4]: https://www.dewakoding.com/open-source/optimasi-seo-laravel-dengan-seo-tools-package

[^1_5]: https://devrims.com/blog/laravel-seo-guide/

[^1_6]: https://clouddevs.com/laravel/seo-best-practices/

[^1_7]: https://dev.to/muhammadsaim/creating-seo-friendly-slugs-in-laravel-a-step-by-step-guide-1ohl

[^1_8]: https://itsolutionstuff.com/post/laravel-53-how-to-create-seo-friendly-sluggable-urlexample.html

[^1_9]: https://www.digittrix.com/scripts/creating-a-blog-with-seo-ready-urls-in-laravel

[^1_10]: https://dev.to/waynetyler/laravel-seo-tools-and-packages-4bi2

[^1_11]: https://www.plerdy.com/blog/ultimate-laravel-seo-guide/

[^1_12]: https://cmlabs.co/id-id/seo-guidelines/laravel-seo

[^1_13]: https://cmlabs.co/en-id/seo-guidelines/laravel-seo

[^1_14]: https://github.com/itrayandra-lab/beautylatory_laravel

[^1_15]: https://www.youtube.com/watch?v=_mkU7ljm1NY

[^1_16]: https://github.com/Honeystone/laravel-seo

[^1_17]: https://www.seomoves.co.uk/laravel-seo/

[^1_18]: https://ralphjsmit.com/laravel-seo-package

[^1_19]: https://laravel-news.com/laravel-seo-honeystone


---

# biar lebih jelas, ayo kita ngobrol-ngobrol dulu. Sebenernya yang mau gua buat itu ada dua fitur, fitur article, dan seo analyzer. Tapi kita fokus di fitur article dulu aja

Baik, fitur artikel di Laravel bisa dibangun step-by-step supaya jelas dan scalable. Fitur inti artikel umumnya mencakup CRUD (Create, Read, Update, Delete), slug SEO friendly, meta data artikel, serta struktur HTML yang bagus buat indeks Google.[^2_1][^2_2][^2_3][^2_4][^2_5]

### Fitur Dasar Artikel SEO Friendly

- **CRUD Article:** Bisa tambah, edit, hapus, dan tampilkan artikel lewat dashboard atau API.
- **Slug Otomatis:** URL artikel dibuat dari judul, jadi lebih ramah mesin pencari seperti `domain.com/article/judul-artikel`.[^2_3][^2_4]
- **Meta Data Dinamis:** Untuk setiap artikel disimpan meta title, meta description, dan keywords agar mudah optimasi SEO di Head.[^2_6][^2_7]
- **Konten Rich HTML:** Gunakan editor HTML (bisa pakai Trix, CKEditor, atau TinyMCE) biar penulisan artikel lebih fleksibel dan mudah formatting.[^2_8][^2_1]
- **Gambar Dengan Alt:** Upload gambar ke artikel harus bisa isi alt text sesuai isi gambar.
- **Preview \& Status:** Ada pilihan preview konten sebelum publish dan status draft/published.
- **Kategori:** Artikel bisa punya kategori/tag biar mudah dikelompokkan.

Kalau mau, bisa dibahas mulai dari struktur database, model, dan flow publish artikel dulu, sebelum masuk ke pengelolaan meta SEO atau optimasi yang lebih advance. Mau mulai dari point manapun boleh, misal dari database schema, model, atau Blade template dulu.

<div align="center">⁂</div>

[^2_1]: https://devrims.com/blog/laravel-seo-guide/

[^2_2]: https://clouddevs.com/laravel/seo-best-practices/

[^2_3]: https://dev.to/muhammadsaim/creating-seo-friendly-slugs-in-laravel-a-step-by-step-guide-1ohl

[^2_4]: https://itsolutionstuff.com/post/laravel-53-how-to-create-seo-friendly-sluggable-urlexample.html

[^2_5]: https://www.digittrix.com/scripts/creating-a-blog-with-seo-ready-urls-in-laravel

[^2_6]: https://madewithlaravel.com/laravel-seo

[^2_7]: https://github.com/ralphjsmit/laravel-seo

[^2_8]: https://www.plerdy.com/blog/ultimate-laravel-seo-guide/


---

# mungkin lu bisa kasih gua pertanyaan dulu coy

Biar proses brainstorming efektif dan hasil fitur artikel-nya sesuai kebutuhan, berikut beberapa pertanyaan pemandu sebelum mulai desain fiturnya:

### Pertanyaan Dasar sebelum Buat Fitur Artikel

1. Artikel ini akan dibuat langsung dari dashboard (backend/admin) saja atau juga dari sisi user publik (misal: guest bisa submit artikel)?
2. Data yang ingin disimpan untuk setiap artikel apa saja? (misal: judul, konten, gambar utama, kategori/tags, author, tanggal publish, status draft/publish, meta description, meta keywords, slug custom, dan lain-lain)
3. Editor artikel mau pakai rich text editor (WYSIWYG seperti TinyMCE/CKEditor) atau cukup textarea plain saja?
4. Fitur upload gambar untuk artikel perlu langsung (drag-n-drop/upload file) atau hanya dari link URL?
5. Apakah artikel harus bisa masuk kategori dan tag? Atau cukup 1 kategori saja?
6. Sistem publish-nya perlu ada status draft, scheduled (terjadwal), atau cukup published/unpublished saja?
7. Perlu preview konten sebelum publish? Atau langsung aja publish begitu submit?
8. Apakah tiap artikel perlu bisa diatur meta tag SEO sendiri (manual diisi admin) atau cukup generate otomatis dari judul dan ringkasan?
9. Perlu sistem author dan histori edit? Misal, tiap artikel ada nama penulis dan histori revisi?
10. Perlu fitur komentar di artikel atau disable dulu?

Bisa dijawab satu-satu atau dikembangkan kalau ada kebutuhan tambahan. Jawaban dari pertanyaan ini bakal ngebantu susun database, flow CRUD, dan fitur SEO-nya supaya sesuai dengan harapan.
<span style="display:none">[^3_1][^3_2][^3_3][^3_4][^3_5][^3_6][^3_7][^3_8][^3_9]</span>

<div align="center">⁂</div>

[^3_1]: https://www.guru99.com/id/laravel-interview-questions.html

[^3_2]: https://www.gamelab.id/news/2706-12-fitur-laravel-framework-php-untuk-membangun-website

[^3_3]: https://www.hostinger.com/id/tutorial/apa-itu-laravel

[^3_4]: https://www.sekawanmedia.co.id/blog/framework-laravel/

[^3_5]: https://www.dumetschool.com/blog/fitur-apa-saja-yang-baru-di-laravel-11-dan-kupas-tuntas-tutorial-belajar-laravel-11-2024

[^3_6]: https://idwebhost.com/blog/belajar-laravel/

[^3_7]: https://www.gramedia.com/literasi/laravel/

[^3_8]: https://www.petanikode.com/laravel-11/

[^3_9]: https://codepolitan.com/blog/5-helpers-laravel-yang-perlu-kamu-tau


---

# Artikel ini akan dibuat langsung dari dashboard (backend/admin) saja atau juga dari sisi user publik (misal: guest bisa submit artikel)?

dibuat langsung dari dashboard
Data yang ingin disimpan untuk setiap artikel apa saja? (misal: judul, konten, gambar utama, kategori/tags, author, tanggal publish, status draft/publish, meta description, meta keywords, slug custom, dan lain-lain)
seperti data article yang biasanya
Editor artikel mau pakai rich text editor (WYSIWYG seperti TinyMCE/CKEditor) atau cukup textarea plain saja?
rich text editor
Fitur upload gambar untuk artikel perlu langsung (drag-n-drop/upload file) atau hanya dari link URL?
langsung
Apakah artikel harus bisa masuk kategori dan tag? Atau cukup 1 kategori saja?
kategori dan tag
Sistem publish-nya perlu ada status draft, scheduled (terjadwal), atau cukup published/unpublished saja?
cukup published/unpublished
Perlu preview konten sebelum publish? Atau langsung aja publish begitu submit?
langsung publish begitu submit
Apakah tiap artikel perlu bisa diatur meta tag SEO sendiri (manual diisi admin) atau cukup generate otomatis dari judul dan ringkasan?
bisa diatur dan bisa generate otomatis
Perlu sistem author dan histori edit? Misal, tiap artikel ada nama penulis dan histori revisi?
sistem author dulu aja
Perlu fitur komentar di artikel atau disable dulu?
disable dulu

Sip, berdasarkan jawaban lo, berikut rangkuman kebutuhan fitur article versi dashboard dengan SEO friendly yang bisa dijadikan acuan desain database, model dan flow development:[^4_1][^4_2][^4_3]

### Rangkuman Fitur Artikel

- **Pembuatan \& pengelolaan artikel via dashboard/admin saja** (tidak ada user publik submit).
- **Data artikel meliputi:**
    - Judul
    - Konten (HTML, pakai rich text editor)
    - Gambar utama (upload langsung)
    - Kategori (1-to-many)
    - Tags (many-to-many)
    - Author (relasi dengan tabel user/admin)
    - Tanggal publish otomatis
    - Status (published/unpublished)
    - Slug (dibuat otomatis dari judul, bisa manual override)
    - Meta title, meta description, meta keywords (bisa diisi manual \& otomatis ter-generate)
- **Tidak perlu preview sebelum publish, artikel langsung tampil saat disimpan (publish)**
- **Upload gambar langsung dari dashboard, bukan link**
- **Fitur komentar sementara dinonaktifkan**
- **Tidak perlu histori revisi, cukup tampil nama penulis**


### Database Design Dasar

Tabel utama:

- `articles` (judul, slug, content, image, category_id, author_id, published_at, status, meta_title, meta_description, meta_keywords)
- `categories` (nama kategori)
- `tags` (nama tag)
- `article_tag` (pivot table, relasi many-to-many)
- `users` (untuk author/admin)


### Flow CRUD Artikel

- Admin login → akses artikel → buat/edit artikel baru
- Isi judul, konten (dengan rich text editor), upload gambar, pilih kategori, centang tag, masukkan meta (atau biarkan auto generate)
- Submit → artikel langsung publish (status published)
- Slug dan meta otomatis dibuat, bisa diedit manual bila perlu
- Artikel tampil di halaman publik, tanpa fitur komentar

Kalau setuju sama flow dan desain ini, tahap selanjutnya bisa lanjut ke detail struktur database migration (Laravel Migration) dan pembuatan model + relasi. Kasih konfirmasi dulu kalau desain udah sesuai, atau ada poin yang mau ditambahin/ubah.Berarti garis besarnya fitur artikel yang mau lu buat:

- Artikel dikelola hanya lewat dashboard admin, bukan user publik.
- Data yang disimpan mencakup informasi standar artikel (judul, konten, gambar, kategori, tags, author, tanggal publish, slug, dan meta data SEO).
- Editor pakai rich text editor (misal: CKEditor/TinyMCE).
- Upload gambar langsung (bukan dari link).
- Artikel bisa punya kategori \& banyak tag.
- Status cuma published/unpublished, tanpa scheduled atau draft.
- Publish otomatis tanpa preview.
- Setiap artikel bisa atur meta tag SEO sendiri (manual/otomatis).
- Ada author, tapi belum butuh histori edit.
- Komentar artikel sementara dinonaktifkan.

Kalau semua ini udah bener dan sesuai kebutuhan, nanti bisa langsung lanjut ke desain database (migration) dan arsitektur CRUD artikel di Laravel, lengkap dengan optimasi SEO di setiap entri artikel. Konfirmasi atau revisi di bagian manapun boleh, supaya langkah berikutnya makin jelas dan tepat sasaran.[^4_2][^4_3][^4_1]

<div align="center">⁂</div>

[^4_1]: https://devrims.com/blog/laravel-seo-guide/

[^4_2]: https://clouddevs.com/laravel/seo-best-practices/

[^4_3]: https://madewithlaravel.com/laravel-seo


---

# apakah semuanya sudah jelas?

Ya, desain dan kebutuhan fitur artikel yang ingin dibuat sudah jelas dan terstruktur untuk dashboard admin di Laravel, dengan optimasi SEO yang bisa diatur manual maupun otomatis. Semua poin terkait data, editor, upload, kategori, tag, publishing, meta tag, author, dan tanpa komentar sudah teridentifikasi sesuai standar sistem artikel modern. Langkah berikutnya tinggal menyiapkan struktur database dan membangun CRUD sesuai implementasi dan kebutuhan SEO friendly.Semuanya sudah jelas dan terstruktur untuk pembuatan fitur artikel: hanya lewat dashboard admin, dengan data lengkap (judul, konten, gambar, kategori, tag, author, status, slug, meta SEO), pakai rich text editor, upload gambar langsung, kategori dan tag, status publish/unpublish, meta tag bisa manual/otomatis, author, tanpa komentar, tanpa histori edit atau preview. Ini sudah sesuai standar dan siap masuk ke tahap desain database, migration, dan pembuatan flow CRUD.[^5_1][^5_2][^5_3]

<div align="center">⁂</div>

[^5_1]: https://devrims.com/blog/laravel-seo-guide/

[^5_2]: https://clouddevs.com/laravel/seo-best-practices/

[^5_3]: https://madewithlaravel.com/laravel-seo


---

# ini website beautylatorynya(yang belum implementasi fitur article) [https://beautylatory.com/](https://beautylatory.com/)

Website beautylatory.com saat ini hanya berisi halaman utama dan listing produk — belum ada fitur article/blog sama sekali, sehingga akan mudah untuk menambahkan fitur artikel dari awal sesuai desain dan kebutuhan yang sudah lo jelaskan. Kategori, tag, meta SEO, upload gambar, dan dashboard admin semuanya bisa diintegrasikan dari struktur yang masih fresh.

Selanjutnya, lo bisa mulai dari:

- Menyiapkan tabel dan model database untuk artikel, kategori, tag, dan relasi author.
- Lanjut ke migration, pembuatan CRUD di admin, dan integrasi rich text editor serta fitur upload gambar.
- Setelah itu tambahkan meta tag SEO dinamis di setiap halaman detail artikel.

Kalau siap, bisa langsung mulai dari struktur database/migration basic untuk fitur artikel ini. Mau mulai dari migration?

---

# apakah semuanya sudah jelas?

Semua kebutuhan dan flow pembuatan fitur artikel di beautylatory.com sudah sangat jelas:

- Artikel hanya dikelola via dashboard/admin, bukan oleh user publik.
- Data artikel meliputi: judul, konten (rich text), gambar utama (upload langsung), kategori, tags, author, tanggal publish, status (published/unpublished), slug, meta SEO (title, description, keywords—bisa manual atau otomatis).
- Editor menggunakan rich text (seperti CKEditor/TinyMCE).
- Upload gambar langsung via dashboard.
- Artikel bisa punya kategori dan banyak tag (relasi many-to-many).
- Status cukup published/unpublished, tanpa draft/scheduled.
- Publish langsung tanpa preview.
- Meta SEO bisa diatur manual ATAU ter-generate otomatis.
- Ada author, tapi belum perlu histori edit.
- Komentar dinonaktifkan.

Website beautylatory.com memang belum ada fitur artikel sama sekali, sehingga akan mulus implementasinya dari awal.

Kalau sudah 100% sesuai, kita bisa lanjut ke desain migration \& skema database dulu (tahap pertama coding).
Konfirmasi kalau sudah fix—atau tambahkan detail tambahan kalau ada!

