<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book your appointment</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </header>

    <div class="container">
        <h2>Book Your Appointment</h2>
        <label for="appointment-type">Select Appointment Type:</label>
        <select id="appointment-type">
            <option value="">Select an option</option>
            <option value="hair">Hair Appointment</option>
            <option value="manicure-pedicure">Manicure & Pedicure</option>
            <option value="makeup">Makeup Appointment</option>
            <option value="lash">Lash Appointment</option>
            <option value="waxing">Waxing Appointment</option>
        </select>
        <button id="show-businesses">Find Available Salons</button>
    </div>

    <h1>Our Clients' Favourite Spots!</h1>
    <div class="biznisi-ri">
        <?php
        require 'database.php'; 

        $query = "SELECT * FROM businesses ORDER BY id DESC LIMIT 3";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="box">
                    <h3><?php echo $row['business_name']; ?></h3>
                    <p class="description"><?php echo $row['email']; ?></p>
                    <p class="price">See deals</p>
                </div>
                <?php
            }
        } else {
            echo "No businesses found!";
        }

        $conn->close();
        ?>
    </div>

    <div class="all-businesses">
        <h1>Find the perfect one for you!</h1>
        <div id="business-list">
            <?php
            require 'database.php';

            $query = "SELECT * FROM businesses ORDER BY business_name ASC";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <!-- <div class="business-card" data-service="<?php echo $row['service_type']; ?>"> -->
                        <h3><?php echo $row['business_name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                        <form action="confirm-booking.php" method="POST">
                            <input type="hidden" name="business_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="business_name" value="<?php echo $row['business_name']; ?>">
                            <input type="hidden" name="service_type" class="selected-service">
                            <button type="submit" class="book-appointment">Book Now</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No businesses found.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-block">
                <p>Dardani, Prishtinë</p>
                <p> Phone: +123 456 7890 |  Email: <a href="mailto:info@company.com">Revivo@company.com</a></p>
            </div>
            <div class="footer-blo">
                <p> <a href="https://www.companywebsite.com" target="_blank">www.Revivo.com</a></p>
                <ul class="social-links">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">X</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
                <p>&copy; 2024 Revivo. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
