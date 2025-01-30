<?php
require 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $qyteti = $_POST['qyteti'];
    $nrTel = $_POST['nrtel']; 
    $stmt = $conn->prepare("INSERT INTO klientet (emri, mbiemri, username, email, password, qyteti, nrtel) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $emri, $mbiemri, $username, $email, $password, $qyteti, $nrTel); 

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='register.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
}

$conn->close();
?>
