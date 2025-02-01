<?php
session_start();
require 'database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user appointments
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Welcome to Your Dashboard</h2>

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
            }
        } else {
            echo "<tr><td colspan='3'>No appointments found.</td></tr>";
        }
        ?>
    </table>

    <p><a href="index.php">Book Another Appointment</a></p>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
