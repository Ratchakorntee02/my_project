<?php

require_once 'condb.php';
require_once 'password.php';

if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = hashPassword($_POST['user_password']);  // แฮชรหัสผ่าน

    if ($condb) {
        // ตรวจสอบว่าอีเมลถูกใช้แล้วหรือไม่
        $stmt = $condb->prepare("SELECT user_email FROM tbl_user WHERE user_email=:user_email");
        $stmt->bindParam(':user_email', $user_email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<script>alert("Email นี้เคยถูกสมัครแล้ว.");</script>';
        } else {
            // ถ้าอีเมลไม่ซ้ำ ทำการลงทะเบียน
            $stmt = $condb->prepare("INSERT INTO tbl_user (user_email, user_name, user_password) 
                VALUES (:user_email, :user_name, :user_password)");

            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_password', $user_password);

            if ($stmt->execute()) {
                echo '<script>alert("ลงทะเบียนสำเร็จ!"); window.location="user.php";</script>';
            } else {
                echo '<script>alert("ลงทะเบียนไม่สำเร็จ!");</script>';
            }
        }
    } else {
        echo "Database connection failed!";
    }
}
?>

<!-- HTML Form -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register to Games Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-image: url('assets/bkgr/gameroom.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            height: 100vh;
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-box {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-box">
            <h3>Register</h3>
            <form method="post">
                <div class="form-group row mb-2">
                    <input type="text" name="user_name" class="form-control" required placeholder="Name">
                </div>
                <div class="form-group row mb-2">
                    <input type="email" name="user_email" class="form-control" required placeholder="Email">
                </div>
                <div class="form-group row mb-2">
                    <input type="password" name="user_password" class="form-control" required placeholder="Password">
                </div>
                <div class="form-group row mb-2">
                    <button type="submit" name="action" value="register" class="btn btn-success w-100">Register</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
