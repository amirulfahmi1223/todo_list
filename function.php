<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_todo";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  echo "Gagal Connect" . mysqli_connect_error($conn);
}
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
function tambahTodo($data)
{
  global $conn;
  //ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
  //menggunakan 0 sebanyak 5 kali menggunakan %05s
  $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_kegiatan, 4)) AS id FROM tb_kegiatan");
  $d = mysqli_fetch_object($getMaxId);
  $generateId = 'KGT' . '-' . date('Y-m-d') . sprintf("%04s", $d->id + 1);
  $kegiatan = htmlspecialchars($data["kegiatan"]);
  $hari = htmlspecialchars($data["hari"]);
  $tgl = htmlspecialchars($data["tgl"]);
  $jam = htmlspecialchars($data["jam"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $id_user = $_SESSION['id'];
  $status = "To do";
  //query insert data
  $query = "INSERT INTO tb_kegiatan
  VALUES 
  ('$generateId','$kegiatan','$hari','$tgl','$jam','$tempat','$status','$id_user')
  ";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function tambahIssue($data)
{
  global $conn;
  $kegiatan = $data["kegiatan"];
  $hari = htmlspecialchars($data["hari"]);
  $tgl = htmlspecialchars($data["tgl"]);
  $tugas = htmlspecialchars($data["tugas"]);
  $status = "To do";
  //upload gambar
  $gambar = uploadGambar();
  if (!$gambar) {
    return false;
  }
  $query = "INSERT INTO tb_issue 
            VALUES ('','$kegiatan','$hari','$tgl','null','$status','$tugas','$gambar')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
function uploadGambar()
{
  $namafile = $_FILES['logo']['name'];
  $ukuranfile = $_FILES['logo']['size'];
  $error = $_FILES['logo']['error'];
  $tmpName = $_FILES['logo']['tmp_name'];

  //cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  //cek apakah yang diupload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
  $ekstensiGambar = explode('.', $namafile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar');
    </script>";
    return false;
  }
  //cek jika ukurannya terlalu besar
  if ($ukuranfile > 5000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar!');
    </script>";
    return false;
  }
  //lolos pengecekan, gambar siap diupload
  //generate nama gambar baru
  $namafileBaru = uniqid();
  $namafileBaru .= '.';
  $namafileBaru .= $ekstensiGambar;
  move_uploaded_file($tmpName, 'gambar/' . $namafileBaru);
  return $namafileBaru;
}


function tambahAkun($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $pass1 = htmlspecialchars($data["pass1"]);
  $pass2 = htmlspecialchars($data["pass2"]);
  $foto = "shshs";
  if ($pass2 != $pass1) {
    echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
    return false;
  }
  $result = mysqli_query($conn, "SELECT email FROM tb_user WHERE email = '$email'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Email sudah terdaftar');</script>";
    return false; //dihentikan funcitionya
    //supaya insert nya gagal dan yang bawah tidak dijalankan
  }
  $query = "INSERT INTO tb_user VALUES ('','$nama','$email','$pass2','$foto','')
    ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function UbahIssue($data)
{
  global $conn;
  $kegiatan = $data["kegiatan"];
  $hari = htmlspecialchars($data["hari"]);
  $tgl = htmlspecialchars($data["tgl"]);
  $tugas = htmlspecialchars($data["tugas"]);
  $status =  htmlspecialchars($data["status"]);
  $id =  htmlspecialchars($data["id"]);
  $gambarLama =  htmlspecialchars($data["gambarLama"]);
  //upload gambar
  //cek apakah user pilih gambar baru atau tidak
  if ($_FILES['logo']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = uploadGambar();
  }
  $query = "UPDATE tb_issue SET 
            name_issue = '$kegiatan',
            hari = '$hari',
            tanggal = '$tgl',
            status = '$status',
            id_user = '$tugas',
            gambar = '$gambar'
            WHERE id_issue = '" . $id . "'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function ubahTodo($data)
{
  global $conn;
  //ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
  //menggunakan 0 sebanyak 5 kali menggunakan %05s
  $kegiatan = htmlspecialchars($data["kegiatan"]);
  $hari = htmlspecialchars($data["hari"]);
  $tgl = htmlspecialchars($data["tgl"]);
  $jam = htmlspecialchars($data["jam"]);
  $tempat = htmlspecialchars($data["tempat"]);
  $id = $data["id"];
  $id_user = $_SESSION['id'];
  $status = htmlspecialchars($data["status"]);
  //query insert data
  $query = "UPDATE tb_kegiatan SET
  nama_kegiatan = '$kegiatan',
  hari = '$hari',
  tanggal= '$tgl',
  jam = '$jam',
  tempat = '$tempat',
  id_user = '$id_user',
  status = '$status'
  WHERE id_kegiatan = '$id'";
  //panggil disini
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
