<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# PMS (Production Management System)

🚀 **PMS** adalah aplikasi manajemen produksi yang memudahkan pengelolaan _work order_, pelacakan progres produksi, dan pembuatan laporan hasil produksi.

## 🎯 **Fitur Utama**

1. **Role-Based Access Control (RBAC)**

    - **Production Manager:** Membuat, menetapkan operator, memperbarui status, dan melihat laporan.
    - **Operator:** Melihat work order yang ditugaskan, memperbarui status, dan mencatat jumlah quantity perubahan status.

2. **Manajemen Work Order**

    - Membuat, memperbarui, dan melihat work order dengan berbagai filter.
    - Operator dapat mencatat progres produksi dan sistem akan mencatat waktu setiap status.

3. **Laporan Produksi** _(Opsional)_
    - Rekapitulasi work order berdasarkan status dan operator.

## 🛠️ **Persyaratan Sistem**

-   PHP >= 8.1
-   Composer
-   MySQL

---

## 🚧 **Instalasi**

### 1. **Clone Repository**

```bash
https://github.com/RizalPradanaaa/pms.git
cd pms
```

### 2. **Instal Dependensi**

```bash
composer install
npm install
npm run dev
```

### 3. **Konfigurasi Environment**

Salin file `.env.example` menjadi `.env` dan atur konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pms
DB_USERNAME=root
DB_PASSWORD=
```

### 4. **Generate Key**

```bash
php artisan key:generate
```

### 5. **Migrasi Database**

```bash
php artisan migrate
```

### 6. **Seed Data Pengguna**

```bash
php artisan db:seed --class=UserSeeder
```

📥 **Akun Default:**

-   **Production Manager:**
    -   Email: `manager@gmail.com`
    -   Password: `123456`
-   **Operator:**
    -   Email: `operator@gmail.com`
    -   Password: `123456`

### 7. **Menjalankan Aplikasi**

```bash
php artisan serve
```

Aplikasi akan berjalan di [http://localhost:8000](http://localhost:8000)

---

## 📂 **Struktur Direktori Utama**

-   `app/Models` - Model Eloquent
-   `database/migrations` - File migrasi database
-   `database/seeders` - Seed data pengguna

## 📄 **Lisensi**

PMS adalah proyek open-source yang dirilis di bawah lisensi [MIT](https://opensource.org/licenses/MIT).

✨ **Selamat menggunakan PMS!**
