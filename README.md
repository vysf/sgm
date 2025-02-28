<p align="center"><img src="https://github.com/vysf/sgm/blob/a5dfa5b5b461e15949df21e3588996c76eba394e/public/assets/img/logo-STA-140x211.png" alt="SGM Logo"></p>

<p align="center">Made using Laravel</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Konfigurasi Filament untuk Production

Uncomment baris kode di mode `User`, cek `\app\Models\User.php`. [Source](https://filamentphp.com/docs/3.x/panels/installation#deploying-to-production)

## Upload file ke Hostingan
Tutorial upload projek laravel lewat ssh [source](https://www.youtube.com/watch?v=KtUNSjXMK1U), sekalian make terminal.
- Upload seperti biasa. Untuk install dan update dependesi pakai terminal hosting.
- Jalankan seed. Pastikan sudah buat database.
```
php artisan db:seed
```

## Konfigurasi email
Perlu authentikasi di akun google.com [menit 40:09](https://www.youtube.com/watch?v=J20l1RGyIZE)
- ubah MAIL_HOST di env dengan host google.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
