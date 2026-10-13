# Aplikasi CRUD Mahasiswa (PHP MVC & MySQL)

Aplikasi Web CRUD modern berbasis arsitektur **MVC (Model - View - Controller)** murni tanpa DAO, menggunakan **PHP PDO** dan terhubung ke database **MySQL / MariaDB**.

---

## 🏛️ Struktur Arsitektur MVC

```text
belajar_crud/
├── index.php                      # [Router] Titik masuk utama
├── config/
│   └── Database.php               # Koneksi database menggunakan PDO
├── model/
│   └── MahasiswaModel.php         # [M] MODEL: Atribut, Getter/Setter, & Query SQL
├── controller/
│   └── MahasiswaController.php    # [C] CONTROLLER: Logika alur & penghubung
├── view/
│   ├── layout_header.php          # [V] Header HTML & Desain UI
│   ├── layout_footer.php          # [V] Footer HTML
│   ├── index.php                  # [V] Halaman tabel data mahasiswa & pencarian
│   ├── tambah.php                 # [V] Form tambah mahasiswa baru
│   └── ubah.php                   # [V] Form edit data mahasiswa
└── database.sql                   # Skema dan data awal database MySQL
```

---

## 🚀 Cara Menjalankan

### Opsi 1: Server Bawaan PHP (Paling Praktis)
Jalankan perintah ini di PowerShell pada folder proyek:

```powershell
& "D:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe" -S localhost:8000
```
Buka peramban (browser) di: **`http://localhost:8000`**

### Opsi 2: Laragon / XAMPP Apache
Buat shortcut atau salin folder proyek ke folder `www` Laragon:
```powershell
cmd /c mklink /D "D:\laragon\www\belajar_crud" "d:\MAS LUTFI\belajar_crud"
```
Lalu buka di browser: **`http://localhost/belajar_crud`**
