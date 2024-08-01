<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>

    <!-- Body -->


    <!-- Context -->
    <div id="context">
        <?php
        include_once ('connect.php');

        $user = $_SESSION['taikhoan'];
        $query = "SELECT * FROM taikhoan WHERE taikhoan = '$user'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $userData = mysqli_fetch_assoc($result);
            ?>
            <h1>Thông tin người dùng</h1>
            <p>Họ: <?php echo $userData['ho']; ?></p>
            <p>Tên: <?php echo $userData['ten']; ?></p>
            <p>Tài khoản: <?php echo $userData['taikhoan']; ?></p>
            <p>Loại: <?php echo $userData['loai'] == 0 ? 'Quản trị viên' : 'Người dùng'; ?></p>
            <p>Địa chỉ: <?php echo $userData['diachi']; ?></p>
            <p>Email: <?php echo $userData['email']; ?></p>
            <p>Số điện thoại: <?php echo $userData['sdt']; ?></p>
            <a href="capnhatnguoidung.php">Cập nhật thông tin</a>
            <?php
        } else {
            echo "Không thể lấy thông tin người dùng";
            exit();
        }


        ?>

        <?php mysqli_close($conn); ?>
    </div>

    <!-- Footer -->
    <?php
    include ("../form/footer.php");
    ?>
</body>

</html>