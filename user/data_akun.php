<?php
include __DIR__ . '/../koneksi.php';

$cari = $_GET['cari'] ?? '';

if ($cari != '') {
    $sql = "SELECT * FROM user WHERE username LIKE '%$cari%'";
} else {
    $sql = "SELECT * FROM user";
}

$users = $koneksi->execute_query($sql)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data user</title>
</head>
<body>



<h1>Data Buku</h1>
<form method="get">
    <input type="text" name="cari" placeholder="Cari user"
           value="<?= htmlspecialchars($cari) ?>">
    <button type="submit">Cari</button>
    <a href="data_akun.php">Reset</a>
</form>
<a href="create.php">Tambah</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>username</th>
            <th>password</th>
            <th>role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($users as $user) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $user['username']; ?></td>
            <td><?= $user['password']; ?></td>
            <td><?= $user['role']; ?></td>
            <td>
                <a href="edit.php?id=<?= $user['id']; ?>">Edit</a>
                <a href="delete.php?id=<?= $user['id']; ?>"
                   onclick="return confirm('Yakin hapus?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>

        <?php if (count($users) == 0) : ?>
        <tr>
            <td colspan="5">Data tidak ditemukan</td>
        </tr>
        <?php endif; ?>
    </tbody>
    
</table>
<a href="../dashboard_admin.php">Kembali</a>

</body>
</html>
