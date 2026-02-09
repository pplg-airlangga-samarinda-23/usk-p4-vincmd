<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO user (username, password, role) VALUES (?,?,?)";
    $result = $koneksi->execute_query($sql, [$username, $password, $role]);

    if ($result) {
        header("Location: ../dashboard_admin.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah User</title>
<style>
* { box-sizing:border-box; font-family:"Segoe UI", Arial, sans-serif; }

body {
    margin:0;
    background:#f5fbff;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    color:#1f2937;
}

.wrapper {
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    width:100%;
    max-width:400px;
}

h1 {
    text-align:center;
    color:#0284c7;
    margin-bottom:25px;
}

.form-item {
    display:flex;
    flex-direction:column;
    margin-bottom:15px;
}

label {
    margin-bottom:6px;
    font-weight:500;
    color:#374151;
}

input[type="text"],
input[type="password"],
select {
    padding:10px;
    border-radius:8px;
    border:1px solid #cbd5e1;
    font-size:14px;
}

button {
    width:100%;
    padding:10px;
    border:none;
    border-radius:8px;
    background:#16a34a;
    color:#fff;
    font-weight:600;
    font-size:16px;
    cursor:pointer;
    transition:0.2s;
}

button:hover { background:#15803d; }

a.back {
    display:inline-block;
    margin-top:15px;
    text-decoration:none;
    color:#0284c7;
    font-weight:500;
}

a.back:hover { text-decoration:underline; }
</style>
</head>
<body>
<div class="wrapper">
<h1>Tambah User</h1>
<form action="" method="POST">
    <div class="form-item">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
    </div>
    <div class="form-item">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
    </div>
    <div class="form-item">
        <label for="role">Role</label>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="siswa">Siswa</option>
        </select>
    </div>
    <button type="submit" name="submit">Tambah</button>
</form>
<a href="../dashboard_admin.php" class="back">← Kembali ke Dashboard</a>
</div>
</body>
</html>
