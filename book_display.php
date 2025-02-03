<?php
session_start();
include 'dbconnect.php';

if (isset($_GET['b_id'])) {
    $book_id = $_GET['b_id'];
    $sql = "SELECT * FROM `postbook` WHERE `b_id` = '$book_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bok_n = $row['b_name'];
        $og_pr = $row['og_pr'];
        $ex_pr = $row['ex_pr'];
        $description = $row['descript'];
        $auth = $row['b_auth'];
        $isbn = $row['b_isbn'];
        $pic1 = $row['pic1'];
        $pic2 = $row['pic2'];
        $_SESSION['owerid'] = $row['user_id'];
        $_SESSION['book_id']=$row['b_id'];
        
        // Add more details as needed
    } else {
        echo "Book not found.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <div class="jumbotron">
        <h1 class="display-4"><b><?php echo $bok_n; ?></b></h1>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/uploads/<?php echo $pic1; ?>" class="d-block mx-auto" style="max-width: 100%; height: auto;" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="images/uploads/<?php echo $pic2; ?>" class="d-block mx-auto" style="max-width: 100%; height: auto;" alt="Second slide">
                </div>
                
                <!-- Add more carousel items as needed -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        <p class="lead"><h6>Description</h6><?php echo $description; ?></p>
        <hr class="my-4">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h6>Author:</h6> <?php echo $auth; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h6>ISBN:</h6> <?php echo $isbn; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row 2 -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h6>Original Price:</h6> <?php echo $og_pr; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h6>Expected Price:</h6> <?php echo $ex_pr; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#buyrequestmodal">
            Request Book
        </button>

        <!-- Modal -->
        <div class="modal fade" id="buyrequestmodal" tabindex="-1" role="dialog" aria-labelledby="buyrequestmodalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buyrequestmodalLabel">Buying Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for buying request -->
                        <form action="request_submit.php" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Phone number</label>
                                <input type="tel" class="form-control" id="inputPhone" name="phone" pattern="[9][0-9]{9}" required>
                                <small class="form-text text-muted">Phone number must start with 9 and be 10 digits long.</small>
                            </div>
                            <div class="form-group">
                                <label for="inputMessage">Message</label>
                                <textarea class="form-control" id="inputMessage" name="message" rows="3" required></textarea>
                                <small class="form-text text-muted">Maximum 150 words.</small>
                            </div>
                            <div class="form-group">
                                <label for="inputOffer">Your Offering Price</label>
                                <input type="number" class="form-control" id="inputOffer" name="offering_price" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
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


    <script>
        // Function to validate the buy request form
        function validateForm() {
            var email = document.getElementById('inputEmail').value.trim();
            var phone = document.getElementById('inputPhone').value.trim();
            var message = document.getElementById('inputMessage').value.trim();
            var offeringPrice = parseFloat(document.getElementById('inputOffer').value.trim());

            // Email validation
            var emailRegex = /^[\w-.]+@[\w-]+(\.\w+)+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

            // Phone number validation
            var phoneRegex = /^[9][0-9]{9}$/;
            if (!phoneRegex.test(phone)) {
                alert('Please enter a valid 10-digit phone number starting with 9.');
                return false;
            }

            // Message validation: Ensure it's not empty
            if (message === "") {
                alert('Please enter your message.');
                return false;
            }

            // Message validation: Ensure it's not more than 150 words
            var words = message.split(/\s+/);
            if (words.length > 150) {
                alert('Message cannot exceed 150 words.');
                return false;
            }

            // Offering price validation: Ensure it's a positive number
            if (isNaN(offeringPrice) || offeringPrice <= 0) {
                alert('Please enter a valid offering price.');
                return false;
            }

            return true; // Allow form submission if all validations pass
        }
    </script>
</body>
</html>
