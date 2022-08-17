<?php
//this page will display all your services
session_start();

$email = $_SESSION['email'];
$password = $_SESSION['password'];

$bizid = $_SESSION["bizid"];
$country = $_SESSION["country"];
$region = $_SESSION["region"];
$city = $_SESSION["city"];
$address = $_SESSION["address"];
$postalcode = $_SESSION["postalcode"];
$bizname = $_SESSION["bizname"];
$verified = $_SESSION["verified"];
$accType = $_SESSION["accType"];


$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);



require_once "dashboard_config.php";

//$sql = "SELECT `serviceNo`, `serviceProviderid`, `serviceProvider`, `serviceName` FROM `service` WHERE `serviceProviderid` = ?";
//    if($stmt = $pdo->prepare($sql)) {
//
//    }

$stmt = $pdo->prepare("SELECT `serviceNo`, `serviceProviderid`, `serviceProvider`, `serviceName` FROM `service` WHERE serviceProviderid=?");
$stmt->execute([$bizid]);
//while ($row = $stmt->fetch()) {
//    echo $row['serviceNo']."<br />\n";
//    echo $row['serviceProviderid']."<br />\n";
//    echo $row['serviceProvider']."<br />\n";
//    echo $row['serviceNo'].$row['serviceProviderid'].$row['serviceName']. $row['serviceProvider']. "<br />\n";
//    maybe I can embed which service I want to edit in the url?
//I think the game plan is to do something similar to the app???
//}
?>
<html>
<head>

</head>
<body>
<h1>service center</h1>
<a href="createservice.php">creat service</a>
<br>
<br>
<h1>my services</h1>
<hr>

<?php while ($row = $stmt->fetch()) {
//    echo $row['serviceNo']."<br />\n";
//    echo $row['serviceProviderid']."<br />\n";
//    echo $row['serviceProvider']."<br />\n";
//    echo $row['serviceName'];
//    echo $row['serviceNo'].$row['serviceProviderid'].$row['serviceName']. $row['serviceProvider']. "<br />\n";
//    maybe I can embed which service I want to edit in the url?
//I think the game plan is to do something similar to the app???
    $a = $row["serviceName"];
    $b = $row["serviceNo"];
    echo '<a href="editservice.php/';echo "?id=$b"; echo '">';echo $a; echo '</a><hr>';

}
?>

</body>
</html>

