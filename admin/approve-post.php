<?php
require_once("../database/connection.php");

// Get the post ID from the query parameter
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    // Update to approved
    $sql = "UPDATE posts SET status = 'approved' WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();

    // Provide feedback
    echo "Post approved successfully.";
    header("Location: reviewposts.php");
} else {
    echo "Invalid request.";
}
?>
