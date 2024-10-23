<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the raw POST data from the request (sent via AJAX)
$data = json_decode(file_get_contents("php://input"), true);

// Check if item details (name and price) were sent
if (isset($data['name']) && isset($data['price'])) {
    // Assume $user_id is retrieved from the session (after user login)
    $user_id = $_SESSION['user_id']; 
    $item_name = $data['name'];
    $item_price = $data['price'];

    // Insert the item into the cart table
    $query = "INSERT INTO cart (user_id, item_name, item_price, quantity) VALUES (?, ?, ?, 1)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isd', $user_id, $item_name, $item_price); // 'isd' - integer, string, decimal

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Item added to cart']);
    } else {
        echo json_encode(['message' => 'Error adding item to cart: ' . $stmt->error]);
    }
} else {
    echo json_encode(['message' => 'Item data missing']);
}
?>