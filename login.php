<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql="SELECT * FROM user WHERE id=?";
    $user=$koneksi->execute_query($sql,[$username])->fetch_assoc();
    $cek = password_verify($password,$user['password']);

    if($cek){
        session_start();
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['usernmae'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if($user['role'] == 'admin'){
            header("location:dashboard_admin.php");
        } else {
            header("location:dashboard_aggota.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login Sitem perpustakaan</h1>
    <form action="dashboard_admin.php" method="post">
        <div class="form-item">
            <label for="username">username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-item">
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Login</button>
</body>
</form>
</html>