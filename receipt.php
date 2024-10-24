<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$customer_query = "SELECT * FROM users WHERE email = '$email'";
$customer_result = mysqli_query($conn, $customer_query);
$customer_data = mysqli_fetch_assoc($customer_result);

$session_id = $_SESSION['session_id'];
$address_query = "SELECT * FROM receipts WHERE session_id = '$session_id'";
$address_result = mysqli_query($conn, $address_query);
$address_data = mysqli_fetch_assoc($address_result);

/* Fetch order details
$order_query = "SELECT item_name, price FROM orders WHERE order_id = '$order_id'";
$order_result = mysqli_query($conn, $order_query);
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Je'Cole's Bakery - Receipt</title>
    <link rel ="Stylesheet" href="receipt.css">
    <link rel="icon" href="images/tab.png">
</head>
<body>
    <section>
        <a href="menu.html"><img src="images/logo.png" id="logo"></a>
        <h1>Online Receipt</h1>
        <table id="customerInfo">
            <tr>
                <th colspan="2"><h2>Customer Details</h2></th>
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
            <tr>
                <td><b>House Number</b></td>
                <td><?php echo htmlspecialchars($address_data['housenumber']); ?></td>
            </tr>
            <tr>
                <td><b>Street Name:</b></td>
                <td><?php echo htmlspecialchars($address_data['streetname']); ?></td>
            </tr>
            <tr>
                <td><b>Barangay:</b></td>
                <td><?php echo htmlspecialchars($address_data['barangay']); ?></td>
            </tr>
            <tr>
                <td><b>Postal code:</b></td>
                <td><?php echo htmlspecialchars($address_data['postalcode']); ?></td>
            </tr>
            <tr>
                <td><b>City:</b></td>
                <td><?php echo htmlspecialchars($address_data['city']); ?></td>
            </tr>
        </table>
<br>
        <table id="orderInfo">
            <tr>
                <th colspan="2"><h2>Order Details</h2></th>
            </tr>
            <tr>
                <th>Item</th>
                <th>Price</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><h3>Total Price: </h3></td>
                <td><?php echo htmlspecialchars($address_data['total_price']); ?></td>
            </tr>
        </table>
    </section>
    
    <script src="scripts/receipt.js"></script>
</body>
</html>