<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change this if you have set a password for your database
$dbname = "chapterchanger";
$port = 3308; // Change this if your MySQL server uses a different port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
