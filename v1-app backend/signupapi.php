<?php

require_once "jiziconf.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

//    echo implode(', ', $obj);

    $email = $obj[0];
    $password = $obj[1];
    $country = $obj[2];
    $city = $obj[3];
    $broad = $obj[4];
    $type = $obj[5];
    $name = $obj[6];
//    sql

//    generate vkey
    $length = 6;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $vkey = $randomString;

    $verified = 0 ;
    //sql
    $sql2 = "INSERT INTO dbv1 (name, country, city, broadbiz, type, email, pwd, vkey, verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("sssssssss", $name,  $country, $city, $broad, $type, $email, $password, $vkey,  $verified);
    if($stmt2->execute()){
        //send email
//        we dont have to send mail. just read it from the db implement it later

        http_response_code(201);
    }else{
        http_response_code(202);
    }


}
