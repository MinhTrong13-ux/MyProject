<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/* =====================
   1. Kiểm tra đăng nhập
===================== */
if (!isset($_SESSION['user_id'])) {
    echo 'Bạn chưa đăng nhập';
    exit;
}

$user_id = $_SESSION['user_id'];

/* =====================
   2. Lấy danh sách đơn hàng
===================== */
$sql = "
    SELECT Id, Total_price, status, Created_at
    FROM orders
    WHERE user_id = ?
    ORDER BY Created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

/* =====================
   3. Đưa dữ liệu vào mảng
===================== */
$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

/* =====================
   4. Gọi UI hiển thị
===================== */
require_once __DIR__ . '/../../views/my_orders.php';

