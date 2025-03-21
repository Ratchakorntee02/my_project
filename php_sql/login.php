<?php
session_start();

require_once 'condb.php';

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

if(isset($_POST['email'])&& isset($_POST['password']) && isset($_POST['action']) && $_POST['action'] == 'login'){

    // ประกาศตัวแปรรับค่าจากฟอร์ม
    $user_email = $_POST['email'];
    $user_password = hash('sha512', $_POST['password']); // sha512 128 str

    // เช็ค username & password ตรงกับตารางหรือไม่
    // single row query แสดงแค่ 1 รายการ   
    $stmtHWadminDetail = $condb->prepare("SELECT user_email, user_name, user_phone FROM tbl_user WHERE user_email=:user_email AND user_password=:user_password");
    // bindParam
    $stmtHWadminDetail->bindParam(':user_email', $user_email, PDO::PARAM_STR);
    $stmtHWadminDetail->execute();
    

   // 0 คือ username or password ไม่ถูกต้อง, 1 = username or password ถูกต้อง
   // echo $stmtHWadminDetail->rowCount();

   // สร้างเงื่อนไข ถ้า username & password correct กระโดดไฟโฟลเดอร์ admin
   // ถ้าไม่ใช่ sweet alert warning แจ้งเตือน
   if($stmtHWadminDetail->rowCount() !=1){
       // echo 'Username & Password ไม่ถูกต้อง';
       echo '<script>
           setTimeout(function() {
               swal({
               title: "Login Fail !!",
               text: "Username Or Password Incorrect !!",
               type: "warning"
               }, function() {
                   window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
               });
           }, 1000);
       </script>';
   }else{ // true
       // echo 'Username & Password ถูกต้อง';
       $row = $stmtHWadminDetail->fetch(PDO::FETCH_ASSOC);
       // ประกาศตัวแปร session
       $_SESSION['user_email'] = $row['user_email'];
       $_SESSION['user_name'] = $row['user_name'];
       $_SESSION['user_phone'] = $row['user_phone'];
   }
}// isset

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