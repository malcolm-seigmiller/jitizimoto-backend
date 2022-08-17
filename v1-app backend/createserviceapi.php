<?php

require_once "jiziconf.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);
//    $obj = json_decode(json_encode($jsonobj));
//    $obj = json_decode(json_encode($jsonobj), true);

//    echo $f;
//    echo $obj;

//    echo implode(', ', $obj);
    $bizname = $obj[0];
    $serviceName = $obj[1];
    $serviceType = $obj[2];
    $serviceDescription = $obj[3];
    $mon = $obj[4];
    $tue = $obj[5];
    $wed = $obj[6];
    $thu = $obj[7];
    $fri = $obj[8];
    $sat = $obj[9];
    $sun = $obj[10];
    $hourStart = $obj[11];
    $minStart = $obj[12];
    $hourEnd = $obj[13];
    $minEnd = $obj[14];
    $price = $obj[15];
    $currency = $obj[16];
    $city = $obj[17];

//    sssiiiiiiiiiiisss
//                                      1               2           3               4             5    6   7     8     9   10   11   12          13        14      15      16     17          18      1  2  3  4  5  6  7  8  9  10 11 12 13 14 15 16 17
    $sql = "INSERT INTO `services` (serviceProvider, serviceType, serviceName, serviceDescription, mon, tue, wed, thu, fri, sat, sun, hourStart, minStart, hourEnd, minEnd, price, currency, city)VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
//                                                           1                 2        3                  4   5      6    7      8     9   10        11         12        13        14       15     16             17      18
    $stmt->bind_param("ssssssssssssssssss",$bizname,$serviceType,$serviceName,$serviceDescription,$mon,$tue, $wed, $thu, $fri, $sat, $sun, $hourStart, $minStart, $hourEnd, $minEnd, $price, $currency, $city);
//    $stmt->bind_param("sssssssssssssssss",$serviceName,$serviceType,$serviceDescription,$mon,$tue, $wed, $thu, $fri, $sat, $sun, $hourStart, $minStart, $hourEnd, $minEnd, $price, $currency, $bizname);
    if($stmt->execute()){
        http_response_code(200);
    }else{
        http_response_code(201);
    }
}