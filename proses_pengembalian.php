<?php
include 'koneksi.php';

$id = $_POST['id_peminjaman'];

// ambil id buku
$q = $koneksi->query("
SELECT id_buku 
FROM peminjaman 
WHERE id = $id
");

$data = $q->fetch_assoc();
$id_buku = $data['id_buku'];

// update peminjaman
$koneksi->query("
UPDATE peminjaman 
SET 
    status = 'dikembalikan',
    tanggal_kembali = CURDATE()
WHERE id = $id
");

// tambah stok buku
$koneksi->query("
UPDATE buku 
SET stok = stok + 1 
WHERE id = $id_buku
");

header("Location: form_pengembalian.php");
