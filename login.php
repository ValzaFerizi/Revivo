<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revivo";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if (empty($email) || empty($password)) {
        die("Error: All fields are required.");
    }

    
    $sql = "SELECT id, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
      
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];


        if (password_verify($password, $hashed_password)) {
       
            $_SESSION['id'] = $row['id'];

   
            header("Location: feedback.html");
            exit(); 
        } else {
          
            die("Error: Invalid password.");
        }
    } else {
        die("Error: User not found.");
    }
}

$conn->close();
?>