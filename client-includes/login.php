<?php
session_start();

// Check if the user is already logged in, redirect to home page
if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

// Check if the login form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['uname']);
    $password = trim($_POST['upass']);

    // Validate the input fields
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        $conn = new PDO('mysql:host=localhost;dbname=dbinfositezycms', 'root', '');

        $stmt = $conn->prepare("SELECT id, uname, upass FROM users WHERE uname = :uname");
        $stmt->bindParam(':uname', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the user's credentials
        if ($user && password_verify($password, $user['upass'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['uname'] = $user['uname'];

            // Redirect to the previous page if available
            if (isset($_SESSION['prev_page'])) {
                $prevPage = $_SESSION['prev_page'];
                unset($_SESSION['prev_page']);
                header("Location: $prevPage");
            } else {
                header("Location: index.php"); // Redirect to a default page if there is no previous page
            }
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
} else {
    // Store the previous page URL in session before redirecting to the login page
    $_SESSION['prev_page'] = $_SERVER['HTTP_REFERER'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Infositezy</title>

    <!-- Favicons -->
    <link href="assets\img\system-logo\INFOSITEZY.png" rel="icon">
    <link href="assets\img\system-logo\INFOSITEZY.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">


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
    }
    .login-container h1 {
        text-align: center;
    }
    .login-container form {
        margin-top: 30px;
    }
    .login-container label {
        font: bold;
    }
    .login-container button[type="submit"] {
        width: 100%;
    }
    </style>

</head>

<body>

    <!--
    <div class="container-fluid">
        <div class="row">
            <div class="lform">
                <div class="loginf">
                    <h1 class="text-center">Login</h1>
                    <div class="lsubmit">
                        <form action="" method="POST">
                            <label for="username">Username:</label><br>
                            <input type="text" name="username" id="username" autocomplete="off" autofocus="on" required><br><br>
                            <label for="password">Password:</label><br>
                            <input type="password" name="password" id="password" autocomplete="off" required><br><br>
                            <input type="submit" name="login" value="Login"></input>
                        </form>
                    </div>
                    <span></span>
                </div>
            </div>
        </div>
    </div>-->

    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error)) {
            echo '<p class="text-danger">' . $error . '</p>';
        } ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="uname" id="uname" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="upass" id="upass" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-center">Don't have an account? <a href="register.php" class="btn btn-link">Register</a></p>
    </div>
</body>

</html>