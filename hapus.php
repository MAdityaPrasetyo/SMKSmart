<?php 
session_start();
require 'koneksi.php';

if($_SESSION["peran"] !== "admin") {
    header("Location: index.php");
    exit;
}


$id = $_GET["id"];

if( hapus($id) > 0 ) {
    echo " 
    <script>
    alert ('data berhasil dihapus');
    document.location.href = 'admin.php';
    </script>
    ";
} else {
    echo "<script>
    alert ('data gagal dihapus');
    document.location.href = 'admin.php';
    </script>
    ";
};
?>