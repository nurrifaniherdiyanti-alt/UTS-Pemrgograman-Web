<?php

include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM produk WHERE id='$id'");

$data = mysqli_fetch_assoc($query);

if(file_exists('uploads/' . $data['foto'])) {

    unlink('uploads/' . $data['foto']);
}

mysqli_query($conn,
"DELETE FROM produk WHERE id='$id'");

header("Location: index.php?pesan=Data berhasil dihapus");

?>