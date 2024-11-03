<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'User  not logged in']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name']) && isset($data['price']) && isset($data['quantity'])) {

    $user_id = $_SESSION['user_id']; 
    $item_name = $data['name'];
    $item_price = $data['price'];
    $item_quantity = $data['quantity'];

    // Check if the item is already in the cart
    $query = "SELECT id FROM cart WHERE user_id = ? AND item_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $user_id, $item_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the quantity if the item already exists in the cart
        $row = $result->fetch_assoc();
        $item_id = $row['id'];

        $updateQuery = "UPDATE cart SET item_price = ?, quantity = quantity + ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('dii', $item_price, $item_quantity, $item_id);
        $updateStmt->execute();
    } else {
        // Insert new item into the cart
        $query = "INSERT INTO cart (user_id, item_name, item_price, item_quantity) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssdi', $user_id, $item_name, $item_price, $item_quantity); // 'ssdi' - string, string, double, integer

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Item added to cart']);
        } else {
            echo json_encode(['message' => 'Error adding item to cart: ' . $stmt->error]);
        }
    }

} else {
    echo json_encode(['message' => 'Item data missing']);
}
?>