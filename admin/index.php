<?php
session_start();
require_once("../database/connection.php");
if (isset($_SESSION['uname']) || isset($_SESSION['upass'])) {
    header("location:dashboard.php");
} else {
    if (isset($_REQUEST['login'])) {
        if (($_REQUEST['username'] == "") || ($_REQUEST['password'] == "")) {
            $err = "Please Fill All The Fields";
        } else {
            $uname = $_REQUEST['username'];
            $upass = ($_REQUEST['password']);
            $sql = "SELECT id,uname,upass,urole FROM users WHERE urole <= 1"; // Modify the query to restrict login access
            $res = $conn->prepare($sql);
            $res->bind_result($id, $name, $pass, $urole);
            $res->execute();
            while ($res->fetch()) {
                if (($uname == $name) and  (password_verify($upass, $pass))) {
                    $_SESSION['uname'] = $uname;
                    $_SESSION['upass'] = $upass;
                    $_SESSION['urole'] = $urole;
                    $_SESSION['uid'] = $id;
                    header("location:dashboard.php");
                    return;
                } else {
                    $err = "Wrong Username or Password";
                }
            }
            if ($urole >= 2) {
                $warning = "Authorized users only.";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infositezy</title>




    <!-- FontAwesome CSS  -->
    <link rel="stylesheet" href="../assets/css/all.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('../assets/img/space.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            padding: 20px;
            border: 1px solid #ddd;
            /* Add border */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Add box shadow */
        }

        .login-container h1 {
            text-align: center;
        }

        .login-container form {
            margin-top: 30px;
        }

        .login-container label {
            font-weight: bold;
        }

        .login-container button[type="submit"] {
            width: 100%;
        }
    </style>


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-container">
                    <h1 class="text-center">Login</h1>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username:</label>
                            <input type="text" name="username" id="username" class="form-control" autocomplete="off" autofocus="on" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                    <span>
                        <?php if (isset($err)) {
                            echo "<div class='bg-danger text-white text-center mt-3'>$err</div>";
                        } elseif (isset($warning)) {
                            echo "<div class='bg-warning text-dark text-center mt-3'>$warning</div>";
                        } ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- FontAwesome JS -->
    <script src="../assets/js/all.js"></script>
</body>

</html>