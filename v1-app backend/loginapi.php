<?php
require_once "jiziconf.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $f = file_get_contents('php://input');
    $jsonobj = stripslashes($f);//may not need this and it may be counter productive in the long run
    $obj = json_decode($jsonobj);

//    echo implode(', ', $obj);

    $email2 = $obj[0];
    $password = $obj[1];

    $logindeets = array(
        'email'=>$email2,
        'password'=>$password
    );

//    $sql = "SELECT plan, cccode, email, verified, password FROM users WHERE email = ?";


    $sql = "SELECT `name`, `country`, `city`, `broadbiz` ,`type`, `email` FROM dbv1 WHERE email = ? AND pwd = ? AND verified = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email2,$password);
    $stmt->execute();
    $stmt->store_result();

        if($stmt->num_rows == 1){
            $stmt->bind_result( $name, $country, $city, $broadbiz,$type, $email);
//            $stmt->bind_result($id, $username, $email, $gender);
            $stmt->fetch();

            $user = array(
                'name'=>$name,
                'country'=>$country,
                'city'=>$city,
                'broadbiz'=>$broadbiz,
                'type'=>$type,
                'email'=>$email
            );

            $return = array("user" => $logindeets, "userdetails" => $user);
            echo json_encode($return);
        }else{
            http_response_code(301);
        }
}