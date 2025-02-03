<?php
session_start();
// Include database connection
include 'dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user's current subscription plan
$user_id = $_SESSION['user_id'];
$sql = "SELECT subscription FROM signup WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_plan = $row['subscription'];

// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscription Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
  <style>
    .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  } 

   h2 {
    text-align: center;
  } 

   form {
    margin-top: 20px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-weight: bold;
  }

  .form-group select {
    width: 100%;
    padding: 10px;
  }

  .form-group input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
  }

  .success-message {
    color: green;
    font-weight: bold;
  }

  .error-message {
    color: red;
    font-weight: bold;
  }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" data-aos="fade-down"
     data-aos-anchor-placement="top-bottom"  data-aos-duration="3000">
  <a class="navbar-brand" href="home.php">
    <img src="images/cc-high-resolution-logo.png" alt="Your Logo">
    ChapterChanger <!-- Add your brand name here -->
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="books.php">Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="makeapost_d.php">Make a Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="myrequest.php">My Request</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mypost.php">My Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sub.php">Membership</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#" id="notificationsTab" data-toggle="modal" data-target="#notificationsModal">Notifications</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Notifications Modal -->
<div class="modal fade right" id="notificationsModal" tabindex="-1" role="dialog" aria-labelledby="notificationsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="notificationsModalLabel">Notifications</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- PHP code for displaying notifications -->
      <?php
      // Fetch notifications for the current user
      include 'dbconnect.php';
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
              echo '<div class="modal-body">' . $row['message'] . '</div>';
          }
      } else {
          // No notifications
          echo '<div class="modal-body">No new notifications</div>';
      }

      // Close database connection
      $stmt->close();
      $conn->close();
      ?>
    </div>
  </div>
</div>

<div class="container" data-aos="zoom-in-down" data-aos-duration="1000">
  <h2>Subscription Page</h2>
  <br>
  <?php
  echo "<h2> NOW YOU HAVE : $current_plan</h2>";
  // Display success message if present in URL query string
  if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<div class="success-message">Subscription updated successfully!</div>';
    // Move alert to separate JavaScript block
    echo '<script> alert("Membership has been successfully updated!"); </script>';
  }

  // Display error message if present in URL query string
  if (isset($_GET['error']) && $_GET['error'] === 'true') {
    echo '<div class="error-message">Failed to update subscription. Please try again.</div>';
  }
  ?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
      <label for="subscription_plan">Select Subscription Plan:</label>
      <select name="subscription_plan" id="subscription_plan">
        <option value="basic" <?php if ($current_plan === 'basic') echo 'selected'; ?>>Basic (5 Requests, 5 Books)</option>
        <option value="premium" <?php if ($current_plan === 'premium') echo 'selected'; ?>>Premium (10 Requests, 10 Books)</option>
        <!-- Add more options for other subscription plans -->
      </select>
    </div>
    <div class="form-group">
      <input type="submit" value="Update Subscription">
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
