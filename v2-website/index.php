<?php
#I am going to remake the hooker booker app
//this time im going to make a website/api framework and build from there
//php is a fine lang but I will also be using javascript
//the app will allow a user to book, pay, review, ask questions on the website and book and pay with a simple U.I. plugin on onwers website
//it will allow the business to maintain customer relations, advertise, make offers, host websites with inbuilt support made from templates,
//automate questions or allow the bizowner or representivive to directly respond to user, advertise product lines.

//in essence its an e-recsptionist website

//for the app I should start with a beta focused on a select few types and then expand from there
//I will choose the following industries:
//beauty (haircuts, nail salons),
//message(erotic message, reg massage, chiropracy refexology ect),
//classes(karate, yoga, Pilates *I should think of something 24 hours*) !i should rename this class


################################################################################
session_start();
require_once "dashboard_config.php";

if (isset($_SESSION['loggedIn']) or isset($_SESSION['usrloggedIn'])) {
    header('Location: login/login.php');
    exit();
}

$city = "winnipeg";

//okay put search bock here, I can do something similar to what I did with my service page where I parse the info between pages with the url
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["search"]))){
        $search = "";
    } else{
        $search = trim($_POST["search"]);
    }
    header("Location: search.php/?location=$city&cat=$search");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<h1>welcome to jitizimoto</h1><br>
<a href="signup/signup.php">signup</a>
<a href="login/login.php">login</a>
<hr>
<p>search for local services</p>
<form method="POST">
    <input class="form-control" name="search" placeholder="search">
    <input type="submit" class="btn btn-primary" value="search">
</form>

</body>
</html>