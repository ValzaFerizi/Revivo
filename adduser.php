<?php
session_start();


include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $nrtel = $_POST['nrtel'];

 
    $sql = "INSERT INTO users (emri, mbiemri, username, email, password, nrtel) 
            VALUES ('$emri', '$mbiemri', '$username', '$email', '$password', '$nrtel')";

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
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
        <img src="logo.jpg" alt="">
        <ul>
           <li><a href="index.html">Home </a></li>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="aboutus.html">About Us</a></li>
        </ul>
    </header>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
               
            </nav>
        </aside>

        <main class="main-content">
            <h1>Add User</h1>
            <form method="POST" action="adduser.php">
                <label>Emri:</label>
                <input type="text" name="emri" required><br>
                <label>Mbiemri:</label>
                <input type="text" name="mbiemri" required><br>
                <label>Username:</label>
                <input type="text" name="username" required><br>
                <label>Email:</label>
                <input type="email" name="email" required><br>
                <label>Password:</label>
                <input type="password" name="password" required><br>
                <label>Nr. Tel:</label>
                <input type="text" name="nrtel"><br>
                <button type="submit">Add User</button>
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