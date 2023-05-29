<?php
require_once("../database/connection.php");
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
                    <span><span id="crh1">Article List</span><button type="button" onclick="location.href='create-post.php'" class="btn btn-success float-right crbtn">Create</button>
                    <button type="button" onclick="location.href='reviewposts.php'" class="btn btn-success float-right crbtn">Review Posts</button>
                    </span>
                    <?php
                    $limit = 15;
                    if (isset($_REQUEST['page'])) {
                        $pageno = $_REQUEST['page'];
                    } else {
                        $pageno = 1;
                    }
                    $offsetl = ($pageno - 1) * $limit;
                    $sql = "SELECT post_id,post_name,author,post_img,ur.uname,ct.category_id,ct.category_name FROM posts LEFT JOIN users ur ON posts.author=ur.id LEFT JOIN category ct ON posts.category=ct.category_id LIMIT $offsetl,$limit";
                    $res = $conn->prepare($sql);
                    $res->bind_result($pid, $pname, $pauthor, $pimg, $urname, $ctid, $ctname);
                    $res->execute();
                    $res->store_result();
                    if ($res->num_rows > 0) {
                    ?>
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="table-dark ">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>ARTICLE</th>
                                    <th>POSTED BY</th>
                                    <th>CATEGORY</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($res->fetch()) { ?>
                                    <tr class="text-center">
                                        <td><?php echo $pid; ?></td>
                                        <td><?php echo $pname; ?></td>
                                        <td><?php if (isset($urname)) {
                                                echo $urname;
                                            } else {
                                                echo "Rhandie";
                                            } ?></td>
                                        <td><?php if (isset($ctname)) {
                                                echo $ctname;
                                            } else {
                                                echo "Default";
                                            } ?></td>
                                        <td><a href="create-post.php?pid=<?php echo $pid; ?>&pimg=<?php echo $pimg ?>&ctid=<?php echo $ctid ?>&paut=<?php echo $pauthor ?>"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                                        <td><a href="delete-post.php?pid=<?php echo $pid; ?>&pimg=<?php echo $pimg ?>&ctid=<?php echo $ctid ?>&paut=<?php echo $pauthor ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo "<div style='display:block; width:100%; font-weight:bold; font-size:2rem; text-align:center;'>0 Results Found</div>";
                    } ?>
                </div>
                <!-- Pagination Code  -->
                
                <?php
                $sqlpg = "SELECT * FROM posts";
                $respg = $conn->prepare($sqlpg);
                $respg->execute();
                $respg->store_result();
                if ($respg->num_rows() > 0) {
                    $ttlrecords = $respg->num_rows();
                    if ($ttlrecords > 14) {
                        $ttlpages = ceil($ttlrecords / $limit);
                        echo '<ul class="pagination">';
                        if ($pageno > 1) {
                            echo '<li class="page-item"><a class="page-link" href="posts.php?page=' . ($pageno - 1) . '">Prev</a></li>';
                        } else {
                            $pageno = 1;
                            echo '<li class="page-item"><a class="page-link" href="posts.php?page=' . ($pageno) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $ttlpages; $i++) {
                            if ($pageno == $i) {
                                $pgactive = "pgactive";
                            } else {
                                $pgactive = "";
                            }
                            echo '<li class="page-item' . $pgactive . '"><a class="page-link" href="posts.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($pageno < $ttlpages) {
                            echo '<li class="page-item"><a class="page-link" href="posts.php?page=' . ($pageno + 1) . '">Next</a></li>';
                        } else {
                            $pageno = $ttlpages;
                            echo '<li class="page-item"><a class="page-link" href="posts.php?page=' . ($pageno) . '">Next</a></li>';
                        }
                        echo '</ul>';
                    }
                }
                ?>
                <!-- Pagination Code END -->
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