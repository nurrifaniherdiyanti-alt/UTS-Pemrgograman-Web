<?php

include 'koneksi.php';

$id = $_POST['id'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$foto_lama = $_POST['foto_lama'];

$namaFoto = $foto_lama;

if($_FILES['foto']['name'] != "") {

    $fileName = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $fileSize = $_FILES['foto']['size'];

    $ekstensiValid = ['jpg', 'jpeg', 'png'];

    $ekstensi = strtolower(
        pathinfo($fileName, PATHINFO_EXTENSION)
    );

    if(!in_array($ekstensi, $ekstensiValid)) {

        die("Format file tidak valid!");
    }

    if($fileSize > 2 * 1024 * 1024) {

        die("Ukuran file terlalu besar!");
    }

    $namaFoto =
    time() . '_' . uniqid() . '.' . $ekstensi;

    move_uploaded_file(
        $tmpName,
        'uploads/' . $namaFoto
    );

    if($foto_lama != "" &&
       file_exists('uploads/' . $foto_lama)) {

        unlink('uploads/' . $foto_lama);
    }
}

if($id == "") {

    mysqli_query($conn,
    "INSERT INTO produk
    (nama_produk, harga, stok, foto)
    VALUES
    ('$nama_produk', '$harga', '$stok', '$namaFoto')");

    header("Location: index.php?pesan=Data berhasil ditambahkan");
} else {

    mysqli_query($conn,
    "UPDATE produk SET
    nama_produk='$nama_produk',
    harga='$harga',
    stok='$stok',
    foto='$namaFoto'
    WHERE id='$id'");

    header("Location: index.php?pesan=Data berhasil diupdate");
}

?>