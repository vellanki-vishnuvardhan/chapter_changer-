<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Post</title>
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

    <div class="container" data-aos="zoom-in-left" data-aos-duration="3000">
        <h1 class="mt-4">Upload Book Post</h1>
        <form action="makeapost.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <!-- Book Name -->
            <div class="form-group">
                <label for="bookname">Book Name</label>
                <input type="text" class="form-control" id="bookname" name="bookname" required>
            </div>
            <!-- ISBN -->
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" required>
            </div>
            <!-- Author -->
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <!-- Original Price -->
            <div class="form-group">
                <label for="originalPrice">Original Price</label>
                <input type="text" class="form-control" id="originalPrice" name="originalPrice" required>
            </div>
            <!-- Expected Price -->
            <div class="form-group">
                <label for="expectedPrice">Expected Price</label>
                <input type="text" class="form-control" id="expectedPrice" name="expectedPrice" required>
            </div>
            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                <small class="form-text text-muted">Maximum 150 words.</small>
            </div>
            <!-- Book Cover Image -->
            <div class="form-group">
                <label for="bookCoverImage">Book Cover Image</label>
                <input type="file" class="form-control-file" id="bookCoverImage" name="bookCoverImage" required>
            </div>
            <!-- Backside Image of Book -->
            <div class="form-group">
                <label for="backsideImage">Backside Image of Book</label>
                <input type="file" class="form-control-file" id="backsideImage" name="backsideImage" required>
            </div>
            <!-- Categories -->
            <div class="form-group">
                <label for="categories">GENRE -1</label>
                <select class="form-control" id="categories" name="categories" required>
                    <option value="science">Science</option>
                    <option value="hardwork">Hard Work</option>
                    <option value="nothing">Nothing</option>
                    <option value="romance">Romance</option>
                    <option value="education">Education</option>
                </select>
            </div>

            <!-- Second Categories -->
            <div class="form-group">
                <label for="categories2">GENRE -2</label>
                <select class="form-control" id="categories2" name="categories2" required>
                    <option value="science">Science</option>
                    <option value="hardwork">Hard Work</option>
                    <option value="nothing">Nothing</option>
                    <option value="romance">Romance</option>
                    <option value="education">Education</option>
                </select>
            </div>

            <!-- Used -->
            <!-- <div class="form-group">
                <label for="used">Used</label>
                <select class="form-control" id="used" name="used" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div> -->
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        // Function to validate form fields
        function validateForm() {
            var originalPrice = parseFloat(document.getElementById('originalPrice').value.trim());
            var expectedPrice = parseFloat(document.getElementById('expectedPrice').value.trim());

            // Original price should be more than expected price
            if (originalPrice <= expectedPrice) {
                alert("Original price should be greater than expected price.");
                return false;
            }

            // Check if original price and expected price are in number format and not negative
            if (isNaN(originalPrice) || originalPrice < 0 || isNaN(expectedPrice) || expectedPrice < 0) {
                alert("Original price and expected price should be positive numbers.");
                return false;
            }

            // Check if ISBN is in number format
            var isbn = document.getElementById('isbn').value.trim();
            if (isNaN(isbn)) {
                alert("ISBN should be in number format.");
                return false;
            }

            // Check if book name and author are not empty
            var bookname = document.getElementById('bookname').value.trim();
            var author = document.getElementById('author').value.trim();
            if (bookname === "" || author === "") {
                alert("Book name and author cannot be empty.");
                return false;
            }

            // Check if description is not empty and does not exceed 150 words
            var description = document.getElementById('description').value.trim();
            var words = description.split(/\s+/);
            if (description === "" || words.length > 150) {
                alert("Description cannot be empty and must be within 150 words.");
                return false;
            }

            // Add additional validations as needed

            return true; // Form is valid
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
