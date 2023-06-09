<?php
require_once("../database/connection.php");
$sql = "SELECT post_id, post_name, author, category FROM posts WHERE status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Infositezy</title>
    <!-- Favicons -->
    <link href="assets\img\system-logo\INFOSITEZY.png" rel="icon">
    <link href="assets\img\system-logo\INFOSITEZY.png" rel="apple-touch-icon">
    <!-- FontAwesome CSS  -->
    <link rel="stylesheet" href="../assets/css/all.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="..\assets\css\admin.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php
        include_once('admin-includes/sidebar.php');
        ?>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php
            include_once('admin-includes/top-navigation.php');
            ?>
            <!-- Page content-->
            <div class="container-fluid" style="padding: 50px;">
                <div class="cont">

                <?php
require_once("../database/connection.php");

// Retrieve pending posts from the database
$sql = "SELECT post_id, post_name, author, category FROM posts WHERE status = 'pending'";
$result = $conn->query($sql);
?>

<!-- HTML code for displaying the pending posts -->
<!-- HTML code for displaying the pending posts -->
<span><span id="crh1">Pending Posts</span>
    <button type="button" onclick="location.href='posts.php'" class="btn btn-success float-right crbtn">Go Back</button>
</span>
<table class="table table-striped table-hover table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th>Post Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Loop through the pending posts and display them in a table
        while ($row = $result->fetch_assoc()) {
            $postId = $row['post_id'];
            $postTitle = $row['post_name'];
            $author = $row['author'];
            $category = $row['category'];
            ?>
            <tr>
            <td><?php echo $postTitle; ?></td>
                <td><?php echo $author; ?></td>
                <td><?php echo $category; ?></td>
                <td>
                    <a href="approve-post.php?postId=<?php echo $postId; ?>&action=approve">Approve</a> |
                    <a href="reject-post.php?postId=<?php echo $postId; ?>&action=reject">Reject</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<?php
// Step 3: Handle the approval or rejection logic here

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    // Retrieve the post details from the database
    $sql = "SELECT post_name, author, category FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($postTitle, $author, $category);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        $stmt->close();

        // Perform the approval or rejection action based on the request
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            if ($action === 'approve') {
                // Update the post status to 'approved'
                $status = 'approved';

                $sql = "UPDATE posts SET status = ? WHERE post_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $status, $postId);

                if ($stmt->execute()) {
                    // Post approved successfully
                    $successMessage = "The post has been approved.";
                } else {
                    $errorMessage = "Failed to approve the post.";
                }
            } elseif ($action === 'reject') {
                // Update the post status to 'rejected'
                $status = 'rejected';

                $sql = "UPDATE posts SET status = ? WHERE post_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $status, $postId);

                if ($stmt->execute()) {
                    // Post rejected successfully
                    $successMessage = "The post has been rejected.";
                } else {
                    $errorMessage = "Failed to reject the post.";
                }
            }
        }
    } else {
        $errorMessage = "Post not found.";
    }
}
?>

                </div>

                <!-- Pagination Code END -->
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="..\assets\js\admin.js"></script>
</body>

</html>
