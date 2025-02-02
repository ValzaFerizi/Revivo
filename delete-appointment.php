<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $appointment_id, $user_id);

    if ($stmt->execute()) {
        header("Location: userdashboard.php?deleted=1");
        exit();
    } else {
        echo "<p>Error: Unable to delete appointment.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
