<?php
session_start();

if(!isset($_SESSION['is_logged_in'])){
    $_SESSION['is_logged_in'] = false;
}

$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$customer_query = "SELECT * FROM users WHERE email = '$email'";
$customer_result = mysqli_query($conn, $customer_query);
$customer_data = mysqli_fetch_assoc($customer_result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Je'Cole's Bakery - User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel ="stylesheet" href="styles.css">
    <link rel="icon" href="images/tab.png">
    <style>

    h1, h2 {
        text-align: center;
        font-size: 30px;
        color: #333;
        font-family: Arial, sans-serif;
    }

    section, table {
        cursor: default;
    }

    table#customerInfo {
        background-color: #D2B48C; 
        width: 60%; 
        margin: 20px auto;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: #F5DEB3; 
    }

    
    table#customerInfo th {
        background-color: #F5DEB3; 
        color: white;
        padding: 15px;
        font-size: 22px;
        font-weight: bold;
    }

    table#customerInfo td {
        padding: 15px;
        font-size: 18px;
        color: #8B4513; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-bottom: 1px solid #dee2e6;
    }

    table#customerInfo tr:nth-child(even) {
        background-color: #FFF8DC;
    }

    table#customerInfo td:first-child {
        width: 40%; 
        font-weight: bold;
    }

    table#customerInfo th, table#customerInfo td {
        text-align: left;
    }
</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="images/logoWhite.png" alt="Je'Cole's Bakery"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                    <?php if ($_SESSION['is_logged_in']): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
                        <li class="nav-item"><a class="nav-link" href="user-info.php">Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?></li>  
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Log in</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <br>
        
        <table id="customerInfo">
            <tr>
                <th colspan="2"><h1>User Details</h1></th>
            </tr>
            <tr>
                <td><b>First Name:</b></td>
                <td><?php echo htmlspecialchars($customer_data['firstname']); ?></td>
            </tr>
            <tr>
                <td><b>Last Name:</b></td>
                <td><?php echo htmlspecialchars($customer_data['lastname']); ?></td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td><?php echo htmlspecialchars($customer_data['email']); ?></td>
            </tr>
            <tr>
                <td><b>Contact Number:</b></td>
                <td><?php echo htmlspecialchars($customer_data['contactnumber']); ?></td>
            </tr>
            
        </table>
    </section>

    <footer class="py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Home</a></li>
                        <li><a href="menu.php" class="text-white">Menu</a></li>
                        <li><a href="aboutus.php" class="text-white">About us</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="https://www.facebook.com/" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>

                <div class="col-md-4">
                    <p>© 2024, Je'Cole's Bakery Online Quiapo Manila</p>
                    <p>Je'Cole's Bakery Online</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>