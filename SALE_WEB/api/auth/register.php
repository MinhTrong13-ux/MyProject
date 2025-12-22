<?php
require_once __DIR__ . '/../config/db.php';
$name = $_POST['name'] ?? '';// ?? là toán tử null coalescing trong PHP
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
 if($name == ''|| $email == ''|| $password == '')
 {
    echo "Thiếu dữ liệu";
    exit;
 }
 // Check email tồn tại
 $sql = 'SELECT Id FROM Users WHERE email = ?';
$stmt = $conn->prepare($sql);//Chuẩn bị SQL
$stmt->bind_param("s", $email);//Gán giá trị vào email = ?, s là kiểu String
$stmt->execute();// Thực thi câu lệnh
$stmt->store_result();// Lưu kết quả vào bộ nhớ

if ($stmt->num_rows > 0) {
    echo "Email đã tồn tại";
    exit;
}
// Hash password
$hash = password_hash($password,PASSWORD_BCRYPT);
// Insert user
$created_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO users (name, email, password, role, created_at)
        VALUES (?, ?, ?, 'user', ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $hash, $created_at);

if ($stmt->execute()) {
    echo "Đăng ký thành công";
} else {
    echo "Lỗi đăng ký";
}
?>