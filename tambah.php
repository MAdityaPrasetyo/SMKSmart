<?php
session_start();
require 'koneksi.php';

if ($_SESSION["peran"] !== "admin") {
    header("Location: index.php");
    exit;
}


//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // var_dump($_POST); 
    // var_dump($_FILES);
    // die;

    // cek apakah data berhasil ditambahkan
    if (tambah($_POST) > 0) {
        echo " 
        <script>
        alert ('data berhasil ditambahkan');
        document.location.href = 'admin.php';
        </script>
        ";
    } else {
        echo "<script>
        alert ('data gagal ditambahkan');
        document.location.href = 'admin.php';
        </script>
        ";
    };
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f2c335;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            color: #f2c335;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            /* Menambahkan latar belakang putih */
        }

        button[type="submit"] {
            background-color: #f2c335;
            /* Ubah warna tombol menjadi f2c335 */
            color: #fff;
            /* Ubah warna teks menjadi putih */
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            /* Ubah radius sudut tombol menjadi 10px */
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Tambah Data Siswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama :</label>
        <input type="text" name="nama" id="nama" required>

        <label for="email">Email :</label>
        <input type="text" name="email" id="email" required>

        <label for="gambar">Gambar :</label>
        <input type="file" name="gambar" id="gambar" required>

        <button type="submit" name="submit">Kirim</button>
    </form>
</body>

</html>