<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $business_id = $_POST['business_id'];
    $appointment_type = $_POST['appointment_type'];
    $appointment_date = $_POST['appointment_date'];

   
    $query = "INSERT INTO appointments (business_id, user_id, appointment_type, appointment_date) 
              VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $business_id, $user_id, $appointment_type, $appointment_date);

    if ($stmt->execute()) {
        header("Location: userdashboard.php?success=1");
        exit();
    } else {
        echo "Error booking appointment!";
    }
}
?>
