<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/* Kiểm tra quyền admin */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die('Không có quyền truy cập');
}

$admin_email = $_SESSION['email'] ?? 'admin@store.com';

/* LẤY SẢN PHẨM */
$sql = "SELECT Id, Name, Price, Image FROM products ORDER BY Id DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("Lỗi SQL: " . $conn->error);
}

/* ĐƯA DỮ LIỆU SANG VIEW */
require_once __DIR__ . '/../../views/admin/products.view.php';
