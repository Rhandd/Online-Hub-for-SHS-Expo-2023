<?php
require_once("../database/connection.php");

// Get the post ID from the query parameter
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    // Update post to rejected
    $sql = "UPDATE posts SET status = 'rejected' WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();

    // Feedback
    echo "Post rejected successfully.";
} else {
    echo "Invalid request.";
}
?>
