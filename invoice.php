<?php session_start();
ob_start();
include 'koneksi.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/tgl_indo.php';


$id = $_GET['id'];
$nama = $_SESSION['nama_pelanggan'];
$alamat = $_SESSION['alamat'];
$no_hp = $_SESSION['no_hp'];
?>

<?php
$idp = $_SESSION['id_pelanggan'];
$id = $_GET['id'];
$invoice = mysqli_query($koneksi, "SELECT * FROM tb_pemesanan WHERE id_pelanggan='$idp' AND id_pemesanan='$id' order by id_pemesanan desc");
while ($i = mysqli_fetch_array($invoice)) {
    $tgl = date('d-m-Y', strtotime($i['tanggal_checkout']));


?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <!-- Bagian halaman HTML yang akan konvert -->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>kopi mukidi</title>
        <link rel="stylesheet" href="kopi/css/bootstrap.min.css">

        <!-- Font Awesome Icon -->
        <style type="text/css">
            .tabel2 {
                border-collapse: collapse;
                margin-top: 20px;
                width: 100%;
            }

            .tabel2 tr.odd td {
                background-color: #f9f9f9;
            }

            .tabel2 th,
            .tabel2 td {
                border: 1px;
                border-color: #fff;
                padding: 7px 7px;
                line-height: 20px;
                vertical-align: top;
            }
        </style>
    </head>

    <body>
        <p align="center"> <img src="gambar/logo1.png" alt="" style="width:250px"> </p>
        <hr>
        <p align="center"> <strong>TGL: <?= $tgl ?> | ID PEMESANAN : <?php echo $id; ?></strong> <br>
        </p>
        <div style="margin-top: 25px; margin-bottom:25px">
            <strong>Nama </strong>: <?= $nama ?><br />
            <strong>Alamat </strong>: <?= $alamat ?><br />
            <strong>No Hp:</strong> <?= $no_hp ?><br />
        </div>
        <hr>
        <table class="tabel2 table-responsive" cellspacing="0" cellpadding="4" align="center">
            <tr style="background-color:#41B883; color:#fff">
                <col width="10">
                <th class="text-center">No</th>
                <col width="190">
                <th class="text-center">Nama Produk</th>
                <col width="60">
                <th class="text-center">Harga/Pcs</th>
                <col width="70">
                <th class="text-center">Jumlah</th>
                <col width="70">
                <th class="text-center">Total Berat</th>
                <col width="90">
                <th class="text-center">Total Harga</th>
            </tr>
            <?php
            $no = 1;
            $total = 0;

            $transaksi = mysqli_query($koneksi, "SELECT * FROM tb_detail_pemesanan a, tb_produk b WHERE a.id_produk = b.id_produk AND a.id_pemesanan='$id' ");

            while ($d = mysqli_fetch_array($transaksi)) {
                $jml = $d['jumlah_produk'];
                $total += $d['harga'];
                $berat = $d['berat'] * $d['jumlah_produk'];;
            ?>
                <tr style="background-color:#F7F7F7">
                    <td align="center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo $d['nama_produk']; ?></td>
                    <td align="center"><?php echo "Rp." . number_format($d['harga']); ?></td>
                    <td align="center"><?php echo number_format($d['jumlah_produk']); ?> Pcs</td>
                    <td align="center"><?php echo $berat; ?> Gram</td>
                    <td class="text-center"><?php echo "Rp." . number_format($d['jumlah_produk'] * $d['harga']); ?></td>
                </tr>

            <?php
            }
            ?>

            <tfoot class="tabel2">
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" style="text-align: right;  background-color:#F8F9FA;">Ongkir (<?php echo $i['kurir']; ?> - <?= $i['total_berat']; ?> Gram)</td>
                    <td class="text-center" style="background-color:#F8F9FA;"><?php echo "Rp." . number_format($i['ongkir']); ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" style="text-align: right;  background-color:#F8F9FA;">Total Bayar</td>
                    <th class=" text-center" style="  background-color:#F8F9FA;"><?php echo "Rp." . number_format($i['total_bayar']); ?></th>
                </tr>
            </tfoot>


        </table>
        <h5>Status :
        </h5>
        <?php
        if ($i['status_pemesanan'] == 0) {
            echo "<a href='#' ><span class='label label-danger'>Gagal</span></a>";
        } elseif ($i['status_pemesanan'] == 1) {
            echo "<a href='#' ><span class='label label-danger'>Menunggu Pembayaran</span></a>";
        } elseif ($i['status_pemesanan'] == 2) {
            echo "<a href='#' ><span class='label label-success'>Pembayaran Success</span></a>";
        } elseif ($i['status_pemesanan'] == 3) {
            echo "<a href='#' ><span class='label label-primary'>Sedang Dipacking</span></a>";
        } elseif ($i['status_pemesanan'] == 4) {
            echo "<a href='#' ><span class='label label-info'>Sudah Dikirim</span></a>";
        } elseif ($i['status_pemesanan'] == 5) {
            echo "<a href='#' ><span class='label label-success'>Selesai</span></a>";
        }
        ?>
    <?php
}
    ?>

    <br>
    <br>
    <div class="mt-4 mb-4">
        <hr>
        <p> <b>Lakukan Pembayaran Sebelum Pukul :<span class="text-danger"> <?php
                            date_default_timezone_set("Asia/Jakarta");
                            
                            $date = date("G:i, d-m-Y");
                            $tomorrow = date('G:i, d-m-Y',strtotime($date . "+1 days"));

                            echo $tomorrow;

                            ?></span></b></p>
                            <hr>
                          <b>Silahkan Pilih Pembayaran Dibawah ini :</b>
                          <br>
                          <p><img src="gambar/pgwy.png" alt="" style="width:250px;  margin-top:4px; margin-bottom:4px"> </p>
                            
    </div>
    <br><br>
    <br>
<hr>
    <p align="center"><strong>Rumah Kopi Mukidi</strong>
        Dusun Jambon, Kecamatan Gandurejo Bulu, Kabupaten Temanggung, Jawa Tengah </p>
    <p align="center">Email: kopimukidi@gmail.com | Telp: 087719052174</p>
    </body>

    </html><!-- Akhir halaman HTML yang akan di konvert -->

    <?php
    // ob_get_clean = salah 1 fungsi dalam PHP
    $content = ob_get_clean();
    // Memanggil class HTML2PDF dari direktori html2pdf pada project kita
    include 'html2pdf/html2pdf.class.php';
    try {
        // Mengatur invoice dalam format HTML2PDF
        // Keterangan: L = Landscape/ P = Portrait, A4 = ukuran kertas, en = bahasa, false = kode HTML2PDF, UTF-8 = metode pengkodean karakter
        $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 5, 10, 0));
        // Mengatur invoice dalam posisi full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // Menuliskan bagian content menjadi format HTML
        $html2pdf->writeHTML($content);
        // Mencetak nama file invoice
        $html2pdf->Output('invoice.pdf');
    }
    // Kodingan HTML2PDF
    catch (HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    ?>