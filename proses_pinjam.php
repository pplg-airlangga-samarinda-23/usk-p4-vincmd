<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['id_buku'])) {
    header("Location: form_pinjam.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];
$id_buku = (int) $_POST['id_buku'];

/* CEK: buku masih ada stok */
$cekStok = $koneksi->query("
    SELECT stok FROM buku WHERE id = $id_buku
");

$b = $cekStok->fetch_assoc();
if ($b['stok'] <= 0) {
    echo "<script>
        alert('Stok buku habis!');
        window.location='form_pinjam.php';
    </script>";
    exit;
}

/* CEK: user sudah pinjam buku ini atau belum */
$cek = $koneksi->query("
    SELECT id FROM peminjaman
    WHERE id_user = $id_user
    AND id_buku = $id_buku
    AND status = 'dipinjam'
");

if ($cek->num_rows > 0) {
    echo "<script>
        alert('Kamu masih meminjam buku ini. Kembalikan dulu!');
        window.location='form_pinjam.php';
    </script>";
    exit;
}

/* SIMPAN PEMINJAMAN */
$koneksi->query("
    INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, status)
    VALUES ($id_user, $id_buku, CURDATE(), 'dipinjam')
");

/* KURANGI STOK */
$koneksi->query("
    UPDATE buku SET stok = stok - 1 WHERE id = $id_buku
");

header("Location: dashboard_anggota.php");
exit;
