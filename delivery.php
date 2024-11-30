<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

if(!isset($_SESSION['is_logged_in'])){
    $_SESSION['is_logged_in'] = false;
}

$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {

    $user_id = $_SESSION['user_id'];
    $session_id = $_SESSION['session_id'];
    $total_price = $_SESSION['total_price'];
    $delivery_fee = $total_price > 250 ? 0 : 50; 
    $_SESSION['delivery_fee'] = $delivery_fee;
    $overall_total = $total_price + $delivery_fee;
    $_SESSION['overall_total'] = $overall_total; 

    $order_date = date('Y-m-d H:i:s');
    $house = mysqli_real_escape_string($conn, $_POST['houseNumber']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $barangay = mysqli_real_escape_string($conn, $_POST['barangay']);
    $postal = mysqli_real_escape_string($conn, $_POST['postalCode']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    $email = $_SESSION['email'];
    $customer_query = "SELECT * FROM users WHERE email = '$email'";
    $customer_result = mysqli_query($conn, $customer_query);
    $customer_data = mysqli_fetch_assoc($customer_result);

    $session_id = $_SESSION['session_id'];
    $address_query = "SELECT * FROM receipts WHERE session_id = '$session_id'";
    $address_result = mysqli_query($conn, $address_query);
    $address_data = mysqli_fetch_assoc($address_result);

    $order_query = "SELECT item_name, item_price, item_quantity FROM orders WHERE session_id = '$session_id'";
    $order_result = mysqli_query($conn, $order_query);

    $query = "INSERT INTO receipts (user_id, session_id, order_date, total_price, housenumber, streetname, barangay, postalcode, city) VALUES ('$user_id', '$session_id', '$order_date', '$total_price', '$house', '$street', '$barangay', '$postal', '$city')";

    if (mysqli_query($conn, $query)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jecolesbakery@gmail.com'; // Your Gmail address
            $mail->Password = 'qmramjiqtaqmmdvp'; // Your Gmail password or App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL encryption
            $mail->Port = 465; // SSL port

            $mail->setFrom('jecolesbakery@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Order Receipt';

            $email_body = '
                <html>
                    <head>
                        <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            table, th, td {
                                border: 1px solid black;
                            }
                            th, td {
                                padding: 8px;
                                text-align: left;
                            }
                            th {
                                background-color: #f2f2f2;
                            }
                            .customer-details {
                                margin-bottom: 20px;
                            }
                            .customer-details p {
                                margin: 5px 0;
                                font-size: 14px;
                            }
                        </style>
                    </head>
                    <body>
                        <h2>Receipt for Your Order</h2>
                        <p>Thank you for shopping with us! Below are your order details:</p>

                        <div class="customer-details">
                            <h3>Customer Details:</h3>
                            <p><strong>Name:</strong> ' . htmlspecialchars($customer_data['firstname']) . ' ' . htmlspecialchars($customer_data['lastname']) . '</p>
                            <p><strong>Email:</strong> ' . htmlspecialchars($customer_data['email']) . '</p>
                            <p><strong>Phone:</strong> ' . htmlspecialchars($customer_data['contactnumber']) . '</p>
                            <p><strong>Address:</strong> ' . htmlspecialchars($house) . ' ' . htmlspecialchars($street) . ', Brgy. ' . htmlspecialchars($barangay) . ', ' . htmlspecialchars($city) . ' - ' . htmlspecialchars($postal) . '</p>
                        </div>

                        <table id="orderInfo">
                    <tr>
                        <th colspan="4"><h2>Order Details</h2></th>
                    </tr>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Item Total</th>
                    </tr>
            ';

            if (mysqli_num_rows($order_result) > 0) {
                while ($order_data = mysqli_fetch_assoc($order_result)) {
                    $item_total_price = $order_data['item_price'] * $order_data['item_quantity'];
                    $email_body .= '<tr>';
                    $email_body .= '<td>' . htmlspecialchars($order_data['item_name']) . '</td>';

                    $email_body .= '<td>' . htmlspecialchars($order_data['item_quantity']) . '</td>';

                    $email_body .= '<td>₱' . number_format($order_data['item_price'], 2) . '</td>';

                    $email_body .= '<td>₱' . number_format($item_total_price, 2) . '</td>';
                    $email_body .= '</tr>';
                }
            } else {
                $email_body .= '<tr><td colspan="4">No order details found.</td></tr>';
            }    

            $email_body .= '
                        <tr>
                            <td><h3>Total Price: </h3></td>
                            <td colspan="3">₱ ' . number_format($total_price, 2) . '</td>
                        </tr>
                        <tr>
                            <td><h3>Delivery Fee: </h3></td>
                            <td colspan="3">₱ ' . number_format($delivery_fee, 2) . '</td>
                        </tr>
                        <tr>
                            <td><h3>Overall Total: </h3></td>
                            <td colspan="3">₱ ' . number_format($overall_total, 2) . '</td>
                        </tr>
                    </table>
                </body>
            </html>
            ';

            $mail->Body = $email_body;
            $mail->AltBody = 'This is the plain text version of the email content.';

            $mail->send();
            echo "
            <script>
                alert('Order Processed Successfully!');
                document.location.href = 'delivery.php';
            </script>
                ";
        } catch (Exception $e) {
            echo "
            <script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                document.location.href = 'delivery.php';
            </script>
                ";
        }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel ="stylesheet" href="styles.css">
    <link rel="icon" href="images/tab.png">
    <style>
        #delivery-info {
            margin: auto;
            padding: 20px;
            width: 100%;
            max-width: 500px;
        }

        .delivery-container {
            background-color: #fff;
            border-radius: 15px;
            margin-top:10%;
            padding: 30px 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: rgb(46, 33, 2);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .total-container {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            color: rgb(46, 33, 2);
        }

        .pay-btn {
            background-color: rgb(121, 65, 28);
            color: #fff;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }

        .pay-btn:hover {
            background-color: rgb(150, 80, 30);
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
                    <li class="nav-item"><a class="nav-link active" href="#" id="openCart">Cart</a></li>
                    <?php if ($_SESSION['is_logged_in']): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Log out</a></li>
                        <li class="nav-item"><a class="nav-link" href="user-info.php">Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?></a></li>  
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Log in</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <section id="delivery-info">
        <div class="delivery-container">
            <h2>Billing Information</h2>
            <form id="delivery" action="delivery.php" method="POST">
                <input type="hidden" name="pay" value="1">
                <label for="house">House/Unit No.:</label>
                <input type="number" id="house" name="houseNumber" required>

                <label for="street">Street:</label>
                <input type="text" id="street" name="street" required>

                <label for="barangay">Barangay:</label>
                <input type="text" id="barangay" name="barangay" required>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>

                <label for="postalCode">Postal Code:</label>
                <input type="text" id="postalCode" name="postalCode" pattern="\d{4}" maxlength="4" required>
                <span class="error-message" style="color:red; display:none;">Please enter the required format.</span>         

                <label for="paymentMethod">Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" required>
                    <option value="" disabled selected>Select a payment method</option>
                    <option value="Cash on delivery">Cash on delivery</option>
                </select>

                <div class="total-container">
                <p id="cartTotal">Total: ₱ <?php echo isset($_SESSION['total_price']) ? number_format($_SESSION['total_price'], 2) : '0.00'; ?></p>
                <p id="deliveryFee">Delivery Fee: ₱ <?php echo isset($_SESSION['delivery_fee']) && $_SESSION['delivery_fee'] == 0 ? 'Free' : '50.00'; ?></p>
                <p id="overallTotal">OVERALL TOTAL: ₱ <?php echo isset($_SESSION['overall_total']) ? number_format($_SESSION['overall_total'], 2) : '0.00'; ?></p>
                </div>

                <button type="submit" class="pay-btn" id="payNow" name="payNow">PAY NOW</button>
            </form>
        </div>
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
    <script> document.getElementById('postalCode').addEventListener('input', function (e) { 
        const input = e.target.value; 
        const errorMessage = document.querySelector('.error-message'); 

        const regex = /^\d{4}$/; 
        if (!regex.test(input)) { 
            errorMessage.style.display = 'block'; 
            } else { 
                errorMessage.style.display = 'none'; 
                } }); 
    </script>
    
</body>
</html>