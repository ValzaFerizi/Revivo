<?php
session_start();
include 'database.php';

$id = $_GET['id'];

$sql = "DELETE FROM businesses WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php"); 
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>