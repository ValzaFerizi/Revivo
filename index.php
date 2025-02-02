<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revivo's Home</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<header>
    <img src="logo.jpg" alt="Revivo Logo">
    <nav>
        <ul>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="registerusers.php">Sign Up</a></li>
        </ul>
    </nav>
</header>
<div class="searchbari">
    <h1 id="para">What are <span>you</span> looking for?</h1>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit">
            <img src="search.png" alt="Search Icon">
        </button>
    </div>
</div>

<div class="te-re">
    <h1>Our clients' favourite spots!</h1>
    <div class="biznisi-ri">
        <?php
        require 'database.php'; 

        $query = "SELECT * FROM businesses ORDER BY id";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="box">';
                echo '<h3>' . htmlspecialchars($row['business_name']) . '</h3>';
                echo '<p class="description">' . htmlspecialchars($row['description']) . '</p>';
                echo '<p class="price"><a href="booking.php?id=' . $row['id'] . '">Book now</a></p>';
                echo '</div>';
            }
        } else {
            echo "<p>No businesses found!</p>";
        }

        $conn->close();
        ?>
    </div>
</div>
    <h1 class="rezervimet" style="margin-left: 110px;">
        What services are you looking for?
    </h1>

    <div class="rezervimet">
        <div class="sherbimet">
            <a href="booking.php">
                <img src="Make up services.jpg" alt="Make-up Services" height="200px" width="200px">
                <p>Make-up Appointments</p>  
            </a>  
        </div>
    
        <div class="sherbimet">
            <a href="booking.php">
                <img src="Hair services.jpg" alt="Hair Services" height="200px" width="200px">
                <p>Hair Appointments</p>  
            </a>
        </div>
    
        <div class="sherbimet">
            <a href="booking.php">
                <img src="Lash services.jpg" alt="Lash Services" height="200px" width="200px">
                <p>Lash Appointments</p>  
            </a>
        </div>
    
        <div class="sherbimet">
            <a href="booking.php">
                <img src="Nails.jpg" alt="Nail Services" height="200px" width="200px">
                <p>Manicure / Pedicure Appointments</p>  
            </a>  
        </div>
    
        <div class="sherbimet">
            <a href="booking.html">
                <img src="Waxing.jpg" alt="Waxing Services" height="200px" width="200px">
                <p>Waxing Appointments</p>  
            </a>   
        </div>
    
        <div class="sherbimet">
            <a href="booking.php">
                <img src="Tanning.jpg" alt="Tanning Services" height="200px" width="200px">
                <p>Solarium Appointments</p>  
            </a>  
        </div>
    </div>

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

