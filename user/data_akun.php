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
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data User</title>

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
    width:200px;
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

.reset, .tambah{
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
    font-weight:500;
}

.reset{
    background:#e5e7eb;
    color:#374151;
}

.tambah{
    background:#16a34a;
    color:white;
    margin-bottom:15px;
    display:inline-block;
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

.edit:hover, .delete:hover{
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
    <h1>Data User</h1>
</header>

<div class="container">
<div class="card">

<form method="get">
    <input type="text" name="cari" placeholder="Cari user"
           value="<?= htmlspecialchars($cari) ?>">
    <button type="submit">Cari</button>
    <a href="data_akun.php" class="reset">Reset</a>
</form>

<a href="register.php" class="tambah">+ Tambah User</a>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Role</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php $no=1; foreach($users as $user): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($user['username']) ?></td>
    <td><?= htmlspecialchars($user['role']) ?></td>
    <td>
        <a class="edit" href="edit.php?id=<?= $user['id'] ?>">Edit</a>
        <a class="delete"
           href="delete.php?id=<?= $user['id'] ?>"
           onclick="return confirm('Yakin hapus user ini?')">
           Hapus
        </a>
    </td>
</tr>
<?php endforeach ?>

<?php if(count($users) == 0): ?>
<tr>
    <td colspan="5">Data tidak ditemukan</td>
</tr>
<?php endif ?>

</tbody>
</table>

<a href="../dashboard_admin.php" class="back">← Kembali ke Dashboard</a>

</div>
</div>

</body>
</html>
