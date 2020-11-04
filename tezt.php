<?php
    // SAMPLE HIT API iPaymu v2 PHP //
    $nama = 'aji';
    $no_hp = '0383838833333';
    $email = 'ajisuk31@gmail.com';

    $total = 5100;

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
    $body['expired']        = '48';
    $body['referenceId']    = 'INV-02922';
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
        header("location:" . $ret->Data->{'QrTemplate'}." ");
        } else {
            echo $ret;
        }
        //End retponse
    } 
?>

