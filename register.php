<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO user (username, password, role) VALUES (?,?,?)";
    $result = $koneksi->execute_query($sql, [$username, $password, $role]);

    if ($result) {
        header("Location: dashboard_admin.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action="" method="POST">
<div class="form-item">
  <label for="username">Silahkan masukkan username:</label><br>
  <input type="text" id="username" name="username" value="username" required><br>
  </div>
  <label for="password">Silahkan masukkan password:</label><br>
  <input type="password" id="password" name="password" value="password" required><br><br>
  <label for="role">Role</label>
  <select name="role" required>
    <option value="admin">Admin</option>
    <option value="siswa">Siswa</option>
    </select>
  <input type="submit" name="submit" value="Submit">
  <a href="dashboard_admin.php">Kembali</a>
</form> 

</body>
</html>