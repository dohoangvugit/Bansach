<?php
$host = 'localhost'; 
$dbname = 'book_store';
$username = 'root';   // Thay thế với username của bạn
$password = '';       // Thay thế với password của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password); // Đối với PostgreSQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>
