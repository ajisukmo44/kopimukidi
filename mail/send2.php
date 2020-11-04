<?php
session_start();
include '../admin/koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');

$email = $_POST['email'];

$cekdata = "SELECT email FROM tb_pelanggan WHERE email = '$email' ";
$ada     = mysqli_query($conn, $cekdata);
if (mysqli_num_rows($ada) == 0) {
    header("location:../lupapassword.php?alert=gakterdaftar");
} else {


    $email_pengirim = 'kopimukiditemanggung@gmail.com'; // Isikan dengan email pengirim
    $nama_pengirim = 'Kopi Mukidi'; // Isikan dengan nama pengirim
    $email_penerima = $email; // Ambil email penerima dari inputan form
    $subjek = 'RESET PASSWORD'; // Ambil subjek dari inputan form

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
    include "content2.php";

    $content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
    ob_end_clean();

    $mail->Subject = $subjek;
    $mail->Body = $content;

    if (empty($attachment)) { // Jika tanpa attachment
        $send = $mail->send();

        if ($send) { // Jika Email berhasil dikirim

            header("location:../lupapassword.php?alert=berhasil");
        } else { // Jika Email gagal dikirim
            header("location:../lupapassword.php?alert=gagal");
        }
    }
};
