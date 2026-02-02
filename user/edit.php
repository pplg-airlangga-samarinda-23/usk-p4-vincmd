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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>
    <h1>Edit user</h1>

    <form action="" method="post">
        <div class="form-item">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= $user['username'] ?>">
            </div>
            <div class="form-item">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?= $user['password'] ?>">
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
      
</body>
</html>

