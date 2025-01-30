<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "revivo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    $business_name = trim($_POST['business-name']);
    $first_name = trim($_POST['first-name']);
    
?>
