<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Bạn không có quyền truy cập trang này";
    exit;
}
