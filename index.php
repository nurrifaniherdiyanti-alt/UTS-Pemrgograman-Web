<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if(isset($_GET['pesan'])) { ?>

<div class="toast">
    <?= $_GET['pesan']; ?>
</div>

<?php } ?>

<div class="container">

    <h1>Data Produk</h1>

    <a href="form.php" class="btn tambah">
        + Tambah Produk
    </a>

    <table>

        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        $query = mysqli_query($conn, "SELECT * FROM produk");

        while($data = mysqli_fetch_assoc($query)) {
        ?>

        <tr>

            <td><?= $no++; ?></td>

            <td>
                <img src="uploads/<?= $data['foto']; ?>" width="100">
            </td>

            <td><?= $data['nama_produk']; ?></td>

            <td>
                Rp <?= number_format($data['harga']); ?>
            </td>

            <td><?= $data['stok']; ?></td>

            <td>
                <div class="action-btn">

                    <a href="form.php?id=<?= $data['id']; ?>"
                         class="btn edit">
                        Edit
                     </a>

                    <a href="hapus.php?id=<?= $data['id']; ?>"
                         class="btn hapus"
                         onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                        </a>

    </div>
</td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>