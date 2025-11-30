# Simulasi CRUD dengan Enkripsi Stream XOR – CodeIgniter 4

Proyek ini merupakan aplikasi sederhana berbasis **CodeIgniter 4** yang menampilkan simulasi proses **CRUD (Create, Read, Update, Delete)** pada database **MySQL**, dengan tambahan fitur **kriptografi simetris menggunakan Stream Cipher XOR**.

## ✨ Fitur Utama

### 1. CRUD Lengkap
- Tambah data
- Tampilkan semua data
- Update data
- Hapus data

### 2. Enkripsi Stream XOR
Menggunakan HMAC-SHA256 sebagai generator keystream, dengan nonce unik per record.

### 3. Dekripsi Otomatis
Sistem otomatis mendekripsi data ketika ditampilkan.

## 🔐 Penjelasan Metode Enkripsi

Skema enkripsi:

```
keystream = HMAC_SHA256(key, nonce || counter)
cipher = plaintext XOR keystream
```

## 📂 Struktur Proyek

```
app/
 ├── Controllers/
 │    └── PersonController.php
 ├── Models/
 │    └── PersonModel.php
 └── Helpers/
      └── xor_helper.php
public/
.env
README.md
```

## ⚙️ Konfigurasi Database

Buat tabel:

```sql
CREATE TABLE persons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    nonce VARCHAR(64),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

Set pada `.env`:

```
database.default.hostname = localhost
database.default.database = xor_crud
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
encryption.key = "MY_SUPER_SECRET_KEY_32CHARS"
```

## 🚀 Menjalankan Aplikasi

```
composer install
php spark serve
```

Akses:
```
http://localhost:8080/person
```

## 📘 Penjelasan File xor_helper.php

### xor_encrypt_hex()
Enkripsi plaintext + XOR + output hex.

### xor_decrypt_hex()
Dekripsi dari cipher hex menjadi plaintext.

## 🧪 Keamanan
Hanya untuk simulasi akademik, bukan untuk produksi.

## 📄 Lisensi
Bebas digunakan untuk pembelajaran dan tugas akhir.
