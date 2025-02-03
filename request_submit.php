<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'dbconnect.php';

    // Sanitize and validate inputs
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $cont1 = mysqli_real_escape_string($conn, $_POST["phone"]);
    $message  = mysqli_real_escape_string($conn, $_POST["message"]);
    $reqmony = mysqli_real_escape_string($conn, $_POST["offering_price"]);
    $poid = $_SESSION['user_id'];
    $usrid = $_SESSION['owerid'];

    // Check how many requests the user has made
    $request_count_query = "SELECT COUNT(*) AS request_count FROM requests WHERE pos_id = '$poid'";
    $request_count_result = mysqli_query($conn, $request_count_query);
    $request_count_row = mysqli_fetch_assoc($request_count_result);
    $request_count = $request_count_row['request_count'];

    // Get the maximum number of requests allowed for the user
    $max_requests_query = "SELECT req FROM signup WHERE id = '$poid'";
    $max_requests_result = mysqli_query($conn, $max_requests_query);
    $max_requests_row = mysqli_fetch_assoc($max_requests_result);
    $max_requests = $max_requests_row['req'];
    $book_id=$_SESSION['book_id'];
    // Check if the user can make another request
    if ($request_count < $max_requests) {
        // Prepare and execute SQL statement to insert the new request
        $sql = "INSERT INTO `requests` (`email`, `contact1`, `price`, `pos_id`, `owner_id`, `message`, `book_id`) VALUES ('$email', '$cont1', '$reqmony', '$poid', '$usrid', '$message', '$book_id')";

        $result = mysqli_query($conn, $sql);

        // Check if query was successful
        if ($result) {
            header("Location: ../index.html?postrequest=true");
            exit();
        } else {
            // Handle database error
            echo "Error: " . mysqli_error($conn);
            // You can redirect to an error page or handle the error in another way
        }
    } else {
        // Redirect to sub.php if the user has reached the maximum number of requests
        header("Location: sub.php");
        exit();
    }
} else {
    // Redirect if form was not submitted via POST
    header("Location:index.php?postrequest=false");
    exit();
}
?>
