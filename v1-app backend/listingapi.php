<?php
require_once "jiziconf.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

    $broad = $obj[0];
    $region = $obj[1];

    $sql = "SELECT `serviceType`,`serviceName`, `serviceProvider`, `serviceDescription`,`mon`,`tue`,`wed`,`thu`,`fri`,`sat`,`sun`,`hourStart`,`minStart`,`hourEnd`,`minEnd`,`price`,`currency` FROM services WHERE serviceType = ? AND city = ?";//not sure about this selection of data fields
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $broad,$region);
    $array_push = [];
    $stmt->execute();
    $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $array_push = array_merge($array_push, $data);
    $return = array("serviceModel" => $array_push);
    echo json_encode($return);

}