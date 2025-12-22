<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

$conn->begin_transaction();

try {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Tạo order
    $stmt = $conn->prepare(
        "INSERT INTO orders (user_id, total_price, status, created_at)
         VALUES (?, ?, 'pending', NOW())"
    );
    $stmt->bind_param("id", $user_id, $total);
    $stmt->execute();

    $order_id = $conn->insert_id;

    // Lưu order_items
    foreach ($cart as $item) {
        $stmt = $conn->prepare(
            "INSERT INTO order_items (order_id, product_id, quantity, price)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "iiid",
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['price']
        );
        $stmt->execute();
    }

    $conn->commit();
    unset($_SESSION['cart']);

    echo "Đặt hàng thành công";

} catch (Exception $e) {
    $conn->rollback();
    echo "Lỗi đặt hàng";
}
