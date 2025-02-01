<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Debug: Script started!<br>";

$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "revivo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>POST Data:\n";
    print_r($_POST);
    echo "</pre>";

    $business_name = trim($_POST['business-name']);
    $first_name = trim($_POST['first-name']);
    $last_name = trim($_POST['last-name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $country = trim($_POST['country']);
    $region = trim($_POST['region']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($business_name) || empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($country) || empty($region) || empty($_POST['password'])) {
        die("Error: All fields are required.");
    }

 
    $sql = "INSERT INTO businesses ($business_name, $first_name, $last_name, $email, $phone, $country, $region, $password)
            VALUES ('business_name', 'first_name', 'last_name', 'email', 'phone', 'country', 'region', 'password')";
$business_name = trim($_POST['business-name']);
$first_name = trim($_POST['first-name']);
$last_name = trim($_POST['last-name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$country = trim($_POST['country']);
$region = trim($_POST['region']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email format.");
}

$sql = "INSERT INTO businesses (business_name, first_name, last_name, email, phone, country, region, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("ssssssss", $business_name, $first_name, $last_name, $email, $phone, $country, $region, $password);


if ($stmt->execute()) {
    echo "Debug: Data inserted successfully!<br>";
    ("Location: login.html"); 
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
}?>