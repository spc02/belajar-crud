<?php
/**
 * controller/MahasiswaController.php
 * ==================================
 * [C] CONTROLLER dalam MVC
 *
 * Bertanggung jawab atas:
 * 1. Menerima request dari browser (GET / POST)
 * 2. Memvalidasi input pengguna
 * 3. Memanggil fungsi di Model untuk membaca/menyimpan ke database
 * 4. Menentukan file View mana yang akan ditampilkan ke layar
 */

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/MahasiswaModel.php';

class MahasiswaController {

    private $model;

    public function __construct() {
        $db = new Database();
        $this->model = new MahasiswaModel($db->koneksi);
    }

    // ============================================================
    // ACTION: Halaman Utama (Daftar Mahasiswa & Pencarian)
    // ============================================================
    public function index() {
        $kata_kunci = $_GET['cari'] ?? '';

        if (!empty($kata_kunci)) {
            $mahasiswa = $this->model->cari($kata_kunci);
        } else {
            $mahasiswa = $this->model->ambilSemua();
        }

        $pesan = $_GET['pesan'] ?? '';

        $this->tampilkan('index', [
            'mahasiswa'  => $mahasiswa,
            'kata_kunci' => $kata_kunci,
            'pesan'      => $pesan,
        ]);
    }

    // ============================================================
    // ACTION: Tambah Mahasiswa
    // ============================================================
    public function tambah() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim     = trim($_POST['nim'] ?? '');
            $nama    = trim($_POST['nama'] ?? '');
            $jurusan = trim($_POST['jurusan'] ?? '');
            $ipk     = (float) ($_POST['ipk'] ?? 0);

            // Validasi input
            if (empty($nim) || empty($nama)) {
                $error = "NIM dan Nama wajib diisi!";
            } elseif ($this->model->nimSudahAda($nim)) {
                $error = "NIM '{$nim}' sudah terdaftar!";
            } elseif ($ipk < 0 || $ipk > 4) {
                $error = "IPK harus bernilai antara 0.00 sampai 4.00!";
            } else {
                $this->model->setNim($nim);
                $this->model->setNama($nama);
                $this->model->setJurusan($jurusan);
                $this->model->setIpk($ipk);
                $this->model->simpan();

                header("Location: index.php?pesan=tambah_berhasil");
                exit;
            }
        }

        $this->tampilkan('tambah', ['error' => $error]);
    }

    // ============================================================
    // ACTION: Ubah Data Mahasiswa
    // ============================================================
    public function ubah() {
        $id    = (int) ($_GET['id'] ?? 0);
        $error = '';

        $data = $this->model->ambilById($id);
        if (!$data) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim     = trim($_POST['nim'] ?? '');
            $nama    = trim($_POST['nama'] ?? '');
            $jurusan = trim($_POST['jurusan'] ?? '');
            $ipk     = (float) ($_POST['ipk'] ?? 0);

            if (empty($nim) || empty($nama)) {
                $error = "NIM dan Nama tidak boleh kosong!";
            } elseif ($this->model->nimSudahAda($nim, $id)) {
                $error = "NIM '{$nim}' sudah digunakan mahasiswa lain!";
            } elseif ($ipk < 0 || $ipk > 4) {
                $error = "IPK harus bernilai antara 0.00 sampai 4.00!";
            } else {
                $this->model->setId($id);
                $this->model->setNim($nim);
                $this->model->setNama($nama);
                $this->model->setJurusan($jurusan);
                $this->model->setIpk($ipk);
                $this->model->perbarui();

                header("Location: index.php?pesan=ubah_berhasil");
                exit;
            }
        }

        $this->tampilkan('ubah', ['data' => $data, 'error' => $error]);
    }

    // ============================================================
    // ACTION: Hapus Mahasiswa
    // ============================================================
    public function hapus() {
        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->hapus($id);
        }

        header("Location: index.php?pesan=hapus_berhasil");
        exit;
    }

    // ============================================================
    // Helper: Mengirimkan data dan me-render View
    // ============================================================
    private function tampilkan(string $namaView, array $data = []) {
        extract($data);
        require_once __DIR__ . "/../view/{$namaView}.php";
    }
}
