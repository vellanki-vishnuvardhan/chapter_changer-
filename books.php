<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Books</title>
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
      $stmt->close();
      $conn->close();
      ?>
    </div>
  </div>
</div>

<div class="container">
    <h1>All Books</h1>
    <div class="search-form">
        <div class="row">
            <div class="col-md-6">
                <form action="search.php" method="GET" class="d-flex">
                    <input type="text" id="search_query" name="query" class="form-control mr-2" placeholder="Enter Bookname or Author...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="search_1.php" method="GET" class="d-flex">
                    <select name="category" class="form-control dropdown-search mr-2">
                        <option value="romance">Romance</option>
                        <option value="hardwork">Hardwork</option>
                        <option value="nothing">Nothing</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        include 'dbconnect.php';
        $sql = "SELECT * FROM `postbook`";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $bok_n = $row['b_name'];
            $og_pr = $row['og_pr'];
            $ex_pr = $row['ex_pr'];
            $time = $row['dt_creation'];
            $pic = $row['pic1'];
            $b_id = $row['b_id'];

            echo '<div class="col-md-4">
            <div class="card" data-aos="flip-down" data-aos-duration="1500">
              <img src="images/uploads/' . $pic . '" class="card-img-top" alt="Book Cover">
              <div class="card-body">
                <h5 class="card-title"><a href="book_display.php?b_id=' . $b_id . '" class="text-dark">' . $bok_n . '</a></h5>
                <p class="card-text">Original Price: ' . $og_pr . '</p>
                <p class="card-text">Expected Price: ' . $ex_pr . '</p>
                <p class="card-text"><small class="text-muted">Last updated ' . $time . '</small></p>
              </div>
            </div>
          </div>';
        }
        ?>
    </div>
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
