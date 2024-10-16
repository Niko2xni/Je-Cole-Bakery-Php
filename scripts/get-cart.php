<?php
session_start();

// Check if the cart exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Return the cart items as JSON
echo json_encode($_SESSION['cart']);
?>