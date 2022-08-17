<?php
session_start();

if (isset($_SESSION['usrloggedIn'])) {
//    header('Location: login/login.php');
//    exit();
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $name = $_SESSION['name'];
}
if (isset($_SESSION['loggedIn'])) {
    echo "biz";
}

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$location = $params['location'];
$cat = $params['cat'];

$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);

if(empty($cat)){
    $stmt = $pdo->prepare("SELECT `serviceNo`, `serviceProviderid`, `serviceProvider`, `serviceName`, bookingslotsandprices FROM `service` WHERE city=?");
    $stmt->execute([$location]);
}else{
    $stmt = $pdo->prepare("SELECT `serviceNo`, `serviceProviderid`, `serviceProvider`, `serviceName`, bookingslotsandprices FROM `service` WHERE city=? AND servicetype=?");
    $stmt->execute([$location, $cat]);

}




?>
<html>
    <head>

    </head>
    <body>
        <h1>looking for <?php echo $cat?> in <?php echo $location?></h1>
        <?php while ($row = $stmt->fetch()) {
            $sno = $row["serviceNo"];
            $name = $row["serviceName"];
            $sid = $row["serviceProviderid"];
            $sp = $row["serviceProvider"];
            $prices = $row["bookingslotsandprices"];
            $decode = json_decode($prices, true);
            $time = $decode['time'];
            $price = $decode['price'];
            echo '<a href="http://localhost/book.php/';echo "?id=$sno"; echo '">';echo $name; echo '</a>'; echo " "; echo $sp ; echo ' price:';echo $price; echo "$"; echo '<hr>';
        }

        ?>
    </body>
</html>