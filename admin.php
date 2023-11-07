<?php
session_start();
require 'koneksi.php';


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION["peran"] !== "admin") {
    header("Location: index.php");
    exit;
}

$portofolio = query("SELECT * FROM portofolio");

// tombol cari ditekan
if (isset($_POST["cari"])) {
    $portofolio = cari($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dyykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <div class="sidebar">
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="index.php">Halaman Utama</a></li>
        </ul>
    </div>

    <div class="content">
        <header style="background-color: #f2c335;border-radius: 20px;">
            <h1 class="container" style="color: white;">Admin Dashboard</h1>
        </header>
        <br>
        <section class="search-bar">
            <a href="tambah.php">Tambah Portofolio</a>
            <br>
            <form action="" method="post">
            <input type="text" name="keyword" size="40" autofocus placeholder="Cari portofolio..." autocomplete="off" class="search-input">
                <button type="submit" name="cari">Cari</button>
            </form>
        </section>

        <section class="table-section">
            <table cellpadding="10" cellspacing="0">
                <tr style="border-radius: 20px;">
                    <th>No.</th>
                    <th>Aksi</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($portofolio as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row["id"]; ?>" class="edit-button">Ubah</a>
                            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="delete-button">Hapus</a>
                        </td>
                        <td>
                            <img src="assets/img/portofolio/<?= $row["gambar"]; ?>" width="120px" height="120px" alt="">
                        </td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </table>
        </section>
    </div>

    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>


</html>