<?php

$localhost = "localhost";
$dbname= "login_and_register";
$user= "root";
$pass = "";
$conn = new PDO("mysql:localhost=$localhost;dbname=$dbname", $user, $pass) or die("couldnt connect");

?>