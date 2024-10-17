<?php
session_start();

// Check if the cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get the raw POST data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if an index was provided
if (isset($data['index'])) {
    $index = $data['index'];

    // Remove the item at the given index
    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
        echo json_encode(['message' => 'Item removed from cart']);
    } else {
        echo json_encode(['message' => 'Item not found']);
    }
} else {
    echo json_encode(['message' => 'Invalid request']);
}
?>