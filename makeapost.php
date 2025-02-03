<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php'; // Include your database connection file
    $err1 = false;
    $err2 = false;

    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

    // Retrieve form data
    $bookname = $_POST["bookname"];
    $isbn = $_POST["isbn"];
    $auth = $_POST["author"];
    $ogprice = $_POST["originalPrice"];
    $exprice = $_POST["expectedPrice"];
    $description = $_POST["description"];
    $gener1 = $_POST["categories"]; // Assuming this is an array
    $gener2 = $_POST["categories2"];
     // Assuming this is an array

    // Retrieve file details for image 1
    $imgname1 = $_FILES["bookCoverImage"]["name"];
    $imgerr1 = $_FILES["bookCoverImage"]["error"];
    $imgtemp1 = $_FILES["bookCoverImage"]["tmp_name"];
    $imgext1 = explode('.', $imgname1);
    $imgactualext1 = strtolower(end($imgext1));

    // Retrieve file details for image 2
    $imgname2 = $_FILES["backsideImage"]["name"];
    $imgerr2 = $_FILES["backsideImage"]["error"];
    $imgtemp2 = $_FILES["backsideImage"]["tmp_name"];
    $imgext2 = explode('.', $imgname2);
    $imgactualext2 = strtolower(end($imgext2));

    $allowed = array('jpg', 'jpeg', 'png');

    // Check if image 1 is of allowed type and handle file upload
    if (in_array($imgactualext1, $allowed)) {
        if ($imgerr1 === 0) {
            $img_new1 = uniqid('', true) . "." . $imgactualext1;
            $filedestination1 = 'images/uploads/' . $img_new1;
            move_uploaded_file($imgtemp1, $filedestination1);
        } else {
            $err1 = true;
            $errmessg1 = "Error uploading file 1";
        }
    } else {
        $err1 = true;
        $errmessg1 = "Invalid file type for file 1";
    }

    // Check if image 2 is of allowed type and handle file upload
    if (in_array($imgactualext2, $allowed)) {
        if ($imgerr2 === 0) {
            $img_new2 = uniqid('', true) . "." . $imgactualext2;
            $filedestination2 = 'images/uploads/' . $img_new2;
            move_uploaded_file($imgtemp2, $filedestination2);
        } else {
            $err2 = true;
            $errmessg2 = "Error uploading file 2";
        }
    } else {
        $err2 = true;
        $errmessg2 = "Invalid file type for file 2";
    }

    // Check the maximum number of books allowed for the user
    $max_books_sql = "SELECT boks FROM signup WHERE id = ?";
    $max_books_stmt = $conn->prepare($max_books_sql);
    $max_books_stmt->bind_param("i", $user_id);
    $max_books_stmt->execute();
    $max_books_result = $max_books_stmt->get_result();
    $max_books_row = $max_books_result->fetch_assoc();
    $max_books = $max_books_row['boks'];

    // Query the database to count the number of books the user has posted
    $count_sql = "SELECT COUNT(*) AS num_books FROM postbook WHERE user_id = ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("i", $user_id);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $count_row = $count_result->fetch_assoc();
    $num_books = $count_row['num_books'];

    // Check if the user has reached the maximum number of books allowed
    if ($num_books < $max_books) {
        // Insert data into database
        $sql = "INSERT INTO postbook (b_name, b_isbn, b_auth, og_pr, ex_pr, descript, pic1, pic2, genr1, genr2,  user_id, user_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssi", $bookname, $isbn, $auth, $ogprice, $exprice, $description, $filedestination1, $filedestination2, $gener1, $gener2,  $user_id, $user_name);
        $stmt->execute();
        $book_id = $stmt->insert_id; // Get the auto-incremented book ID
        $stmt->close();

        // Trigger notification for the owner of the book
        $owner_id_sql = "SELECT user_id FROM postbook WHERE b_id = ?";
        $owner_id_stmt = $conn->prepare($owner_id_sql);
        $owner_id_stmt->bind_param("i", $book_id);
        $owner_id_stmt->execute();
        $owner_id_result = $owner_id_stmt->get_result();
        
        if ($owner_id_row = $owner_id_result->fetch_assoc()) {
            $owner_id = $owner_id_row['user_id'];
            $notification_message = "Your book '{$bookname}' has been posted.";
            $notification_sql = "INSERT INTO notifications (user_id, message,username) VALUES (?, ?,?)";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param("iss", $owner_id, $notification_message,$user_name );
            $notification_stmt->execute();
            $notification_stmt->close();
        }
        $owner_id_stmt->close();

        // Rename the images with the book ID
        $new_img1 = $book_id . "." . $imgactualext1;
        $new_img2 = $book_id . "_backside." . $imgactualext2;
        rename($filedestination1, 'images/uploads/' . $new_img1);
        rename($filedestination2, 'images/uploads/' . $new_img2);

        // Update the database record with the new image names
        $update_sql = "UPDATE postbook SET pic1 = ?, pic2 = ? WHERE b_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $new_img1, $new_img2, $book_id);
        $update_stmt->execute();
        $update_stmt->close();

        // Redirect to home page or display success message
        header("Location:home.php ?postpsuccess=true");
        exit();
    } else {
        // Redirect to subscription page
        header("Location: sub.php");
        exit();
    }
}
?>
