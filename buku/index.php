<?php
session_start();
include __DIR__ . '/../koneksi.php';

$role = $_SESSION['role'] ?? 'user'; // default user
$cari = $_GET['cari'] ?? '';

if ($cari != '') {
    $sql = "SELECT * FROM buku WHERE judul LIKE ?";
    $books = $koneksi->execute_query($sql, ["%$cari%"])->fetch_all(MYSQLI_ASSOC);
} else {
    $sql = "SELECT * FROM buku";
    $books = $koneksi->query($sql)->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Buku</title>

<style>
*{
    box-sizing:border-box;
    font-family:"Segoe UI", Arial, sans-serif;
}

body{
    margin:0;
    background:#f5fbff;
    color:#1f2937;
}

/* HEADER */
header{
    background:#e0f2fe;
    padding:20px 30px;
    border-bottom:1px solid #bae6fd;
}

header h1{
    margin:0;
    font-size:22px;
    font-weight:600;
}

/* CONTENT */
.container{
    padding:30px;
}

.card{
    background:white;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:20px;
}

/* FORM */
form{
    display:flex;
    gap:10px;
    margin-bottom:15px;
}

input[type="text"]{
    padding:8px 12px;
    border:1px solid #cbd5e1;
    border-radius:8px;
    width:220px;
}

button{
    padding:8px 14px;
    border:none;
    border-radius:8px;
    background:#0284c7;
    color:white;
    cursor:pointer;
}

button:hover{
    background:#0369a1;
}

.reset{
    padding:8px 14px;
    border-radius:8px;
    background:#e5e7eb;
    color:#374151;
    text-decoration:none;
}

/* TAMBAH */
.tambah{
    display:inline-block;
    margin-bottom:15px;
    padding:8px 14px;
    background:#16a34a;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-weight:500;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th, td{
    padding:12px 14px;
    text-align:left;
}

th{
    background:#f0f9ff;
    border-bottom:1px solid #bae6fd;
    font-size:14px;
}

td{
    border-bottom:1px solid #e5e7eb;
    font-size:14px;
}

tr:hover{
    background:#f0f9ff;
}

/* AKSI */
.edit{
    color:#0284c7;
    font-weight:600;
    text-decoration:none;
    margin-right:10px;
}

.delete{
    color:#dc2626;
    font-weight:600;
    text-decoration:none;
}

.edit:hover,
.delete:hover{
    text-decoration:underline;
}

/* BACK */
.back{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:#0284c7;
    font-weight:500;
}

.back:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<header>
    <h1>Data Buku</h1>
</header>

<div class="container">
<div class="card">

<form method="get">
    <input type="text" name="cari" placeholder="Cari judul buku"
           value="<?= htmlspecialchars($cari) ?>">
    <button type="submit">Cari</button>
    <a href="index.php" class="reset">Reset</a>
</form>

<?php if ($role === 'admin'): ?>
    <a href="create.php" class="tambah">+ Tambah Buku</a>
<?php endif; ?>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Judul</th>
    <th>Pengarang</th>
    <th>Stok</th>
    <?php if ($role === 'admin'): ?>
        <th>Aksi</th>
    <?php endif; ?>
</tr>
</thead>
<tbody>

<?php if (count($books) > 0): ?>
    <?php $no=1; foreach($books as $book): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($book['judul']) ?></td>
        <td><?= htmlspecialchars($book['pengarang']) ?></td>
        <td><?= $book['stok'] ?></td>

        <?php if ($role === 'admin'): ?>
        <td>
            <a class="edit" href="edit.php?id=<?= $book['id'] ?>">Edit</a>
            <a class="delete"
               href="delete.php?id=<?= $book['id'] ?>"
               onclick="return confirm('Yakin hapus buku ini?')">
               Hapus
            </a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="<?= $role === 'admin' ? 5 : 4 ?>">
            Data tidak ditemukan
        </td>
    </tr>
<?php endif; ?>

</tbody>
</table>

<?php
$dashboard = ($role === 'admin')
    ? '../dashboard_admin.php'
    : '../dashboard_anggota.php';
?>

<a href="<?= $dashboard ?>" class="back">← Kembali ke Dashboard</a>

</div>
</div>

</body>
</html>
