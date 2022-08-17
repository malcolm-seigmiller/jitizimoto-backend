<?php
define('dbserver', 'localhost');
define('dbuser', 'root');
define('dbpassword', '');
define('dbname', 'jitzimoto');

/* Attempt to connect to MySQL database */
$conn = mysqli_connect('localhost', 'root', '', 'jitzimoto');

// Check connection
if (!$conn) {
    die("ERROR: Could not connect." . mysqli_connect_error());
}
