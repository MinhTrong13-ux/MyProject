<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/* Check admin */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die('Không có quyền truy cập');
}

/* Validate order id */
if (!isset($_GET['id'])) {
    die('Thiếu mã đơn hàng');
}

$order_id = (int)$_GET['id'];

/* LẤY THÔNG TIN ĐƠN HÀNG */
$sqlOrder = "
    SELECT o.Id, o.Total_price, o.Created_at,
           u.Email
    FROM orders o
    JOIN users u ON o.user_id = u.Id
    WHERE o.Id = ?
";

$stmt = $conn->prepare($sqlOrder);
if (!$stmt) {
    die("SQL Order lỗi: " . $conn->error);
}
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    die('Đơn hàng không tồn tại');
}

/* LẤY CHI TIẾT SẢN PHẨM */
$sqlItems = "
    SELECT p.Name, od.Price, od.Quantity
    FROM order_items od
    JOIN products p ON od.Product_id = p.Id
    WHERE od.Order_id = ?
";

$stmt = $conn->prepare($sqlItems);
if (!$stmt) {
    die("SQL Items lỗi: " . $conn->error);
}
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();

/* LOAD VIEW */
require_once __DIR__ . '/../../views/admin/orders_detail.view.php';
