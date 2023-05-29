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
  <link href="assets/css/blogs.css" rel="stylesheet">

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
<header id="header" class="sticky-top article-header">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="index.php">Infositezy</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!--<a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="item nav-link" href="index.php">HOME</a></li>
                <li><a class="item nav-link" href="portal.php">PORTAL</a></li>
                <li><a class="item nav-link" href="blogs.php">POSTS</a></li>
                <li><a class="item nav-link " href="#about">ABOUT US</a></li>
               

                <li>
                    <?php
                    session_start();
                    if (isset($_SESSION['uname'])) {
                        echo '<a class="login" href="client-includes/logout.php">LOG OUT</a>';
                    } else {
                        echo '<a class="login" href="client-includes/login.php">LOG IN</a>';
                    }
                    ?>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="article-hero" class="d-flex align-items-center">

    <div class="container">
  
       

    <div class="container my-3">
    <div class="row">
      <div class="col-12 col-md-8 main">
        <?php
        if (isset($_REQUEST['id'])) {
          $id = $_REQUEST['id'];
        } else {
          header('location:error.php');
        }
        $sql = "SELECT post_name,post_desc,post_date,post_img,ur.uname,ct.category_name FROM posts LEFT JOIN users ur ON posts.author=ur.id LEFT JOIN category ct ON posts.category=ct.category_id WHERE post_id=$id ";
        $res = $conn->prepare($sql);
        $res->bind_result($pname, $pdesc, $pdate, $pimg, $urname, $ctname);
        $res->execute();
        $res->store_result();
        if ($res->num_rows() > 0) {
          $res->fetch();
        ?>
          <div class="article">
            <div class="ptitle">
              <h1><?php echo $pname; ?></h1>
              <div class="postdet">
                <span class="postdet1">
                  <i class="fas fa-tag fa-xs"></i>
                  <a href="#"><?php if (isset($ctname)) {
                                echo $ctname;
                              } else {
                                echo "Default";
                              } ?></a>
                </span>
                <span class="postdet1">
                  <i class="fas fa-user fa-xs"></i>
                  <a><?php if (isset($urname)) {
                        echo $urname;
                      } else {
                        echo "Rhandie";
                      } ?></a>
                </span>
                <span class="postdet1">
                  <i class="fas fa-calendar-alt fa-xs"></i>
                  <a><?php if (isset($pdate)) {
                        echo $pdate;
                      } ?></a>
                </span>
              </div>
            </div>
            <div class="pimg">
              <img src="<?php echo "admin/images/" . $pimg; ?>" alt="">
            </div>
            <!-- Article Description -->
            <div class="p_desc">
              <?php
              $pdesc = nl2br($pdesc);
              echo $pdesc; ?>


            </div>

          </div>

        <?php } else {
          echo "Error";
        } ?>
      </div>
      <?php include_once('client-includes/blog-includes/sidebar.php'); ?>


    </div>
  </div>

 


  

    </div>

  </section><!-- End Hero -->

  <?php
  include_once('client-includes/footer.php');
  ?>



  

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