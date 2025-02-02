<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Appointment</title>
  <link rel="stylesheet" href="booking.css">
</head>
<body>

  <header>
    <img src="logo.jpg" alt="Logo">
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="feedback.html">Feedback</a></li>
        <li><a href="aboutus.html">About Us</a></li>
        <li><a href="contact.html">Contact Us</a></li>
    </ul>
  </header>

  <div class="container">
    <h2>Book Your Appointment</h2>

    <form action="confirm-booking.php" method="POST">
    
      <label for="appointment-type">Select Appointment Type:</label>
      <select id="appointment-type" name="appointment_type" required>
        <option value="">Select an option</option>
        <option value="hair">Hair Appointment</option>
        <option value="manicure-pedicure">Manicure & Pedicure</option>
        <option value="makeup">Makeup Appointment</option>
        <option value="lash">Lash Appointment</option>
        <option value="waxing">Waxing Appointment</option>
      </select>

   
      <label for="business">Select Business:</label>
      <select id="business" name="business_id" required>
        <option value="">Select a business</option>
        <?php
        require 'database.php';
        $query = "SELECT id, business_name FROM businesses ORDER BY business_name ASC";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
          echo "<option value='{$row['id']}'>{$row['business_name']}</option>";
        }
        ?>
      </select>

     
      <label for="appointment-date">Select Date:</label>
      <input type="date" id="appointment-date" name="appointment_date" required>

      <button type="submit">Book Now</button>
    </form>
  </div>

  <footer>
    <p>&copy; 2024 Revivo. All Rights Reserved.</p>
  </footer>

</body>
</html>
