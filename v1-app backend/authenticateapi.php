<?php
require_once "jiziconf.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

    $email2 = $obj[0];
    $password = $obj[1];

    $sql = "SELECT `name`, `country`, `city`, `broadbiz` ,`type`, `email` FROM dbv1 WHERE email = ? AND pwd = ? AND verified = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email2,$password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        http_response_code(200);
    }else{
        http_response_code(301);
    }
}