<?php

$host = 'localhost';
$dbname = 'revivo'; 
$username = 'root'; 
$password = ''; 


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $qyteti = $_POST['qyteti'];
        $nrTel = $_POST['nrTel'];

        
        $revivo = "INSERT INTO klientet (Emri, Mbiemri, Username, Email, Password, Qyteti, Nr_tel) 
                VALUES (:emri, :mbiemri, :username, :email, :password, :qyteti, :nr_tel)";
        
        $stmt = $conn->prepare($revivo);
        $stmt->bindParam(':emri', $emri);
        $stmt->bindParam(':mbiemri', $mbiemri);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':qyteti', $qyteti);
        $stmt->bindParam(':nr_tel', $nrTel);

        $stmt->execute();

        echo "Registration successful!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
