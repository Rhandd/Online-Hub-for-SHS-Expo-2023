<?php
require_once('../database/connection.php');
//-------------------------------------category ---------------------------------------
if (isset($_REQUEST['catsubmit'])) {
    if (($_REQUEST['catname'] == "")) {
        $caterr = "Please Enter Category Name";
    } else {
        $sql = "INSERT INTO category(category_name,category_posts) VALUES(?,?)";
        $res = $conn->prepare($sql);
        $res->bind_param("si", $catname, $catposts);
        $catname = mysqli_real_escape_string($conn, $_REQUEST['catname']);
        $catposts = 0;
        $r = $res->execute();
        if ($r) {
            $catadd = "Category Added";
        } else {
            $caterr = "Unable to Add New Category";
        }
    }
}
//-------------------------------------category update---------------------------------------
if (isset($_REQUEST['updatecat'])) {
    if (($_REQUEST['catname'] == "")) {
        $caterr = "Please Enter Category Name";
    } else {
        $id = $_REQUEST['hid'];
        $sql = "UPDATE category SET category_name=? Where category_id=$id";
        $res = $conn->prepare($sql);
        $res->bind_param("s", $catname);
        $catname = mysqli_real_escape_string($conn, $_REQUEST['catname']);
        $r = $res->execute();
        if ($r) {
            $catadd = "Category Updated";
        } else {
            $caterr = "Unable to Update Category";
        }
    }
}
//-------------------------------------users ---------------------------------------
if (isset($_REQUEST['usersubmit'])) {
    if (($_REQUEST['uname'] == "") || ($_REQUEST["urole"] == "") || ($_REQUEST["upass"] == "")) {
        $err = "Please Fill All The Fields";
    } else {
        $sql = "INSERT INTO users(uname,upass,urole) VALUES(?,?,?)";
        $res = $conn->prepare($sql);
        $res->bind_param("ssi", $uname, $upass, $urole);
        $uname = mysqli_real_escape_string($conn, $_REQUEST['uname']);
        $upass = mysqli_real_escape_string($conn, password_hash($_REQUEST['upass'], PASSWORD_BCRYPT));
        $urole = mysqli_real_escape_string($conn, $_REQUEST['urole']);
        $r = $res->execute();
        if ($r) {
            $success = "User Added";
        } else {
            $err = "Unable to Add User";
        }
    }
}
//-------------------------------------Update User ---------------------------------------
if (isset($_REQUEST['updateuser'])) {
    if (($_REQUEST['uname'] == "") || ($_REQUEST["urole"] == "")) {
        $err = "Please Fill All The Fields";
    } else {
        $id = $_REQUEST['hid'];
        $sql = "UPDATE users SET uname=?,urole=? Where id=$id";
        $res = $conn->prepare($sql);
        $res->bind_param("si", $uname, $urole);
        $uname = mysqli_real_escape_string($conn, $_REQUEST['uname']);
        $urole = mysqli_real_escape_string($conn, $_REQUEST['urole']);
        $r = $res->execute();
        if ($r) {
            $success = "User Details Updated";
        } else {
            $err = "Unable to Update User Details";
        }
    }
}
//-------------------------------------Update Image ---------------------------------------
if (isset($_REQUEST['imgsubmit'])) {
    if ($_FILES['bimg'] == "") {
        $err = "Please Upload a Image";
    } else {
        $imgname = $_FILES['bimg']['name'];
        $imgsize = $_FILES['bimg']['size'];
        $imgtmp = $_FILES['bimg']['tmp_name'];
        $imgtype = $_FILES['bimg']['type'];
        $e = explode(".", $imgname);
        $imgext = end($e);
        $imgextsupp = 'jpg';
        if ($imgext !== $imgextsupp) {
            $imgerr = "Please Upload Only JPEG Format";
        }
        if ($imgsize > 2097152) {
            $imgerr = "File size must be less than 2mb";
        }
        if (move_uploaded_file($imgtmp, "images/headerlogo." . $imgext)) {
            $imgadd = "Image Uploaded Succesfully";
        } else {
            $imgerr = "Unable to Upload Image";
        }
    }
}

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
                    <h1>Settings</h1>
                    <div class="createct">
                        <?php
                        if (isset($_REQUEST['cid'])) {
                            $id = $_REQUEST['cid'];
                            $sql = "SELECT category_id,category_name FROM category WHERE category_id=$id";
                            $res = $conn->prepare($sql);
                            $res->bind_result($catid, $catname);
                            $res->execute();
                            $res->fetch();
                        }

                        ?>
                        <h2>Create Category</h2>
                        <div class="catint">
                            <form action="" method="POST" class="int">
                                <label for="" class="slabel">Category Name:</label> <input type="text" name="catname" id="catinput" value="<?php if (isset($_REQUEST['cid'])) {
                                                                                                                                                echo $catname;
                                                                                                                                            } ?>" autocomplete="off">
                                <input type="hidden" name="hid" value="<?php if (isset($_REQUEST['cid'])) {
                                                                            echo $catid;
                                                                        } ?>">
                                <input type="submit" name="<?php if (isset($_REQUEST['cid'])) {
                                                                echo "updatecat";
                                                            } else {
                                                                echo "catsubmit";
                                                            } ?>" value="<?php if (isset($_REQUEST['cid'])) {
                                                                                echo "Update";
                                                                            } else {
                                                                                echo "Create";
                                                                            } ?>" class="btn btn-success crtbtn" id="createbtn">
                            </form>
                            <br><br>
                            <div><?php if (isset($catadd)) {
                                        echo "<div class='bg-success text-white' style='width:100%; height:30px; text-align:center; margin-top:10px; font-weight:bold;' > $catadd </div>";
                                    } else if (isset($caterr)) {
                                        echo "<div class='bg-danger text-white' style='width:100%; height:30px; text-align:center; margin-top:10px; font-weight:bold;'>$caterr</div>";
                                    } else {
                                    } ?></div>
                        </div>
                    </div>
                    <div class="createct">
                        <?php
                        if (isset($_REQUEST['id'])) {
                            $id = $_REQUEST['id'];
                            $sql = "SELECT uname,urole FROM users WHERE id=$id";
                            $res = $conn->prepare($sql);
                            $res->bind_result($uname, $urole);
                            $res->execute();
                            $res->fetch();
                        }

                        ?>
                        <h2>Create User</h2>
                        <form action="" method="POST" class="catint">
                            <label for="" class="slabel sslabel">User Name:</label> <input type="text" name="uname" id="catinput" value="<?php if (isset($_REQUEST['id'])) {
                                                                                                                                                echo $uname;
                                                                                                                                            } ?>" autocomplete="off"><br>
                            <label for="" class="slabel sslabel">User Role:</label>
                            <select id="catinput" name="urole">
                                <option value="0">Admin</option>
                                <option value="1">Editor</option>
                            </select>
                            <label for="" class="slabel sslabel">Password:</label> <input type="password" name="upass" id="catinput">
                            <input type="hidden" name="hid" value="<?php if (isset($_REQUEST['id'])) {
                                                                        echo $id;
                                                                    } ?>">
                            <input type="submit" name="<?php if (isset($_REQUEST['id'])) {
                                                            echo "updateuser";
                                                        } else {
                                                            echo "usersubmit";
                                                        } ?>" value="<?php if (isset($_REQUEST['id'])) {
                                                                            echo "Update";
                                                                        } else {
                                                                            echo "Create";
                                                                        } ?>" class="btn btn-success crtbtn" id="createbtn">
                            <span><?php if (isset($success)) {
                                        echo "<div class='bg-success text-white' style='width:100%; height:30px; text-align:center; margin-top:10px; font-weight:bold;' > $success </div>";
                                    } else if (isset($err)) {
                                        echo "<div class='bg-danger text-white' style='width:100%; height:30px; text-align:center; margin-top:10px; font-weight:bold;'>$err</div>";
                                    } else {
                                    } ?></span>
                        </form>
                        <br><br>
                    </div>
                    <div class="createct">
                        <h2>Upload Blog Image</h2>
                        <div class="catint">
                            <form action="" method="POST" class="int" enctype="multipart/form-data">
                                <label for="" class="slabel">Image:</label> <input type="file" name="bimg" id="catinput">
                                <input type="submit" name="imgsubmit" value="Update" class="btn btn-success crtbtn" id="createbtn">
                            </form>
                            <div><?php if (isset($imgadd)) {
                                        echo "<div class='bg-success text-white' style='width:100%; height:30px; text-align:center; margin-top:10px; font-weight:bold;' > $imgadd </div>";
                                    } else if (isset($imgerr)) {
                                        echo "<div class='bg-danger text-white' style='width:100%; height:30px; text-align:center; margin-top:10px; font-weight:bold;'>$imgerr</div>";
                                    } else {
                                    } ?></div>
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