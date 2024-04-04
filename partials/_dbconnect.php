<?php
$hostname="localhost";
$username= "root";
$password= "";
$database= "signup";
$conn = mysqli_connect($hostname, $username, $password, $database);
if(!$conn){
    die("Unable to connect =>". mysqli_connect_error());
}
else{
    echo"Successfully connected";
}