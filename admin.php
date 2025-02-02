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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <style>



header {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    background-color: #fafafa;
    border-bottom: 1px solid #1a1a1a;
    padding: 15px;
}

header img {
    height: 45px;
    object-fit: contain;
    justify-self: left;
    margin-right: 750px;
    margin-left: 10px;
}

header ul {
    display: flex;
    justify-content: right;
    align-items: center;
    list-style: none;
}

header li {
    margin: 0 6px;
    color: #1a1a1a;
}
header a {
    text-decoration: none;
    color: #1a1a1a;
    font-size: 14px;
    padding:  5px;
    transition: background-color 0.3s ease-in-out;
   
}

header a:hover {
   color: #1a1a1a;
   border-bottom: 1px solid #1a1a1a;
   border-bottom-width: thin;
   padding: 5px;
}

@media (max-width: 768px) {
    header {
        flex-direction: column;
        align-items: flex-start;
    }

    header ul {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    header li {
        margin: 10px 0;
    }
}</style>
</head>
<body>

<header>
        <img src="logo.jpg" alt="">
        <ul>
           <li><a href="index.html">Home </a></li>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="aboutus.html">About Us</a></li>
        
        </ul>
    </header>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
          
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Welcome, Admin.</h1>
                <p>Manage your wellness services efficiently.</p>
            </div>

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
