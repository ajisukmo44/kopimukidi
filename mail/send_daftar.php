<?php
session_start();
include '../admin/koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');

$id = $_GET['id'];
$email = $_GET['email'];

$email_pengirim = 'kopimukiditemanggung@gmail.com'; // Isikan dengan email pengirim
$nama_pengirim = 'Kopi Mukidi'; // Isikan dengan nama pengirim
$email_penerima = $email; // Ambil email penerima dari inputan form
$subjek = 'VALIDASI PENDAFTARAN'; // Ambil subjek dari inputan form

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
include "contentdaftar.php";

$content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
ob_end_clean();

$mail->Subject = $subjek;
$mail->Body = $content;

if (empty($attachment)) { // Jika tanpa attachment
    $send = $mail->send();

    if ($send) { // Jika Email berhasil dikirim
        header("location:../login.php?alert=terdaftar");
    } else { // Jika Email gagal dikirim
        echo "<script>alert('Email Gagal, Terkirim!');location.replace('../daftar.php')</script>";
    }
};
