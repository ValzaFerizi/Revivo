<?php
session_start();


include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $business_name = $_POST['business_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['counrty'];
    $region = $_POST['region'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
   

 
    $sql = "INSERT INTO businesses (business_name, first_name, last_name, email, phone, country, region, password) 
            VALUES ('$business_name', '$first_name', '$last_name', '$email', '$phone', '$country', '$region', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="adminCss.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="#">Manage Appointments</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Users</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <h1>Add Business</h1>
            <form method="POST" action="addbusiness.php">
                <label>Business Name:</label>
                <input type="text" name="business_name" required><br>
                <label>First Name:</label>
                <input type="text" name="first_name" required><br>
                <label>Last Name</label>
                <input type="text" name="last_name" required><br>
                <label>Email:</label>
                <input type="email" name="email" required><br>
                <label>Phone:</label>
                <input type="text" name="phone" required><br>
                <label>Country:</label>
                <input type="text" name="country" required><br>
                <label>Region:</label>
                <input type="text" name="region" required><br>
                <label>Password:</label>
                <input type="password" name="password"required>
                <br>
                <button type="submit">Add Business</button>
            </form>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>