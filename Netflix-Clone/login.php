<?php
session_start();
include 'db.php';

$error_message = "";
$debug_output = ""; // For debugging

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $email = mysqli_real_escape_string($conn, $email);

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            // Debug info
            $debug_output .= "User found with email: " . $email . "<br>";
            $debug_output .= "Stored password: " . $user["password"] . "<br>";
            $debug_output .= "Entered password: " . $password . "<br>";
            
            // Check if password is a bcrypt hash (starts with $2y$)
            if (strpos($user["password"], '$2y$') === 0) {
                // Password is hashed, use password_verify
                $debug_output .= "Using password_verify()<br>";
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user_email"] = $user["email"];
                    $_SESSION["logged_in"] = true;
                    header("Location: http://localhost/Netflix%20Clone/Netflix-Clone/home.html");
                    exit;
                } else {
                    $error_message = "Invalid email or password (hash comparison).";
                }
            } else {
                // Password is plain text, use direct comparison
                $debug_output .= "Using direct comparison<br>";
                if ($password === $user["password"]) {
                    $_SESSION["user_email"] = $user["email"];
                    $_SESSION["logged_in"] = true;
                    header("Location: http://localhost/Netflix%20Clone/Netflix-Clone/home.html");
                    exit;
                } else {
                    $error_message = "Invalid email or password (direct comparison).";
                }
            }
        } else {
            $error_message = "Invalid email or password (no user found).";
        }
    } else {
        $error_message = "Please fill out all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Rest of your HTML remains the same -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Netflix Clone - Login</title>
    <link rel="stylesheet" href="login.css" />
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
        <div class="login-container">
            <h1>Sign In</h1>

            <?php if (!empty($error_message)): ?>
                <p style="color: red; font-weight: bold;"><?= $error_message ?></p>
            <?php endif; ?>
            
            <?php if (!empty($debug_output)): ?>
                <div style="background: #ffffcc; padding: 10px; margin: 10px 0; border: 1px solid #ffcc00;">
                    <h3>Debug Info:</h3>
                    <?= $debug_output ?>
                </div>
            <?php endif; ?>

            <form class="login-form" action="login.php" method="POST">
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder=" " required>
                    <label for="email">Email or phone number</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder=" " required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="signin-button">Sign In</button>
                <div class="form-footer">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="help-link">Need help?</a>
                </div>
            </form>

            <div class="signup-now">
                <p>New to Netflix? <a href="signup.php">Sign up now</a>.</p>
            </div>

            <div class="recaptcha-info">
                <p>This page is protected by Google reCAPTCHA to ensure you're not a bot. <a href="#">Learn more.</a></p>
            </div>
        </div>
    </main>

    <footer>
        <!-- Footer content remains the same -->
    </footer>
</body>
</html>