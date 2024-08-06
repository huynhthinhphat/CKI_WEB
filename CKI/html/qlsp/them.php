<?php
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $taptruyen = $_POST['taptruyen'];
    $theloai = $_POST['theloai'];
    $gia = $_POST['gia'];
    $soluongtonkho = $_POST['soluongtonkho'];
    $hinhanh = basename($_FILES["hinhanh"]["name"]);

    $currentDate = date('Y-m-d');

    $sql = "INSERT INTO danhsachtruyen (ten, taptruyen, hinhanh, theloai, gia, ngay, soluongtonkho)
            VALUES ('$ten', '$taptruyen', '/img/truyen/$hinhanh', '$theloai', '$gia', '$currentDate', '$soluongtonkho')";

    if ($conn->query($sql) === TRUE) {
        // Đường dẫn tuyệt đối trên hệ thống tệp
        $target_dir = "D:/xampp/htdocs/project/LTWEB/CKI/img/truyen/";
        $target_file = $target_dir . $hinhanh;

        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
            echo "Truyện được thêm thành công!";
        } else {
            echo "Không thể tải lên tệp";
        }
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
// header("Location: QLSP.php");
exit();
?>