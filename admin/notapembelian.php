<?php session_start();
ob_start();
include 'koneksi.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session.php';  // Panggil fungsi cek session public
include 'fungsi/tgl_indo.php';
include 'fungsi/time.php';

$id = $_GET['id'];

$sql = "SELECT * FROM tb_pembelian_bahanbaku a JOIN tb_bahanbaku b ON a.id_bahanbaku = b.id_bahanbaku JOIN tb_petani c ON a.id_petani = c.id_petani WHERE id_pembelian = $id ORDER BY a.id_pembelian ASC;";
$result = mysqli_query($conn, $sql);
$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_array($result)) {
        $petani = $data['nama_petani'];
        $alamat = $data['alamat'];
        $nohp = $data['no_hp'];
        $id_pembelian = $data['id_pembelian'];
    }
?>


    <html xmlns="http://www.w3.org/1999/xhtml">
    <!-- Bagian halaman HTML yang akan konvert -->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Nota Pembelian</title>
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
                        <img src="../gambar/logo1.png" style="width: 200px; height: 50px; float: left;">
                        <p style="margin-left:250px">NOTA PEMBELIAN BAHANBAKU<b> #<?= $id ?></b></p>
                    </font>
                </td>
            </tr>
        </table>
        <hr />
        <br>
        <b>From</b>
        <p> Nama Petani : <?= $petani ?> | Alamat : <?= $alamat ?> | No Hp : <?= $nohp ?> <br>
        </p>
        <hr>
    <?php
}
    ?>
    <p align="center">DATA PEMBELIAN BAHANBAKU</p>
    <table id="tabel2" class="tabel2" align="center" width="100%" cellspacing="0">
        <thead style="text-align: center; background-color:#C1C1C1">
            <tr>
                <td style="text-align: center; background-color:#f5f5f5">Tgl Pembelian</td>
                <td style="text-align: center; background-color:#f5f5f5">Nama Bahanbaku</td>
                <td style="text-align: center; background-color:#f5f5f5">Jumlah / Kg</td>
                <td style="text-align: center; background-color:#f5f5f5">Total Harga</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tb_pembelian_bahanbaku a JOIN tb_bahanbaku b ON a.id_bahanbaku = b.id_bahanbaku JOIN tb_petani c ON a.id_petani = c.id_petani WHERE id_pembelian = $id ORDER BY a.id_pembelian ASC;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $th = number_format($data['total_harga'], 0, ',', '.');
                    $tanggal = date('d-m-Y', strtotime($data['tanggal_pembelian']));
                    $namapetani = $data['nama_petani'];
                    echo "<tr>
                <col width='80'>
                  <td style='text-align: center'>$tanggal</td>
                <col width='200'>
                  <td style='text-align: center'>" . $data['nama_bahanbaku'] . "</td>
                <col width='120'>
                  <td style='text-align: center'>" . $data['jumlah'] . " Kg</td>
                  <col width='120'>
                  <td style='text-align: right'><b>Rp, $th </b></td>
                </tr>";
                    $no++;
                }
            ?>
        </tbody>
    </table>
    <br>
    <br>
    <br><br><br>
    <hr />
    <h5 align="right"> <?= $tanggal ?> </h5>
    <br>
    <br>
    <br>
    <br>
    <p align="right"><b><?= $namapetani ?></b></p>
    </body>
<?php
            }
?>

    </html><!-- Akhir halaman HTML yang akan di konvert -->

    <?php
    // ob_get_clean = salah 1 fungsi dalam PHP
    $content = ob_get_clean();
    // Memanggil class HTML2PDF dari direktori html2pdf pada project kita
    include '../html2pdf/html2pdf.class.php';
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