<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assume $user_id is retrieved from the session
$user_id = $_SESSION['user_id'];

// Move cart items to an orders table
$query = "INSERT INTO orders (user_id, item_name, item_price, quantity) SELECT user_id, item_name, item_price, quantity FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Error moving items to orders: ' . $stmt->error]);
    exit();
}

// Clear the cart after checkout
$clearCartQuery = "DELETE FROM cart WHERE user_id = ?";
$clearStmt = $conn->prepare($clearCartQuery);
$clearStmt->bind_param('i', $user_id);

if (!$clearStmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Error clearing cart: ' . $clearStmt->error]);
    exit();
}

// Return success response
echo json_encode(['success' => true]);
?>