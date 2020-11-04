<?php session_start();
include '../koneksi.php';
$query     = "SELECT max(id_produksi)AS kode FROM tb_produksi";
$cari_kd   = mysqli_query($conn, $query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'], 4, 7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah = $kode + 1; //kode yang sudah di pecah di tambah 1
if ($tambah < 10) { //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
    $id = "PRD-0" . $tambah;
} else {
    $id = "PRD-00" . $tambah;
}

if (isset($_POST['submit'])) {

    $idp        = mysqli_real_escape_string($conn, $_POST['id_produk']);
    $jml        = mysqli_real_escape_string($conn, $_POST['jumlah_bahanbaku']);
    $stok       = mysqli_real_escape_string($conn, $_POST['stok_bahanbaku']);

    $sql = "SELECT * FROM tb_bahanbaku WHERE stok_bahanbaku = $stok ";
    $result = $conn->query($sql);
    foreach ($result as $baris) {
        $idb = $baris['id_bahanbaku'];
    }

    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_produksi (id_produksi, tanggal_produksi, id_produk, id_bahanbaku, jumlah_bahanbaku, jumlah_stok_baru, status_produksi)
VALUES ('$id',now(),'$idp','$idb','$jml','-', 1);";


    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
VALUES ('','$id', 1, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>
    alert('Insert data berhasil! Klik ok untuk melanjutkan');
    location.replace('../dataproduksi.php')
</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
