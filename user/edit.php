<?php

include __DIR__ . '/../koneksi.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = $_GET['id'];
    $sql ="SELECT * FROM user WHERE id=?";
    $user = $koneksi->execute_query($sql,[$id])->fetch_assoc();
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $id = $_GET['id'];

    $sql = "UPDATE user SET username=?, password=?, role=? WHERE id=?";
    $result = $koneksi->execute_query($sql,[$username,$password,$role,$id]);

    if ($result){
        header("location:data_akun.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
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
    background:#0284c7;
    color:#fff;
    font-weight:600;
    font-size:16px;
    cursor:pointer;
    transition:0.2s;
}

button:hover { background:#0369a1; }

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
<h1>Edit User</h1>
<form action="" method="post">
    <div class="form-item">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    </div>
    <div class="form-item">
        <label for="password">Password (kosongkan jika tidak diubah)</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="form-item">
        <label for="role">Role</label>
        <select name="role" required>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="siswa" <?= $user['role'] === 'siswa' ? 'selected' : '' ?>>Siswa</option>
        </select>
    </div>
    <button type="submit">Edit</button>
</form>
<a href="data_akun.php" class="back">← Kembali ke Data Akun</a>
</div>
</body>
</html>
