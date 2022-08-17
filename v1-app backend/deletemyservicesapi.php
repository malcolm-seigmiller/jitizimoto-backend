<?php
require_once "jiziconf.php";
$conn->set_charset('utf8mb4'); // always set the charset

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = $f;
    $obj = json_decode($jsonobj);

    $sql = "DELETE FROM `services` WHERE `serviceName` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$obj);
    if($stmt->execute()){
        http_response_code(200);
    }else{
        http_response_code(201);
    }
}