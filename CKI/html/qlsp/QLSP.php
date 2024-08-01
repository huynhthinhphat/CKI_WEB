<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/project/LTWEB/CKI/css/qlsp.css">
</head>
<body>

<h2>Quản Lý Truyện</h2>


<table>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Tập truyện</th>
        <th>Hình ảnh</th>
        <th>Thể loại</th>
        <th>Giá</th>
        <th>Ngày</th>
        <th>Số lượng tồn kho</th>
        <th>Số lượng đã bán</th>
        <th>Hành động</th>
    </tr>
    <?php
    include 'ketnoi.php';
    $sql = "SELECT * FROM danhsachtruyen";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["ten"] . "</td>";
            echo "<td>" . $row["taptruyen"] . "</td>";
            echo "<td><img src='" . $row["hinhanh"] . "' alt='Hình ảnh' width='50'></td>";
            echo "<td>" . $row["theloai"] . "</td>";
            echo "<td>" . $row["gia"] . "</td>";
            echo "<td>" . $row["ngay"] . "</td>";
            echo "<td>" . $row["soluongtonkho"] . "</td>";
            echo "<td>" . $row["soluongdaban"] . "</td>";
            echo "<td class='actions'>";
            echo "<a href='sua.php?id=" . $row["id"] . "'>Sửa</a>";
            echo "<form action='xoa.php' method='post' style='display:inline;'>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<input type='submit' value='Xóa'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
    }
    $conn->close();
    ?>
</table>

<h3>Thêm Truyện</h3>
<form action="them.php" method="post" enctype="multipart/form-data">
    Tên: <input type="text" name="ten"><br>
    Tập truyện: <input type="text" name="taptruyen"><br>
    Hình ảnh: <input type="file" name="hinhanh"><br>
    Thể loại: <input type="text" name="theloai"><br>
    Giá: <input type="text" name="gia"><br>
    Ngày: <input type="date" name="ngay"><br>
    Số lượng tồn kho: <input type="text" name="soluongtonkho"><br>
    Số lượng đã bán: <input type="text" name="soluongdaban"><br>
    <input type="submit" value="Thêm Truyện">
</form>

</body>
</html>
