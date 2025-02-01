<?php

session_start();


include 'database.php';

// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//      exit();
// }


$user_id = $_SESSION['user_id'];


$sql_business = "SELECT id, business_name, email, phone
                 FROM businesses 
                 WHERE owner_id = $user_id";
$result_business = $conn->query($sql_business);
$business = $result_business->fetch_assoc();

$business_id = $business['id'];
$sql_appointments = "SELECT a.id, a.service, a.appointment_date, a.status, u.username 
                     FROM appointments a 
                     JOIN users u ON a.user_id = u.id 
                     WHERE a.business_id = $business_id";
$result_appointments = $conn->query($sql_appointments);


while ($row = $result_appointments->fetch_assoc()) {
    if ($row['status'] == 'Pending') {
        $pending_appointments[] = $row;
    } else {
        $accepted_appointments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Dashboard</title>
    <link rel="stylesheet" href="businessCss.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Business Panel</h2>
            <nav>
                <ul>
                    <li><a href="business_dashboard.php">Dashboard</a></li>
                    <li><a href="edit_business.php">Edit Business</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header>
                <h1>Hello, <?php echo $_SESSION['username']; ?>!</h1>
                <p>Manage your business and appointments efficiently.</p>
            </header>

            <section class="business-info">
                <h2>Business Information</h2>
                <p><strong>Business Name:</strong> <?php echo $business['business_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $business['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $business['phone']; ?></p>
                <p><strong>Registration Date:</strong> <?php echo $business['registration_date']; ?></p>
                <p><strong>Status:</strong> <?php echo $business['status']; ?></p>
            </section>

            <section class="appointments">
                <h2>Pending Appointments</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($pending_appointments)) {
                            foreach ($pending_appointments as $appointment) {
                                echo "
                                <tr>
                                    <td>{$appointment['username']}</td>
                                    <td>{$appointment['service']}</td>
                                    <td>{$appointment['appointment_date']}</td>
                                    <td>
                                        <a href='accept_appointment.php?id={$appointment['id']}'>Accept</a>
                                        <a href='reject_appointment.php?id={$appointment['id']}'>Reject</a>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No pending appointments.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>

            <section class="appointments">
                <h2>Accepted Appointments</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Service</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($accepted_appointments)) {
                            foreach ($accepted_appointments as $appointment) {
                                echo "
                                <tr>
                                    <td>{$appointment['username']}</td>
                                    <td>{$appointment['service']}</td>
                                    <td>{$appointment['appointment_date']}</td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No accepted appointments.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>