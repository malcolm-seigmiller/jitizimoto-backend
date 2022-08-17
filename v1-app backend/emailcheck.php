<?php
$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);
require_once "jiziconf.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

//    $m = "mr.fantabluar@gmail.com";

    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

    $sql2 = "SELECT email FROM emailtemp WHERE email = ? ";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $obj );
    $stmt2->execute();
    $result = $stmt2->get_result(); // get the mysqli result

    if($result->num_rows == 1){
        http_response_code(200);
    }else{
        http_response_code(202);
    }
    echo $f;
}