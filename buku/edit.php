<?php

include __DIR__ . '/../koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = $_GET['id'];
    $sql ="SELECT * FROM buku WHERE id=?";
    $book = $koneksi->execute_query($sql,[$id])->fetch_assoc();
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];
    $id = $_GET['id'];

    $sql = "UPDATE buku SET judul=?, pengarang=?, stok=? WHERE id=?";
    $result = $koneksi->execute_query($sql,[$judul,$pengarang,$stok,$id]);

    if ($result){
        header("location:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Buku</title>

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

header h1 {
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
    max-width: 500px;
    margin: auto;
    box-shadow: 0 4px 8px rgba(0,0,0,0.03);
}

/* FORM */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-item label {
    font-weight: 500;
    margin-bottom: 5px;
    display: block;
}

.form-item input[type="text"],
.form-item input[type="number"] {
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    width: 100%;
}

button {
    padding: 10px 14px;
    border: none;
    border-radius: 8px;
    background: #0284c7;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
}

button:hover {
    background: #0369a1;
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
    <h1>Edit Buku</h1>
</header>

<div class="container">
<div class="card">

<form action="" method="post">
    <div class="form-item">
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" value="<?= htmlspecialchars($book['judul']) ?>">
    </div>
    <div class="form-item">
        <label for="pengarang">Pengarang</label>
        <input type="text" name="pengarang" id="pengarang" value="<?= htmlspecialchars($book['pengarang']) ?>">
    </div>
    <div class="form-item">
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" value="<?= htmlspecialchars($book['stok']) ?>">
    </div>
    <button type="submit">Edit</button>
</form>

<a href="index.php" class="back">← Kembali ke Daftar Buku</a>

</div>
</div>

</body>
</html>
