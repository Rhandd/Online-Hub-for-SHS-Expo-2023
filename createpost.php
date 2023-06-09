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
    <?php include_once('client-includes\header.php'); ?>
    <!-- ======= End header ======= -->

    <main id="main">
        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="200">
                    <div class="col-lg-8">
                        <div class="createpost-form bg-white p-4">
                            <h2 class="text-center mb-4" style="color: #333;">Add New Post</h2>
                            <?php if (!empty($errorMsg)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $errorMsg; ?>
                                </div>
                            <?php elseif (isset($registrationSuccess) && $registrationSuccess) : ?>
                                <div class="alert alert-success" role="alert">
                                    Your post is pending review and waiting for approval.
                                </div>
                            <?php endif; ?>
                            <form action="submitpost.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="cheading" id="cheading" placeholder="Enter Article Title..." value="<?php if (isset($upname)) { echo $upname; } ?>" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <textarea name="cdesc" id="cdesc" class="form-control" rows="6" style="max-height: 300px;" placeholder="Write Article Here..."><?php if (isset($updesc)) { echo $updesc; } ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="crselect" class="form-label">Category</label>
                                    <select name="crselect" id="crselect" class="form-select">
                                        <option>Select Category</option>
                                        <?php
                                        $sql = "SELECT category_id,category_name FROM category";
                                        $res = $conn->prepare($sql);
                                        $res->bind_result($id, $name);
                                        $res->execute();
                                        $res->store_result();
                                        if ($res->num_rows() > 0) {
                                            while ($res->fetch()) { ?>
                                                <option value="<?php echo $id; ?>" <?php if (isset($upcat) && ($upcat == $id)) { echo "selected"; } ?>><?php echo $name; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">Post Image</label>
                                    <input type="file" name="imgt" id="img" class="form-control">
                                    <input type="hidden" name="oldimg" value="<?php if (isset($upimg)) { echo $upimg; } ?>">
                                 
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="<?php if (isset($upid)) { echo "update"; } else { echo "publish"; } ?>" class="btn btn-success" value="<?php if (isset($upid)) { echo "Update"; } else { echo "Publish"; } ?>">
                                </div>
                            </form>
                            <p id="category-message" class="mt-3" style="color: red; font-size: 16px; font-weight: bold;"></p>

                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Hero -->
    </main><!-- End #main -->

    <?php include_once('client-includes/footer.php'); ?>

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

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var categoryDropdown = document.getElementById("crselect");
        var messageElement = document.getElementById("category-message");

        categoryDropdown.addEventListener("change", function() {
            var selectedCategory = categoryDropdown.options[categoryDropdown.selectedIndex].text;

            // Define the category messages dynamically based on the categories in the database
            var categoryMessages = {
                <?php
                $sql = "SELECT category_id, category_name, guideline FROM category";
                $res = $conn->prepare($sql);
                $res->bind_result($id, $name, $guideline);
                $res->execute();
                $res->store_result();
                if ($res->num_rows() > 0) {
                    while ($res->fetch()) {
                        echo "'" . $name . "': '" . addslashes($guideline) . "', ";
                    }
                }
                ?>
            };

            if (categoryMessages.hasOwnProperty(selectedCategory)) {
                messageElement.textContent = categoryMessages[selectedCategory];
            } else {
                messageElement.textContent = "";
            }
        });
    });
</script>
</body>

</html>
