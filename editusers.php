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
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
        <img src="logo.jpg" alt="">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </header>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
              
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
    <footer>
    <div class="footer-container">
        <div class="footer-block">
      <p>Dardani, Prishtinë</p>
      <p> Phone: +123 456 7890 |  Email: <a href="mailto:info@company.com">Revivo@company.com</a></p></div>
      <div class="footer-blo">
      <p> <a href="https://www.companywebsite.com" target="_blank">www.Revivo.com</a></p>
      <ul class="social-links">
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">X</a></li>
        <li><a href="#">LinkedIn</a></li>
    </ul>
    <p>&copy; 2024 Revivo. All Rights Reserved.</p></div>
    </div>
  </footer>
</body>
</html>

<?php
$conn->close();
?>