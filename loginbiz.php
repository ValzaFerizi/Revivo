<?php
session_start();
require 'database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM businesses WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {  
            $_SESSION['business_name'] = $row['business_name'];
            $_SESSION['business_id'] = $row['id']; 
            header("Location: dashboard.php");
            exit();
        } else {
            echo "❌ Incorrect password.";
        }
    } else {
        echo "❌ Email not found.";
    }
}
echo "Email: $email <br>";
echo "Password: $password <br>";

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    echo "Found user: " . $row['email'] . "<br>";
    echo "Stored password: " . $row['password'] . "<br>";

    if (password_verify($password, $row['password'])) {
        echo "✅ Password matches!";
    } else {
        echo "❌ Password doesn't match.";
    }
} else {
    echo "❌ No user found.";
}

   
    
            echo "Session variables set!<br>"; 

           
            header("Location: BiznesDashboard.php");
            exit();
      



?>