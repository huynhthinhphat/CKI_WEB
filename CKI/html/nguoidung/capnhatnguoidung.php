<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin người dùng</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">

    <style>
        form p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include("../form/header.php"); ?>

    <!-- Body -->
    <!-- Menu left -->
    <!-- <?php include("../form/menuLeft.php"); ?> -->

    <!-- Context -->
    <div id="context">
        <?php
        include_once('connect.php');

        $user = $_SESSION['taikhoan'];
        $query = "SELECT * FROM taikhoan WHERE taikhoan = '$user'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $userData = mysqli_fetch_assoc($result);
        } else {
            echo "Không thể lấy thông tin người dùng";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho = $_POST['ho'];
            $ten = $_POST['ten'];
            // $taikhoan = $_POST['taikhoan'];
            $diachi = $_POST['diachi'];
            $email = $_POST['email'];
            $sdt = $_POST['sdt'];

            // Cập nhật thông tin người dùng
            $updateQuery = "UPDATE taikhoan SET ho = ?, ten = ?, diachi = ?, email = ?, sdt = ? WHERE taikhoan = ?";
            $stmt = $conn->prepare($updateQuery);
            
            // Bind parameters: 'ssssss' means 6 strings (s) are expected
            $stmt->bind_param("ssssss", $ho, $ten, $diachi, $email, $sdt, $_SESSION['taikhoan']);
            
            // Execute the statement
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Cập nhật thành công!";
            } else {
                echo "Cập nhật không thành công!";
            }

            $stmt->close();
            exit();
        }

        mysqli_close($conn);
        ?>
        <h1>Cập nhật thông tin người dùng</h1>
        <form onsubmit="event.preventDefault(); updateUser();">
            <p>Họ: <input type="text" id="ho" name="ho" value="<?php echo htmlspecialchars($userData['ho']); ?>"></p>
            <p>Tên: <input type="text" id="ten" name="ten" value="<?php echo htmlspecialchars($userData['ten']); ?>"></p>
            <p>Tài khoản: <input type="text" id="taikhoan" name="taikhoan" disabled value="<?php echo htmlspecialchars($userData['taikhoan']); ?>"></p>
            <p>Địa chỉ: <input type="text" id="diachi" name="diachi" value="<?php echo htmlspecialchars($userData['diachi']); ?>"></p>
            <p>Email: <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>"></p>
            <p>Số điện thoại: <input type="text" id="sdt" name="sdt" value="<?php echo htmlspecialchars($userData['sdt']); ?>"></p>
            <button type="submit">Cập nhật</button>
        </form> 
        <a href="nguoidung.php">Quay lại</a>
    </div>

    <!-- Footer -->
    <?php include("../form/footer.php"); ?>
</body>
<script>
            function updateUser() {
                var ho = document.getElementById('ho').value;
                var ten = document.getElementById('ten').value;
                // var taikhoan = document.getElementById('taikhoan').value;
                var diachi = document.getElementById('diachi').value;
                var email = document.getElementById('email').value;
                var sdt = document.getElementById('sdt').value;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "capnhatnguoidung.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                    //   var res = xhr.responseText;
        
                    alert("Cập nhật thành công");   
                }
                };
                xhr.send("ho=" + ho + "&ten=" + ten + "&diachi=" + diachi + "&email=" + email + "&sdt=" + sdt);
            }
        </script>

</html>
