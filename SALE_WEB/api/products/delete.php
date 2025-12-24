<?php
require_once '../middleware/admin.php';
require_once '../config/db.php';

$id = (int)$_GET['id'];

// Lấy ảnh cũ
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

// Xóa ảnh
if ($product) {
    unlink('../../uploads/products/' . $product['image']);
}

// Xóa DB
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo "Đã xóa sản phẩm";
