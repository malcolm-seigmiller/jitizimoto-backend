<?php
session_start();
require_once "dashboard_config.php";

if (!isset($_SESSION['loggedIn'])) {
    header('Location: login/login.php');
    exit();
}else {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $id = $params['id'];

    $sql = "SELECT * FROM `bookings` WHERE `bookingid` = ? ";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
//                echo "match";
//                this gets the service info
                mysqli_stmt_bind_result($stmt, $bbookingid, $bserviceNo, $bserviceProvider, $bserviceName, $bprice, $bcity, $bcountry, $bregion, $baddress, $bpostalcode, $bbooker, $bcomments, $bemail, $bverrifiedacc, $bday, $bmonth, $byear, $bstarttime, $blength, $bendtime);
                if (mysqli_stmt_fetch($stmt)) {

                    $combo = "$bmonth/$bday/$byear";
//                    echo $combo;
//                    combo leaves spaces but it will do
                    $sql2 = "SELECT * FROM `service` WHERE serviceNo = ?";

                    if ($stmt2 = mysqli_prepare($conn, $sql2)) {
                        mysqli_stmt_bind_param($stmt2, "i", $bserviceNo);
                        if (mysqli_stmt_execute($stmt2)) {
                            mysqli_stmt_store_result($stmt2);
                            if (mysqli_stmt_num_rows($stmt2) == 1) {
                                mysqli_stmt_bind_result($stmt2, $serviceNo, $serviceProviderid, $serviceProvider, $serviceName, $serviceDescription, $servicetype, $mon, $monearly, $monlate, $tue, $tueearly, $tuelate, $wed, $wedearly, $wedlate, $thu, $thuearly, $thulate, $fri, $friearly, $frilate, $sat, $satearly, $satlate, $sun, $sunearly, $sunlate, $city, $country, $region, $address, $postalcode, $bookingslotsandprices);
                                if (mysqli_stmt_fetch($stmt2)) {
                                    $decode = json_decode($bookingslotsandprices, true);

                                    $time = $decode['time'];
                                    $price = $decode['price'];
                                    $jtime = substr($time, -2);
                                    if ($time == 'flatrate') {
                                        $jtime = "1";
                                    }

                                }
                            }
                        }
                    }
                }
            } else {
                echo "no match";
            }
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (filter_has_var(INPUT_POST, 'delete')) {
//        echo "delete";
            $sql4 = "DELETE FROM `bookings` WHERE bookingid= $id";

            if (mysqli_query($conn, $sql4)) {
                header('Location: http://localhost/dashboard.php');
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }

        } else {
            header('Location: http://localhost/dashboard.php');
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
                defaultTime: '<?php echo $bstarttime;?>',
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
    <input id="name" name="name" readonly value="<?php echo $bbooker; ?>" >
    <small>your name</small>
    <input id="email" name="email" readonly value="<?php echo $bemail; ?>">
    <small>your email</small>
    <br>
    <br>
    <textarea rows="4" cols="40" class="form-control" name="comment"  readonly placeholder="comment"><?php echo $bcomments?></textarea><br>
    <hr>
    <h2>date and time</h2>
    <p>Date: <input type="text" name="datepicker" readonly  id="datepicker" value="<?php echo $combo; ?>"></p>
    <p>time: <input type="text" name="timepicker" readonly id="timepicker" class="timepicker"></p>


    <input type="checkbox" id="delete" name="delete" value="cancel booking">
    <label for="delete"> cancel booking</label><br>
<!--    <input type="checkbox" id="accept" name="accept" value="accept booking">-->
<!--    <label for="accept"> accept booking</label><br>-->

    <input type="submit" class="btn btn-primary" value="submit">


</form>
<br>
</body>
</html>
