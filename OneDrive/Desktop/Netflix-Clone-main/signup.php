<?php
// Start the session and include database connection
session_start();
include 'db.php';

// Process the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (!$check) {
        die("Database error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='signup.html';</script>";
        exit();
    } else {
        // Insert new user into database
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            die("Error: " . mysqli_error($conn));
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone - Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="background">
        <div class="overlay"></div>
    </div>

    <header>
        <div class="logo">
            <img src="https://www.freepnglogos.com/uploads/netflix-logo-drawing-png-19.png" alt="Netflix Logo">
        </div>
        <div class="signin-link">
            <a href="login.html">Sign In</a>
        </div>
    </header>

    <main>
        <div class="signup-container">
            <div class="signup-content">
                <h1>Unlimited movies, TV shows, and more</h1>
                <h2>Watch anywhere. Cancel anytime.</h2>
                <h3>Ready to watch? Enter your email to create or restart your membership.</h3>
                
                <form class="signup-form" action="signup.php" method="POST">
                    <div class="email-input-container">
                        <div class="form-group">
                            <input type="email" name="email" id="email" required>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password</label>
                        </div>
                        <button type="submit" class="get-started-button">Get Started ></button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>Questions? Call 1-800-123-4567</p>
            <div class="footer-links">
                <a href="#">FAQ</a>
                <a href="#">Help Center</a>
                <a href="#">Account</a>
                <a href="#">Media Center</a>
                <a href="#">Investor Relations</a>
                <a href="#">Jobs</a>
                <a href="#">Ways to Watch</a>
                <a href="#">Terms of Use</a>
                <a href="#">Privacy</a>
                <a href="#">Cookie Preferences</a>
                <a href="#">Corporate Information</a>
                <a href="#">Contact Us</a>
                <a href="#">Speed Test</a>
                <a href="#">Legal Notices</a>
                <a href="#">Only on Netflix</a>
            </div>
            <div class="language-selector">
                <select>
                    <option value="en">English</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                </select>
            </div>
            <p class="netflix-clone">Netflix Clone</p>
        </div>
    </footer>
</body>
</html>


