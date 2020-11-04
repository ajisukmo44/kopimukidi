<?php session_start();
include '../../koneksi.php';
// Panggil koneksi ke database

$id         = $_POST['id_pembelian'];
$idb        = $_POST['id_bahanbaku'];
$idp        = $_POST['id_petani'];
$jml        = $_POST['jumlah'];
$th         = $_POST['total_harga'];
$tgl        = $_POST['tanggal'];
$img        = $_FILES['nota']['name'];

//cek dulu jika merubah gambar produk jalankan coding ini
if ($img != "") {
    $ekstensi_diperbolehkan = array('jpeg','png', 'jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $img); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['nota']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $notapembelian = $angka_acak . '-' . $img; //menggabungkan angka acak dengan nama file sebenarnya
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, '../../images/notapembelian/' . $notapembelian); //memindah file gambar ke folder gambar

        // jalankan query UPDATE berdasarkan ID yang produknya kita edit
        $query  = "UPDATE tb_pembelian_bahanbaku SET tanggal_pembelian = '$tgl', id_bahanbaku = '$idb', id_petani = '$idp', jumlah = '$jml', total_harga = '$th', nota_pembelian = '$notapembelian' ";
        $query .= "WHERE id_pembelian = '$id'";
        $result = mysqli_query($conn, $query);
        
        // periska query apakah ada error
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            //silahkan ganti index.php sesuai halaman yang akan dituju
            echo "<script>alert('Data berhasil diubah.');window.location='../../datapembelian.php';</script>";
        }
    } else {
        //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='../../datapembelian.php';</script>";
    }
} else {
    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
    $query  = "UPDATE tb_pembelian_bahanbaku SET tanggal_pembelian = '$tgl', id_bahanbaku = '$idb', id_petani = '$idp', jumlah = '$jml', total_harga = '$th' ";
    $query .= "WHERE id_pembelian = '$id'";
    $result = mysqli_query($conn, $query);
    // periska query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Data berhasil diubah.');window.location='../../datapembelian.php';</script>";
    }
}
