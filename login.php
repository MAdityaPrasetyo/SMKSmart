<?php
session_start();
require 'koneksi.php';

//cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
  $id = $_COOKIE["id"];
  $key = $_COOKIE["key"];

  // ambil username
  $result = mysqli_query($conn, "SELECT username from user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION["login"] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}



if (isset($_POST["login"])) {
  $username = $_POST["nama"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE nama = '$username'");


  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Verifikasi password
    if (password_verify($password, $row["password"])) {
      // Cek peran (role)
      if ($row["peran"] === "admin") {
        $_SESSION["login"] = true;
        $_SESSION["peran"] = "admin";
        //cek remember me
        if (isset($_POST['remember'])) {
          //buat cookie
          setcookie('id', $row['id'], time() +  60);
          setcookie('key', hash('sha256', $row['username']), time() +  60);
        }
        // Pengguna dengan peran admin diarahkan ke admin.php
        header("Location: admin.php");
      } else {
        $_SESSION["login"] = true;
        //cek remember me
        if (isset($_POST['remember'])) {
          //buat cookie
          setcookie('id', $row['id'], time() +  60);
          setcookie('key', hash('sha256', $row['username']), time() +  60);
        }

        // Pengguna tanpa peran admin diarahkan ke index.php
        header("Location: index.php");
      }
      exit;
    }
  }

  $error = true;
}

?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="assets/css/stylelogin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <?php if (isset($error)) : ?>
    <h1>Password/Nama Salah!</h1>
  <?php endif; ?>
  <div class="container">
    <div class="wrapper">
      <div class="title"><span>Login</span></div>
      <form action="" method="post">
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="nama" placeholder="Email atau No.hp" required>
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <div>
          <input type='checkbox' name='remember' id='remember'>
          <label for='remember'>Remember me</label>
        </div><br>
        <div class="pass"><a href="#">Lupa password?</a></div>
        <div class="row button">
          <input type="submit" name="login">
        </div>
        <div class="signup-link">Belum Daftar? <a href="register.php">Daftar Sekarang</a></div>
      </form>
    </div>
  </div>

</body>

</html>