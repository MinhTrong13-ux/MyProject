<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if (empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống";
    exit;
}

foreach ($_SESSION['cart'] as $item) {
    $stmt = $conn->prepare("SELECT name FROM products WHERE id = ?");
    $stmt->bind_param("i", $item['product_id']);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    echo $product['name'] . " - SL: " . $item['quantity'] . "<br>";
}