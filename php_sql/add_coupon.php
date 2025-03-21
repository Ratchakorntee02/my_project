<?php
session_start();

// ตรวจสอบการล็อคอิน
if (!isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit();
}

// เชื่อมต่อฐานข้อมูล
try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_project', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// ตรวจสอบการเพิ่มคูปอง
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coupon_name = $_POST['coupon_name'] ?? '';
    $coupon_value = $_POST['coupon_value'] ?? '';

    // เพิ่มข้อมูลคูปองลงในฐานข้อมูล
    $stmt = $pdo->prepare("INSERT INTO tbl_coupon (coupon_name, coupon_value) VALUES (?, ?)");
    $stmt->execute([$coupon_name, $coupon_value]);

    // เปลี่ยนเส้นทางไปยังหน้า coupon.php หลังจากเพิ่มคูปอง
    header('Location: coupon.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มคูปอง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body{ 
            background: linear-gradient(90deg,rgb(219, 209, 207),rgb(37, 131, 185)); 
            background-size: cover;
            padding: 20px;
            align-items: center;
        }
        h1{
            color: white;
        }
        label{
            color:rgb(3, 38, 240);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>เพิ่มคูปอง</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="coupon_name" class="form-label">ชื่อคูปอง</label>
            <input type="text" class="form-control" id="coupon_name" name="coupon_name" required>
        </div>
        <div class="mb-3">
            <label for="coupon_value" class="form-label">มูลค่าส่วนลด</label>
            <input type="text" class="form-control" id="coupon_value" name="coupon_value" required>
        </div>
        <button type="submit" class="btn btn-outline-primary">เพิ่มคูปอง</button>
    </form>
    <br>
    <a href="coupon.php" class="btn btn-outline-dark">กลับไปที่รายการคูปอง</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>