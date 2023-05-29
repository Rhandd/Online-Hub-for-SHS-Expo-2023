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

  <?php
  include_once('client-includes\header.php');
  ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style=" background:url('assets/img/space.png') fixed center; height: 60vh; ">

    <div class="container">
      <div class="container">
        <div class="row">
          <?php
          $sql = "SELECT post_id, post_name, post_img, ur.id, ur.uname, ct.category_id, ct.category_name
                   FROM posts
                   LEFT JOIN users ur ON posts.author=ur.id
                   LEFT JOIN category ct ON posts.category=ct.category_id
                   WHERE posts.status = 'approved'
                   ORDER BY post_id DESC
                   LIMIT 3";

          $res = $conn->prepare($sql);
          $res->bind_result($pid, $pname, $pimg, $uid, $urname, $ctid, $ctname);
          $res->execute();
          $res->store_result();
          if ($res->num_rows() > 0) {
            while ($res->fetch()) {
          ?>
              <div class="col-sm-3 mx-auto ml-auto">
                <div class="card" style="opacity: 0.9">

                  <img style="padding: 5px;" class="recent-post card-img-top" src="<?php if (isset($pimg)) {
                                                                                      echo "admin/images/" . $pimg;
                                                                                    } ?>" onclick="location.href='article.php?id=<?php echo $pid ?>'" alt="">
                  <div class="card-body">
                    <h5 class="card-title"><a href="article.php?id=<?php echo $pid ?>" style="text-decoration:none; color:black;"><?php if (isset($pname)) {
                                                                                                                                    echo $pname;
                                                                                                                                  } ?></a></h5>

                  </div>

                </div>

              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>

    </div>

  </section><!-- End Hero -->



  <section class="container my-3">
    <div class="row">
      <!-- Categories Nav -->
      <?php
      include_once('client-includes\blog-includes\category-nav.php')
      ?>
      <!-- End Categories -->

      <div class="col-12 main">

        <!---------------- Post --------------------------- -->
        <?php
        if (isset($_REQUEST['searchsub'])) {
          $searcht = $_REQUEST['search'];
          if (($_REQUEST['search'] == "")) {
            echo "<p> No Articles Found. </p>";
          } else {
            $limit = 10;
            if (isset($_REQUEST['page'])) {
              $pageno = $_REQUEST['page'];
            } else {
              $pageno = 1;
            }
            $offsetl = ($pageno - 1) * $limit;
            $sql = "SELECT post_id,post_name,post_desc,post_date,post_img,ur.id,ur.uname,ct.category_id,ct.category_name FROM posts LEFT JOIN users ur ON posts.author=ur.id LEFT JOIN category ct ON posts.category=ct.category_id WHERE post_name COLLATE utf8_general_ci LIKE '%$searcht%' OR post_desc COLLATE utf8_general_ci LIKE '%$searcht%' LIMIT $offsetl,$limit";
            $res = $conn->prepare($sql);
            $res->bind_result($pid, $pname, $pdesc, $pdate, $pimg, $uid, $urname, $ctid, $ctname);
            $res->execute();
            $res->store_result();
            if ($res->num_rows() > 0) {
              while ($res->fetch()) {
        ?>
                <div class="post" style="margin-bottom: 0px;">
                  <span class="postimg">
                    <img src="<?php if (isset($pimg)) {
                                echo "admin/images/" . $pimg;
                              } ?>" onclick="location.href='article.php?id=<?php echo $pid ?>'" alt="">
                  </span>
                  <span class="postright">
                    <h2><a href="article.php?id=<?php echo $pid ?>"><?php if (isset($pname)) {
                                                                      echo $pname;
                                                                    } ?></a></h2>

                    <p class="postcontent"><?php if (isset($pdesc)) {
                                              echo substr($pdesc, 0, 130) . "...";
                                            } ?>
                    </p>
                    <br><br>
                    <div class="readmore">
                      <div class="postdet">
                        <span class="postdet1">
                          <i class="fas fa-user fa-xs"></i>
                          <a href="user.php?pageid=<?php echo $uid ?>"><?php if (isset($urname)) {
                                                                          echo $urname;
                                                                        } else {
                                                                          echo "Rhandie";
                                                                        } ?></a>
                        </span>
                        <span class="postdet1">
                          <i class="fas fa-calendar-alt fa-xs"></i>
                          <a>
                            <?php
                            if (isset($pdate)) {
                              $formattedDate = date("F j, Y", strtotime($pdate));
                              echo $formattedDate;
                            }
                            ?>
                          </a>
                        </span>
                        <span class="postdet1">
                          <i class="fas fa-tag fa-xs"></i>
                          <a href="category.php?pageid=<?php echo $ctid ?>"><?php if (isset($ctname)) {
                                                                              echo $ctname;
                                                                            } else {
                                                                              echo "Default";
                                                                            } ?></a>
                        </span>
                      </div>
                      <a href="article.php?id=<?php echo $pid; ?>" style="text-decoration:none;" class="">View</a>
                    </div>
                  </span>
                </div>
        <?php }
            }
          }
        } else {
          header('location:error.php');
        } ?>
        <!---------------- Post End ------------------------------>

      </div>

      <!-- Pagination Code  -->
      <?php
      $sqlpg = "SELECT * FROM posts";
      $respg = $conn->prepare($sqlpg);
      $respg->execute();
      $respg->store_result();
      if ($respg->num_rows() > 0) {
        $ttlrecords = $respg->num_rows();
        $limit = 10;
        $ttlpages = ceil($ttlrecords / $limit);
        echo '<ul class="pagination">';
        if ($pageno > 1) {
          echo '<li class="paginationli prev"><a href="search.php?page=' . ($pageno - 1) . '">Prev</a></li>';
        } else {
          $pageno = 1;
          echo '<li class="paginationli prev"><a href="search.php?page=' . ($pageno) . '">Prev</a></li>';
        }
        for ($i = 1; $i <= $ttlpages; $i++) {
          if ($pageno == $i) {
            $pgactive = "pgactive";
          }
          echo '<li class="paginationli ' . '"><a href="search.php?page=' . $i . '">' . $i . '</a></li>';
        }
        if ($pageno < $ttlpages) {
          echo '<li class="paginationli next"><a href="search.php?page=' . ($pageno + 1) . '">Next</a></li>';
        } else {
          $pageno = $ttlpages;
          echo '<li class="paginationli prev"><a href="search.php?page=' . ($pageno) . '">Next</a></li>';
        }
        echo '</ul>';
      }
      ?>
      <!-- Pagination Code END -->
    </div>

  </section>
  </div>

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