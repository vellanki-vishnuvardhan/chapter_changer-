<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    .card {
      margin-bottom: 20px; /* Add space between cards */
    }
    .navbar-brand {
      display: flex;
      align-items: center;
      color: #333; /* Change color as needed */
      font-weight: bold;
      text-decoration: none;
    }

    .navbar-brand img {
      width: 30px; /* Adjust width as needed */
      height: 30px; /* Adjust height as needed */
      border-radius: 50%;
      margin-right: 10px; /* Adjust margin as needed */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="images\cc-high-resolution-logo.png" alt="Your Logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="makeapost.html">Make a Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profile</a>
      </li>
    </ul>
    <!-- You can add additional elements here like search bar or buttons -->
  </div>
</nav>

<div class="container">
<?php
// Include database connection
include 'dbconnect.php';

// Check if the search query is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["category"])) {
    // Sanitize the search query
    $search_query = mysqli_real_escape_string($conn, $_GET["category"]);

    // Perform search query
    $sql = "SELECT * FROM `postbook` WHERE `genr1` = '$search_query' OR `genr2` = '$search_query'";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if ($result && mysqli_num_rows($result) > 0) {
        // Display search results
        echo '<h2>Search Results</h2>';
        echo '<div class="row">';
        while ($row = mysqli_fetch_assoc($result)) {
            $bok_n = $row['b_name'];
            $og_pr = $row['og_pr'];
            $ex_pr = $row['ex_pr'];
            $time = $row['dt_creation'];
            $pic = $row['pic1'];
            $b_id = $row['b_id'];

            echo '<div class="col-md-4">
                <div class="card">
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
        echo '</div>';
    } else {
        echo '<p>No results found for the selected genre.</p>';
    }
} else {
    // Redirect if accessed directly without search query
    header("Location: home.php");
    exit();
}

// Close database connection
mysqli_close($conn);
?>


</div>

<!-- Bootstrap JS and jQuery (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
