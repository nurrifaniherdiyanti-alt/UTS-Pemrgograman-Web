<?php

include 'koneksi.php';

$id = "";
$nama_produk = "";
$harga = "";
$stok = "";
$foto_lama = "";

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = mysqli_query($conn,
    "SELECT * FROM produk WHERE id='$id'");

    $data = mysqli_fetch_assoc($query);

    $nama_produk = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $foto_lama = $data['foto'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>
        <?= $id ? 'Edit Produk' : 'Tambah Produk'; ?>
    </h1>

    <form action="simpan.php"
          method="POST"
          enctype="multipart/form-data"
          onsubmit="return validasiForm()">

        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="foto_lama" value="<?= $foto_lama; ?>">

        <label>Nama Produk</label>
        <input type="text"
               name="nama_produk"
               id="nama_produk"
               value="<?= $nama_produk; ?>">

        <label>Harga</label>
        <input type="number"
               name="harga"
               id="harga"
               value="<?= $harga; ?>">

        <label>Stok</label>
        <input type="number"
               name="stok"
               id="stok"
               value="<?= $stok; ?>">

        <label>Foto Produk</label>
        <input type="file"
               name="foto"
               id="foto">

        <?php if($foto_lama != "") { ?>

            <p>Foto Saat Ini:</p>

            <img src="uploads/<?= $foto_lama; ?>" width="120">

        <?php } ?>

        <br><br>

        <button type="submit" class="btn simpan">
            Simpan
        </button>

        <a href="index.php" class="btn hapus">
            Kembali
        </a>

    </form>

</div>

<script>

function validasiForm() {

    let nama = document.getElementById('nama_produk').value;
    let harga = document.getElementById('harga').value;
    let stok = document.getElementById('stok').value;
    let foto = document.getElementById('foto');

    if(nama == "" || harga == "" || stok == "") {

        alert("Semua field wajib diisi!");

        return false;
    }

    if(foto.files.length > 0) {

        let file = foto.files[0];

        let tipe = [
            'image/jpg',
            'image/jpeg',
            'image/png'
        ];

        if(!tipe.includes(file.type)) {

            alert("File harus JPG, JPEG, atau PNG!");

            return false;
        }

        if(file.size > 2 * 1024 * 1024) {

            alert("Ukuran file maksimal 2 MB!");

            return false;
        }
    }

    return true;
}

</script>

</body>
</html>