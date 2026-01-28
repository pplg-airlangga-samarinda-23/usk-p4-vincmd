<?php

include __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $id = $_GET['id'];
    $sql = "DELETE FROM buku WHERE id=?";
    $result = $koneksi->execute_query($sql, [$id]);

    if ($result){
        header("location:index.php");
    }
}