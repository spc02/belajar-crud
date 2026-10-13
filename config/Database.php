<?php
/**
 * config/Database.php
 * ====================
 * Kelas koneksi database MySQL menggunakan PDO (PHP Data Objects).
 */

class Database {

    private $host     = "localhost";
    private $user     = "root";
    private $password = "";
    private $nama_db  = "belajar_crud";

    public $koneksi;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->nama_db};charset=utf8mb4";
            $this->koneksi = new PDO($dsn, $this->user, $this->password);
            $this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->koneksi->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("
                <div style='font-family:sans-serif; padding:20px; background:#fdecea; color:#c0392b; border-radius:8px;'>
                    <h2>❌ Gagal Terhubung ke Database!</h2>
                    <p>{$e->getMessage()}</p>
                    <p>Pastikan MySQL (di Laragon / XAMPP) sudah berjalan dan database <strong>belajar_crud</strong> sudah dibuat.</p>
                </div>
            ");
        }
    }
}
