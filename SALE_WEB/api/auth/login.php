<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT Id, Email, Password, Role FROM users WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user || !password_verify($password, $user['Password'])) {
    die('Sai tài khoản hoặc mật khẩu');
}

/* LƯU SESSION */
$_SESSION['user_id'] = $user['Id'];
$_SESSION['email']   = $user['Email'];
$_SESSION['role']    = $user['Role'];

/* ĐIỀU HƯỚNG THEO ROLE */
if ($user['Role'] === 'admin') {
    header('Location: /SALE_WEB/api/admin/products.php');
    exit;
}

header('Location: /SALE_WEB/index.php');
exit;
