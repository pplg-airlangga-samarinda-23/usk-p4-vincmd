<?php
session_start();
include 'koneksi.php';

// cek admin
if($_SESSION['role'] !== 'admin'){
    echo "Akses ditolak!";
    exit;
}

// ambil ID peminjaman
$id = $_GET['id'] ?? '';
if(!$id){
    echo "ID peminjaman tidak ditemukan.";
    exit;
}

// ambil data peminjaman
$sql = "SELECT * FROM peminjaman WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(!$data){
    echo "Data peminjaman tidak ditemukan.";
    exit;
}

// proses update
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $status = $_POST['status'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    $sql = "UPDATE peminjaman SET status=?, tanggal_pinjam=? WHERE id=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssi", $status, $tanggal_pinjam, $id);
    $stmt->execute();

    header("Location: data_peminjaman.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Peminjaman</title>
<style>
body{ 
    font-family:Arial,sans-serif; 
    background:#f5fbff; 
    padding:30px; 
}

form{ background:white; padding:20px; border-radius:10px; width:400px; margin:auto; border:1px solid #ddd;}
label{ display:block; margin-top:10px; font-weight:600; }
input, select{ width:100%; padding:8px; margin-top:5px; border-radius:5px; border:1px solid #ccc; }
button{ margin-top:15px; padding:10px 15px; border:none; border-radius:5px; background:#0284c7; color:white; font-weight:600; cursor:pointer; }
button:hover{ background:#0369a1; }
a.back{ display:block; margin-top:15px; text-decoration:none; color:#0284c7; }
a.back:hover{ text-decoration:underline; }
</style>
</head>
<body>

<h2>Edit Data Peminjaman</h2>

<form method="POST">

    <label>Status:</label>
    <select name="status" required>
        <option value="dipinjam" <?= $data['status']=='dipinjam'?'selected':'' ?>>DIPINJAM</option>
        <option value="dikembalikan" <?= $data['status']=='dikembalikan'?'selected':'' ?>>DIKEMBALIKAN</option>
    </select>

    <label>Tanggal Pinjam:</label>
    <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam'] ?>" required>

    <button type="submit">Simpan Perubahan</button>
</form>

<a href="data_peminjaman.php" class="back">← Kembali ke Data Peminjaman</a>

</body>
</html>
