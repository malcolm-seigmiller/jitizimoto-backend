<?php
require_once "jiziconf.php";
$conn->set_charset('utf8mb4'); // always set the charset
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
//    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long
    $jsonobj = $f;//may not need this and it may be counter productive in the long run

    $obj = json_decode($jsonobj);

//    $sql = "SELECT * FROM services WHERE serviceProvider = ?";//not sure about this selection of data fields
        $sql = "SELECT `serviceType`,`serviceName`, `serviceProvider`, `serviceDescription`,`mon`,`tue`,`wed`,`thu`,`fri`,`sat`,`sun`,`hourStart`,`minStart`,`hourEnd`,`minEnd`,`price`,`currency`,`city` FROM services WHERE serviceProvider = ?";//not sure about this selection of data fields
//    $sql = "SELECT `serviceName`,`price` FROM services WHERE serviceProvider = ?";//not sure about this selection of data fields

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $obj);
//    $stmt->execute();
    $array_push = [];
    $stmt->execute();
    $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $array_push = array_merge($array_push, $data);

//    $return = $array_push;
//    echo json_encode("item"$array_push);
//    $return = array("resoponse" => array("check" => "ahhhhhhhh"), "Mlist" => $array_push);

    $return = array("serviceModel" => $array_push);
    echo json_encode($return);
}

//$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
//    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
//    \PDO::ATTR_EMULATE_PREPARES => false
//]);
//if($_SERVER["REQUEST_METHOD"] == "POST"){
//    //get incoming data
//    $f = file_get_contents('php://input');
//    $jsonobj = stripslashes($f);
//
//    $obj = json_decode($jsonobj);
//    // print_r(array($data));
////    $wherein = str_repeat(',?', count($obj) - 1);
//    $stmt = $pdo->prepare("SELECT (*) FROM services WHERE name = ?");
//    $stmt->execute($obj);
//    $array_push = $stmt->fetchAll(PDO::FETCH_ASSOC);
////    $return = array("resoponse" => array("check" => "ahhhhhhhh"), "Mlist" => $array_push);
//    $return = array($array_push);
//}
//echo json_encode($return);

//require_once "jiziconf.php";
//$conn->set_charset('utf8mb4'); // always set the charset
//
//if($_SERVER["REQUEST_METHOD"] == "POST") {
//    $f = file_get_contents('php://input');
////    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long
//    $jsonobj = $f;//may not need this and it may be counter productive in the long run
//
//    $obj = json_decode($jsonobj);
//
//    $sql = "SELECT * FROM services WHERE name = ?";//not sure about this selection of data fields
//    $stmt = $conn->prepare($sql);
//    $stmt->bind_param("s", $obj);
////    $stmt->execute();
//    $array_push = [];
//    foreach ($obj as $key => $value) {
//        $stmt->execute();
//        $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
//        $array_push = array_merge($array_push, $data);
//    }
//
//    $return = array($array_push);
//    echo json_encode($return);
//}