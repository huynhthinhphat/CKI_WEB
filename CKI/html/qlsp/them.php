<?php
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $taptruyen = $_POST['taptruyen'];
    $theloai = $_POST['theloai'];
    $gia = $_POST['gia'];
    $ngay = $_POST['ngay'];
    $soluongtonkho = $_POST['soluongtonkho'];
    $soluongdaban = $_POST['soluongdaban'];

    $target_dir = "img/truyen/";
    $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
    move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file);

    $sql = "INSERT INTO danhsachtruyen (ten, taptruyen, hinhanh, theloai, gia, ngay, soluongtonkho, soluongdaban)
            VALUES ('$ten', '$taptruyen', '$target_file', '$theloai', '$gia', '$ngay', '$soluongtonkho', '$soluongdaban')";

    if ($conn->query($sql) === TRUE) {
        echo "Truyện được thêm thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
header("Location: index.php");
exit();
?>
