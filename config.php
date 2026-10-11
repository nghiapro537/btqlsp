<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'product_db';

try {
    // Kết nối trực tiếp đến database product_db đã tạo bằng SQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
}
