<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['items' => [], 'total_price' => 0.00]);
    exit();
}

// Assume $user_id is retrieved from the session (after user login)
$user_id = $_SESSION['user_id'];

// Retrieve items from the cart table for this user
$query = "SELECT item_name, item_price, quantity, (item_price * quantity) AS item_total FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id); // 'i' means integer
$stmt->execute();
$result = $stmt->get_result();

$items = [];
$total_price = 0.00;

while ($row = $result->fetch_assoc()) {
    // Make sure each row is an associative array with all fields
    $items[] = [
        'item_name' => $row['item_name'],
        'item_price' => $row['item_price'],
        'quantity' => $row['quantity']
    ];
    $total_price += $row['item_total'];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['items' => $items, 'total_price' => $total_price]);
?>