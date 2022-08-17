<?php
require_once "jiziconf.php";
$conn->set_charset('utf8mb4'); // always set the charset

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = $f;
    $obj = json_decode($jsonobj);

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
    $serviceNameold = $obj[17];
    $city = $obj[18];


    $sql = "UPDATE `services` SET `serviceProvider` = ?, `serviceType` = ?, `serviceName` = ?, `serviceDescription` = ?, `mon` = ?, `tue` = ?, `wed` = ?, `thu` = ?, `fri` = ?, `sat` = ?, `sun` = ?, `hourStart` = ?, `minStart` = ?, `hourEnd` = ?, `minEnd` = ?, `price` = ?, `currency` = ?, `city` = ? WHERE `serviceName` = ?";
    $stmt = $conn->prepare($sql);
//                                                      1                       2               3          4    5     6     7    8      9    10     11              12      13        14        15    16            17
    $stmt->bind_param("sssssssssssssssssss",$bizname,$serviceType,$serviceName,$serviceDescription,$mon,$tue, $wed, $thu, $fri, $sat, $sun, $hourStart, $minStart, $hourEnd, $minEnd, $price, $currency, $city,$serviceNameold);
    if($stmt->execute()){
        http_response_code(200);
    }else{
        http_response_code(201);
    }
}