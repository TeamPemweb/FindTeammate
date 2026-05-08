<h1 align="center">
    <img src="/icon.png" width="100px">
    <br>
    <img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white">
    <img src="https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white">
</h1>

## 👨‍💻 Kontribusi

Anda dapat berkontribusi pada proyek ini dengan cara _clone_ atau _fork_ repositori ini.

## 🛠️ Pnduan Instalasi & Persiapan

Ikuti langkang-langkah di bawah ini untuk menyiapkan lingkungan pengembangan di komputer Anda.

### 1. Instal Laragon (Local Server)

Jika anda belum memiliki laragon, ikuti langkah berikut:

- Unduh **Laragon Full** melalui situs resmi: [laragon.org/download](https://laragon.org/download/).
- Jalankan installer dan ikuti petunjuknya hingga selesai.
- Setelah terinstal, buka Laragon dan klik tombol **"Start All"** untuk mengaktifkan Apache/Nginx dan MySQL.

### 2. Clone Repositori

Buka terminal (atau Git Bash), masuk ke direktori `www` milik Laragon, lalu duplikat proyek ini:

```sh
cd C:/laragon/www
git clone [https://github.com/username/nama-repo-kamu.git](https://github.com/username/nama-repo-kamu.git)
cd nama-repo-kamu
```

### 3. Instalasi Dpendensi

Jalankan perintah berikut untuk menginstal library PHP (Laravel) dan Node.js (Vue/Tailwind):

```sh
composer install
npm install
```

### 4. Langkah bikin .env

1. Duplikst file example: cp .env.example .env
2. Gemerete kunci aplikasi: php artisan key:generete
3. Buka file .env di VS Code lalu sesuaikan bagian database

    ```sh .env
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY= ...
    APP_DEBUG=true
    APP_URL=http://localhost
    ```

### 5. Warning Database

Pastikan database sudah dibuat di MySQL dengan nama yang sesuai dengan konfigurasi di file `.env`. Jika belum, buat database baru dengan nama yang sesuai.