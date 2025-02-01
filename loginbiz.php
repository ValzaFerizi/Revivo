<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted!<br>"; 

    $email = $_POST['email'];
    $password = $_POST['password'];

   
    echo "Email: $email<br>"; 
    echo "Password: $password<br>"; 

   
    if (empty($email) || empty($password)) {
        die("Error: All fields are required.");
    }


    $sql = "SELECT id, password FROM businesses WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {

            $_SESSION['business_id'] = $row['id'];
            $_SESSION['email'] = $email;

            
            echo "Session variables set!<br>"; 

           
            header("Location: admin.php");
            exit();
        } else {
            
            die("Error: Invalid email or password.");
        }
    } else {
      
        die("Error: Invalid email or password.");
    }
} else {
    echo "Form not submitted!<br>"; 
}

$conn->close();
?>