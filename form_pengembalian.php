<?php
include 'koneksi.php';
session_start();
$sql = "
SELECT 
    p.id,
    u.username,
    b.judul,
    p.tanggal_pinjam
FROM peminjaman p
JOIN user u ON p.id_user = u.id
JOIN buku b ON p.id_buku = b.id
WHERE p.status = 'dipinjam'
";

$data = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengembalian Buku</title>

<style>
/* RESET & FONTS */
* {
    box-sizing: border-box;
    font-family: "Segoe UI", Arial, sans-serif;
    margin: 0;
    padding: 0;
}

body {
    background: #f5fbff;
    color: #1f2937;
    line-height: 1.6;
}

/* HEADER */
header {
    background: #e0f2fe;
    padding: 20px 30px;
    border-bottom: 1px solid #bae6fd;
}

header h2 {
    font-size: 22px;
    font-weight: 600;
}

/* CONTAINER & CARD */
.container {
    padding: 30px;
}

.card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px;
    max-width: 900px;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0,0,0,0.03);
    overflow-x: auto;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 12px 14px;
    text-align: left;
}

th {
    background: #f0f9ff;
    border-bottom: 1px solid #bae6fd;
    font-size: 14px;
}

td {
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

tr:hover {
    background: #f0f9ff;
}

/* BUTTON */
button {
    padding: 6px 12px;
    border: none;
    border-radius: 8px;
    background: #16a34a;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
}

button:hover {
    background: #15803d;
}

/* BACK LINK */
.back {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: #0284c7;
    font-weight: 500;
}

.back:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<header>
    <h2>Form Pengembalian Buku</h2>
</header>

<div class="container">
<div class="card">

<table>
<thead>
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = 1;
while($d = $data->fetch_assoc()){ ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($d['username']) ?></td>
    <td><?= htmlspecialchars($d['judul']) ?></td>
    <td><?= htmlspecialchars($d['tanggal_pinjam']) ?></td>
    <td>
        <form action="proses_pengembalian.php" method="post" style="display:inline;">
            <input type="hidden" name="id_peminjaman" value="<?= $d['id'] ?>">
            <button type="submit"
                onclick="return confirm('Yakin buku dikembalikan?')">
                Kembalikan
            </button>
        </form>
    </td>
</tr>
<?php } ?>
</tbody>
</table>
<?php


// Ambil role user dari session
$role = $_SESSION['role'] ?? 'anggota'; // default anggota kalau kosong

// Tentukan link dashboard
$dashboard = ($role === 'admin') ? 'dashboard_admin.php' : 'dashboard_anggota.php';
?>

<a href="<?= $dashboard ?>" class="back">← Kembali ke Dashboard</a>

</div>
</div>

</body>
</html>
