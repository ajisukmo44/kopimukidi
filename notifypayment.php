<?php
    session_start();
    // SAMPLE HIT API iPaymu v2 PHP //
    $nama   = $_SESSION['nama_pelanggan'];
    $no_hp  = $_SESSION['no_hp'];
    $email  = $_SESSION['email'];
    $idp    = $_GET['idp'];
    $total  = $_GET['thp'];
    $ongkir = $_GET['ong'];
    $tb     = $total + $ongkir;

    // SAMPLE HIT API iPaymu v2 PHP //

    $va           = '1179008872095918';
    $secret       = '4494BB41-3A98-4CA4-B5B1-37D8C0602705'; 
    $url          = 'https://my.ipaymu.com/api/v2/payment';
    $method       = 'POST'; 

    //Request Body//
    $body['product']        = array('total harga produk', 'ongkir');
    $body['qty']            = array('1', '1');
    $body['price']          = array($total, $ongkir);
    $body['returnUrl']      = 'http://localhost/kopimukidi/paymentsuccess.php?idp='.$idp;
    $body['cancelUrl']      = 'http://localhost/kopimukidi/index.php';
    $body['notifyUrl']      = 'http://localhost/kopimukidi/index.php';
    $body['paymentMethod']  = 'qris';
    $body['expired']        = '24';
    $body['referenceId']    = $idp;
    $body['buyerName']      = $nama;
    $body['buyerEmail']     = $email;
    $body['buyerPhone']     = $no_hp;
    
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

        //Response
        $ret = json_decode($ret);
        if($ret->Status == 200) {
            $sessionId  = $ret->Data->SessionID;
            $url        =  $ret->Data->Url;

            include 'koneksi.php';

            mysqli_query($koneksi, "UPDATE tb_pemesanan SET link_pembayaran = '$url', status_pemesanan='2' WHERE id_pemesanan = '$idp'");

            mysqli_query($koneksi, "INSERT INTO tb_pembayaran values ('','$idp','payment gateway','-','QRIS','$tb','payment.jpg',now(),'1')");

            mysqli_query($koneksi, "INSERT INTO tb_riwayat_status values('','$idp',2, now())");

            header('Location:' . $url);
        } else {
            echo $ret;
        }
        //End Response
    }

?>