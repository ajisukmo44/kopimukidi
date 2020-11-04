<?php
session_start();
include '../koneksi.php';
$id       = mysqli_real_escape_string($koneksi, $_GET['id']);
$email    = $_SESSION['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include librari phpmailer
include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');


$email_pengirim = 'kopimukiditemanggung@gmail.com'; // Isikan dengan email pengirim
$nama_pengirim = 'Kopi Mukidi'; // Isikan dengan nama pengirim
$email_penerima = $email; // Ambil email penerima dari inputan form
$subjek = 'INVOICE'; // Ambil subjek dari inputan form

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Username = $email_pengirim; // Email Pengirim
$mail->Password = 'fepouvdradrcyreo'; // Isikan dengan Password email pengirim
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
//$mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

$mail->setFrom($email_pengirim, $nama_pengirim);
$mail->addAddress($email_penerima, '');
$mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

// Load file content.php
ob_start();
include "content.php";

$content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
ob_end_clean();

$mail->Subject = $subjek;
$mail->Body = $content;
$mail->AddEmbeddedImage('image/logo.png', 'logo_mynotescode', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email
$mail->AddEmbeddedImage('image/logo2.png', 'logo_mynotescode2', 'logo2.png'); // Aktifkan jika ingin menampilkan gambar dalam email
$mail->AddEmbeddedImage('image/payment.png', 'logo_mynotescode3', 'logo3.png'); // Aktifkan jika ingin menampilkan gambar dalam email

if (empty($attachment)) { // Jika tanpa attachment
    $send = $mail->send();

    if ($send) { // Jika Email berhasil dikirim

        header("location:../invoicetransaksi.php?id=$id");
    } else { // Jika Email gagal dikirim
        echo "<h1>Email gagal dikirim</h1><br /><a href='index.php'>Kembali ke Form</a>";
        // echo '<h1>ERROR<br /><small>Error while sending email: '.$mail->getError().'</small></h1>'; // Aktifkan untuk mengetahui error message
    }
};
