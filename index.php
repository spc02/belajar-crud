<?php
/**
 * index.php (Router & Entry Point)
 * ================================
 * File ini menangani setiap permintaan yang masuk dan mengarahkannya
 * ke aksi yang sesuai di MahasiswaController.
 */

require_once __DIR__ . '/controller/MahasiswaController.php';

$controller = new MahasiswaController();
$action     = $_GET['action'] ?? 'index';

switch ($action) {
    case 'tambah':
        $controller->tambah();
        break;

    case 'ubah':
        $controller->ubah();
        break;

    case 'hapus':
        $controller->hapus();
        break;

    case 'index':
    default:
        $controller->index();
        break;
}
