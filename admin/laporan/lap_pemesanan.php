<?php session_start();
ob_start();
include '../koneksi.php';                     // Panggil koneksi ke database
include '../fungsi/base_url.php';            // Panggil fungsi base_url
include '../fungsi/cek_session.php';  // Panggil fungsi cek session public
include '../fungsi/tgl_indo.php';
include '../fungsi/time.php';
?>
<?php
$tanggalakhir1    = date('d/m/Y', strtotime($_POST['tanggal1']));
$tanggalawal1     = date('d/m/Y', strtotime($_POST['tanggal']));
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Laporan Pemesanan</title>
    <style type="text/css">
        .tabel2 {
            margin-top: 4px;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 1;
        }

        .tabel2 tr.odd td {
            background-color: #000;
        }

        .tabel2 th,
        .tabel2 td {
            padding: 4px 5px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border: 1px solid #dddddd;
        }
    </style>

</head>

<body>
    <table>
        <tr>
            <td align="center">
                <font style="font-size: 15px; text-align: left;">
                    <img src="../../gambar/logo1.png" style="width: 200px; height: 50px; float: left;">
                    <p><b>Rumah Kopi Mukidi</b> Dusun Jambon, Kecamatan Gandurejo Bulu, Kabupaten Temanggung, Jawa Tengah. 56253</p>
                </font>
            </td>
        </tr>
    </table>
    <hr />
    <br>
    <p align="center"> <b>DATA LAPORAN PEMESANAN :</b> <b style="color:blue"><?php echo $tanggalawal1 ?></b> - <b style="color:blue"><?php echo $tanggalakhir1 ?></b> </p>
    <table id="tabel2" class="tabel2" align="center" width="100%" cellspacing="0">
        <thead style="text-align: center; background-color:#C1C1C1">
            <tr>
                <td style="text-align: center; background-color:#f5f5f5">No</td>
                <td style="text-align: center; background-color:#f5f5f5">ID Pemesanan</td>
                <td style="text-align: center; background-color:#f5f5f5">Tgl Checkout</td>
                <td style="text-align: center; background-color:#f5f5f5">Nama Pelanggan</td>
                <td style="text-align: center; background-color:#f5f5f5">Total Bayar</td>
            </tr>

        </thead>
        <tbody>

            <?php
            $tanggalakhir  = date('Y-m-d', strtotime($_POST['tanggal1']));
            $tanggalawal   = date('Y-m-d', strtotime($_POST['tanggal']));
            $sql = "SELECT * FROM tb_pemesanan a JOIN tb_pelanggan b ON a.id_pelanggan = b.id_pelanggan  WHERE tanggal_checkout BETWEEN '$tanggalawal' AND ' $tanggalakhir'  AND status_pemesanan = 5 ORDER BY id_pemesanan ASC;";

            $result = mysqli_query($conn, $sql);
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $ttb = number_format($data['total_bayar'], 0, ',', '.');

                    $tanggal = date('d-m-Y', strtotime($data['tanggal_checkout']));

                    echo "<tr>
                <col width='10'>
                  <td style='text-align: center'>" . $no . "</td>
                <col width='80'>
                  <td style='text-align: center'>" . $data['id_pemesanan'] . "</td>
                <col width='100'>
                  <td style='text-align: center'>$tanggal</td>
                <col width='200'>
                  <td style='text-align: center'>" . $data['nama_pelanggan'] . "</td>
                <col width='140'>
                  <td style='text-align: right'>Rp, $ttb</td>
                </tr>";
                    $no++;
                }
            } else {
                echo " ";
            }
            ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>

    <br>
    <br><br><br>
    <hr />

    <h5 align="right"><?php echo $hr . ", " . $tgl . " " . $bln . " " . $thn; ?> </h5>
    <br>
    <br>
    <br>
    <br>
    <p align="right"><b> Pak Mukidi</b></p>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
// ob_get_clean = salah 1 fungsi dalam PHP
$content = ob_get_clean();
// Memanggil class HTML2PDF dari direktori html2pdf pada project kita
include '../../html2pdf/html2pdf.class.php';
try {
    // Mengatur invoice dalam format HTML2PDF
    // Keterangan: L = Landscape/ P = Portrait, A4 = ukuran kertas, en = bahasa, false = kode HTML2PDF, UTF-8 = metode pengkodean karakter
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 5, 10, 0));
    // Mengatur invoice dalam posisi full page
    $html2pdf->pdf->SetDisplayMode('fullpage');
    // Menuliskan bagian content menjadi format HTML
    $html2pdf->writeHTML($content);
    // Mencetak nama file invoice
    $html2pdf->Output('laporan.pdf');
}
// Kodingan HTML2PDF
catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>