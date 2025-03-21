<?php
session_start();
require_once 'condb.php'; // เชื่อมต่อฐานข้อมูล
require_once 'password.php';

// เช็ค email, password, และ action=login
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['action']) && $_POST['action'] == 'login') {
    $user_email = $_POST['email'];
    $user_password = $_POST['password']; 

    // ตรวจสอบว่าเป็นผู้ใช้แอดมินหรือไม่
    if ($user_email === 'admin@gmail.com') {
        // เชื่อมต่อกับฐานข้อมูล tbl_admin สำหรับแอดมิน
        $stmt = $condb->prepare("SELECT admin_user, admin_password FROM tbl_admin WHERE admin_user = :user_email");
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบรหัสผ่าน
        if ($row && $row['admin_password'] === '1234') {
            $_SESSION['admin'] = true; // ตั้งค่า session สำหรับแอดมิน
            header('Location: admin_list.php'); // เปลี่ยนเส้นทางไปหน้า admin_list
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "Login Fail !!",
                        text: "Username หรือ Password ไม่ถูกต้อง !!",
                        type: "warning"
                    }, function() {
                        window.location = "user.php";
                    });
                }, 1000);
            </script>';
        }
    } else {
        // เชื่อมต่อกับฐานข้อมูล tbl_user สำหรับผู้ใช้ทั่วไป
        $stmt = $condb->prepare("SELECT user_id, user_name, user_password FROM tbl_user WHERE user_email = :user_email");
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบรหัสผ่าน
        if ($row && verifyPassword($user_password, $row['user_password'])) {
            $_SESSION['user_name'] = $row['user_name'];
            header('Location: index.php'); // เปลี่ยนเส้นทางไปหน้า index สำหรับผู้ใช้ทั่วไป
            exit();
        } else {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "Login Fail !!",
                        text: "Username Or Password Incorrect !!",
                        type: "warning"
                    }, function() {
                        window.location = "user.php";
                    });
                }, 1000);
            </script>';
        }
    }
} // isset
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        body {
            background-image: url('assets/bkgr/gameroom.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
</head>

<body>
    <div class="d-none d-sm-block" style="margin-top: 250px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-4">

                <h3>Login</h3>

                <form method="post">

                    <div class="form-group row mb-2">
                        <input type="email" name="email" class="form-control" required placeholder="Email">
                    </div>

                    <div class="form-group row mb-2">
                        <input type="password" name="password" class="form-control" required placeholder="Password">
                    </div>

                    <div class="form-group row mb-2">
                        <button type="submit" name="action" value="login" class="btn btn-success">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
