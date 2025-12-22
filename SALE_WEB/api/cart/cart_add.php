<?php
session_start();
require_once __DIR__ . '/../config/db.php';
//
$product_id = (int)$_POST['product_id'];
// Kiểm tra sản phẩm có tồn tại không
$stmt = $conn->prepare("SELECT id, price FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
if (!$product) {
    die("Sản phẩm không tồn tại");
}

// Tạo giỏ nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu đã có → tăng số lượng
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity']++;
} else {
    $_SESSION['cart'][$product_id] = [
        'product_id' => $product_id,
        'price' => $product['price'],
        'quantity' => 1
    ];
}

echo "Đã thêm vào giỏ";