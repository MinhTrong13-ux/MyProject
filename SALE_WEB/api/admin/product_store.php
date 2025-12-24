<?php
session_start();
require_once __DIR__ . '/../config/db.php';


/* 1. Check quyền admin */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Bạn không có quyền');
}

/* 2. Nhận dữ liệu từ form (đÚNG TÊN) */
$name        = $_POST['name'] ?? '';
$price       = $_POST['price'] ?? 0;
$description = $_POST['description'] ?? '';
$stock       = $_POST['stock'] ?? 0;

/* Validate tối thiểu */
if ($name === '' || $price <= 0) {
    die('Dữ liệu không hợp lệ');
}

/* 3. Xử lý upload ảnh */
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
    die('Chưa chọn ảnh sản phẩm');
}

$imgName = time() . '_' . basename($_FILES['image']['name']);
$imgDir  = __DIR__ . '/../../uploads/';
$imgPath = $imgDir . $imgName;

/* tạo thư mục nếu chưa tồn tại */
if (!is_dir($imgDir)) {
    mkdir($imgDir, 0777, true);
}

move_uploaded_file($_FILES['image']['tmp_name'], $imgPath);

/* 4. Insert DB (ĐÚNG TÊN CỘT) */
$sql = "INSERT INTO products (Name, Price, Image, Description, Stock, Created_at)
        VALUES (?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Lỗi SQL: ' . $conn->error);
}

$stmt->bind_param(
    "sdssi",
    $name,
    $price,
    $imgName,
    $description,
    $stock
);

$stmt->execute();

/* 5. Redirect */
header('Location: ../../views/admin/add_product.php');
exit;
