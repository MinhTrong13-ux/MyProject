<?php
$host = 'localhost';
$db = 'sale_website';
$user = 'root';
$pass = '140105';
//
$conn = new mysqli($host,$user,$pass,$db);
if($conn -> connect_error)
    die("DATABASE ERROR");
?>