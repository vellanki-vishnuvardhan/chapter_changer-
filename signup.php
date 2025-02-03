<?php
$name = $_POST["name"];
$email = $_POST["email"];
$number = $_POST["phnumber"];
$state = $_POST["state"];
$city = $_POST["city"];
$password = $_POST["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$servername = "localhost";
$username = "root";
$password = ""; // Assuming you haven't set a password
$dbname = "chapterchanger";
$port = 3308; // Specify the correct port here

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);


// Database connection
// $conn = new mysqli('localhost', 'root', '', 'chapterchanger');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $smt = $conn->prepare("INSERT INTO signup (name, email, number, state, city, password) VALUES (?, ?, ?, ?, ?, ?)");
    $smt->bind_param("ssssss", $name, $email, $number, $state, $city, $hashed_password);
    $smt->execute();
    
    session_start();
$_SESSION['signup_success'] = true;
header('Location: signupsucess.php');

    $smt->close();
    $conn->close();
}
?>
