<?php
require_once '../middleware/admin.php';
require_once '../config/db.php';

$name  = $_POST['name'];
$price = $_POST['price'];
$desc  = $_POST['description'];

// Kiểm tra có file không
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
    die("Vui lòng chọn ảnh sản phẩm");
}

// Tạo tên file không trùng
$imageName = time() . '_' . basename($_FILES['image']['name']);
$uploadDir = '../../uploads/products/';
$target    = $uploadDir . $imageName;

// Upload
if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    die("Upload ảnh thất bại");
}

// Lưu DB
$sql = "INSERT INTO products (name, price, description, image)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdss", $name, $price, $desc, $imageName);
$stmt->execute();

echo "Thêm sản phẩm thành công";
