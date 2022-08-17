<?php
session_start();
require_once "dashboard_config.php";



if(isset($_SESSION['usrloggedIn'])){
    $semail = $_SESSION['email'];
    $spassword = $_SESSION['password'];
    $sname = $_SESSION['name'];

    $ssemail = $semail;
}
//do account check here

$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);



$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$id = $params['id'];

if (isset($_SESSION['loggedIn'])) {
    echo "biz";
//    !!put in redirect!!
}

$sql = "SELECT * FROM `service` WHERE serviceNo = ?";

$email_err = $name_err = "";
$verified = 0;


if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $serviceNo, $serviceProviderid, $serviceProvider, $serviceName, $serviceDescription, $servicetype, $mon, $monearly, $monlate, $tue, $tueearly, $tuelate, $wed, $wedearly, $wedlate, $thu, $thuearly, $thulate, $fri, $friearly, $frilate, $sat, $satearly, $satlate, $sun, $sunearly, $sunlate, $city, $country, $region, $address, $postalcode, $bookingslotsandprices);
            if(mysqli_stmt_fetch($stmt)) {
                $decode = json_decode($bookingslotsandprices, true);

                $time = $decode['time'];
                $price = $decode['price'];
                $jtime = substr($time, -2);

                if($time == 'flatrate'){
                    $jtime = "1";
                }

                if (isset($_SESSION['usrloggedIn'])) {
                        $v = 1;
//                        echo "logged in";
                        $sql2 = "SELECT verified FROM `user` WHERE email = ? and verified = ?";
                        $stmt = $conn->prepare($sql2);

                        $stmt->bind_param("si",$ssemail, $v);
                        $stmt->execute();
                        $stmt->store_result();
                        if($stmt->num_rows == 1){
                            $verified = 1;
//                            echo "verified";
                        }else{
                            $verified = 0;
//                            echo "not verified";
                        }
                    }else{
                    echo "logged off";
                }

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    if(empty($_POST["name"])){
                        $name_err = "please enter your name.";
                    } else {
                        $name = trim($_POST["name"]);
                    }

                    if(empty($_POST["email"])){
                        $email_err = "please enter your email.";
                    } else {
                        $email = trim($_POST["email"]);
                    }

                    $comment = trim($_POST["comment"]);
                    if(filter_has_var(INPUT_POST,'check')) {
                        $password = trim($_POST["password"]);
                        $acc = trim($_POST["acc"]);

                    }
                    $datepicker = trim($_POST["datepicker"]);
//                    echo $datepicker;

                    $jday= substr($datepicker, -7,2);
                    $jmonth = substr($datepicker, -10,2);
                    $jyear = substr($datepicker, -4);

                    echo $jday;
                    $timepicker = trim($_POST["timepicker"]);

                    $a = substr($timepicker, -4, 2);
//                    echo $a;
                    $jendtime = $a . $jtime;
//                    echo $jendtime;
//                    echo $jtime;
//                    echo $timepicker;

                    if(empty($name_err) && empty($email_err)){

                        $sql3 = "INSERT INTO bookings(serviceNo, serviceProvider, serviceName, price, city, country, region, address, postalcode, booker, comments, email, verrifiedacc, day, month, year, starttime, length, endtime) VALUES (:serviceNo, :serviceProvider, :serviceName, :price, :city, :country, :region, :address, :postalcode, :booker, :comments, :email, :verrifiedacc, :day, :month, :year, :starttime, :length, :endtime)";

                        if($stmt = $pdo->prepare($sql3)) {
                            $stmt->bindParam(":serviceNo", $param_serviceNo, PDO::PARAM_STR);
                            $stmt->bindParam(":serviceProvider", $param_serviceProvider, PDO::PARAM_STR);
                            $stmt->bindParam(":serviceName", $param_serviceName, PDO::PARAM_STR);
                            $stmt->bindParam(":price", $param_price, PDO::PARAM_STR);
                            $stmt->bindParam(":city", $param_city, PDO::PARAM_STR);
                            $stmt->bindParam(":country", $param_country, PDO::PARAM_STR);
                            $stmt->bindParam(":region", $param_region, PDO::PARAM_STR);
                            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
                            $stmt->bindParam(":postalcode", $param_postalcode, PDO::PARAM_STR);
                            $stmt->bindParam(":booker", $param_booker, PDO::PARAM_STR);
                            $stmt->bindParam(":comments", $param_comments, PDO::PARAM_STR);
                            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                            $stmt->bindParam(":verrifiedacc", $param_verrifiedacc, PDO::PARAM_STR);
                            $stmt->bindParam(":day", $param_day, PDO::PARAM_STR);
                            $stmt->bindParam(":month", $param_month, PDO::PARAM_STR);
                            $stmt->bindParam(":year", $param_year, PDO::PARAM_STR);
                            $stmt->bindParam(":starttime", $param_starttime, PDO::PARAM_STR);
                            $stmt->bindParam(":length", $param_length, PDO::PARAM_STR);
                            $stmt->bindParam(":endtime", $param_endtime, PDO::PARAM_STR);

                            $param_serviceNo = $serviceNo;
                            $param_serviceProvider = $serviceProvider;
                            $param_serviceName = $serviceName;
                            $param_price = $price;
                            $param_city = $city;
                            $param_country = $country;
                            $param_region = $region;
                            $param_address = $address;
                            $param_postalcode = $postalcode;
                            $param_booker = $name;
                            $param_comments = $comment;
                            $param_email = $email;
                            $param_verrifiedacc = $verified;
                            $param_day = $jday;
                            $param_month = $jmonth;
                            $param_year = $jyear;
                            $param_starttime = $timepicker;
                            $param_length = $jtime;
                            $param_endtime = $jendtime;

                            if($stmt->execute()) {
                                header("Location:http://localhost/");
                            }
                        }
                    }
                }
            }
        }else{
            echo "im sorry this service cannot be found";
        }
    }

}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>book service</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('input.timepicker').timepicker({
                timeFormat: 'HH:mm',
                interval: `<?php echo $jtime;?>`,
                minTime: '1am',
                maxTime: '11pm',
                defaultTime: '1am',
                startTime: '1am',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>
</head>
    <body>
    <h1>book a service</h1>
    <hr>
    <h2>information</h2>
    <p>service name:</p>
    <p><?php echo $serviceName?></p>
    <p>service provider:</p>
    <p><?php echo $serviceProvider?></p>
    <p>service type:</p>
    <p><?php echo $servicetype?></p>
    <p>description:</p>
    <p><?php echo $serviceDescription?></p>
    <p>price</p>
    <p><?php echo $price; echo "$";?></p>
    <hr>
    <h1>location information</h1>
    <p>country:</p>
    <p><?php echo $country?></p>
    <p>region:</p>
    <p><?php echo $region?></p>
    <p>city:</p>
    <p><?php echo $city?></p>
    <p>address:</p>
    <p><?php echo $address?></p>
    <p>postalcode:</p>
    <p><?php echo $postalcode?></p>

    <p><?php echo $jtime?></p>


    <!--    <p>service type:</p>-->
    <hr>
    <h1>days of the week available:</h1>
    <p><?php if($mon == 1){echo " available monday"; echo "starting at"; echo $monearly; echo " ending at:"; echo $monlate;} else{ echo "not available monday";} ?></p>
    <p><?php if($tue == 1){echo " available tuesday"; echo "starting at"; echo $tueearly; echo " ending at:"; echo $tuelate;} else{ echo "not available tuesday";} ?></p>
    <p><?php if($wed == 1){echo " available wednesday"; echo "starting at"; echo $wedearly; echo " ending at:"; echo $wedlate;} else{ echo "not available wednesday";} ?></p>
    <p><?php if($thu == 1){echo " available thursday"; echo "starting at"; echo $thuearly; echo " ending at:"; echo $thulate;} else{ echo "not available thursday";} ?></p>
    <p><?php if($fri == 1){echo " available friday"; echo "starting at"; echo $friearly; echo " ending at:"; echo $frilate;} else{ echo "not available friday";} ?></p>
    <p><?php if($sat == 1){echo " available saturday"; echo "starting at"; echo $satearly; echo " ending at:"; echo $satlate;} else{ echo "not available saturday";} ?></p>
    <p><?php if($sun == 1){echo " available sunday"; echo "starting at"; echo $sunearly; echo " ending at:"; echo $sunlate;} else{ echo "not available sunday";} ?></p>
    <hr>
    <h1>booking information</h1>
    <form method="POST">
        <input id="name" name="name" value="<?php if(isset($_SESSION['usrloggedIn'])){echo $sname;} ?>">
        <small>your name</small>
        <span class="help-block"><?php echo $name_err; ?></span>
        <input id="email" name="email" value="<?php if(isset($_SESSION['usrloggedIn'])){echo $semail;} ?>">
        <small>your email</small>
        <span class="help-block"><?php echo $email_err; ?></span>
        <?php if(empty(isset($_SESSION['usrloggedIn']))){echo '
    <input type="checkbox" id="check" name="check" value="check">
    <label for="mon">do you want to create account while booking</label>
    <input id="password" name="password" placeholder="password">         
    <!--put time block here-->
';}?>
        <input type="submit" class="btn btn-primary" value="book">
        <br>
        <br>
        <textarea rows="4" cols="40" class="form-control" name="comment" placeholder="comment">comment</textarea><br>
        <hr>
        <h2>date and time</h2>
        <p>Date: <input type="text" name="datepicker"  id="datepicker"></p>
        <p>time: <input type="text" name="timepicker" id="timepicker" class="timepicker"></p>
    </form>
    <br>
    </body>
</html>
