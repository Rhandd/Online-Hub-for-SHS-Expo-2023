<?php
require_once("database/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process the form data
    if (isset($_POST['cheading'], $_POST['cdesc'], $_POST['crselect'], $_FILES['imgt'])) {
        $cheading = $_POST['cheading'];
        $cdesc = $_POST['cdesc'];
        $crselect = $_POST['crselect'];
        $imgt = $_FILES['imgt'];

        // Perform form validation here
        // ...

        if (empty($cheading) || empty($cdesc) || empty($crselect) || empty($imgt['name'])) {
            // Display an error message
            echo "Please fill in all the fields.";
        } else {
            // Form validation passed
            // Insert the post into the database
            $status = 'pending'; // Set default status to 'pending'
            $ufile_name = uniqid() . '.' . strtolower(pathinfo($imgt['name'], PATHINFO_EXTENSION));
            $destination = "admin/images/" . $ufile_name; // Modify the destination folder path as per your requirement
            
            if (move_uploaded_file($imgt['tmp_name'], $destination)) {
                // File moved successfully
                $sql = "INSERT INTO posts (post_name, post_desc, category, post_img, status) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $cheading, $cdesc, $crselect, $ufile_name, $status);
                if ($stmt->execute()) {
                    // Post inserted successfully
                    $successMessage = "Article Published Successfully";
                    header("Location: createpost.php");
                } else {
                    $errorMessage = "Unable to publish the article.";
                }
            } else {
                $errorMessage = "Failed to move the uploaded file.";
            }
        }
    } else {
        // Display an error message if any required field is missing
        echo "Required field(s) missing.";
    }
}
?>
