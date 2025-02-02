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
    <style>
footer {
    background-color: #1a1a1a;
    color: #fafafa;
    padding: 20px 15px;
    font-size: 14px;
    margin-top: 200px;

}

.footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 80px;
}

.footer-block {
    width: 38%;
}

.footer-block p {
    margin: 5px 0;
}

.footer-block a {
    color: #fafafa;
    text-decoration: none;
}

.footer-block a:hover {
    text-decoration: underline;
}

.social-links {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 10px;
}

.social-links li {
    display: inline-block;
}

.social-links a {
    color: #fafafa;
    text-decoration: none;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: #fafafa;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .footer-block {
        width: 100%;
    }
}
</style>
    
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
$stmt->close();
$conn->close();
?>
