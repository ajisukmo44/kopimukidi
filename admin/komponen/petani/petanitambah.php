<?php session_start();
include '../../koneksi.php';

if (isset($_POST['simpan'])) {

  $nama       = mysqli_real_escape_string($conn, $_POST['nama_petani']);
  $nohp       = mysqli_real_escape_string($conn, $_POST['no_hp']);
  $alamat      = mysqli_real_escape_string($conn, $_POST['alamat']);
  $bergabung   = mysqli_real_escape_string($conn, $_POST['bergabung']);
  $username   = mysqli_real_escape_string($conn, $_POST['username']);
  $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $cekdata    = "SELECT username FROM tb_petani WHERE username = '$username' ";
  $ada        =  mysqli_query($conn, $cekdata);
  if (mysqli_num_rows($ada) > 0) {
    echo "<script>alert('ERROR: Username telah terdaftar, silahkan pakai Username lain!');history.go(-1)</script>";
  } else {
    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_petani ( nama_petani,
                                no_hp,
                                alamat,
                                bergabung,
                                username,
                                password)
                        VALUES (
                                '$nama',
                                '$nohp',
                                '$alamat',
                                '$bergabung',
                                '$username',
                                '$password')";

    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapetani.php')</script>";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }
} else {
  echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}
