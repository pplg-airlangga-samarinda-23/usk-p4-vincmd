<?php
session_start();
include('koneksi.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username=?";
    $user = $koneksi->execute_query($sql, [$username])->fetch_assoc();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if($user['role'] == 'admin'){
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_anggota.php");
        }
        exit;
    } else {
        $error= "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="wrapper">

    <h1>Login Sistem perpustakaan</h1>
    
    <form action="" method="post">
        <div class="input-box">
            <label for="username">username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="input-box">
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit" class="login">Login</button>
          <?php if(!empty($error)) : ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    </div>
</body>
</form>
</html>