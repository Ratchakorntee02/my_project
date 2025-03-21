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

// ดึงข้อมูลคูปองจากฐานข้อมูล
$stmt = $pdo->prepare("SELECT * FROM tbl_coupon");
$stmt->execute();
$coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body{ 
          background: linear-gradient(90deg,rgb(196, 59, 24),rgb(24, 27, 24)); 
          background-size: cover;
          padding: 20px;
          align-items: center;
        }
        h1{
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Coupon ส่วนลด</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ชื่อคูปอง</th>
                <th>มูลค่าส่วนลด</th>
                <th>เก็บเส๊</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coupons as $coupon): ?>
            <tr>
                <td><?= $coupon['coupon_id'] ?></td>
                <td><?= $coupon['coupon_name'] ?></td>
                <td><?= $coupon['coupon_value'] ?></td>
                <td>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="coupon_id" value="<?= $coupon['coupon_id'] ?>">
                        <button type="submit" name="save_coupon" class="btn btn-success btn-sm">เก็บ</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="add_coupon.php" class="btn btn-outline-dark mb-3">เพิ่มคูปองใหม่</a>
    <a href="index.php" class="btn btn-outline-warning mb-3">รีบกลับไปซื้อเร็ว!!</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
