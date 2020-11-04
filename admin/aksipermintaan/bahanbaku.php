<?php session_start();
include '../koneksi.php';
$query     = "SELECT max(id_pembelian)AS kode FROM tb_pembelian_bahanbaku";
$cari_kd   = mysqli_query($conn, $query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'], 5, 8); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah = $kode + 1; //kode yang sudah di pecah di tambah 1
if ($tambah < 10) { //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id = "PMB-00" . $tambah;
} else {
    $id = "PMB-000" . $tambah;
}


if (isset($_POST['submit'])) {

    $idb          = mysqli_real_escape_string($conn, $_POST['id_bahanbaku']);
    $idp          = mysqli_real_escape_string($conn, $_POST['id_petani']);
    $jumlah       = mysqli_real_escape_string($conn, $_POST['jumlah']);

    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_pembelian_bahanbaku (id_pembelian, id_bahanbaku, id_petani, jumlah, total_harga, tanggal_pembelian, status_pembelian)
    VALUES ('$id','$idb','$idp','$jumlah','', now(), 1);";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id',1, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../datapembelian.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
