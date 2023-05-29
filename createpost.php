<?php require_once('database/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Infositezy</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets\img\system-logo\INFOSITEZY.png" rel="icon">
    <link href="assets\img\system-logo\INFOSITEZY.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <?php
    include_once('client-includes\header.php');
    ?>
    <!-- ======= End header ======= -->



    <main id="main">
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">

            <div class="container">
                <div class="row">
                    <div class="justify-content-center" data-aos="fade-down" data-aos-delay="200">

                   
                        <div style="background-color: white; padding: 50px;">
                            <form action="submitpost.php" method="POST" class="cform" enctype="multipart/form-data">
                                <span><span id="crh1">Add New Post</span><input type="submit" name="<?php if (isset($upid)) {
                                                                                                        echo "update";
                                                                                                    } else {
                                                                                                        echo "publish";
                                                                                                    } ?>" class="btn btn-success float-right" value="<?php if (isset($upid)) {
                                                                                                                                                        echo "Update";
                                                                                                                                                    } else {
                                                                                                                                                        echo "Publish";
                                                                                                                                                    } ?>"></input></span>
                                <input type="text" class="form-control" name="cheading" id="cheading" placeholder="Enter Article Title..." value="<?php if (isset($upname)) {
                                                                                                                                                        echo $upname;
                                                                                                                                                    } ?>" autocomplete="off">
                                <br>
                                <textarea name="cdesc" id="cdesc" placeholder="Write Article Here...."><?php if (isset($updesc)) {
                                                                                                            echo $updesc;
                                                                                                        } ?></textarea>
                                <br>
                                <br>
                                <h3>Category</h3>
                                <select name="crselect" id="crselect">
                                    <option>Select Category</option>
                                    <?php
                                    $sql = "SELECT category_id,category_name FROM category";
                                    $res = $conn->prepare($sql);
                                    $res->bind_result($id, $name);
                                    $res->execute();
                                    $res->store_result();
                                    if ($res->num_rows() > 0) {
                                        while ($res->fetch()) { ?>
                                            <option value="<?php echo $id; ?>" <?php if (isset($upcat) && ($upcat == $id)) {
                                                                                    echo "selected";
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>><?php echo $name; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <br>
                                <br><br>
                                <h3>Post Image</h3>
                                <input type="file" name="imgt" id="img">
                                <input type="hidden" name="oldimg" value="<?php if (isset($upimg)) {
                                                                                echo $upimg;
                                                                            } ?>">
                                <br>
                                <br>
                                <br>
                                <br>
                            </form>
                        </div>




                    </div>
                </div>
            </div>
        </section><!-- End Hero -->

    </main><!-- End #main -->

    <?php
    include_once('client-includes/footer.php');
    ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>