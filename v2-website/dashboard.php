<?php
require_once "dashboard_config.php";

session_start();

$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);


if (!isset($_SESSION['loggedIn'])) {
    header('Location: login/login.php');
    exit();
}else{

//    I dont think this is a safe way of doing it
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


    $sql = "SELECT * FROM biz WHERE email = ? AND password = ? AND verified = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email,$password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){

        $stmt = $pdo->prepare("SELECT * FROM `bookings` WHERE serviceProvider = ?");
        $stmt->execute([$bizname]);

    }else{
        unset($_SESSION['loggedIn']);
        session_destroy();
        header('Location: login/login.php');
        exit();
    }
}

?>
<html>
    <head>

    </head>
    <body>
        <h1>dashboard</h1>
        <a href="logout.php">logout</a>
        <a href="login/login.php">test</a>
    <br>
        <p>my bizid is <?php echo $bizid?></p>
        <p>my email is <?php echo $email?></p>
        <p>my country is <?php echo $country?></p>
        <p>my region is <?php echo $region?></p>
        <p>my city is <?php echo $city?></p>
        <p>my address is <?php echo $address?></p>
        <p>my postalcode is <?php echo $postalcode?></p>
        <p>my bizname is <?php echo $bizname?></p>
        <p>my verified is <?php echo $verified?></p>
        <p>my accType is <?php echo $accType?></p>

        <a href="myservices.php">service center</a>

        <center><p>service bookings</p></center>
    <hr>
        <?php while ($row = $stmt->fetch()) {
            $bookingid = $row["bookingid"];
            $b = $row["bookingid"];
            $day = $row["day"];
            $month = $row["month"];
            $year = $row["year"];
            $booker = $row["booker"];
            $starttime = $row["starttime"];
//            $serviceName = $row["length"];
            $serviceName = $row["serviceName"];


//            echo '<a href="editsbooking.php/';echo "?id=$b";echo '">';echo $booker;echo ' has booked ';echo $serviceName; echo '</a>';
            echo '<a href="editservicebooking.php/';echo "?id=$b";echo '">';echo $serviceName; echo " was booked"; echo " for $starttime"; '</a>';
            echo '<hr>';
        }?>
    </body>
</html>
