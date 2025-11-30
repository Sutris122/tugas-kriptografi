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

## Environment Requirements

### **1. Server Requirements**
- **PHP 8.1+**
- Ekstensi PHP:
  - intl
  - json
  - mbstring
  - openssl
  - mysqli / pdo_mysql
- **Composer 2.x**
- **MySQL 5.7 atau 8.x**

### **2. CodeIgniter**
- CodeIgniter **4.4.x** atau lebih baru

### **3. Web Server**
- Apache 2.4+ (mod_rewrite ON), atau
- Nginx 1.18+

### **4. OS Support**
- Windows 10/11
- Linux (Ubuntu/Debian/CentOS)
- macOS terbaru

### **5. Tools Opsional**
- Laragon / XAMPP / MAMP
- Git
- Postman / Bruno untuk testing

## 📂 Struktur Proyek

```
app/
 ├── Controllers/
 │    └── Contacts.php
 ├── Models/
 │    └── ContactModel.php
 └── Helpers/
      └── stream_xor_helper.php
public/
.env
README.md
```

## ⚙️ Konfigurasi Database

Set pada `.env`:

```
database.default.hostname = localhost
database.default.database = db_kriptografi
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

Jalankan Migration:
```
php spark migrate
```

## 🚀 Menjalankan Aplikasi

```
composer install
php spark serve
```

Akses:
```
http://localhost:8080/contacts
```

## 📘 Penjelasan File stream_xor_helper.php

### xor_encrypt_hex()
Enkripsi plaintext + XOR + output hex.

### xor_decrypt_hex()
Dekripsi dari cipher hex menjadi plaintext.
