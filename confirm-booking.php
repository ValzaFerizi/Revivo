<?php
session_start();
require 'database.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $business_id = $_POST['business_id'];
    $business_name = $_POST['business_name'];
    $service_type = $_POST['service_type'];
    $user_id = $_SESSION['user_id']; 

 
    $stmt = $conn->prepare("INSERT INTO appointments (business_id, user_id, appointment_type) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $business_id, $user_id, $service_type);

    if ($stmt->execute()) {
        
        header("Location: userdashboard.php?success=1");
        exit();
    } else {
        echo "<p>Error: Unable to book appointment.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Error: Invalid request.</p>";
}
?>
