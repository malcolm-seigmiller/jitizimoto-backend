<?php
require_once "jiziconf.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn->set_charset('utf8mb4'); // always set the charset

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

    $name = $obj[0];
    $serviceProvider = $obj[1];
    $servicename = $obj[2];
    $price = $obj[3];
    $location = $obj[4];
    $comment = $obj[5];
    $day = $obj[6];
    $month = $obj[7];
    $year = $obj[8];
    $hour = $obj[9];
    $min = $obj[10];
//                                  1           2           3           4          5        6       7     8     9      10
    $sql = "INSERT INTO bookings (booker, serviceProvider, serviceName, price, location, comments, day,month, year, hour, minute) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
//                                                 1            2                  3            4           5       6       7       8       9     10     11
    $stmt->bind_param("sssssssssss", $name,  $serviceProvider, $servicename, $price, $location, $comment, $day, $month, $year,  $hour, $min);
    if($stmt->execute()){
        http_response_code(200);
    }else{
        http_response_code(201);
    }
}