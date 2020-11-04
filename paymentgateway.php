<?php
session_start();
    // SAMPLE HIT API iPaymu v2 PHP //
    $nama  = $_SESSION['nama_pelanggan'];
    $no_hp = $_SESSION['no_hp'];
    $email = $_SESSION['email'];
    $total =  $_GET['tb'];
    $idp =  $_GET['idp'];

    $va           = '1179002147210076'; //get on iPaymu dashboard
    $secret       = '37B0F8A5-980A-4307-BE82-36DD23CF84C4'; //get on iPaymu dashboard

    $url          = 'https://my.ipaymu.com/api/v2/payment/direct'; //url
    $method       = 'POST'; //method

    //Request Body//

    $body['key']            = '37B0F8A5-980A-4307-BE82-36DD23CF84C4';
    $body['name']           = "{$nama}";
    $body['phone']          = $no_hp;
    $body['email']          = "{$email}";
    $body['amount']         = $total;
    $body['paymentMethod']  = 'qris';
    $body['expired']        = '24';
    $body['referenceId']    = "{$idp}";
    $body['notifyUrl']      = 'http://google.com';
    //End Request Body//

    //Generate Signature
    // *Don't change this
    $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
    $requestBody  = strtolower(hash('sha256', $jsonBody));
    $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
    $signature    = hash_hmac('sha256', $stringToSign, $secret);
    $timestamp    = Date('YmdHis');
    //End Generate Signature


    $ch = curl_init($url);

    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        'va: ' . $va,
        'signature: ' . $signature,
        'timestamp: ' . $timestamp
    );

    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_POST, count($body));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $err = curl_error($ch);
    $ret = curl_exec($ch);
    curl_close($ch);
    if($err) {
        echo $err;
    } else {

        //retponse
        $ret = json_decode($ret);
        if($ret->Status == 200) {    
            include 'koneksi.php';
            $link = $ret->Data->{'QrTemplate'};
            
            mysqli_query($koneksi, "UPDATE tb_pemesanan SET link_pembayaran = '$link', status_pemesanan='2' WHERE id_pemesanan = '$idp'");

            mysqli_query($koneksi, "INSERT INTO tb_pembayaran values ('','$idp','payment gateway','-','QRIS','$total','payment.jpg',now(),'1')");

            mysqli_query($koneksi, "INSERT INTO tb_riwayat_status values('','$id',2, now())");
        
            header("location:" . $ret->Data->{'QrTemplate'}." ");
        
        } else {
            echo $ret;
        }
        //End retponse
    } 
?>