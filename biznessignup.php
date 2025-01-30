<?php

require 'database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $business_name = $_POST['business_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 


    $query = "INSERT INTO business_registration (business_name, first_name, last_name, email, phone, country, region, password, status)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";  

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssssss", $business_name, $first_name, $last_name, $email, $phone, $country, $region, $password);
        if ($stmt->execute()) {
            
            header("Location: contact.html");  
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
