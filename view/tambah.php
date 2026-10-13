<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
</head>
<body>

    <h2>Tambah Mahasiswa</h2>

    <?php if (!empty($error)): ?>
        <p><b>Error:</b> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=tambah">
        <table>
            <tr>
                <td>NIM</td>
                <td>: <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>: <input type="text" name="jurusan" value="<?= htmlspecialchars($_POST['jurusan'] ?? '') ?>"></td>
            </tr>
            <tr>
                <td>IPK</td>
                <td>: <input type="number" name="ipk" step="0.01" min="0" max="4" value="<?= htmlspecialchars($_POST['ipk'] ?? '') ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Simpan</button>
                    <a href="index.php">Batal</a>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>
