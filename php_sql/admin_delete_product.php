<?php
session_start();

require 'condb.php';

// ตรวจสอบการล็อคอิน
if (!isset($_SESSION['admin'])) {
    header('Location: user.php');
    exit();
}

// เชื่อมต่อฐานข้อมูล
try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_project', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// ลบสินค้า
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM tbl_product WHERE product_id = ?");
    $stmt->execute([$_GET['id']]);

    // หลังจากลบเสร็จแล้วกลับไปที่หน้า admin_list.php
    header('Location: admin_list.php');
    exit();
}
?>
