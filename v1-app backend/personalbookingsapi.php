<?php
require_once "jiziconf.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn->set_charset('utf8mb4'); // always set the charset

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

    $sql = "SELECT `booker`, `serviceProvider`, `serviceName`, `location` ,`comments`, `price`,`day`, `month` ,`year`, `hour`, `minute` FROM bookings WHERE `booker` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $obj);
    $array_push = [];
    $stmt->execute();
    $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $array_push = array_merge($array_push, $data);

    $return = array("bookingModel" => $array_push);
    echo json_encode($return);

}
