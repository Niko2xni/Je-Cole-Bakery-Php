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

$user_id = $_SESSION['user_id'];

$query = "SELECT item_name, item_price, item_quantity FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $user_id); 
$stmt->execute();
$result = $stmt->get_result();

$items = [];
$total_price = 0.00;

while ($row = $result->fetch_assoc()) {
    $items[] = [
        'item_name' => $row['item_name'],
        'item_price' => (float)$row['item_price'],
        'item_quantity' => (int)$row['item_quantity'],
    ];
    $total_price += (float)$row['item_price'] * (int)$row['item_quantity']; 
    $_SESSION['total_price'] = $total_price;
}
$delivery_fee = $total_price > 250 ? 0 : 50; 
$_SESSION['total_price'] = $total_price;
$_SESSION['delivery_fee'] = $delivery_fee;
$_SESSION['overall_total'] = $total_price + $delivery_fee; 

header('Content-Type: application/json');
echo json_encode(['items' => $items, 'total_price' => $total_price]);
?>