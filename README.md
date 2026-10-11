# Tugas Rutin 10 — Blog CRUD Laravel
Implementasi CRUD Blog Laravel sesuai requirement **Tugas Pertemuan 10**.

## 📋 Checklist Requirement Wajib

| # | Requirement | Ada di file |
|---|---|---|
| 1 | `Route::resource('posts')` + named routes | `routes/web.php` |
| 2 | PostController resource (7 method) | `app/Http/Controllers/PostController.php` |
| 3 | Blade layout master + `@extends` / `@yield` | `resources/views/layouts/app.blade.php` |
| 4 | Minimal 2 komponen (Alert, Card) | `resources/views/components/` |
| 5 | Validasi + error per field + old input | `PostController` (method store & update) + view create/edit |
| 6 | Flash message sukses/gagal | `PostController` (`->with('success'/'error', ...)`) + `<x-alert>` |
| 7 | `@csrf` semua form + `@method` PUT/DELETE | semua file di `resources/views/posts/` |
| 8 | Route Model Binding + pagination | `PostController` (`Post $post`, `->paginate(5)`) |

## 🎁 Bonus yang Sudah Diimplementasikan

- **Pencarian** — kotak cari di halaman daftar (cari di judul & isi), tetap jalan bareng pagination lewat `?search=...`.
- **Soft delete** — hapus postingan tidak benar-benar menghapus baris di database, hanya mengisi kolom `deleted_at` (lewat trait `SoftDeletes` di model `Post`).
- **Upload gambar** — form tambah/edit bisa upload gambar sampul (opsional, format jpg/jpeg/png, maks 2MB).

## 🚀 Cara Menjalankan

### 1. Siapkan project Laravel

Kalau belum punya project Laravel, buat dulu (butuh PHP & Composer terpasang di komputer kamu):

```bash
composer create-project laravel/laravel TugasWeb-P10-BlogCRUD
cd TugasWeb-P10-BlogCRUD
```

### 2. Salin file dari folder ini

Salin seluruh isi folder ini ke dalam project Laravel-mu — strukturnya sudah sama persis, tinggal timpa/gabung:

```
app/Http/Controllers/PostController.php
app/Models/Post.php
database/migrations/2026_09_29_000000_create_posts_table.php
database/factories/PostFactory.php
database/seeders/PostSeeder.php
resources/views/layouts/app.blade.php
resources/views/components/alert.blade.php
resources/views/components/card.blade.php
resources/views/posts/index.blade.php
resources/views/posts/create.blade.php
resources/views/posts/edit.blade.php
resources/views/posts/show.blade.php
routes/web.php     ⚠️ ini akan MENIMPA route default bawaan Laravel
public/css/app.css
```

### 3. Atur koneksi database

Cara paling gampang, pakai SQLite. Di dalam folder project:

```bash
touch database/database.sqlite
```

Lalu buka file `.env`, ubah baris `DB_CONNECTION` jadi:

```
DB_CONNECTION=sqlite
```

(Kalau kamu lebih familiar pakai MySQL, tinggal isi `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` seperti biasa.)

### 4. Jalankan migrasi

```bash
php artisan migrate
```

### 5. Buat symbolic link storage — **WAJIB** untuk fitur upload gambar

```bash
php artisan storage:link
```

> ⚠️ Kalau langkah ini dilewati, gambar yang berhasil diupload TIDAK akan muncul di browser (error 404), walaupun proses upload-nya sendiri tidak error.

### 6. (Opsional) Isi 15 data dummy — supaya pagination & pencarian langsung kelihatan hasilnya

```bash
php artisan db:seed --class=PostSeeder
```

### 7. Jalankan server

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

## 🗂️ Struktur Folder

```
TugasWeb-P10-BlogCRUD/
├── app/
│   ├── Http/Controllers/PostController.php
│   └── Models/Post.php
├── database/
│   ├── migrations/2026_09_29_000000_create_posts_table.php
│   ├── factories/PostFactory.php
│   └── seeders/PostSeeder.php
├── resources/views/
│   ├── layouts/app.blade.php       (master layout)
│   ├── components/
│   │   ├── alert.blade.php         (komponen 1)
│   │   └── card.blade.php          (komponen 2)
│   └── posts/
│       ├── index.blade.php         (daftar + cari + pagination)
│       ├── create.blade.php        (form tambah)
│       ├── edit.blade.php          (form edit)
│       └── show.blade.php          (detail)
├── routes/web.php
└── public/css/app.css
```

## 📝 Catatan Desain Kode

- **Validasi ditulis langsung di controller** (`$request->validate()`), bukan di kelas Form Request terpisah. Tujuannya supaya semua logika satu fitur (validasi, simpan, redirect) ada di satu tempat yang sama — lebih gampang dibaca dan diedit untuk tugas kuliah.
- **Komentar di `PostController.php` diberi label `[1]` sampai `[7]`** supaya gampang dicocokkan urutannya dengan requirement resource controller.
- Kalau butuh nilai tambahan, kamu bisa kembangkan: halaman khusus untuk lihat/restore postingan yang di-soft-delete, atau validasi `unique` untuk judul.
