<?php

session_start();


include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nrtel = $_POST['nrtel'];
    
    $sql = "UPDATE users SET 
            emri = '$emri', 
           mbiemri= '$mbiemri', 
            username = '$username', 
            email = '$email', 
            nrtel = '$nrtel'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$id = $_GET['id'];
$sql = "SELECT id, emri, mbiemri, username ,email, nrtel FROM users WHERE id = $id";
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
<body><header>
    <img src="logo.jpg" alt="Revivo Logo">
    <nav>
        <ul>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="registerusers.php">Sign Up</a></li>
        </ul>
    </nav>
</header>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
               
            </nav>
        </aside>

        <main class="main-content">
            <h1>Edit Business</h1>
            <form method="POST" action="edituserat.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Name:</label>
                <input type="text" name="emri" value="<?php echo $row['emri']; ?>" required><br>
                <label>Last-name:</label>
                <input type="text" name="mbiemri" value="<?php echo $row['mbiemri']; ?>" required><br>
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                <label>Phone:</label>
                <input type="text" name="nrtel" value="<?php echo $row['nrtel']; ?>" required><br>
                
                <button type="submit">Save Changes</button>
            </form>
        </main>
    </div>
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