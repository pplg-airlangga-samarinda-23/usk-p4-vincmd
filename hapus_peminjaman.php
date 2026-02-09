<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: data_peminjaman.php");
    exit;
}

$id = (int) $_GET['id'];

/* ambil id buku buat balikin stok */
$data = $koneksi->query("
    SELECT id_buku 
    FROM peminjaman 
    WHERE id = $id
")->fetch_assoc();

if ($data) {
    $id_buku = $data['id_buku'];

    /* hapus permanen */
    $koneksi->query("DELETE FROM peminjaman WHERE id = $id");

    /* kembalikan stok */
    $koneksi->query("
        UPDATE buku 
        SET stok = stok + 1 
        WHERE id = $id_buku
    ");
}

header("Location: data_peminjaman.php");
