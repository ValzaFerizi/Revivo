<?php

ini_set('display_errors', 1);
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

    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qyteti = $_POST['qyteti'];
    $nrtel = $_POST['nrtel'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

   
    $sql = "INSERT INTO users (emri, mbiemri, username, email, password, qyteti, nrtel) 
            VALUES ('$emri', '$mbiemri', '$username', '$email', '$hashedPassword', '$qyteti', '$nrtel')";

    echo $sql; 

   
    if (mysqli_query($conn, $sql)) {
      
        header("Location: success.php");
        exit();
    } else {
    
        echo "Error: " . mysqli_error($conn);
    }
}

?>