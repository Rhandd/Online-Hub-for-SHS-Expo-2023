<!-- nasa taas ng admin panel -->
<?php
if(isset($_SESSION['uname'])||isset($_SESSION['upass'])|| isset($_SESSION['urole'])||isset($_SESSION['uid'])){
    
}else{
     header("location:index.php");
}
if(isset($_REQUEST['logout'])){
    session_unset();
    session_destroy();
    header("location:index.php");
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><form action="" method="POST"><input class="nav-link" type="submit" name="logout" value="Logout"></form></li>  
                </li>
            </ul>
        </div>
    </div>
   
</nav>