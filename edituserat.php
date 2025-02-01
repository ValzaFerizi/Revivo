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
</body>
</html>

<?php
$conn->close();
?>