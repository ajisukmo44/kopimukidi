<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database
$query     = "SELECT max(id_pembelian)AS kode FROM tb_pembelian_bahanbaku";
$cari_kd   = mysqli_query($conn, $query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'], 5, 8); 

$tambah = $kode + 1; //kode yang sudah di pecah di tambah 1
if ($tambah < 10) { //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id = "PMB-00" . $tambah;
} else {
    $id = "PMB-000" . $tambah;
}

// membuat variabel untuk menampung data dari form
$idb        = $_POST['id_bahanbaku'];
$idp        = $_POST['id_petani'];
$jml        = $_POST['jumlah'];
$th         = $_POST['total_harga'];
$tgl        = $_POST['tanggal'];
$img        = $_FILES['nota_pemesanan']['name'];

//cek dulu jika ada gambar produk jalankan coding ini
if ($img != "") {
  $ekstensi_diperbolehkan = array('jpeg','png', 'jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $img); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['nota_pemesanan']['tmp_name'];
  $angka_acak     = rand(1, 999);
  $notapembelian = $angka_acak . '-' . $img; //menggabungkan angka acak dengan nama file sebenarnya
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, '../../images/notapembelian/' . $notapembelian); 

    $isi = mysqli_query($conn, "SELECT * FROM tb_bahanbaku WHERE id_bahanbaku='$idb'");
    $i = mysqli_fetch_assoc($isi);
    $stoklama = $i['stok_bahanbaku'];
    $stokbaru = $stoklama + $jml;

    $sql = "INSERT INTO tb_pembelian_bahanbaku (id_pembelian, tanggal_pembelian, id_bahanbaku, id_petani, jumlah, total_harga, nota_pembelian)
    VALUES ('$id','$tgl','$idb','$idp','$jml','$th','$notapembelian');";
 
    $sql .= "UPDATE tb_bahanbaku SET stok_bahanbaku = $stokbaru WHERE id_bahanbaku = '$idb' ";

    $result = mysqli_multi_query($conn, $sql);
    // periska query apakah ada error
    if (!$result) {
      die("Query gagal dijalankan: " . mysqli_errno($conn) .
        " - " . mysqli_error($conn));
    } else {

      echo "<script>alert('Data berhasil ditambah.');window.location='../../datapembelian.php';</script>";
    }
  } else {
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../../datapembelian.php';</script>";
  }
} else {

  $isi = mysqli_query($conn, "SELECT * FROM tb_bahanbaku WHERE id_bahanbaku='$idb'");
  $i = mysqli_fetch_assoc($isi);
  $stoklama = $i['stok_bahanbaku'];
  $stokbaru = $stoklama + $jml;

$sql = "INSERT INTO tb_pembelian_bahanbaku (id_pembelian, tanggal_pembelian, id_bahanbaku, id_petani, jumlah, total_harga)
VALUES ('$id', '$tgl','$idb','$idp','$jml','$th');";


$sql .= "UPDATE tb_bahanbaku SET stok_bahanbaku = $stokbaru WHERE id_bahanbaku = '$idb' ";


    $result = mysqli_multi_query($conn, $sql);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($conn) .
      " - " . mysqli_error($conn));
  } else {
    echo "<script>alert('Data berhasil ditambah.');window.location='../../datapembelian.php';</script>";
  }
};
