<?php
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (firstname, lastname, number, email, password) VALUES ('$firstname', '$lastname', '$number', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.html");
        exit();

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
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
</head>
<body>
<section id="header">
        <a href="index.html"><img src="images/logoWhite.png" id="logo"></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="index.html">Log in</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="aboutus.html">About Us</a></li>
            </ul>
        </nav>
    </section>
    <section>
    <div class="container">
        <h1>Sign Up</h1>
        <p>Already have an account? <a href="index.html">Log in</a> instead</p>

        <form id="signup" action="signup.php" method="POST">
            <input type="hidden" name="register" value="1">
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
                    <td><input type="number" name="number" id="number" required></td>
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
                    <td><input type="password" id="pass2" required></td>
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