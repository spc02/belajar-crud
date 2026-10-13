<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>

    <h2>Data Mahasiswa</h2>

    <!-- Pesan Notifikasi Sederhana -->
    <?php if ($pesan === 'tambah_berhasil'): ?>
        <p><b>Data mahasiswa berhasil ditambahkan.</b></p>
    <?php elseif ($pesan === 'ubah_berhasil'): ?>
        <p><b>Data mahasiswa berhasil diperbarui.</b></p>
    <?php elseif ($pesan === 'hapus_berhasil'): ?>
        <p><b>Data mahasiswa berhasil dihapus.</b></p>
    <?php endif; ?>

    <!-- Tombol Tambah & Form Pencarian -->
    <p>
        <a href="index.php?action=tambah">[ + Tambah Mahasiswa ]</a>
    </p>

    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="index">
        <input type="text" name="cari" placeholder="Cari..." value="<?= htmlspecialchars($kata_kunci) ?>">
        <button type="submit">Cari</button>
        <?php if (!empty($kata_kunci)): ?>
            <a href="index.php">[ Reset ]</a>
        <?php endif; ?>
    </form>
    <br>

    <!-- Tabel Hitam Putih Standar -->
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>IPK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($mahasiswa)): ?>
                <tr>
                    <td colspan="6" align="center">Tidak ada data mahasiswa.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= $mhs['id'] ?></td>
                        <td><?= htmlspecialchars($mhs['nim']) ?></td>
                        <td><?= htmlspecialchars($mhs['nama']) ?></td>
                        <td><?= htmlspecialchars($mhs['jurusan']) ?></td>
                        <td><?= number_format($mhs['ipk'], 2) ?></td>
                        <td>
                            <a href="index.php?action=ubah&id=<?= $mhs['id'] ?>">Ubah</a> |
                            <a href="index.php?action=hapus&id=<?= $mhs['id'] ?>"
                               onclick="return confirm('Hapus data mahasiswa ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p>Total data: <?= count($mahasiswa) ?></p>

</body>
</html>
