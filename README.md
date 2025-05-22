# Sistem Informasi Data Pasien

Proyek ini merupakan aplikasi dashboard rumah sakit yang dibangun menggunakan Laravel. Aplikasi ini memungkinkan admin untuk:
- Melihat daftar pasien
- Menambah data pasien
- Memfilter data pasien berdasarkan tanggal registrasi

## Fitur Utama

- Tabel data pasien
- Tabel pendaftaran pasien
- Form tambah data pasien
- Filter pasien berdasarkan tanggal registrasi

## Teknologi yang Digunakan

- PHP 8.2.28
- Laravel 10.48.29
- MySQL
- Bootstrap
- Blade Templating (default Laravel)
- Template AdminLT-4.0.0-beta3

## Struktur Form Tambah Pasien

| Field         | Keterangan                                     |
| ------------- | ---------------------------------------------- |
| NIK           | Nomor Induk Kependudukan                       |
| Nama Pasien   | Nama lengkap pasien                            |
| No. RM        | Nomor Rekam Medis format `YYMMDD001` otomatis |
| Alamat        | Alamat lengkap pasien                          |
| Agama         | Dropdown (Islam, Kristen, Katolik, Hindu, dll) |
| Tanggal Lahir | Format: yyyy-mm-dd                             |
| Register Date | Otomatis sesuai timestamp saat form dikirim    |

## Struktur Form Tambah Pendaftaran

| Field            | Keterangan                                        |
| ---------------- | ------------------------------------------------- |
| Nama Pasien      | Nama lengkap pasien                               |
| No. RM           | Nomor Rekam Medis format `YYMMDD001` otomatis    |
| Pendaftaran Date | Otomatis sesuai timestamp saat form dikirim       |
| No. Pendaftaran  | Nomor Rekam Medis format `YYMMDD000001` otomatis |

## Instalasi & Menjalankan Proyek

1. **Clone Repository**

    ```bash
    git clone https://github.com/Sutrii/SistemInformasiDataPasien.git
    cd SistemInformasiDataPasien
    ```

2. **Install Dependency**

    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Copy File .env**

    ```bash
    cp .env.example .env
    ```

4. **Atur Konfigurasi Database di .env (Harap Sesuaikan DB_USERNAME dan DB_PASSWORD dengan Yang Ada di Perangkat Anda)**

    ```env
    DB_DATABASE=datapasien
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Generate App Key**

    ```bash
    php artisan key:generate
    ```

6. **Impor Database**
- File `datapasien.sql` terdapat pada folder `database/`
- Lakukan import melalui phpMyAdmin atau CLI:
    ```bash
    mysql -u root -p datapasien < database/datapasien.sql
    ```

7. **Jalankan Server**

    ```bash
    php artisan serve
    ```

## Catatan

- Daftarkan Akun Melalui Register Akun Jika Belum Memiliki Akun