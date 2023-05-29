<?php
require_once('../database/connection.php');
//-===== posts count ======-
$sql = "SELECT post_id,post_name FROM posts";
$res = $conn->prepare($sql);
$res->bind_result($pid, $pname);
$res->execute();
$res->store_result();
$pcnt = $res->num_rows();
//-===== category count ======-

$sql1 = "SELECT category_id FROM category";
$res1 = $conn->prepare($sql1);
$res1->bind_result($cid);
$res1->execute();
$res1->store_result();
$ccnt = $res1->num_rows();

//-===== users count ======-

$sql2 = "SELECT id FROM users";
$res2 = $conn->prepare($sql2);
$res2->bind_result($uid);
$res2->execute();
$res2->store_result();
$ucnt = $res2->num_rows();

//-===== Latest Articles ======-
$sql3 = "SELECT post_id,post_name FROM posts ORDER BY post_id DESC LIMIT 4";
$res3 = $conn->prepare($sql3);
$res3->bind_result($pid3, $pname3);
$res3->execute();
$res3->store_result();
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
                <h2 style="text-align: center;">Hello, <?php echo $_SESSION['uname']; ?></h2>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Articles</h5>
                                <p class="card-text"><?php echo $pcnt; ?></p>
                                <a href="posts.php" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Categories</h5>
                                <p class="card-text"><?php echo $ccnt; ?></p>
                                <a href="category.php" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>
                                <p class="card-text"><?php echo $ucnt; ?></p>
                                <a href="users.php" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Latest Posts</h5>
                                <?php if ($res3->num_rows() > 0) {
                                    while ($res3->fetch()) { ?>
                                        <hr>
                                        <div class="larticles">
                                            <p> <?php echo $pname3; ?> </p>
                                        </div>
                                <?php }
                                } else {
                                    echo "<div style='display:block; width:100%; font-weight:bold; font-size:2rem; text-align:center;'>0 Results Found</div>";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="..\assets\js\admin.js"></script>
</body>

</html>