<?php
require_once "dashboard_config.php";

session_start();

$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);


if (!isset($_SESSION['usrloggedIn'])) {
    header('Location: login/login.php');
    exit();
}else{

//    I dont think this is a safe way of doing it
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $name = $_SESSION['name'];


    $city = "winnipeg";

    $sql = "SELECT userid FROM user WHERE email = ? AND password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email,$password);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result( $userid);
        $stmt->fetch();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty(trim($_POST["search"]))){
                $search = "";
            } else{
                $search = trim($_POST["search"]);
            }

            header("Location: search.php/?location=$city&cat=$search");
        }

        }else{
        unset($_SESSION['loggedIn']);
        session_destroy();
        header('Location: login/login.php');
        exit();
    }

}
//echo $userid;
$stmt1 = $pdo->prepare("SELECT * FROM `bookings` WHERE email =? ");
$stmt1->execute([$email]);

?>
<html>
<head>

</head>
<body>
<h1>home</h1>
<a href="logout.php">logout</a>
<a href="login/login.php">test</a>
<br>
<h1>my name is <?php echo $name ?></h1>
<form method="POST">
    <input class="form-control" name="search" placeholder="search">
    <input type="submit" class="btn btn-primary" value="search">
</form>
<hr>
<h1>my bookings</h1>
<?php while ($row = $stmt1->fetch()) {
    $a = $row["serviceName"];
    $b = $row["bookingid"];
    echo '<a href="editbooking.php/';echo "?id=$b";echo '">';echo $a;echo '</a><hr>';
}?>
</body>
</html>