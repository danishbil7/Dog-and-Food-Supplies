<?php
 
$servername = "lrgs.ftsm.ukm.my";
$username = "a189016";
$password = "largepurplecat";
$dbname = "a189016";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
?>