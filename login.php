<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Database connection parameters
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'chapterchanger';

    // Create a database connection
    $conn = new mysqli($server, $user, $password, $db, 3308);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $sql = "SELECT id, name, email, password FROM signup WHERE email=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Error preparing statement: ' . $conn->error);
    }
    $stmt->bind_param('s', $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $dbpass = $row['password'];

        // Verify the password
        if (password_verify($pass, $dbpass)) {
            // Store user data in session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];

            // Close the database connection
            $stmt->close();
            $conn->close();

            // Redirect to the home page
            header("Location: home.php");
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid Password";
        }
    } else {
        // Account does not exist
        $error_message = "Account does not exist";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
