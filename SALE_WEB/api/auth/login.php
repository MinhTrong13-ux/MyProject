<?php
require_once __DIR__ . '/../config/db.php';
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT id, name, password, role FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Sai email hoặc mật khẩu";
    exit;
}

$user = $result->fetch_assoc();//Lấy 1 dòng dữ liệu từ kết quả truy vấn MySQL

if (!password_verify($password, $user['password'])) {
    echo "Sai email hoặc mật khẩu";
    exit;
}

// Lưu session
$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

echo "Đăng nhập thành công";
?>