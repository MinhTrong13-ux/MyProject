<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/* =====================
   1. Kiểm tra đăng nhập
===================== */
if (!isset($_SESSION['user_id'])) {
    echo 'Bạn chưa đăng nhập!';
    exit;
}

$user_id  = $_SESSION['user_id'];

/* =====================
   2. Kiểm tra order_id
===================== */
if (!isset($_GET['id'])) {
    echo 'Thiếu mã đơn hàng';
    exit;
}

$order_id = (int) $_GET['id'];

/* =====================
   3. Kiểm tra đơn hàng
===================== */
$sql = "SELECT Id, Total_price, status, Created_at
        FROM orders
        WHERE Id = ? AND user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    echo "Đơn hàng không tồn tại hoặc không thuộc về bạn";
    exit;
}

/* =====================
   4. Lấy sản phẩm trong đơn
===================== */
$sql = "SELECT 
            p.name,
            oi.quantity,
            oi.price
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();

/* =====================
   5. Tính tổng số lượng
===================== */
$total_items = 0;
$items_array = [];

while ($row = $items->fetch_assoc()) {
    $total_items += $row['quantity'];
    $items_array[] = $row;
}

/* =====================
   6. Gọi UI hiển thị
===================== */
require_once __DIR__ . '/../../views/order_detail.php';
