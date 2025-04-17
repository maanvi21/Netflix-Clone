<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone - Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="background">
        <div class="overlay"></div>
    </div>

    <header>
        <div class="logo">
            <img src="https://www.freepnglogos.com/uploads/netflix-logo-drawing-png-19.png" alt="Netflix Logo">
        </div>
    </header>

    <main>
        <div class="login-container">
            <h1>Sign In</h1>
            <form class="login-form" action="login.php" method="POST">
                <div class="form-group">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email or phone number</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" required>
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
                <p>New to Netflix? <a href="signup.html">Sign up now</a>.</p>
            </div>

            <div class="recaptcha-info">
                <p>This page is protected by Google reCAPTCHA to ensure you're not a bot. <a href="#">Learn more.</a>
                </p>
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
            <div class="language-selector">
                <select>
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                </select>
            </div>
        </div>
    </footer>
</body>

</html>

<!-- login.php -->
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION["user"] = $user["email"];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Invalid email or password!'); window.location.href='login.html';</script>";
    }
}
?>