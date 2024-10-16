<?php
session_start();

// Check if the cart session exists, if not, create it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get the raw POST data from the request (sent via AJAX)
$data = json_decode(file_get_contents("php://input"), true);

// Check if item details (name and price) were sent
if (isset($data['name']) && isset($data['price'])) {
    $item = [
        'name' => $data['name'],
        'price' => $data['price']
    ];

    // Add the item to the cart session
    $_SESSION['cart'][] = $item;

    // Return a success message as a JSON response
    echo json_encode(['message' => 'Item added to cart']);
} else {
    echo json_encode(['message' => 'Invalid data']);
}
?>