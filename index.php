<?php require_once('database/connection.php');
//-===== Latest Articles ======-
/*$sql3 = "SELECT post_id,post_name FROM posts ORDER BY post_id DESC LIMIT 7";
*/
$sql3 = "SELECT post_id, post_name FROM posts
WHERE posts.status = 'approved'
ORDER BY post_id DESC
LIMIT 7";


$res3 = $conn->prepare($sql3);
$res3->bind_result($pid3, $pname3);
$res3->execute();
$res3->store_result();
?>

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

            <div class="hero-img" data-aos="zoom-out" data-aos-delay="200">
              <img src="assets/img/Expo-title.png" class="img-fluid animated" alt="">
            </div>


          </div>
        </div>
        <div>
          <span class="scrollDown"></span>
        </div>
      </div>


    </section><!-- End Hero -->

    <!-- ======= Services Section ======= -->
    <section style="background-color: #0e0e0e;" id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h1 style="color: #fafafa;">NEWS UPDATE</h1>
        </div>

        <div class="row">
          <div id="carouselExampleIndicators" class="carousel slide col-5  pe-0" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>

            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img onclick="location.href='article.php?id=50'" src="admin/images/646a3e560330dHISTORY OF STI'S SENIOR HIGH SCHOOL EXPO.png" class="d-block w-100 carousel-image" alt="...">
              </div>
              <div class="carousel-item">
                <img onclick="location.href='article.php?id=53'" src="admin\images\646a43169514a346151993_809371757199727_3972239031703697499_n.png" class="d-block w-100 carousel-image" alt="...">
              </div>

            </div>
          </div>
          <div class="col ps-0">
            <div class="news-right">
              <div class="tab-list">
                <h3 style="padding-top: 15px;margin-left: 17px; margin-right: 17px; font-size: 20px; color: #a100ff;">Latest</h1>
                  <div>
                    <?php if ($res3->num_rows() > 0) {
                      while ($res3->fetch()) { ?>
                        <hr class="news-line">
                        <div class="larticles" style="margin-left: 17px; margin-right: 17px;">
                          <p> <a href="article.php?id=<?php echo $pid3 ?>" style="text-decoration:none; color:white;"><?php if (isset($pname3)) {
                                                                                                                        echo $pname3;
                                                                                                                      } ?></a> </p>
                        </div>
                    <?php }
                    } else {
                      echo "<div style='padding-top: 15px;margin-left: 17px; margin-right: 17px; font-size: 20px; color: #a100ff; text-align: center;'>No Posts</div>";
                    } ?>
                  </div>
                  <div>
                    <a href="blogs.php">
                      <h3 style="text-align: right; font-size: 17px; margin-right: 17px;">More</h3>
                    </a>
                  </div>
              </div>

            </div>
          </div>
        
        </div>





    </section><!-- End Services Section -->

    <!-- ======= Hero Section ======= -->
<!--<section id="hero" class="portal-section d-flex align-items-center" style="height: 100%;">

      <div class="portal-row-container container-fluid d-flex flex-column" style="height: 100%;">

     
        <a href="portal.php">
          <div class="portal-ddalo portal-row flex-grow-1">
            <div class="row h-100">
              <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="portal-img-bg"></div>
                <img class="portal-img" src="assets\img\system-logo\DDALO.png" alt="Image" style="max-width: 100%; max-height: 100%; width: 200px; height: 200px;">
              </div>
            </div>
          </div>
        </a>
   
        <a href="portal.php">
          <div class="portal-demoqratic portal-row flex-grow-1">
            <div class="row h-100">
              <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="portal-img-bg"></div>
                <img class="portal-img" src="assets\img\system-logo\demoQratic.png" alt="Image" style="max-width: 100%; max-height: 100%; width: 200px; height: 200px;">
              </div>
            </div>
          </div>
        </a>
     
        <a href="portal.php">
          <div class="portal-atlas portal-row flex-grow-1">
            <div class="row h-100">
              <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="portal-img-bg"></div>
                <img class="portal-img" src="assets\img\system-logo\ATLAS.png" alt="Image" style="max-width: 100%; max-height: 100%; width: 200px; height: 200px;">
              </div>
            </div>
          </div>
        </a>
  
        <a href="portal.php">
          <div class="portal-eventiqo portal-row flex-grow-1">
            <div class="row h-100">
              <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="portal-img-bg"></div>
                <img class="portal-img" src="assets\img\system-logo\EVENTIQO.png" alt="Image" style="max-width: 100%; max-height: 100%; width: 200px; height: 200px;">
              </div>
            </div>
          </div>
        </a>

        <a href="portal.php">
          <div class="portal-portalco portal-row flex-grow-1">
            <div class="row h-100">
              <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="portal-img-bg"></div>
                <img class="portal-img" src="assets\img\system-logo\PORTALCO..png" alt="Image" style="max-width: 100%; max-height: 100%; width: 200px; height: 200px;">
              </div>
            </div>
          </div>
        </a>
      
        <a href="portal.php">
          <div class="portal-kopfee portal-row flex-grow-1">
            <div class="row h-100">
              <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="portal-img-bg"></div>
                <img class="portal-img" src="assets\img\system-logo\KOPFEE.png" alt="Image" style="max-width: 100%; max-height: 100%; width: 200px; height: 200px;">
              </div>
            </div>
          </div>
        </a>

      </div>
    </section>End Hero -->
                













  </main><!-- End #main -->

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