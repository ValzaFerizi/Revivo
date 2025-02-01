<?php
session_start();


include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
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
</body>
</html>

<?php
$conn->close();
?>