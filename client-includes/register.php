<?php
require_once('../database/connection.php');

// Variable to store the error message
$errorMsg = '';

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate form data
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $errorMsg = 'Please fill in all the fields.';
    } elseif ($password !== $confirmPassword) {
        $errorMsg = 'Passwords do not match.';
    } else {
        // Check if the username already exists
        $checkQuery = "SELECT id FROM users WHERE uname = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $errorMsg = 'Username already exists. Please choose a different username.';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Set the role ID (2 for "attendee")
            $roleID = 2;

            // Insert the user data into the database
            $sql = "INSERT INTO users (uname, upass, urole) VALUES (?, ?, ?)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind the parameters
            $stmt->bind_param("ssi", $username, $hashedPassword, $roleID);

            // Execute the statement
            if ($stmt->execute()) {
                // Registration successful, set success flag
                $registrationSuccess = true;

                // Set the user ID in the session
                $_SESSION['id'] = $stmt->insert_id;
            } else {
                $errorMsg = 'Error: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the check statement
        $checkStmt->close();
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>User Registration Form</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-image: url("../assets/img/space.png");
            background-size: cover;
        }

        .card {
            width: 400px;
            margin: 100px auto;
        }
    </style>
</head>

<body>
<div class="card">
    <div class="card-body">
        <h2 class="card-title">User Registration</h2>

        <?php if (!empty($errorMsg)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMsg; ?>
            </div>
        <?php elseif (isset($registrationSuccess) && $registrationSuccess) : ?>
            <div class="alert alert-success" role="alert">
                Registration successful! Redirecting to the home page...
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "../index.php";
                }, 2000);
            </script>
        <?php else : ?>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        <?php endif; ?>

        <?php if (!isset($registrationSuccess) || !$registrationSuccess) : ?>
            <div class="mt-3 text-center">
                <a href="../index.php" class="btn btn-link">Back to Home Page</a>
            </div>
        <?php endif; ?>
    </div>
</div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>