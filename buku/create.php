<?php

include __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $judul =  $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO buku (judul, pengarang, stok) VALUES (?,?,?)";
    $result = $koneksi->execute_query($sql, [$judul, $pengarang, $stok]);

    if($result){
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Buku</title>
<style>
* {
    box-sizing: border-box;
    font-family: "Segoe UI", Arial, sans-serif;
}

body {
    margin: 0;
    background: #f5fbff;
    color: #1f2937;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.wrapper {
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

h1 {
    text-align: center;
    color: #0284c7;
    margin-bottom: 25px;
}

.form-item {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 6px;
    font-weight: 500;
    color: #374151;
}

input[type="text"],
input[type="number"] {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    background: #16a34a;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: 0.2s;
}

button:hover {
    background: #15803d;
}

a.back {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #0284c7;
    font-weight: 500;
}

a.back:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
<div class="wrapper">
    <h1>Tambah Buku</h1>
    <form action="" method="post">
        <div class="form-item">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" required>
        </div>
        <div class="form-item">
            <label for="pengarang">Pengarang</label>
            <input type="text" name="pengarang" id="pengarang" required>
        </div>
        <div class="form-item">
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" min="1" required>
        </div>
        <button type="submit">Tambah</button>
    </form>
    <a href="index.php" class="back">← Kembali ke Data Buku</a>
</div>
</body>
</html>
