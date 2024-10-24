<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login_successful = false; 
$error_message = ""; 

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $login_successful = true; 
            $_SESSION['user_id'] = $user['firstname'] . ' ' . $user['lastname'];
            $_SESSION['email'] = $email;
            $_SESSION['session_id'] = session_id();
        } else {
            $error_message = "Incorrect Username or Password!"; 
        }
    } else {
        $error_message = "Incorrect Username or Password!"; 
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Je'Cole's Bakery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/tab.png">
    <script>
        window.onload = function() {
            <?php if ($login_successful): ?>
                alert("Login successfully submitted!");
                window.location.href = "index.php"; 
            <?php elseif ($error_message): ?>
                alert("<?php echo addslashes($error_message); ?>"); 
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <section id="header">
        <a href="index.php"><img src="images/logoWhite.png" id="logo"></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="login.php">Log in</a></li>
                <li><a href="index.php">Menu</a></li>
                <li><a href="aboutus.html">About Us</a></li>
            </ul>
        </nav>
    </section>
    <section>
        <div class="container">
            <h1>Log in</h1>
            <p>New user? <a href="signup.php">Sign up</a> instead</p>

            <form id="login" method="POST" action="login.php">
                
                <label for="email"><h4>Email:</h4></label>
                <input type="email" name="email" id="email" required>
                <br><br><br>
                <label for="password"><h4>Password:</h4></label>
                <input type="password" name="password" id="password" required>
                <button type="submit" name="login" id="submit"><h3>Log in</h3></button>
            </form>
        </div>
    </section>
    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="login.php">Log in</a>
                <a href="index.html">Menu</a>
                <a href="aboutus.html">About us</a>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/">Facebook</a>
                <a href="https://x.com/?lang=en">Twitter</a>
                <a href="https://www.instagram.com/">Instagram</a>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-copyright">
                <p>© 2024, Je'Cole's Bakery Online Quiapo Manila</p>
                <p>Je'Cole's Bakery Online</p>
            </div>
        </div>
    </footer>
</body>
</html>