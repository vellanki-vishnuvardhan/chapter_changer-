<?php
// Include database connection
include 'dbconnect.php';

// Start session if not already started
session_start();

// Fetch notifications for the current user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are notifications
if ($result->num_rows > 0) {
    // Output notifications HTML
    while ($row = $result->fetch_assoc()) {
        echo $row['message'] ;
        
    }
} else {
    // No notifications
    echo 'No new notifications';
}

// Close database connection
$stmt->close();
$conn->close();
?>
