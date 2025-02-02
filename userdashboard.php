<?php
session_start();
require 'database.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query_user = "SELECT emri FROM users WHERE id = ?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$user_name = $user['emri'];

$query = "SELECT a.id, b.business_name, a.appointment_type, a.appointment_date 
          FROM appointments a 
          JOIN businesses b ON a.business_id = b.id 
          WHERE a.user_id = ? 
          ORDER BY a.appointment_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="userDashboard.css">
    
</head>
<body>
    <header>
        <img src="logo.jpg" alt="">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="register.html">Sign Up</a></li>
        </ul>
    </header>
<body>
<h2>Welcome, <?php echo htmlspecialchars($user_name); ?>! 👋</h2>
  

    <?php if (isset($_GET['success'])) { ?>
        <p style="color: green;">✅ Appointment booked successfully!</p>
    <?php } ?>

    <h3>Your Appointments:</h3>
    <table border="1">
        <tr>
            <th>Business</th>
            <th>Service</th>
            <th>Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['business_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['appointment_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                echo "</tr>";
                echo "<td>
                <form action='delete-appointment.php' method='POST' onsubmit='return confirm(\"Are you sure?\");'>
                <input type='hidden' name='appointment_id' value='" . $row['id'] . "'>
                <button type='submit' style='color: red;'>Delete</button>
            </form>
            </td>";
            }
        } else {
            echo "<tr><td colspan='3'>No appointments found.</td></tr>";
        }
        ?>
        <?php if (isset($_GET['deleted'])) { ?>
    <p style="color: red;">🗑️ Appointment deleted successfully!</p>
<?php } ?>
    </table>

    <p><a href="index.php">Book Another Appointment</a></p>
    
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
