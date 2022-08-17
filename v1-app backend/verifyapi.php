<?php
require_once "jiziconf.php";
$conn->set_charset('utf8mb4'); // always set the charset


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

    $vkey = $obj;

    $sql = "SELECT verified vkey FROM dbv1 WHERE verified = 0 AND vkey = ? Limit 1"; // not sure if '' needs to go around ?
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $vkey);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $sql2 = "UPDATE dbv1 SET verified = 1 WHERE vkey = ? LIMIT 1";
        $stmt= $conn->prepare($sql2);
        $stmt->bind_param("s", $vkey);
        $stmt->execute();
        echo http_response_code(200);

    }else{
        echo http_response_code(202);

    }

}
