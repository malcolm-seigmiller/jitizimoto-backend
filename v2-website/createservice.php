<?php
//now comes the hard part
require_once "dashboard_config.php";
//no its fun what are you talking about
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=jitzimoto;charset=utf8mb4", 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);


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


$servicename = $description = $servicetype = $mon = $tue = $wed = $thu = $fri = $sat = $sun = $booking1 = $booking2 = $flatprice = "";
$servicename_err = $description_err = $servicetype_err = $mon_err = $tue_err = $wed_err = $thu_err = $fri_err = $sat_err = $sun_err = $booking1_err = $booking2_err = $flatprice_err = "";

$monstart = $monend = "";
$tuestart = $tueend = "";
$wedstart = $wedend = "";
$thustart = $thuend = "";
$fristart = $friend = "";
$satstart = $satend = "";
$sunstart = $sunend = "";

//pricing and booking info


if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty(trim($_POST["servicename"]))){
        $servicename_err = "the name of your service.";
    } else{
        $servicename = trim($_POST["servicename"]);
    }

    if(empty(trim($_POST["description"]))){
        $description_err = "please enter a description.";
//        for the release version I'd like to have this optional
    } else{
        $description = trim($_POST["description"]);
    }

    if(empty(trim($_POST["servicetype"]))){
        $servicetype_err = "please enter a service type.";
    } else{
        $servicetype = trim($_POST["servicetype"]);
    }

//    monday
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'mon')) {
        $mon = 1;
        if(filter_has_var(INPUT_POST,'mon24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $monstart = "00:00";
            $monend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["monstart"])){
                $mon_err = "please enter the earliest your service is available.";
            } else{
                $monstart = $_POST["monstart"];
            }

            if(empty($_POST["monend"])){
                $mon_err = "please enter the earliest your service is available.";
            } else{
                $monend = $_POST["monend"];
            }

        }
    }else{
        $mon = 0;
    }

//    tuesday
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'tue')) {
        $tue = 1;
        if(filter_has_var(INPUT_POST,'tue24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $tuestart = "00:00";
            $tueend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["tuestart"])){
                $tue_err = "please enter the earliest your service is available.";
            } else{
                $tuestart = $_POST["tuestart"];
            }

            if(empty($_POST["tueend"])){
                $tue_err = "please enter the earliest your service is available.";
            } else{
                $tueend = $_POST["tueend"];
            }

        }
    }else{
        $tue = 0;
    }

    //    wends day
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'wed')) {
        $wed = 1;
        if(filter_has_var(INPUT_POST,'wed24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $wedstart = "00:00";
            $wedend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["wedstart"])){
                $wed_err = "please enter the earliest your service is available.";
            } else{
                $wedstart = $_POST["wedstart"];
            }

            if(empty($_POST["wedend"])){
                $wed_err = "please enter the earliest your service is available.";
            } else{
                $wedend = $_POST["wedend"];
            }

        }
    }else{
        $wed = 0;
    }

//    thursday
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'thu')) {
        $thu = 1;
        if(filter_has_var(INPUT_POST,'thu24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $thustart = "00:00";
            $thuend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["thustart"])){
                $thu_err = "please enter the earliest your service is available.";
            } else{
                $thustart = $_POST["thustart"];
            }

            if(empty($_POST["thuend"])){
                $thu_err = "please enter the earliest your service is available.";
            } else{
                $thuend = $_POST["thuend"];
            }

        }
    }else{
        $thu = 0;
    }

//    friday
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'fri')) {
        $fri = 1;
        if(filter_has_var(INPUT_POST,'fri24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $fristart = "00:00";
            $friend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["fristart"])){
                $fri_err = "please enter the earliest your service is available.";
            } else{
                $fristart = $_POST["fristart"];
            }

            if(empty($_POST["friend"])){
                $fri_err = "please enter the earliest your service is available.";
            } else{
                $friend = $_POST["friend"];
            }

        }
    }else{
        $fri = 0;
    }

    //    saturday
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'sat')) {
        $sat = 1;
        if(filter_has_var(INPUT_POST,'sat24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $satstart = "00:00";
            $satend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["satstart"])){
                $sat_err = "please enter the earliest your service is available.";
            } else{
                $satstart = $_POST["satstart"];
            }

            if(empty($_POST["satend"])){
                $sat_err = "please enter the earliest your service is available.";
            } else{
                $satend = $_POST["satend"];
            }

        }
    }else{
        $sat = 0;
    }

    //    sunday
//    this checks if the check box has been checked
    if(filter_has_var(INPUT_POST,'sun')) {
        $sun = 1;
        if(filter_has_var(INPUT_POST,'sun24')) {
//            echo "24 hours has been selected";
//            for the 24 hours just hard set the start and end values
            $sunstart = "00:00";
            $sunend = "23:59";
//          idk but for now ill just set the day start and end as the min and max values in the day
        }else{
//            echo "custom hours has been selected";

            if(empty($_POST["sunstart"])){
                $sun_err = "please enter the earliest your service is available.";
            } else{
                $sunstart = $_POST["sunstart"];
            }

            if(empty($_POST["sunend"])){
                $sun_err = "please enter the earliest your service is available.";
            } else{
                $sunend = $_POST["sunend"];
            }

        }
    }else{
        $sun = 0;
    }


    if(filter_has_var(INPUT_POST,'flatrate')) {
//i guess get the flatrate and set the time as na or something, I think ill save it as a JSON string\
//        flatprice
        if(empty(trim($_POST["flatprice"]))){
            $flatprice_err = "please enter the price to book.";
        } else{
            $flatprice = trim($_POST["flatprice"]);
        }

        if(empty($flatprice_err)){
//            convert to json
            $flatrate = 'flatrate';
            $arr = array(
                    "time" => $flatrate,
                "price" => $flatprice
            );
            $flatrate_output = json_encode($arr);

            $booking1 = $flatrate_output;

//            echo $output;
        }

    }else {
//        this is where the non flatprice things go down
        $minute1 = "";
        $price1 = "";

        $minute2 = "";
        $price2 = "";

//        minute 1 is nessicary, minute 2 is not

        if(empty($_POST ["minute1"])){
            $booking1_err = "please enter the length of time offered.";
        } else {
            if (empty($_POST["price1"])) {
                $booking1_err = "please enter the price of booking this timeslot.";
            }else{
                $minute1 = $_POST["minute1"];
                $price1 = $_POST["price1"];

                if(filter_has_var(INPUT_POST,'booking2')) {
                    if(empty($_POST ["minute2"])){
                        $booking1_err = "please enter the length of time offered.";
                    } else {
                        if (empty($_POST["price2"])) {
                            $booking1_err = "please enter the price of booking this timeslot.";
                        }else{
                            $minute2 = $_POST["minute2"];
                            $price2 = $_POST["price2"];

                            $arr = array(
                                "time" => $minute1,
                                "price" => $price1
                            );
                            $arr2 = array(
                                "time" => $minute2,
                                "price" => $price2
                            );
                            $arr3 = array(
//                                "slots",
                                $arr,
                                $arr2
                            );
                            $j2 = json_encode($arr3);
//                            echo $j2;
                            $booking1 = $j2;

                        }
                    }

                }else{
                    $arr = array(
                        "time" => $minute1,
                        "price" => $price1
                    );
                    $j = json_encode($arr);
//                    echo $j;
                    $booking1 = $j;

                }
            }

        }

    }
//    so the way I do this(alternate booking option) works, but its cumbersome and not scalable, I think javascript is needed to pull off in half decent way

//    I think I can insert this into the database

    if(empty($servicename_err) && empty($description_err) && empty($description_err &&  empty($servicetype_err) && empty($mon_err)&& empty($tue_err) && empty($wed_err) && empty($thu_err) && empty($fri_err) && empty($sat_err) && empty($sun_err) && empty($booking1_err) && empty($booking2_err) && empty($flatprice_err))){
        $sql = "INSERT INTO service (serviceProviderid, serviceProvider, serviceName, serviceDescription, servicetype, mon, `monearly`, `monlate`, `tue`, `tueearly`, `tuelate`, `wed`, `wedearly`, `wedlate`, thu, thuearly, thulate, fri, friearly, frilate, sat, satearly, satlate, sun, sunearly, sunlate, city, country, region, address, postalcode, bookingslotsandprices) VALUES (:serviceProviderid, :serviceProvider, :serviceName, :serviceDescription, :servicetype, :mon, :monearly, :monlate, :tue, :tueearly, :tuelate, :wed, :wedearly, :wedlate, :thu, :thuearly, :thulate, :fri, :friearly, :frilate, :sat, :satearly, :satlate, :sun, :sunearly, :sunlate, :city, :country, :region, :address, :postalcode, :bookingslotsandprices )";

        if($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":serviceProviderid", $param_serviceProviderid, PDO::PARAM_STR);
            $stmt->bindParam(":serviceProvider", $param_serviceProvider, PDO::PARAM_STR);
            $stmt->bindParam(":serviceName", $param_serviceName, PDO::PARAM_STR);
            $stmt->bindParam(":serviceDescription", $param_serviceDescription, PDO::PARAM_STR);
            $stmt->bindParam(":servicetype", $param_servicetype, PDO::PARAM_STR);
            $stmt->bindParam(":mon", $param_mon, PDO::PARAM_STR);
            $stmt->bindParam(":monearly", $param_monearly, PDO::PARAM_STR);
            $stmt->bindParam(":monlate", $param_monlate, PDO::PARAM_STR);
            $stmt->bindParam(":tue", $param_tue, PDO::PARAM_STR);
            $stmt->bindParam(":tueearly", $param_tueearly, PDO::PARAM_STR);
            $stmt->bindParam(":tuelate", $param_tuelate, PDO::PARAM_STR);
            $stmt->bindParam(":wed", $param_wed, PDO::PARAM_STR);
            $stmt->bindParam(":wedearly", $param_wedearly, PDO::PARAM_STR);
            $stmt->bindParam(":wedlate", $param_wedlate, PDO::PARAM_STR);
            $stmt->bindParam(":thu", $param_thu, PDO::PARAM_STR);
            $stmt->bindParam(":thuearly", $param_thuearly, PDO::PARAM_STR);
            $stmt->bindParam(":thulate", $param_thulate, PDO::PARAM_STR);
            $stmt->bindParam(":fri", $param_fri, PDO::PARAM_STR);
            $stmt->bindParam(":friearly", $param_friearly, PDO::PARAM_STR);
            $stmt->bindParam(":frilate", $param_frilate, PDO::PARAM_STR);
            $stmt->bindParam(":sat", $param_sat, PDO::PARAM_STR);
            $stmt->bindParam(":satearly", $param_satearly, PDO::PARAM_STR);
            $stmt->bindParam(":satlate", $param_satlate, PDO::PARAM_STR);
            $stmt->bindParam(":sun", $param_sun, PDO::PARAM_STR);
            $stmt->bindParam(":sunearly", $param_sunearly, PDO::PARAM_STR);
            $stmt->bindParam(":sunlate", $param_sunlate, PDO::PARAM_STR);
            $stmt->bindParam(":city", $param_city, PDO::PARAM_STR);
            $stmt->bindParam(":country", $param_country, PDO::PARAM_STR);
            $stmt->bindParam(":region", $param_region, PDO::PARAM_STR);
            $stmt->bindParam(":address", $param_address, PDO::PARAM_STR);
            $stmt->bindParam(":postalcode", $param_postalcode, PDO::PARAM_STR);
            $stmt->bindParam(":bookingslotsandprices", $param_bookingslotsandprices, PDO::PARAM_STR);

            $param_serviceProviderid = $bizid;
            $param_serviceProvider = $bizname;
            $param_serviceName = $servicename;
            $param_serviceDescription = $description;
            $param_servicetype = $servicetype;
            $param_mon = $mon;
            $param_monearly = $monstart;
            $param_monlate = $monend;
            $param_tue = $tue;
            $param_tueearly = $tuestart;
            $param_tuelate = $tueend;
            $param_wed = $wed;
            $param_wedearly = $wedstart;
            $param_wedlate = $wedend;
            $param_thu = $thu;
            $param_thuearly = $thustart;
            $param_thulate = $thuend;
            $param_fri = $fri;
            $param_friearly = $fristart;
            $param_frilate = $friend;
            $param_sat = $sat;
            $param_satearly = $satstart;
            $param_satlate = $satend;
            $param_sun = $sun;
            $param_sunearly = $sunstart;
            $param_sunlate = $sunend;
            $param_city = $city;
            $param_country = $country;
            $param_region = $region;
            $param_address = $address;
            $param_postalcode = $postalcode;
            $param_bookingslotsandprices = $booking1;

            if($stmt->execute()){
//                echo "i put it in her boss";
//                echo $monstart;
//                echo $monend;
//                echo $tuestart;
//                echo $tueend;
//                echo $wedstart;
//                echo $wedend;
                header('Location: http://localhost/myservices.php');

            }else{
                echo "Something went wrong. Please try again later.";
            }
        }

    }
}
$g1 = "p";
?>
<html>
<head>
</head>

<!--<p>--><?php //echo $g1; ?><!--</p>-->

<h1>create a service</h1>
<!--basic things needed for  create a service-->
<!--service name-->
<!--7 days in a week-->
<!--hours available during selected day-->
<!--service description-->
<!--time blocks settings-->
<!--service type-->

<!--nice to have-->

<!--photos-->
<!--ai chat bot that answers question-->
<!--special days to block out-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <h2>general info</h2>
    <p>service name</p>
    <input class="form-control" name="servicename" placeholder="service name">
    <span class="help-block"><?php echo $servicename_err; ?></span>

    <p>description</p>
    <textarea rows="8" cols="80" class="form-control" name="description" placeholder="description"></textarea><br>
    <span class="help-block"><?php echo $description_err; ?></span>

    <p>service type</p>
    <input class="form-control" name="servicetype" placeholder="service type">
    <span class="help-block"><?php echo $servicetype_err; ?></span>

    <br>
    <br>
    <p>days available</p>

    <input type="checkbox" id="mon" name="mon" value="monday">
    <label for="mon"> monday</label><br>
    <input type="time" id="monstart" name="monstart">
    <small>earliest time available</small>
    <input type="time" id="monend" name="monend">
    <small>latest time available</small>
    <input type="checkbox" id="mon24" name="mon24" value="mon24">
    <label for="mon24"> 24 hours</label><br>
    <span class="help-block"><?php echo $mon_err; ?></span>

    <!--  don't do the work of implimentind anything until you've sorted out the day picker for monday  -->
    <br>

    <input type="checkbox" id="tue" name="tue" value="tuesday">
    <label for="tue"> tuesday</label><br>

    <input type="time" id="tuestart" name="tuestart">
    <small>earliest time available</small>
    <input type="time" id="tueend" name="tueend">
    <small>latest time available</small>
    <input type="checkbox" id="tue24" name="tue24" value="tue24">
    <label for="tue24"> 24 hours</label>
    <span class="help-block"><?php echo $tue_err; ?></span>

    <br>
    <br>

    <input type="checkbox" id="wed" name="wed" value="wednesday">
    <label for="wed"> wednesday</label><br>

    <input type="time" id="wedstart" name="wedstart">
    <small>earliest time available</small>
    <input type="time" id="wedend" name="wedend">
    <small>latest time available</small>
    <input type="checkbox" id="wed24" name="wed24" value="wed24">
    <label for="wed24"> 24 hours</label>
    <span class="help-block"><?php echo $wed_err; ?></span>

    <br>
    <br>

    <input type="checkbox" id="thu" name="thu" value="thursday">
    <label for="thu"> thursday</label><br>

    <input type="time" id="thustart" name="thustart">
    <small>earliest time available</small>
    <input type="time" id="thuend" name="thuend">
    <small>latest time available</small>
    <input type="checkbox" id="thu24" name="thu24" value="thu24">
    <label for="thu24"> 24 hours</label>
    <span class="help-block"><?php echo $thu_err ; ?></span>

    <br>
    <br>

    <input type="checkbox" id="fri" name="fri" value="friday">
    <label for="fri"> friday</label><br>
    <input type="time" id="fristart" name="fristart">
    <small>earliest time available</small>
    <input type="time" id="friend" name="friend">
    <small>latest time available</small>
    <input type="checkbox" id="fri24" name="fri24" value="fri24">
    <label for="fri24"> 24 hours</label>
    <span class="help-block"><?php echo $fri_err ; ?></span>

    <br>
    <br>

    <input type="checkbox" id="sat" name="sat" value="saturday">
    <label for="sat"> saturday</label><br>

    <input type="time" id="satstart" name="satstart">
    <small>earliest time available</small>
    <input type="time" id="satend" name="satend">
    <small>latest time available</small>
    <input type="checkbox" id="sat24" name="sat24" value="sat24">
    <label for="sat24"> 24 hours</label>
    <span class="help-block"><?php echo $sat_err ; ?></span>

    <br>
    <br>

    <input type="checkbox" id="sun" name="sun" value="sunday">
    <label for="sun"> sunday</label><br>

    <input type="time" id="sunstart" name="sunstart">
    <small>earliest time available</small>
    <input type="time" id="sunend" name="sunend">
    <small>latest time available</small>
    <input type="checkbox" id="sun24" name="sun24" value="sun24">
    <label for="sun24"> 24 hours</label>
    <span class="help-block"><?php echo $sun_err ; ?></span>

    <br>
    <br>
    <h2>booking slots and rate</h2>
    <!--  do an add time button, then below it or something add the price  -->
    <!--  this deff requires some js, i hope not  -->
    <!--  I think it may be prudent to have it only be 4 settalbe time and prices but for now but make the backend work for custom amount of slots and prices  -->
    <!--  I think ill do it with JSON string. it will go time:price. ill have to see if I can use json for that -->

    <p>please enter the price and time block available for booking</p>
<!--    <select name="hour1" id="hour1">-->
<!--        <option value="00">0</option>-->
<!--        <option value="01">1</option>-->
<!--        <option value="02">2</option>-->
<!--        <option value="03">3</option>-->
<!--        <option value="04">4</option>-->
<!--        <option value="05">5</option>-->
<!--        <option value="06">6</option>-->
<!--        <option value="07">7</option>-->
<!--        <option value="08">8</option>-->
<!--        <option value="09">9</option>-->
<!--        <option value="10">10</option>-->
<!--        <option value="11">11</option>-->
<!--        <option value="12">12</option>-->
<!--        <option value="13">13</option>-->
<!--        <option value="14">14</option>-->
<!--        <option value="15">15</option>-->
<!--        <option value="16">16</option>-->
<!--        <option value="17">17</option>-->
<!--        <option value="18">18</option>-->
<!--        <option value="19">19</option>-->
<!--        <option value="20">20</option>-->
<!--        <option value="21">21</option>-->
<!--        <option value="22">22</option>-->
<!--        <option value="23">23</option>-->
<!--        <option value="24">24</option>-->
    </select>
<!--    <small>:</small>-->
    <select name="minute1" id="minute1">
        <option value="">0:00</option>
        <option value="00:01">0:01</option>
        <option value="00:02">0:02</option>
        <option value="00:03">0:03</option>
        <option value="00:04">0:04</option>
        <option value="00:05">0:05</option>
        <option value="00:06">0:06</option>
        <option value="00:07">0:07</option>
        <option value="00:08">0:08</option>
        <option value="00:09">0:09</option>
        <option value="00:10">0:10</option>
        <option value="00:11">0:11</option>
        <option value="00:12">0:12</option>
        <option value="00:13">0:13</option>
        <option value="00:14">0:14</option>
        <option value="00:15">0:15</option>
        <option value="00:16">0:16</option>
        <option value="00:17">0:17</option>
        <option value="00:18">0:18</option>
        <option value="00:19">0:19</option>
        <option value="00:20">0:20</option>
        <option value="00:21">0:21</option>
        <option value="00:22">0:22</option>
        <option value="00:23">0:23</option>
        <option value="00:24">0:24</option>
        <option value="00:25">0:25</option>
        <option value="00:26">0:26</option>
        <option value="00:27">0:27</option>
        <option value="00:28">0:28</option>
        <option value="00:29">0:29</option>
        <option value="00:30">0:30</option>
        <option value="00:31">0:31</option>
        <option value="00:32">0:32</option>
        <option value="00:33">0:33</option>
        <option value="00:34">0:34</option>
        <option value="00:35">0:35</option>
        <option value="00:36">0:36</option>
        <option value="00:37">0:37</option>
        <option value="00:38">0:38</option>
        <option value="00:39">0:39</option>
        <option value="00:40">0:40</option>
        <option value="00:41">0:41</option>
        <option value="00:42">0:42</option>
        <option value="00:43">0:43</option>
        <option value="00:44">0:44</option>
        <option value="00:45">0:45</option>
        <option value="00:46">0:46</option>
        <option value="00:47">0:47</option>
        <option value="00:48">0:48</option>
        <option value="00:49">0:49</option>
        <option value="00:50">0:50</option>
        <option value="00:51">0:51</option>
        <option value="00:52">0:52</option>
        <option value="00:53">0:53</option>
        <option value="00:54">0:54</option>
        <option value="00:55">0:55</option>
        <option value="00:56">0:56</option>
        <option value="00:57">0:57</option>
        <option value="00:58">0:58</option>
        <option value="00:59">0:59</option>
        <option value="01:00">1:00</option>

        <option value="01:01">1:01</option>
        <option value="01:02">1:02</option>
        <option value="01:03">1:03</option>
        <option value="01:04">1:04</option>
        <option value="01:05">1:05</option>
        <option value="01:06">1:06</option>
        <option value="01:07">1:07</option>
        <option value="01:08">1:08</option>
        <option value="01:09">1:09</option>
        <option value="01:10">1:10</option>
        <option value="01:11">1:11</option>
        <option value="01:12">1:12</option>
        <option value="01:13">1:13</option>
        <option value="01:14">1:14</option>
        <option value="01:15">1:15</option>
        <option value="01:16">1:16</option>
        <option value="01:17">1:17</option>
        <option value="01:18">1:18</option>
        <option value="01:19">1:19</option>
        <option value="01:20">1:20</option>
        <option value="01:21">1:21</option>
        <option value="01:22">1:22</option>
        <option value="01:23">1:23</option>
        <option value="01:24">1:24</option>
        <option value="01:25">1:25</option>
        <option value="01:26">1:26</option>
        <option value="01:27">1:27</option>
        <option value="01:28">1:28</option>
        <option value="01:29">1:29</option>
        <option value="01:30">1:30</option>
        <option value="01:31">1:31</option>
        <option value="01:32">1:32</option>
        <option value="01:33">1:33</option>
        <option value="01:34">1:34</option>
        <option value="01:35">1:35</option>
        <option value="01:36">1:36</option>
        <option value="01:37">1:37</option>
        <option value="01:38">1:38</option>
        <option value="01:39">1:39</option>
        <option value="01:40">1:40</option>
        <option value="01:41">1:41</option>
        <option value="01:42">1:42</option>
        <option value="01:43">1:43</option>
        <option value="01:44">1:44</option>
        <option value="01:45">1:45</option>
        <option value="01:46">1:46</option>
        <option value="01:47">1:47</option>
        <option value="01:48">1:48</option>
        <option value="01:49">1:49</option>
        <option value="01:50">1:50</option>
        <option value="01:51">1:51</option>
        <option value="01:52">1:52</option>
        <option value="01:53">1:53</option>
        <option value="01:54">1:54</option>
        <option value="01:55">1:55</option>
        <option value="01:56">1:56</option>
        <option value="01:57">1:57</option>
        <option value="01:58">1:58</option>
        <option value="01:59">1:59</option>

        <option value="02:00">2:00</option>

        <option value="02:01">2:01</option>
        <option value="02:02">2:02</option>
        <option value="02:03">2:03</option>
        <option value="02:04">2:04</option>
        <option value="02:05">2:05</option>
        <option value="02:06">2:06</option>
        <option value="02:07">2:07</option>
        <option value="02:08">2:08</option>
        <option value="02:09">2:09</option>
        <option value="02:10">2:10</option>
        <option value="02:11">2:11</option>
        <option value="02:12">2:12</option>
        <option value="02:13">2:13</option>
        <option value="02:14">2:14</option>
        <option value="02:15">2:15</option>
        <option value="02:16">2:16</option>
        <option value="02:17">2:17</option>
        <option value="02:18">2:18</option>
        <option value="02:19">2:19</option>
        <option value="02:20">2:20</option>
        <option value="02:21">2:21</option>
        <option value="02:22">2:22</option>
        <option value="02:23">2:23</option>
        <option value="02:24">2:24</option>
        <option value="02:25">2:25</option>
        <option value="02:26">2:26</option>
        <option value="02:27">2:27</option>
        <option value="02:28">2:28</option>
        <option value="02:29">2:29</option>
        <option value="02:30">2:30</option>
        <option value="02:31">2:31</option>
        <option value="02:32">2:32</option>
        <option value="02:33">2:33</option>
        <option value="02:34">2:34</option>
        <option value="02:35">2:35</option>
        <option value="02:36">2:36</option>
        <option value="02:37">2:37</option>
        <option value="02:38">2:38</option>
        <option value="02:39">2:39</option>
        <option value="02:40">2:40</option>
        <option value="02:41">2:41</option>
        <option value="02:42">2:42</option>
        <option value="02:43">2:43</option>
        <option value="02:44">2:44</option>
        <option value="02:45">2:45</option>
        <option value="02:46">2:46</option>
        <option value="02:47">2:47</option>
        <option value="02:48">2:48</option>
        <option value="02:49">2:49</option>
        <option value="02:50">2:50</option>
        <option value="02:51">2:51</option>
        <option value="02:52">2:52</option>
        <option value="02:53">2:53</option>
        <option value="02:54">2:54</option>
        <option value="02:55">2:55</option>
        <option value="02:56">2:56</option>
        <option value="02:57">2:57</option>
        <option value="02:58">2:58</option>
        <option value="02:59">2:59</option>

        <option value="03:00">3:00</option>

        <option value="03:01">3:01</option>
        <option value="03:02">3:02</option>
        <option value="03:03">3:03</option>
        <option value="03:04">3:04</option>
        <option value="03:05">3:05</option>
        <option value="03:06">3:06</option>
        <option value="03:07">3:07</option>
        <option value="03:08">3:08</option>
        <option value="03:09">3:09</option>
        <option value="03:10">3:10</option>
        <option value="03:11">3:11</option>
        <option value="03:12">3:12</option>
        <option value="03:13">3:13</option>
        <option value="03:14">3:14</option>
        <option value="03:15">3:15</option>
        <option value="03:16">3:16</option>
        <option value="03:17">3:17</option>
        <option value="03:18">3:18</option>
        <option value="03:19">3:19</option>
        <option value="03:20">3:20</option>
        <option value="03:21">3:21</option>
        <option value="03:22">3:22</option>
        <option value="03:23">3:23</option>
        <option value="03:24">3:24</option>
        <option value="03:25">3:25</option>
        <option value="03:26">3:26</option>
        <option value="03:27">3:27</option>
        <option value="03:28">3:28</option>
        <option value="03:29">3:29</option>
        <option value="03:30">3:30</option>
        <option value="03:31">3:31</option>
        <option value="03:32">3:32</option>
        <option value="03:33">3:33</option>
        <option value="03:34">3:34</option>
        <option value="03:35">3:35</option>
        <option value="03:36">3:36</option>
        <option value="03:37">3:37</option>
        <option value="03:38">3:38</option>
        <option value="03:39">3:39</option>
        <option value="03:40">3:40</option>
        <option value="03:41">3:41</option>
        <option value="03:42">3:42</option>
        <option value="03:43">3:43</option>
        <option value="03:44">3:44</option>
        <option value="03:45">3:45</option>
        <option value="03:46">3:46</option>
        <option value="03:47">3:47</option>
        <option value="03:48">3:48</option>
        <option value="03:49">3:49</option>
        <option value="03:50">3:50</option>
        <option value="03:51">3:51</option>
        <option value="03:52">3:52</option>
        <option value="03:53">3:53</option>
        <option value="03:54">3:54</option>
        <option value="03:55">3:55</option>
        <option value="03:56">3:56</option>
        <option value="03:57">3:57</option>
        <option value="03:58">3:58</option>
        <option value="03:59">3:59</option>




    </select>
    <small>please select how long you want this time block to be</small>
    <input class="form-control" name="price1" placeholder="price">
    <small>how much to book for this long?</small><br>
    <span class="help-block"><?php echo $booking1_err; ?></span>

    <br><br>
<!--    <input type="checkbox" id="booking2" name="booking2" value="booking2">-->
<!--    <label for="booking2">add alternate booking option</label><br>-->
<!--    <select name="minute2" id="minute2">-->
<!--        <option value="">0:00</option>-->
<!--        <option value="00:01">0:01</option>-->
<!--        <option value="00:02">0:02</option>-->
<!--        <option value="00:03">0:03</option>-->
<!--        <option value="00:04">0:04</option>-->
<!--        <option value="00:05">0:05</option>-->
<!--        <option value="00:06">0:06</option>-->
<!--        <option value="00:07">0:07</option>-->
<!--        <option value="00:08">0:08</option>-->
<!--        <option value="00:09">0:09</option>-->
<!--        <option value="00:10">0:10</option>-->
<!--        <option value="00:11">0:11</option>-->
<!--        <option value="00:12">0:12</option>-->
<!--        <option value="00:13">0:13</option>-->
<!--        <option value="00:14">0:14</option>-->
<!--        <option value="00:15">0:15</option>-->
<!--        <option value="00:16">0:16</option>-->
<!--        <option value="00:17">0:17</option>-->
<!--        <option value="00:18">0:18</option>-->
<!--        <option value="00:19">0:19</option>-->
<!--        <option value="00:20">0:20</option>-->
<!--        <option value="00:21">0:21</option>-->
<!--        <option value="00:22">0:22</option>-->
<!--        <option value="00:23">0:23</option>-->
<!--        <option value="00:24">0:24</option>-->
<!--        <option value="00:25">0:25</option>-->
<!--        <option value="00:26">0:26</option>-->
<!--        <option value="00:27">0:27</option>-->
<!--        <option value="00:28">0:28</option>-->
<!--        <option value="00:29">0:29</option>-->
<!--        <option value="00:30">0:30</option>-->
<!--        <option value="00:31">0:31</option>-->
<!--        <option value="00:32">0:32</option>-->
<!--        <option value="00:33">0:33</option>-->
<!--        <option value="00:34">0:34</option>-->
<!--        <option value="00:35">0:35</option>-->
<!--        <option value="00:36">0:36</option>-->
<!--        <option value="00:37">0:37</option>-->
<!--        <option value="00:38">0:38</option>-->
<!--        <option value="00:39">0:39</option>-->
<!--        <option value="00:40">0:40</option>-->
<!--        <option value="00:41">0:41</option>-->
<!--        <option value="00:42">0:42</option>-->
<!--        <option value="00:43">0:43</option>-->
<!--        <option value="00:44">0:44</option>-->
<!--        <option value="00:45">0:45</option>-->
<!--        <option value="00:46">0:46</option>-->
<!--        <option value="00:47">0:47</option>-->
<!--        <option value="00:48">0:48</option>-->
<!--        <option value="00:49">0:49</option>-->
<!--        <option value="00:50">0:50</option>-->
<!--        <option value="00:51">0:51</option>-->
<!--        <option value="00:52">0:52</option>-->
<!--        <option value="00:53">0:53</option>-->
<!--        <option value="00:54">0:54</option>-->
<!--        <option value="00:55">0:55</option>-->
<!--        <option value="00:56">0:56</option>-->
<!--        <option value="00:57">0:57</option>-->
<!--        <option value="00:58">0:58</option>-->
<!--        <option value="00:59">0:59</option>-->
<!--        <option value="01:00">1:00</option>-->
<!---->
<!--        <option value="01:01">1:01</option>-->
<!--        <option value="01:02">1:02</option>-->
<!--        <option value="01:03">1:03</option>-->
<!--        <option value="01:04">1:04</option>-->
<!--        <option value="01:05">1:05</option>-->
<!--        <option value="01:06">1:06</option>-->
<!--        <option value="01:07">1:07</option>-->
<!--        <option value="01:08">1:08</option>-->
<!--        <option value="01:09">1:09</option>-->
<!--        <option value="01:10">1:10</option>-->
<!--        <option value="01:11">1:11</option>-->
<!--        <option value="01:12">1:12</option>-->
<!--        <option value="01:13">1:13</option>-->
<!--        <option value="01:14">1:14</option>-->
<!--        <option value="01:15">1:15</option>-->
<!--        <option value="01:16">1:16</option>-->
<!--        <option value="01:17">1:17</option>-->
<!--        <option value="01:18">1:18</option>-->
<!--        <option value="01:19">1:19</option>-->
<!--        <option value="01:20">1:20</option>-->
<!--        <option value="01:21">1:21</option>-->
<!--        <option value="01:22">1:22</option>-->
<!--        <option value="01:23">1:23</option>-->
<!--        <option value="01:24">1:24</option>-->
<!--        <option value="01:25">1:25</option>-->
<!--        <option value="01:26">1:26</option>-->
<!--        <option value="01:27">1:27</option>-->
<!--        <option value="01:28">1:28</option>-->
<!--        <option value="01:29">1:29</option>-->
<!--        <option value="01:30">1:30</option>-->
<!--        <option value="01:31">1:31</option>-->
<!--        <option value="01:32">1:32</option>-->
<!--        <option value="01:33">1:33</option>-->
<!--        <option value="01:34">1:34</option>-->
<!--        <option value="01:35">1:35</option>-->
<!--        <option value="01:36">1:36</option>-->
<!--        <option value="01:37">1:37</option>-->
<!--        <option value="01:38">1:38</option>-->
<!--        <option value="01:39">1:39</option>-->
<!--        <option value="01:40">1:40</option>-->
<!--        <option value="01:41">1:41</option>-->
<!--        <option value="01:42">1:42</option>-->
<!--        <option value="01:43">1:43</option>-->
<!--        <option value="01:44">1:44</option>-->
<!--        <option value="01:45">1:45</option>-->
<!--        <option value="01:46">1:46</option>-->
<!--        <option value="01:47">1:47</option>-->
<!--        <option value="01:48">1:48</option>-->
<!--        <option value="01:49">1:49</option>-->
<!--        <option value="01:50">1:50</option>-->
<!--        <option value="01:51">1:51</option>-->
<!--        <option value="01:52">1:52</option>-->
<!--        <option value="01:53">1:53</option>-->
<!--        <option value="01:54">1:54</option>-->
<!--        <option value="01:55">1:55</option>-->
<!--        <option value="01:56">1:56</option>-->
<!--        <option value="01:57">1:57</option>-->
<!--        <option value="01:58">1:58</option>-->
<!--        <option value="01:59">1:59</option>-->
<!---->
<!--        <option value="02:00">2:00</option>-->
<!---->
<!--        <option value="02:01">2:01</option>-->
<!--        <option value="02:02">2:02</option>-->
<!--        <option value="02:03">2:03</option>-->
<!--        <option value="02:04">2:04</option>-->
<!--        <option value="02:05">2:05</option>-->
<!--        <option value="02:06">2:06</option>-->
<!--        <option value="02:07">2:07</option>-->
<!--        <option value="02:08">2:08</option>-->
<!--        <option value="02:09">2:09</option>-->
<!--        <option value="02:10">2:10</option>-->
<!--        <option value="02:11">2:11</option>-->
<!--        <option value="02:12">2:12</option>-->
<!--        <option value="02:13">2:13</option>-->
<!--        <option value="02:14">2:14</option>-->
<!--        <option value="02:15">2:15</option>-->
<!--        <option value="02:16">2:16</option>-->
<!--        <option value="02:17">2:17</option>-->
<!--        <option value="02:18">2:18</option>-->
<!--        <option value="02:19">2:19</option>-->
<!--        <option value="02:20">2:20</option>-->
<!--        <option value="02:21">2:21</option>-->
<!--        <option value="02:22">2:22</option>-->
<!--        <option value="02:23">2:23</option>-->
<!--        <option value="02:24">2:24</option>-->
<!--        <option value="02:25">2:25</option>-->
<!--        <option value="02:26">2:26</option>-->
<!--        <option value="02:27">2:27</option>-->
<!--        <option value="02:28">2:28</option>-->
<!--        <option value="02:29">2:29</option>-->
<!--        <option value="02:30">2:30</option>-->
<!--        <option value="02:31">2:31</option>-->
<!--        <option value="02:32">2:32</option>-->
<!--        <option value="02:33">2:33</option>-->
<!--        <option value="02:34">2:34</option>-->
<!--        <option value="02:35">2:35</option>-->
<!--        <option value="02:36">2:36</option>-->
<!--        <option value="02:37">2:37</option>-->
<!--        <option value="02:38">2:38</option>-->
<!--        <option value="02:39">2:39</option>-->
<!--        <option value="02:40">2:40</option>-->
<!--        <option value="02:41">2:41</option>-->
<!--        <option value="02:42">2:42</option>-->
<!--        <option value="02:43">2:43</option>-->
<!--        <option value="02:44">2:44</option>-->
<!--        <option value="02:45">2:45</option>-->
<!--        <option value="02:46">2:46</option>-->
<!--        <option value="02:47">2:47</option>-->
<!--        <option value="02:48">2:48</option>-->
<!--        <option value="02:49">2:49</option>-->
<!--        <option value="02:50">2:50</option>-->
<!--        <option value="02:51">2:51</option>-->
<!--        <option value="02:52">2:52</option>-->
<!--        <option value="02:53">2:53</option>-->
<!--        <option value="02:54">2:54</option>-->
<!--        <option value="02:55">2:55</option>-->
<!--        <option value="02:56">2:56</option>-->
<!--        <option value="02:57">2:57</option>-->
<!--        <option value="02:58">2:58</option>-->
<!--        <option value="02:59">2:59</option>-->
<!---->
<!--        <option value="03:00">3:00</option>-->
<!---->
<!--        <option value="03:01">3:01</option>-->
<!--        <option value="03:02">3:02</option>-->
<!--        <option value="03:03">3:03</option>-->
<!--        <option value="03:04">3:04</option>-->
<!--        <option value="03:05">3:05</option>-->
<!--        <option value="03:06">3:06</option>-->
<!--        <option value="03:07">3:07</option>-->
<!--        <option value="03:08">3:08</option>-->
<!--        <option value="03:09">3:09</option>-->
<!--        <option value="03:10">3:10</option>-->
<!--        <option value="03:11">3:11</option>-->
<!--        <option value="03:12">3:12</option>-->
<!--        <option value="03:13">3:13</option>-->
<!--        <option value="03:14">3:14</option>-->
<!--        <option value="03:15">3:15</option>-->
<!--        <option value="03:16">3:16</option>-->
<!--        <option value="03:17">3:17</option>-->
<!--        <option value="03:18">3:18</option>-->
<!--        <option value="03:19">3:19</option>-->
<!--        <option value="03:20">3:20</option>-->
<!--        <option value="03:21">3:21</option>-->
<!--        <option value="03:22">3:22</option>-->
<!--        <option value="03:23">3:23</option>-->
<!--        <option value="03:24">3:24</option>-->
<!--        <option value="03:25">3:25</option>-->
<!--        <option value="03:26">3:26</option>-->
<!--        <option value="03:27">3:27</option>-->
<!--        <option value="03:28">3:28</option>-->
<!--        <option value="03:29">3:29</option>-->
<!--        <option value="03:30">3:30</option>-->
<!--        <option value="03:31">3:31</option>-->
<!--        <option value="03:32">3:32</option>-->
<!--        <option value="03:33">3:33</option>-->
<!--        <option value="03:34">3:34</option>-->
<!--        <option value="03:35">3:35</option>-->
<!--        <option value="03:36">3:36</option>-->
<!--        <option value="03:37">3:37</option>-->
<!--        <option value="03:38">3:38</option>-->
<!--        <option value="03:39">3:39</option>-->
<!--        <option value="03:40">3:40</option>-->
<!--        <option value="03:41">3:41</option>-->
<!--        <option value="03:42">3:42</option>-->
<!--        <option value="03:43">3:43</option>-->
<!--        <option value="03:44">3:44</option>-->
<!--        <option value="03:45">3:45</option>-->
<!--        <option value="03:46">3:46</option>-->
<!--        <option value="03:47">3:47</option>-->
<!--        <option value="03:48">3:48</option>-->
<!--        <option value="03:49">3:49</option>-->
<!--        <option value="03:50">3:50</option>-->
<!--        <option value="03:51">3:51</option>-->
<!--        <option value="03:52">3:52</option>-->
<!--        <option value="03:53">3:53</option>-->
<!--        <option value="03:54">3:54</option>-->
<!--        <option value="03:55">3:55</option>-->
<!--        <option value="03:56">3:56</option>-->
<!--        <option value="03:57">3:57</option>-->
<!--        <option value="03:58">3:58</option>-->
<!--        <option value="03:59">3:59</option>-->
<!---->
<!---->
<!---->
<!---->
<!--    </select>-->
<!--    <small>please select how long you want this time block to be</small>-->
<!--    <input class="form-control" name="price2" placeholder="price">-->
<!--    <small>how much to book for this long?</small><br>-->
<!--    <span class="help-block">--><?php //echo $booking2_err; ?><!--</span>-->


    <br><br>

    <p>flat rate for service</p>
    <input type="checkbox" id="flatrate" name="flatrate" value="flatrate">
    <label for="flatrate">flat rate for service</label>
    <input class="form-control" name="flatprice" placeholder="price">
    <small> price</small>
    <span class="help-block"><?php echo $flatprice_err; ?></span>

    <br>
    <br>
    <input type="submit" class="btn btn-primary" value="create service">

</form>

</body>

<!--<input type="time" id="timeamount2" name="timeamount2">-->
<!--<small> booking duration</small>-->
<!--<input class="form-control" name="price2" placeholder="price">-->
<!--<small> price</small>-->
<!---->
<!--<br><br>-->
<!---->
<!--<input type="time" id="timeamount3" name="timeamount3">-->
<!--<small> booking duration</small>-->
<!--<input class="form-control" name="price3" placeholder="price">-->
<!--<small> price</small>-->
<!---->
<!--<br><br>-->
<!---->
<!--<input type="time" id="timeamount4" name="timeamount4">-->
<!--<small> booking duration</small>-->
<!--<input class="form-control" name="price4" placeholder="price">-->
<!--<small> price</small>-->

</html>