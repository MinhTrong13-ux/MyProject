<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/* Check quyền admin */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die('Không có quyền truy cập');
}

$admin_email = $_SESSION['email'] ?? 'admin@store.com';

/* LẤY DANH SÁCH ĐƠN HÀNG */
$sql = "
    SELECT 
        o.Id,
        o.Created_at,
        o.Total_price,
        o.Status,
        u.Email
    FROM orders o
    JOIN users u ON o.user_id = u.Id
    ORDER BY o.Created_at DESC
";

$result = $conn->query($sql);
if (!$result) {
    die('Lỗi SQL: ' . $conn->error);
}

/* LOAD VIEW */
require_once __DIR__ . '/../../views/admin/orders.view.php';
