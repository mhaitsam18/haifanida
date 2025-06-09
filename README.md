# Format tambahan
```
    // MODIFIED--
    (Codingannya)
    // --MODIFIED

    OR

    {{-- MODIFIED-- --}}
    (Codingannya)
    {{-- --MODIFIED --}}

    OR ETC. tergantung bahasa pemrogramannya
```
# Format Updatean klo ada kodingan lama yang diubah
jangan diapus, tapi kodingan lamanya di jadiin komentar aja
```
    // MODIFIED--
    //Codingan lama
    (Codingannya)
    // --MODIFIED

    OR

    {{-- MODIFIED-- --}}
    {{-- codingan lama --}}
    (Codingannya)
    {{-- --MODIFIED --}}

    OR ETC. tergantung bahasa pemrogramannya
```
# SOP commit
Commit file 1 per 1, biar klo ada konflik gampang diurusnya

# SOP GITTO PULLO MERGECONFLICTO
kalau sudah menyelesaikan merge conflict harap double check kerjaan rekan yang berconflict dengan kalian
---
- pull
- taro di laragon/www
- exract env.rar di file haifanida-main
- nyalain laragon
- masukin terminal ke diektori laragon/www/haifanida-main
- cek versi php, ketik  php -v
- kata chat GPT Laravel 10 itu kurang kompatibel ama php 8.3 jadi ganti ke 8.2, 
- Buka link berikut untuk download PHP 8.2: 🔗 https://windows.php.net/download
Pilih versi "Thread Safe" sesuai dengan arsitektur Laragon-mu:
Jika Laragon 64-bit → Download "x64 Thread Safe"
Jika Laragon 32-bit → Download "x86 Thread Safe"
Ekstrak file hasil download, misalnya:
Jika kamu download php-8.2.12-Win32-vs16-x64.zip, \laragon\bin\php\php-8.2.12

- set laragon ke php 8.2, klik kanan di laragon -> PHP -> set php version ke 8.2 -> lalu restart laragon
- cek lagi php -v
-klo masi 8.3, ganti path ke system environtmen variable, di system variable, cari path, klik, lalu pencet edit, tambahin path [tergantung file laragon klean ada dimana]\laragon\bin\php\php-8.2.27-Win32-vs16-x64
- restart leptop klean
- buka vscode buka terminal masuk lagi ke direktori haifanida-main
- jalanin command composer install -> tunnggu ampe selese

DATABASE
- buka navicat bikin db baru haifanida
- buka db haifanidanya, trus klik kanan, pilih execute SQLfile, browse ke haifanida-main/database/export/haifanida pilih, trus start, nanti DB nya jadi tuh

-balik ke vscode, terminal udh di haifanida-main/php arisan serve, trus buka http://127.0.0.1:8000 di chrome, atau launch project di laragon langsung


# Meisya
- Update file create.blade.php, web.php, umroh.blade.php, AdminPaketController.php, PaketTableSeeder.php, dan Paket.php.
- Create file detail-paket.blade.php dan UmrohController.php


# el problemo
---
## dalam scope
- bagian Tambah Jemaah bagian 1(jamaah pertama) drop down untuk provinsi ada, namun dropdown kabupaten tidak muncul, sedangkan ketika tambah 1 lagi dibawahnya itu normal normal 
- ada kesalahan pada UmrahController, tidak mengambil data kabupaten, sudah di fix
- adanya vulnerability pada table berkas yang dimana tidak tersedianya kolom user_id yang mengupload file berkas tersebut yang menyebabkan tidak dapat dilakukannya pengecekan akses(apakah user yg ingin melihat preveiew adalah user yang mengupload?)
## luar scope=
- autentikasi
```
- login pakai google
- autentikasi
- jika belum ada di database -> masukin datanya ke database -> muncul terjadi kesalahan(pdhl keregister)
- wah ada di database -> masuk ke beranda dengan status member
```
