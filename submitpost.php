<?php
require_once("database/connection.php");

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process the form data
    if (isset($_POST['cheading'], $_POST['cdesc'], $_POST['crselect'], $_FILES['imgt'])) {
        $cheading = $_POST['cheading'];
        $cdesc = $_POST['cdesc'];
        $crselect = $_POST['crselect'];
        $imgt = $_FILES['imgt'];

        // Perform form validation here
        // ...

        // Check if the uploaded file is an image (PNG, JPG, or JPEG)
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $fileExtension = strtolower(pathinfo($imgt['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            // Display an error message
            echo "Only PNG, JPG, or JPEG images are allowed.";
        } else {
            if (empty($cheading) || empty($cdesc) || empty($crselect) || empty($imgt['name'])) {
                // Display an error message
                echo "Please fill in all the fields.";
            } else {
                // Form validation passed
                // Insert the post into the database
                $status = 'pending'; // Set default status to 'pending'
                $ufile_name = uniqid() . '.' . $fileExtension;
                $destination = "admin/images/" . $ufile_name; // Modify the destination folder path as per your requirement
                
                if (move_uploaded_file($imgt['tmp_name'], $destination)) {
                    // File moved successfully
                    if (!isset($_SESSION['id'])) {
                        // Redirect the user to the login page or handle the scenario when the user is not logged in
                        header("Location: login.php");
                        exit();
                    }
                
                    // Get the user ID from the session
                    $user_id = $_SESSION['id'];
                
                    // Save the post to the database
                    $sql = "INSERT INTO posts (post_name, post_desc, category, post_img, status, author) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssisss", $cheading, $cdesc, $crselect, $ufile_name, $status, $user_id);
                    if ($stmt->execute()) {
                        // Post inserted successfully
                        $successMessage = "Article Published Successfully";
                
                        // Display notification message
                        echo '<div class="notification">Your post has been submitted successfully. It will be reviewed by the admins for acceptance or rejection.</div>';
                    } else {
                        $errorMessage = "Unable to publish the article.";
                    }
                } else {
                    $errorMessage = "Failed to move the uploaded file.";
                }
            }
        }
    } else {
        // Display an error message if any required field is missing
        echo "Required field(s) missing.";
    }
}
?>
