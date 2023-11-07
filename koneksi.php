<?php

// koneksi ke dbms
$conn = mysqli_connect("localhost", "root", "", "smks");

function query($query)
{
        global $conn;
        $result = mysqli_query($conn, $query);
        if (!$result) {
                die("Error: " . mysqli_error($conn)); // Untuk menampilkan pesan kesalahan jika terjadi
        }
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
        }
        return $rows;
}



function tambah($data)
{
        // ambil data dari tiap elemen dalam form
        global $conn;
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);

        // upload gambar

        $gambar = upload();

        if (!$gambar) {
                return false;
        }

        $query = "INSERT INTO portofolio 
        VALUES
        ('', '$nama','$gambar','$email')
    ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
}

function upload()
{

        $namafile = $_FILES["gambar"]["name"];
        $ukuranfile = $_FILES["gambar"]["size"];
        $error = $_FILES["gambar"]["error"];
        $tmpname = $_FILES["gambar"]["tmp_name"];

        //cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
                echo "<script>
      alert('alamak');
    </script>";
                return false;
        }


        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode(".", $namafile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "<script>
    alert('alamak');
    </script>";
                return false;
        }

        // cek jika ukurannya terlalu besar
        if ($ukuranfile > 1000000) {
                echo "<script>
    alert('alamak besarnya');
    </script>";
                return false;
        }

        // lolos pengecekan , gambar siap diupload 
        // generate nama gambar baru
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensiGambar;


        move_uploaded_file($tmpname, 'assets/img/portofolio/' . $namafilebaru);
        return $namafilebaru;
}


function hapus($id)
{
        global $conn;
        mysqli_query($conn, "DELETE FROM portofolio WHERE id = $id");

        return mysqli_affected_rows($conn);
}

function ubah($data)
{
        global $conn;


        $id = ($data["id"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $gambarlama = htmlspecialchars($data["gambarlama"]);

        if ($_FILES["gambar"]["error"] === 4) {
                $gambar = $gambarlama;
        } else {
                $gambar = upload();
        }

        $query = " UPDATE portofolio SET
    nama = '$nama',
    email = '$email',
    gambar = '$gambar'
    WHERE id = $id
  ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $query = "SELECT * FROM portofolio 
    WHERE
    nama LIKE '%$keyword%' OR 
    gambar LIKE '%$keyword%'  OR
    email LIKE '%$keyword'";
    
  $results = query($query);
  return $results;
}

function registrasi($data) {

        global $conn;
      
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password"]);
        $email = $data["email"]; // Add email field

      
        //cek konfirmasi password 
      
        if( $password !== $password2) {
          echo "<script>
          alert('konfirmasi password salah)';
          </script>";
          return false;
        }
      
      
        //cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT nama FROM pengguna 
        WHERE nama = '$username'");
      
        if(mysqli_fetch_assoc($result)) {
          echo "<script>
            alert('username sudah ada!');
          </script>";
          return false;
        }
      
        // enkripsi password
      
        $password = password_hash($password, PASSWORD_DEFAULT);
      
        //tambahkan userbaru ke database
        mysqli_query($conn, "INSERT INTO pengguna (nama, password, email) VALUES('$username', '$password', '$email')");
      
        return mysqli_affected_rows($conn);
      
}
?>      
