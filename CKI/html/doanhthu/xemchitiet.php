<?php
$conn = mysqli_connect("localhost", "root", "", "webbansach");

if (!$conn) {
    echo "Không kết nối được cơ sở dữ liệu";
}

$mahoadon = isset($_GET['mahoadon']) ? $_GET['mahoadon'] : " ";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        font-family: arial;
    }

    #container_chitiethoadon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
        padding-top: 3%
    }

    .title {
        text-align: center;
        text-transform: capitalize;
        font-size: 3.5vh;
    }

    #container_chitiethoadon>div {
        width: 75%;
        margin-bottom: 1%;
    }

    #container_chitiethoadon>div:last-child {
        display: flex;
        justify-content: space-between;
    }

    table {
        width: 100%;
        height: auto;
        border: 1px solid black;
        border-collapse: collapse;
    }

    tr {
        text-align: center;
    }

    thead tr {
        background-color: rgb(215, 215, 215);
    }

    td {
        padding: 1% 0;
    }
</style>

<body>
    <div id="container_chitiethoadon">
        <div>
            <div class="title">
                <h3>Chi tiết hóa đơn <?php echo $mahoadon ?></h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Tên truyện</td>
                        <td>Tập truyện</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Tổng tiền</td>
                    </tr>
                </thead>
                <?php
                $truyvan = "SELECT * FROM chitiethoadon WHERE mahoadon = '$mahoadon'";
                $thuchien = mysqli_query($conn, $truyvan);

                if ($thuchien && mysqli_num_rows($thuchien) > 0) {
                    while ($row = mysqli_fetch_array($thuchien)) {
                        ?>

                        <tbody>
                            <tr>
                                <td><?php echo $row['tentruyen'] ?></td>
                                <td><?php echo $row['taptruyen'] ?></td>
                                <td><?php echo number_format($row['gia'], 0, '', '.') . "<u>đ</u>" ?></td>
                                <td><?php echo $row['soluong'] ?></td>
                                <td><?php echo number_format($row['tongtien'], 0, '', '.') . "<u>đ</u>" ?></td>
                            </tr>
                        </tbody>
                    <?php }
                } else {
                    echo "Không thêm xem chi tiết hóa đơn này";
                } ?>
            </table>
        </div>
        <div>
            <a href="doanhthu.php">Trở về</a>
            <?php

            $truyvan = "SELECT * FROM doanhthu WHERE mahoadon = '$mahoadon'";
            $thuchien = mysqli_query($conn, $truyvan);
            if ($thuchien && mysqli_num_rows($thuchien) > 0) {
                while ($row = mysqli_fetch_array($thuchien)) {
                    ?>
                    <p>Tổng tiền: <?php echo number_format($row['thanhtien'], 0, '', '.') . "<u>đ</u>" ?></p>
                </div>
            <?php }
            } ?>
    </div>
    </div>
</body>

</html>