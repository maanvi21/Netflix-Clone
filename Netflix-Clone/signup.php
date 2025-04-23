<?php
session_start();
include 'db.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $email = mysqli_real_escape_string($conn, $email);

        $check_query = "SELECT * FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Email already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $insert_query = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ss", $email, $hashed_password);

            if ($stmt->execute()) {
                // Redirect to home after signup success
                header("Location: http://localhost/Netflix%20Clone/Netflix-Clone/home.html");
                exit;
            } else {
                $error_message = "Error creating account. Please try again.";
            }
            $stmt->close();
        }
        $check_stmt->close();
    } else {
        $error_message = "All fields are required.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Netflix Clone - Sign Up</title>
    <link rel="stylesheet" href="signup.css" />
</head>

<body>
    <div class="background">
        <div class="overlay"></div>
    </div>

    <header>
        <div class="logo">
            <img src="https://www.freepnglogos.com/uploads/netflix-logo-drawing-png-19.png" alt="Netflix Logo" />
        </div>
    </header>
    <main>
        <div class="signup-container">
            <div class="signup-content">
                <h1>Sign Up</h1>

                <?php if (!empty($error_message)): ?>
                    <p style="color: red; font-weight: bold;"><?= $error_message ?></p>
                <?php endif; ?>

                <?php if (!empty($success_message)): ?>
                    <p style="color: green; font-weight: bold;"><?= $success_message ?></p>
                <?php endif; ?>

                <form class="signup-form" action="signup.php" method="POST">
                    <div class="email-input-container">
                        <div class="form-group">
                            <input type="email" name="email" id="email" required placeholder=" " />
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="email-input-container">
                        <div class="form-group">
                            <input type="password" name="password" id="password" required placeholder=" " />
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <div class="email-input-container">
                        <button type="submit" class="get-started-button">Sign Up</button>
                    </div>
                </form>

                <div class="signup-now">
                    <p>Already have an account? <a href="login.php">Sign in now</a>.</p>
                </div>
            </div>
        </div>
    </main>


    <footer>
        <div class="footer-content">
            <p>Questions? Call 1-800-123-4567</p>
            <div class="footer-links">
                <a href="#">FAQ</a>
                <a href="#">Help Center</a>
                <a href="#">Terms of Use</a>
                <a href="#">Privacy</a>
                <a href="#">Cookie Preferences</a>
                <a href="#">Corporate Information</a>
            </div>
        </div>
    </footer>
</body>

</html>