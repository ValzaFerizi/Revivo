<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revivo's Home</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header style="background-color: #fafafa;">
        <img src="logo.jpg" alt="">
        <ul>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="registerusers.php">Sign Up</a></li>
        </ul>
    </header>
<div class="searchbari">
    <h1 id="para">What are <span>you </span>looking for?</h1>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <img src="search.png" alt="" srcset="">
    </div>
</div>

<div class="te-re">
    <h1>Our clients favourites spots!</h1>
    <div class="biznisi-ri">
        <?php
        require 'database.php'; 
        
       
        $query = "SELECT * FROM businesses ORDER BY id DESC LIMIT 3";
        $result = $conn->query($query);
        
       
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $business_name = $row['business_name'];
                $email = $row['email'];
                $country = $row['country'];
                // <!-- $deal_link = $row['deal_link']; -->
                ?>
        
                <div class="box">
                    <!-- <img src="<?php echo $image; ?>" alt="<?php echo $business_name; ?>"> -->
                    <h3><?php echo $business_name; ?></h3>
                    <p class="description"><?php echo $email; ?></p>
                    <p class="price">See deals</p>
                    <!-- <button class="book-now"><a href="<?php echo $deal_link; ?>">Book Now</a></button> -->
                </div>
        
                <?php
            }
        } else {
            echo "No businesses found!";
        }
        
        $conn->close();
        ?>
    </div>

    <div class="te-re">
    <h1>Our clients favourites spots!</h1>