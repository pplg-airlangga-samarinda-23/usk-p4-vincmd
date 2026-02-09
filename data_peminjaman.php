<?php
session_start();
include 'koneksi.php';

$sql = "
SELECT 
    p.id,
    u.username,
    b.judul,
    p.status,
    p.tanggal_pinjam,
    DATE_ADD(p.tanggal_pinjam, INTERVAL 7 DAY) AS jatuh_tempo
FROM peminjaman p
JOIN user u ON p.id_user = u.id
JOIN buku b ON p.id_buku = b.id
ORDER BY p.tanggal_pinjam DESC
";

$data = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Peminjaman</title>

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

header h2{
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

/* STATUS */
.dipinjam{
    color:#f59e0b;
    font-weight:600;
}

.dikembalikan{
    color:#16a34a;
    font-weight:600;
}

/* AKSI */
.hapus-btn{
    color:#dc2626;
    text-decoration:none;
    font-weight:600;
    margin-right:5px;
}

.hapus-btn:hover{
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
    <h2>Data Peminjaman Buku</h2>
</header>

<div class="container">
<div class="card">

<table>
<tr>
    <th>No</th>
    <th>User</th>
    <th>Buku</th>
    <th>Status</th>
    <th>Tgl Pinjam</th>
    <th>Jatuh Tempo</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($d=$data->fetch_assoc()){ ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($d['username']) ?></td>
    <td><?= htmlspecialchars($d['judul']) ?></td>
    <td class="<?= $d['status'] ?>"><?= strtoupper($d['status']) ?></td>
    <td><?= $d['tanggal_pinjam'] ?></td>
    <td><?= $d['jatuh_tempo'] ?></td>
    <td>
        <?php if ($_SESSION['role'] === 'admin') { ?>
            <a class="hapus-btn"
               href="hapus_peminjaman.php?id=<?= $d['id'] ?>"
               onclick="return confirm('Yakin hapus data peminjaman ini?')">
               Hapus
            </a>
            <a class="hapus-btn"
               href="edit_data_peminjaman.php?id=<?= $d['id'] ?>">
               Edit
            </a>
        <?php } else { ?>
            -
        <?php } ?>
    </td>
</tr>
<?php } ?>

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
