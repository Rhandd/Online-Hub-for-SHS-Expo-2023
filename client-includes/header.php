<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
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