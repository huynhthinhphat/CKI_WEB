<?php
session_start();
include 'ketnoi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            /* border: 2px solid #000000; */
            /* Khung màu cho phần Quản lý Truyện */
        }

        h2 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #000000;
            /* Khung màu dưới tiêu đề */
            padding-bottom: 10px;
        }

        #add-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            background-color: #000000;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #add-button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: rgb(215, 215, 215);
        }

        td img {
            width: 50px;
            height: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 1%;
            padding-left: 25%;
        }

        .modal-content {
            background-color: #fff;
            /* margin: 5% auto; */
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="file"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #218838;
        }

        .action-buttons a,
        .action-buttons form {
            display: inline-block;
        }

        .action-buttons a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons input[type="submit"] {
            background-color: #000000;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .action-buttons input[type="submit"]:hover {
            background-color: #c82333;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">

    <script>
        function showModal() {
            document.getElementById('myModal').style.display = "block";
        }
        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }
    </script>
</head>

<body>

    <!-- Header -->
    <?php
    include ("../form/header.php");
    ?>

    <div class="container">
        <h2>Quản lý Truyện</h2>

        <!-- Nút thêm để hiển thị form -->
        <button id="add-button" onclick="showModal()">Thêm</button>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form id="addForm" action="them.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="ten">Tên:</label>
                        <input type="text" id="ten" name="ten" required>
                    </div>
                    <div class="form-group">
                        <label for="taptruyen">Tập truyện:</label>
                        <input type="text" id="taptruyen" name="taptruyen" required>
                    </div>
                    <div class="form-group">
                        <label for="hinhanh">Hình ảnh:</label>
                        <input type="file" id="hinhanh" name="hinhanh" required>

                    </div>
                    <div class="form-group">
                        <label for="theloai">Thể loại:</label>
                        <select id="theloai" name="theloai" required>
                            <?php

                            $truyvan = "SELECT * FROM theloai";
                            $thuchien = mysqli_query($conn, $truyvan);
                            while ($row = mysqli_fetch_array($thuchien)) {
                                ?>
                                <option value="<?php echo $row['theloai'] ?>"><?php echo $row['theloai'] ?></option>
                            <?php } ?>
                            <!-- <option value="Action">Action</option>
                            <option value="Arts">Arts</option>
                            <option value="Cổ Đại">Cổ Đại</option>
                            <option value="Hiện Đại">Hiện Đại</option>
                            <option value="Historical">Historical</option>
                            <option value="Horror">Horror</option>
                            <option value="Huyền Nguyễn">Huyền Nguyễn</option>
                            <option value="Kiếm Hiệp">Kiếm Hiệp</option>
                            <option value="Quân Sự">Quân Sự</option>
                            <option value="Romance">Romance</option>
                            <option value="School Life">School Life</option>
                            <option value="Truyện Teen">Truyện Teen</option>
                            <option value="Xuyên Không">Xuyên Không</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Manga">Manga</option>
                            <option value="Manhua">Manhua</option>
                            <option value="Manhwa">Manhwa</option>
                            <option value="Hài Hước">Hài Hước</option>
                            <option value="One Shot">One Shot</option>
                            <option value="Phiêu lưu">Phiêu lưu</option>
                            <option value="Truyện Màu">Truyện Màu</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gia">Giá:</label>
                        <input type="text" id="gia" name="gia" required>
                    </div>

                    <?php
                    $now = date("Y-m-d");
                    ?>

                    <div class="form-group">
                        <label for="ngay">Ngày:</label>
                        <input type="text" id="ngay" name="ngay" value="<?php echo $now ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="soluongtonkho">Số lượng tồn kho:</label>
                        <input type="text" id="soluongtonkho" name="soluongtonkho" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="soluongdaban">Số lượng đã bán:</label>
                        <input type="text" id="soluongdaban" name="soluongdaban" required>
                    </div> -->
                    <input type="submit" value="Thêm Truyện">
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Tập truyện</th>
                    <th>Hình ảnh</th>
                    <th>Thể loại</th>
                    <th>Giá</th>
                    <th>Ngày</th>
                    <th>Tồn kho</th>
                    <th>Đã bán</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM danhsachtruyen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $stt = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td style='width:5%'>$stt</td>
                        <td style='width:15%'>" . $row['ten'] . "</td>
                        <td style='width:15%'>" . $row['taptruyen'] . "</td>
                        <td style='width:5%'><img src='/project/LTWEB/CKI/" . $row['hinhanh'] . "' alt='" . $row['ten'] . "'></td>
                        <td style='width:5%'>" . $row['theloai'] . "</td>
                        <td style='width:5%'>" . $row['gia'] . "</td>
                        <td style='width:10%'>" . $row['ngay'] . "</td>
                        <td style='width:7%'>" . $row['soluongtonkho'] . "</td>
                        <td style='width:7%'>" . $row['soluongdaban'] . "</td>
                        <td style='width:7%' class='action-buttons'>
                            <a href='sua.php?id=" . $row['id'] . "'>Sửa</a>
                            <form action='xoa.php' method='post'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <input type='submit' value='Xóa'>
                            </form>
                        </td>
                      </tr>";
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='10'>Không có truyện nào</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Footer -->
    <?php
    include ("../form/footer.php");
    ?>
</body>

</html>