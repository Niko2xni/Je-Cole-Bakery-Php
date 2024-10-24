<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$signup_successful = false; 
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $number = mysqli_real_escape_string($conn, $_POST['contactnumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $pass = $_POST['password'];
    $confirmpass = $_POST['confirmpassword'];

    $checkNumberQuery = "SELECT * FROM users WHERE contactnumber='$number'";
    $numresult = mysqli_query($conn, $checkNumberQuery);

    if (mysqli_num_rows($numresult) > 0) {
        $error_message .= "Error: Contact number already registered. Please use a different number.";
    }

    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $passresult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($passresult) > 0) {
        $error_message .= "Error: Email already registered. Please use a different email.";
    }

    if ($pass !== $confirmpass) {
        $error_message .= "Error: Passwords do not match. Please enter matching passwords.";
    }

    if (empty($error_message)) {
        $query = "INSERT INTO users (firstname, lastname, contactnumber, email, password) VALUES ('$firstname', '$lastname', '$number', '$email', '$password')";

        if (mysqli_query($conn, $query)) {
            $user_id = mysqli_insert_id($conn);
            $_SESSION['user_id'] = $user_id;

            $signup_successful = true;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/tab.png">
    <script>
        window.onload = function() {
            <?php if ($signup_successful): ?>
                alert("Signup successful!");
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
        <h1>Sign Up</h1>
        <p>Already have an account? <a href="login.php">Log in</a> instead</p>

        <form id="signup" action="signup.php" method="POST">
            <table>
                <tr>
                    <td><label for="Fname"><h4>First Name:</h4></label></td>
                    <td><input type="text" name="firstname" id="Fname" required></td>
                </tr>
                <tr>
                    <td><label for="Lname"><h4>Last Name:</h4></label></td>
                    <td><input type="text" name="lastname" id="Lname" required></td>
                </tr>
                <tr>
                    <td><label for="number"><h4>Phone Number:</h4></label></td>
                    <td><input type="number" name="contactnumber" id="number" required></td>
                </tr>
                <tr>
                    <td><label for="email"><h4>Email Address:</h4></label></td>
                    <td><input type="email" name="email" id="email" required></td>
                </tr>
                <tr>
                    <td><label for="pass"><h4>Password:</h4></label></td>
                    <td><input type="password" name="password" id="pass" required></td>
                </tr>
                <tr>
                    <td><label for="pass2"><h4>Confirm Password:</h4></label></td>
                    <td><input type="password" name="confirmpassword" id="pass2" required></td>
                </tr>
            </table>
            
            <button type="submit" name="register" id="submit"><h3>Sign Up</h3></button>
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