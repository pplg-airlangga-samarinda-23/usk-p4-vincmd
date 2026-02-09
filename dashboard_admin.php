<?php
session_start();

// Cek apakah user login
if (!isset($_SESSION['id_user'])) {
    // Belum login → langsung redirect ke login
    header("Location: login.php");
    exit;
}

// Cek role admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
</head>
<body>
<h1>Selamat datang, <?= htmlspecialchars($username) ?></h1>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Perpustakaan</title>

<style>
*{
    box-sizing:border-box;
    font-family: "Segoe UI", Arial, sans-serif;
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

/* LAYOUT */
.container{
    display:flex;
    min-height:calc(100vh - 72px);
}

/* SIDEBAR */
nav{
    width:220px;
    background:#ffffff;
    border-right:1px solid #e5e7eb;
    padding:20px;
}

nav ul{
    list-style:none;
    padding:0;
    margin:0;
}

nav li{
    margin-bottom:8px;
}

nav a{
    display:flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    padding:10px 14px;
    border-radius:8px;
    color:#374151;
    font-size:14px;
    transition:0.2s;
}

nav a:hover{
    background:#e0f2fe;
    color:#0284c7;
}

/* LOGOUT */
.logout{
    margin-top:20px;
    color:#dc2626;
}

.logout:hover{
    background:#fee2e2;
}

/* CONTENT */
.content{
    flex:1;
    padding:30px;
}

.card{
    background:#ffffff;
    padding:25px;
    border-radius:14px;
    border:1px solid #e5e7eb;
}

.card h2{
    margin-top:0;
    font-size:20px;
    font-weight:600;
}

.card p{
    line-height:1.6;
    color:#4b5563;
}

/* RESPONSIVE */
@media(max-width:768px){
    .container{
        flex-direction:column;
    }

    nav{
        width:100%;
        border-right:none;
        border-bottom:1px solid #e5e7eb;
    }
}
</style>
</head>

<body>

<header>
    <h1>Dashboard Perpustakaan</h1>
</header>

<div class="container">

<nav>
    <ul>
        <li><a href="buku/index.php">📚 Data Buku</a></li>
        <li><a href="data_peminjaman.php">📄 Data Peminjaman</a></li>
        <li><a href="form_pinjam.php">➕ Peminjaman</a></li>
        <li><a href="form_pengembalian.php">🔄 Pengembalian</a></li>
        <li><a href="user/data_akun.php">👤 Data Akun</a></li>
        <li><a href="login.php" class="logout">🚪 Logout</a></li>
    </ul>
</nav>

<div class="content">
    <div class="card">
        <h2>Selamat Datang</h2>
        <p>
            Kelola data buku, peminjaman, pengembalian, dan akun pengguna
            melalui menu di samping.
        </p>
    </div>
</div>

</div>

</body>
</html>
