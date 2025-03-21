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

// ดึงข้อมูลสินค้า
$stmt = $pdo->prepare("SELECT * FROM tbl_product");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body{
            background: linear-gradient(90deg,rgb(210, 75, 223),rgb(17, 20, 17)); 
            font-family: Arial, sans-serif;
        }
        h1{
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>รายการสินค้า</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['product_id'] ?></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_price'] ?></td>
                <td><?= $product['product_total'] ?></td>
                <td>
                    <a href="admin_product.php?id=<?= $product['product_id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    <a href="admin_delete_product.php?id=<?= $product['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')">ลบ</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="admin_product.php" class="btn btn-secondary">เพิ่มสินค้าใหม่</a>
    <a href="index.php" class="btn btn-outline-warning">กลับสู่หน้าหลัก</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
