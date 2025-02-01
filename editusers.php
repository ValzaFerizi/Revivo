<?php

session_start();


include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $business_name = $_POST['business_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $region = $_POST['region'];
  
    $sql = "UPDATE businesses SET 
            business_name = '$business_name', 
           first_name = '$first_name', 
            last_name = '$last_name', 
            email = '$email', 
            phone = '$phone', 
            country = '$country', 
            region = '$region'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$id = $_GET['id'];
$sql = "SELECT id, business_name, first_name, last_name ,email, phone, country, region FROM businesses WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Business</title>
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
            <h1>Edit Business</h1>
            <form method="POST" action="editusers.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Business Name:</label>
                <input type="text" name="business_name" value="<?php echo $row['business_name']; ?>" required><br>
                <label>First Name:</label>
                <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required><br>
                <label>Last Name:</label>
                <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required><br>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br>
                <label>Country:</label>
                <input type="text" name="country" value="<?php echo $row['country']; ?>" required><br>
                <label>Region:</label>
                <input type="text" name="region" value="<?php echo $row['region']; ?>" required><br>
                <br>
                <button type="submit">Save Changes</button>
            </form>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>