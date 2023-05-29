
<?php
session_start();
?>
<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        <a href="index.php"><h1>INFOSITEZY</h1></a>
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="dashboard.php">Dashboard</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="posts.php">Manage Posts</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="category.php">Manage Categories</a>
        <?php
        if (isset($_SESSION['urole'])) {
            if ($_SESSION['urole'] == 0) {
                echo '  <a class="list-group-item list-group-item-action list-group-item-light p-3" href="users.php">Manage Users</a>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="settings.php">Settings</a>';
            }
        }
        ?>
    </div>
</div>