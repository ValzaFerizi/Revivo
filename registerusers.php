
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become part of us!</title>
    <link rel="stylesheet" href="style_reg.css">
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

    <div>
        <form action="register.php" method="POST">
            <h2  id="titulli">Become a part of us!</h2>
            <label for="emri">Emri:</label>
            <input type="text"  name="emri"placeholder="emri" required>
            <label for="mbiemri">Mbiemri:</label>
            <input type="text" placeholder="Mbiemri"  name="mbiemri" required>
            <label for="username">Username:</label>
            <input type="text" placeholder="Username"  name="username"required>
            <label for="Email">Email</label>
            <input type="email"placeholder="Email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" placeholder="Password" name="password" required>
           
            <label for="NrTel">Numri i telefonit</label>
            <input type="tel" placeholder="Numri i telefonit" maxlength="12" name="nrtel">

            <button type="submit" name="submit">Register</button>
            <h1 id="linkat" style="margin-top: 15px;"><a href="login.html">Have an account already?</a></h1>
            <h1 id="linkat" style="margin-left: 165px;"><a href="SignupBussines.Html">Register as business!</a></h1>
                </form>

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
    </div>
<!-- <script src="scriptValidim.js"></script> -->
    </body>
    </html>