<?php
/**
 * model/MahasiswaModel.php
 * ========================
 * [M] MODEL dalam MVC
 *
 * Bertanggung jawab atas:
 * 1. Data mahasiswa (id, nim, nama, jurusan, ipk) dengan Enkapsulasi (Getter & Setter).
 * 2. Logika query SQL ke database (Create, Read, Update, Delete).
 */

class MahasiswaModel {

    // Atribut privat (Enkapsulasi)
    private $id;
    private $nim;
    private $nama;
    private $jurusan;
    private $ipk;

    // Objek koneksi PDO
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    // ============================================================
    // GETTERS
    // ============================================================
    public function getId()      { return $this->id; }
    public function getNim()     { return $this->nim; }
    public function getNama()    { return $this->nama; }
    public function getJurusan() { return $this->jurusan; }
    public function getIpk()     { return $this->ipk; }

    // ============================================================
    // SETTERS (Dengan pembersihan data)
    // ============================================================
    public function setId($nilai)      { $this->id = (int) $nilai; }
    public function setNim($nilai)     { $this->nim = trim($nilai); }
    public function setNama($nilai)    { $this->nama = trim($nilai); }
    public function setJurusan($nilai) { $this->jurusan = trim($nilai); }
    public function setIpk($nilai)     { $this->ipk = (float) $nilai; }

    // ============================================================
    // CREATE - Menambah data mahasiswa baru
    // ============================================================
    public function simpan(): bool {
        $sql  = "INSERT INTO mahasiswa (nim, nama, jurusan, ipk) VALUES (:nim, :nama, :jurusan, :ipk)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nim'     => $this->nim,
            ':nama'    => $this->nama,
            ':jurusan' => $this->jurusan,
            ':ipk'     => $this->ipk,
        ]);
    }

    // ============================================================
    // READ - Mengambil semua data mahasiswa
    // ============================================================
    public function ambilSemua(): array {
        $stmt = $this->db->query("SELECT * FROM mahasiswa ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    // ============================================================
    // READ - Mengambil data berdasarkan ID
    // ============================================================
    public function ambilById(int $id): array|false {
        $sql  = "SELECT * FROM mahasiswa WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // ============================================================
    // READ - Mengambil data berdasarkan NIM
    // ============================================================
    public function ambilBerdasarkanNim(string $nim): array|false {
        $sql  = "SELECT * FROM mahasiswa WHERE nim = :nim LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nim' => $nim]);
        return $stmt->fetch();
    }

    // ============================================================
    // READ - Mengambil data berdasarkan Nama
    // ============================================================
    public function ambilBerdasarkanNama(string $nama): array {
        $sql  = "SELECT * FROM mahasiswa WHERE nama LIKE :nama ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nama' => "%{$nama}%"]);
        return $stmt->fetchAll();
    }

    // ============================================================
    // READ - Pencarian fleksibel (NIM, Nama, atau Jurusan)
    // ============================================================
    public function cari(string $kata_kunci): array {
        $pola = "%{$kata_kunci}%";
        $sql  = "SELECT * FROM mahasiswa
                 WHERE nim LIKE :p OR nama LIKE :p OR jurusan LIKE :p
                 ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':p' => $pola]);
        return $stmt->fetchAll();
    }

    // ============================================================
    // VALIDASI - Cek apakah NIM sudah dipakai orang lain
    // ============================================================
    public function nimSudahAda(string $nim, int $kecuali_id = 0): bool {
        $sql  = "SELECT id FROM mahasiswa WHERE nim = :nim AND id != :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nim' => $nim, ':id' => $kecuali_id]);
        return $stmt->fetch() !== false;
    }

    // ============================================================
    // UPDATE - Memperbarui data mahasiswa
    // ============================================================
    public function perbarui(): bool {
        $sql  = "UPDATE mahasiswa SET nim = :nim, nama = :nama, jurusan = :jurusan, ipk = :ipk WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nim'     => $this->nim,
            ':nama'    => $this->nama,
            ':jurusan' => $this->jurusan,
            ':ipk'     => $this->ipk,
            ':id'      => $this->id,
        ]);
    }

    // ============================================================
    // DELETE - Menghapus data mahasiswa berdasarkan ID
    // ============================================================
    public function hapus(int $id): bool {
        $sql  = "DELETE FROM mahasiswa WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
