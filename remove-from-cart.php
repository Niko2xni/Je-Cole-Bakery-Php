<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_registration");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the raw POST data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Check if an index was provided
if (isset($data['index'])) {
    $user_id = $_SESSION['user_id'];
    $index = $data['index'];

    // First, retrieve the item from the cart to get its ID or other details
    $query = "SELECT id FROM cart WHERE user_id = ? LIMIT 1 OFFSET ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $user_id, $index);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $item_id = $row['id'];

        // Now, delete the item from the cart
        $deleteQuery = "DELETE FROM cart WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param('i', $item_id);

        if ($deleteStmt->execute()) {
            echo json_encode(['message' => 'Item removed from cart']);
        } else {
            echo json_encode(['message' => 'Error removing item from cart: ' . $deleteStmt->error]);
        }
    } else {
        echo json_encode(['message' => 'Item not found in cart']);
    }
} else {
    echo json_encode(['message' => 'Index data missing']);
}
?>