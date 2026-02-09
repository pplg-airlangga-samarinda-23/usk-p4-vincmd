<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Perpustakaan KS Tubun</title>
<style>
* {
    box-sizing: border-box;
    font-family: "Segoe UI", Arial, sans-serif;
    margin:0;
    padding:0;
}

body {
    background:#f5fbff;
    color:#1f2937;
}

header {
    background:#0284c7;
    color:white;
    padding:30px;
    text-align:center;
}

header h1 {
    margin:0;
    font-size:28px;
}

header p {
    margin-top:8px;
    font-size:16px;
    color:#e0f2fe;
}

nav {
    background:#ffffff;
    border-bottom:1px solid #bae6fd;
}

nav ul {
    list-style:none;
    display:flex;
    justify-content:center;
    padding:10px 0;
    gap:20px;
}

nav a {
    text-decoration:none;
    color:#0284c7;
    font-weight:600;
    padding:8px 14px;
    border-radius:8px;
    transition:0.2s;
}

nav a:hover {
    background:#e0f2fe;
}

main {
    text-align:center;
    padding:50px 20px;
}

button {
    background:#16a34a;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    margin:10px;
    transition:0.2s;
}

button:hover {
    background:#15803d;
}
</style>
</head>
<body>

<header>
    <h1>Perpustakaan KS Tubun</h1>
    <p>Selamat datang di sistem perpustakaan kami</p>
</header>

<nav>
    <ul>
        <li><a href="#">Katalog Buku</a></li>
        <li><a href="#">Tentang</a></li>
        <li><a href="register1.php">Daftar Anggota</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>

<main>
    <h2>Mulai menjelajahi buku-buku favoritmu!</h2>
    <a href="register1.php"><button>Daftar Anggota</button></a>
    <a href="login.php"><button>Login</button></a>
</main>

</body>
</html>
