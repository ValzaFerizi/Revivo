<?php
session_start();
if (!isset($_SESSION['business_name'])) {
    header("Location: loginbiz.php"); 
    exit();
}
$business_name = $_SESSION['business_name']; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<!-- <body>  <header style="background-color: #fafafa;">
    <img src="logo.jpg" alt="">
    <ul>
        <li><a href="feedback.html">Feedback</a></li>
        <li><a href="aboutus.html">About Us</a></li>
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="registerusers.php">Sign Up</a></li>
    </ul>
</header> -->
        <ul>
            <li><a href="#services">Manage Services</a></li>
            <li><a href="#appointments">View Appointments</a></li>
            <li><a href="#add-service">Add New Service</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </header>
    <h2>Hi, <?php echo htmlspecialchars($business_name); ?> 👋</h2>

    <div class="dashboard-content">
        <section id="services">
            <h1>Manage Services</h1>
            <div class="biznisi-ri">
                <?php
                require 'database.php';

                $query = "SELECT * FROM businesses ORDER BY id DESC";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $business_name = $row['business_name'];
                        $description = $row['description'];
                        $region = $row['region'];
                        $images = $row['images'];
                        ?>
                        <div class="box">
                            <img src="<?php echo $images; ?> 
                            <h3><?php echo $service_name; ?></h3>
                            <p class="description"><?php echo $description; ?></p>
                           
                            <div class="actions">
                                <button class="edit">Edit</button>
                                <button class="delete">Delete</button>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No services found!";
                }

                $conn->close();
                ?>
            </div>
        </section>

        <section id="appointments">
            <h1>View Appointments</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'database.php';

                    $query = "SELECT * FROM appointments ORDER BY appointment_date DESC";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['user_name']}</td>
                                    <td>{$row['appointment_date']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No appointments found!</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

        <section id="add-service">
            <h1>Add New Service</h1>
            <form method="POST" action="add_service.php" enctype="multipart/form-data">
                <label for="service-name">Service Name:</label>
                <input type="text" id="service-name" name="service-name" placeholder="Enter service name" required>

                <label for="service-price">Price (€):</label>
                <input type="number" id="service-price" name="service-price" placeholder="Enter price" required>

                <label for="service-description">Description:</label>
                <textarea id="service-description" name="service-description" placeholder="Enter a brief description" required></textarea>

                <label for="service-image">Upload Image:</label>
                <input type="file" id="service-image" name="service-image" accept="image/*" required>

                <button type="submit">Add Service</button>
            </form>
        </section>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-block">
                <p>123 Wellness Street, City</p>
                <p>Phone: +123 456 7890 | Email: <a href="mailto:info@company.com">info@company.com</a></p>
            </div>
            <div class="footer-blo">
                <p><a href="https://www.companywebsite.com" target="_blank">www.companywebsite.com</a></p>
                <ul class="social-links">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
                <p>&copy; 2025 Company. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

