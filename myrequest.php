<?php
session_start();
// Include database connection
include 'dbconnect.php'; // Make sure to replace with your actual connection code
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
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
    <ul class="navbar-nav">
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
        <a class="nav-link" href="#" id="notificationsTab" data-toggle="modal" data-target="#notificationsModal">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
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
      // Include database connection
      include 'dbconnect.php';

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
              echo '<div class="modal-body">' . $row['message'] . '</div>';
          }
      } else {
          // No notifications
          echo '<div class="modal-body">No new notifications</div>';
      }

      // Close database connection
      ?>
    </div>
  </div>
</div>

<!-- Requests Section -->
<div class="container">
  <h2>Requests from Buyers to You:</h2>
  <br>
  <?php
  // session_start();
  $user = $_SESSION['user_id'];
  // Fetch requests from the database
  $sqlRequests = "SELECT * FROM requests WHERE owner_id='$user' ORDER BY request_date DESC";
  $resultRequests = mysqli_query($conn, $sqlRequests);

  // Check if there are any requests
  if ($resultRequests && mysqli_num_rows($resultRequests) > 0) {
      // Display requests
      while ($rowRequests = mysqli_fetch_assoc($resultRequests)) {
          // Process and display request data
          $requestId = $rowRequests['request_id'];
          $email = $rowRequests['email'];
          $contact = $rowRequests['contact1'];
          $requestMessage = $rowRequests['message'];
          $timestamp = $rowRequests['request_date'];
          $post =$rowRequests['pos_id'];
          // $name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Unknown";

          $bookId = $rowRequests['book_id'];

          // Fetch book name based on book ID
          $sqlBook = "SELECT b_name FROM postbook WHERE b_id = '$bookId'";
          $resultBook = mysqli_query($conn, $sqlBook);

          // Check if book details query was successful
          if ($resultBook && mysqli_num_rows($resultBook) > 0) {
              $rowBook = mysqli_fetch_assoc($resultBook);
              $bookName = $rowBook['b_name'];
          } else {
              // Handle the case where book details query fails or returns no data
              $bookName = "Unknown Book";
          }

             // Fetch book name based on book ID
             $sqluser = "SELECT name FROM signup WHERE id = '$post'";
             $resultuser = mysqli_query($conn, $sqluser);
   
             // Check if book details query was successful
             if ($resultuser && mysqli_num_rows($resultuser) > 0) {
                 $rowuser = mysqli_fetch_assoc($resultuser);
                 $name = $rowuser['name'];
             } else {
                 // Handle the case where book details query fails or returns no data
                 $user = "Unknown Book";
             }

          // You can format the timestamp as desired
          $formattedTimestamp = date('Y-m-d H:i:s', strtotime($timestamp));

          // Output request information
          echo "<div class='request' data-aos='zoom-in-left' data-aos-duration='900' >";
          echo "<p><strong>Name:</strong> $name</p>";
          echo "<p><strong>Email:</strong> $email</p>";
          echo "<p><strong>Contact :</strong> $contact</p>";
          echo "<p><strong>Book Name:</strong> $bookName</p>";
          echo "<p><strong>Request Message:</strong> $requestMessage</p>";
          echo "<p><strong>Date of request:</strong> $formattedTimestamp</p>";
          echo "</div>";
      }
  } else {
      echo "<p>No requests found.</p>";
  }
  ?>
</div>

<!-- Bootstrap JS and jQuery (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
