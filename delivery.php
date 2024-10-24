<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {

    $user_id = $_SESSION['user_id'];

    $order_date = date('Y-m-d H:i:s');
    $house = mysqli_real_escape_string($conn, $_POST['houseNumber']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $barangay = mysqli_real_escape_string($conn, $_POST['barangay']);
    $postal = mysqli_real_escape_string($conn, $_POST['postalCode']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    $query = "INSERT INTO receipts (user_id, order_date, housenumber, streetname, barangay, postalcode, city) VALUES ('$user_id', '$order_date', '$house', '$street', '$barangay', '$postal', '$city')";

    if (mysqli_query($conn, $query)) {
        header("Location: receipt.php");
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
    <title>Je'Cole's Bakery - Billing Information</title>
    <link rel="stylesheet" href="delivery.css">
    <link rel="icon" href="images/tab.png">
</head>
<body>
    <section id="header">
        <a href="index.php"><img src="images/logoWhite.png" id="logo"></a>
        <nav>
            <ul id="navbar">
                <li><a href="index.php">Menu</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
        </nav>
    </section>

    <section id="delivery-info">
        <div class="delivery-container">
            <h2>Billing Information</h2>
            <form id="delivery" action="delivery.php" method="POST">
                <input type="hidden" name="pay" value="1">
                <label for="house">House/Unit No.:</label>
                <input type="text" id="house" name="houseNumber" required>

                <label for="street">Street:</label>
                <input type="text" id="street" name="street" required>

                <label for="barangay">Barangay:</label>
                <input type="text" id="barangay" name="barangay" required>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>

                <label for="postalCode">Postal Code:</label>
                <input type="text" id="postalCode" pattern="\d*" name="postalCode" required>

                <label for="paymentMethod">Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" required>
                    <option value="" disabled selected>Select a payment method</option>

                    <option value="Gcash">Gcash</option>
                    <option value="PayMaya">PayMaya</option>
                    <option value="BDO">BDO</option>
                    <option value="Cash on delivery">Cash on delivery</option>
                </select>

                <div class="total-container">
                    <p id="cartTotal">TOTAL: ₱<?php echo htmlspecialchars($_SESSION['total_price']); ?></p>
                </div>

                <button type="submit" class="pay-btn" id="payNow" name="payNow">PAY NOW</button>
            </form>
        </div>
    </section>
</body>
</html>