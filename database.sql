-- ========================================================
-- Database untuk CRUD Mahasiswa
-- ========================================================

CREATE DATABASE IF NOT EXISTS `belajar_crud`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `belajar_crud`;

-- Tabel Mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nim` VARCHAR(20) NOT NULL UNIQUE,
    `nama` VARCHAR(100) NOT NULL,
    `jurusan` VARCHAR(50) NOT NULL,
    `ipk` DOUBLE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Awal
INSERT IGNORE INTO `mahasiswa` (`nim`, `nama`, `jurusan`, `ipk`) VALUES
('2024001', 'Lutfi Pratama', 'Teknik Informatika', 3.85),
('2024002', 'Siti Rahma', 'Sistem Informasi', 3.90),
('2024003', 'Ahmad Fauzi', 'Teknik Komputer', 3.65);
