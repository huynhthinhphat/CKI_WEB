<!DOCTYPE html>
<html>
<head>
    <title>Sửa Truyện</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 20px;
    }
    h2 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
    }
    .actions {
        display: flex;
        gap: 10px;
    }
    form {
        margin: 20px 0;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    form input[type="text"],
    form input[type="date"],
    form input[type="file"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }
    form input[type="submit"]:hover {
        background-color: #45a049;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-group input[type="file"] {
        padding: 3px;
    }
</style>
</head>
<body>

<h2>Sửa Truyện</h2>

<?php
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM danhsachtruyen WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        ?>

        <form action="sua.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Tên: <input type="text" name="ten" value="<?php echo $row['ten']; ?>"><br>
            Tập truyện: <input type="text" name="taptruyen" value="<?php echo $row['taptruyen']; ?>"><br>
            Hình ảnh: <input type="file" name="hinhanh"><br>
            Thể loại: <input type="text" name="theloai" value="<?php echo $row['theloai']; ?>"><br>
            Giá: <input type="text" name="gia" value="<?php echo $row['gia']; ?>"><br>
            Ngày: <input type="date" name="ngay" value="<?php echo $row['ngay']; ?>"><br>
            Số lượng tồn kho: <input type="text" name="soluongtonkho" value="<?php echo $row['soluongtonkho']; ?>"><br>
            Số lượng đã bán: <input type="text" name="soluongdaban" value="<?php echo $row['soluongdaban']; ?>"><br>
            <input type="submit" name="sua" value="Sửa Truyện">
        </form>

        <?php
    } else {
        echo "Không tìm thấy truyện.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sua'])) {
    $id = $_POST['id'];
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

    $sql = "UPDATE danhsachtruyen
            SET ten='$ten', taptruyen='$taptruyen', hinhanh='$target_file', theloai='$theloai', gia='$gia', ngay='$ngay', soluongtonkho='$soluongtonkho', soluongdaban='$soluongdaban'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Truyện được cập nhật thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}
?>

</body>
</html>