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

$product = ['product_name' => '', 'product_price' => '', 'product_total' => ''];
$isEdit = false;

// ดึงข้อมูลสินค้าเมื่อมีการแก้ไข
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id = ?");
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $isEdit = true;
}

// บันทึกสินค้า
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $product_price = $_POST['product_price'] ?? 0;
    $product_total = $_POST['product_total'] ?? 0;

    if ($isEdit) {
        $stmt = $pdo->prepare("UPDATE tbl_product SET product_name = ?, product_price = ?, product_total = ? WHERE product_id = ?");
        $stmt->execute([$product_name, $product_price, $product_total, $_GET['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO tbl_product (product_name, product_price, product_total) VALUES (?, ?, ?)");
        $stmt->execute([$product_name, $product_price, $product_total]);
    }

    // เปลี่ยนเส้นทางไปแสดงข้อมูลที่ถูกเพิ่ม
    header('Location: admin_list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'แก้ไขสินค้า' : 'เพิ่มสินค้าใหม่' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        body {
            background: linear-gradient(90deg,rgb(196, 59, 24),rgb(24, 27, 24)); 
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h1><?= $isEdit ? 'แก้ไขสินค้า' : 'เพิ่มสินค้าใหม่' ?></h1>
                <form method="post">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">ชื่อสินค้า:</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="<?= $product['product_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_price" class="form-label">ราคา:</label>
                        <input type="number" name="product_price" id="product_price" class="form-control" value="<?= $product['product_price'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_total" class="form-label">จำนวน:</label>
                        <input type="number" name="product_total" id="product_total" class="form-control" value="<?= $product['product_total'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </form>
                <br>
                <a href="index.php">กลับหน้าหลัก</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
