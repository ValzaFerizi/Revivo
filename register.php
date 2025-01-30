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
    $emri = trim($_POST['emri']);
    $mbiemri = trim($_POST['mbiemri']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
   
    $nrtel = trim($_POST['nrtel']);
    
    if (empty($emri)) die("Emri is empty.");
    if (empty($mbiemri)) die("Mbiemri is empty.");
    if (empty($username)) die("Username is empty.");
    if (empty($email)) die("Email is empty.");
    if (empty($password)) die("Password is empty.");
    
    if (empty($nrtel)) die("Numri i telefonit is empty.");

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (emri, mbiemri, username, email, password,  nrtel) 
            VALUES ('$emri', '$mbiemri', '$username', '$email', '$hashedPassword',  '$nrtel')";

    echo "Query: " . $sql; 

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
        header("Location: login.html");
         exit();
        
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>