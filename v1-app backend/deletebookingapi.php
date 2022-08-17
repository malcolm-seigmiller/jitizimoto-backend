<?php
require_once "jiziconf.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn->set_charset('utf8mb4'); // always set the charset

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = $f;
    $obj = json_decode($jsonobj);

    $name = $obj[0];
    $servicename = $obj[1];

    $sql = "DELETE FROM `bookings` WHERE `booker` = ? AND `serviceName` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$name,$servicename);
    if($stmt->execute()){
        http_response_code(200);
    }else{
        http_response_code(201);
    }
}