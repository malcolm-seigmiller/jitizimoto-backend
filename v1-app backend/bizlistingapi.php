<?php
require_once "jiziconf.php";
$conn->set_charset('utf8mb4'); // always set the charset
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);


}