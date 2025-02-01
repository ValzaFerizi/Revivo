<?php

session_start();


include 'database.php';


$sql_users = "SELECT id, emri, mbiemri, username, email, nrtel FROM users";
$result_users = $conn->query($sql_users);

$sql_businesses = "SELECT id, business_name, first_name, last_name, email, phone, country, region FROM businesses";
$result_businesses = $conn->query($sql_businesses);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminCss.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Manage Appointments</a></li>
                
                    <li><a href="#">Log Out</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header>
                <h1>Welcome, Admin.</h1>
                <p>Manage your wellness services efficiently.</p>
            </header>

            <section class="cards">
                <div class="card">
                    <h3>Total Users</h3>
                    <p><?php echo $result_users->num_rows; ?></p>
                </div>
                <div class="card">
                    <h3>Services Available</h3>
                    <p><?php echo $result_businesses -> num_rows ?></p>
                </div>
                <div class="card">
                    <h3>Total Appointments</h3>
                    <p>124</p>
                </div>
                <div class="card">
                    <h3>Registered Businesses</h3>
                    <p><?php echo $result_businesses -> num_rows ?></p>
                </div>
            </section>

            <section class="table-section">
                <h2>Recent register users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                    <button><a href="adduser.php">Add User</a></button>
                        <?php
                        if ($result_users->num_rows > 0) {
                            while ($row = $result_users->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['emri']}</td>
                                    <td>{$row['mbiemri']}</td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['nrtel']}</td>
                                    <td>
                                        <a href='edituserat.php?id={$row['id']}'>Edit</a>
                                        <a href='fshiuser.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>

            <section class="table-section">
                <h2>Recent Businesses</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <button><a href="addbusiness.php">Add Bussiness</a></button>
                        <?php
                        if ($result_businesses->num_rows > 0) {
                            while ($row = $result_businesses->fetch_assoc()) {
                                echo "
            
                                <tr>
                                    <td>{$row['business_name']}</td>
                                    <td>{$row['first_name']}</td>
                                     <td>{$row['last_name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                 <td>
                                        <a href='editusers.php?id={$row['id']}'>Edit</a>
                                        <a href='fshibiznes.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                                    </td>
                                </tr>
                                ";
                            }} else {
                                echo "<tr><td colspan='6'>No businesses found.</td></tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
