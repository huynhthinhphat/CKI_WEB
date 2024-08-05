<?php
session_start();
include_once ('connect.php');

// Xử lý thêm vào giỏ hàng
if (isset($_GET['id']) && !isset($_GET['action'])) {
    $id = $_GET['id'];
    // $ten = $_POST['ten'];
    // $gia = $_POST['gia'];
    // $soluong = $_POST['soluong'];
    $taikhoan = $_SESSION['taikhoan'];
    // $thanhtien = $gia * $soluong;
    $ngaythem = date("Y-m-d");

    //lấy sp theo id trong bảng danhsachtruyen
    $sql_getproduct = "SELECT * FROM danhsachtruyen WHERE id = '$_GET[id]'";
    $thuchien_getporduct = mysqli_query($conn, $sql_getproduct);

    if ($thuchien_getporduct) {
        while ($row_getproduct = mysqli_fetch_array($thuchien_getporduct)) {

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $sql_check = "SELECT * FROM giohang WHERE taikhoan = ? AND tentruyen = ? AND taptruyen = ?";
            $stmt_check = mysqli_prepare($conn, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "sss", $taikhoan, $row_getproduct['ten'], $row_getproduct['taptruyen']);
            mysqli_stmt_execute($stmt_check);
            $result_check = mysqli_stmt_get_result($stmt_check);

            if (mysqli_num_rows($result_check) > 0) {
                // Nếu sản phẩm đã tồn tại, cập nhật số lượng
                $sql_update = "UPDATE giohang SET soluong = soluong + ?, thanhtien = gia * soluong WHERE taikhoan = ? AND id = ?";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "isi", $soluong, $taikhoan, $id);
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
                $sql_insert = "INSERT INTO giohang (taikhoan, hinhanh , tentruyen, soluong, gia, thanhtien, ngaythem) VALUES (?,?, ?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $sql_insert);
                mysqli_stmt_bind_param($stmt_insert, "ssiiiss", $taikhoan, $row_getproduct['hinhanh'], $ten, $soluong, $gia, $thanhtien, $ngaythem);
                mysqli_stmt_execute($stmt_insert);
                mysqli_stmt_close($stmt_insert);
            }
        }
    } else {
        echo " " . $conn->error;
    }

    //header('Location: trangchu.php');
    exit();
}

// Xử lý cập nhật giỏ hàng
if (isset($_POST['soluong'])) {
    foreach ($_POST['soluong'] as $id => $soluong) {
        $soluong = intval($soluong);

        if ($soluong <= 0) {
            continue;
        }

        // Cập nhật số lượng trong giỏ hàng
        $sql_update = "UPDATE giohang SET soluong = ?, thanhtien = gia * ? WHERE taikhoan = ? AND id = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "iisi", $soluong, $soluong, $_SESSION['taikhoan'], $id);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);
    }

    header('Location: giohang.php');
    exit();
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql_delete = "DELETE FROM giohang WHERE id = ? AND taikhoan = ?";
        $stmt_delete = mysqli_prepare($conn, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "is", $id, $_SESSION['taikhoan']);
        mysqli_stmt_execute($stmt_delete);
        mysqli_stmt_close($stmt_delete);
    }

    header('Location: giohang.php');
    exit();
}

// Lấy thông tin giỏ hàng
$taikhoan = $_SESSION['taikhoan'];
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Lấy danh sách các truyện trong giỏ hàng với tìm kiếm
$sql = "SELECT * FROM giohang WHERE taikhoan = ? AND (tentruyen LIKE ? OR taptruyen LIKE ?)";
$stmt = mysqli_prepare($conn, $sql);
$search_param = "%$search%";
mysqli_stmt_bind_param($stmt, "sss", $taikhoan, $search_param, $search_param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Tính tổng thành tiền
$totalAmount = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/style.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/header.css">
    <link rel="stylesheet" href="/project/LTWEB/CKI/css/footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="/project/LTWEB/CKI/js/trangchu.js"></script> -->
    <script src="/project/LTWEB/CKI/js/header.js"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        .cart-image {
            width: 50px;
            /* Kích thước của hình ảnh */
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include ("../form/header.php"); ?>

    <!-- Body -->

    <!-- Context -->
    <h2>Giỏ hàng của bạn</h2>
    <form action="" method="post">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
            placeholder="Tìm kiếm theo tên truyện" />
        <input type="submit" value="Tìm kiếm" />
    </form>
    <form action="giohang.php" method="post">
        <table style="width: 100%">
            <tr>
                <th style="text-align: center">Hình ảnh</th>
                <th style="text-align: center">Tên truyện</th>
                <th style="text-align: center">Tập truyện</th>
                <th style="text-align: center">Số lượng</th>
                <th style="text-align: center">Giá</th>
                <th style="text-align: center">Thành tiền</th>
                <th style="text-align: center">Ngày thêm</th>
                <th style="text-align: center">Thao tác</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id"];
                    $tentruyen = $row["tentruyen"];
                    $taptruyen = $row["taptruyen"];
                    $soluong = $row["soluong"];
                    $gia = $row["gia"];
                    $amount = $gia * $soluong;
                    $totalAmount += $amount; // Cộng dồn thành tiền
            
                    // Lấy hình ảnh của truyện từ bảng danh sách truyện
                    // $sql_image = "SELECT hinhanh FROM danhsachtruyen WHERE id = ?";
                    // $stmt_image = mysqli_prepare($conn, $sql_image);
                    // mysqli_stmt_bind_param($stmt_image, "s", $id);
                    // mysqli_stmt_execute($stmt_image);
                    // $result_image = mysqli_stmt_get_result($stmt_image);
                    // $image_row = mysqli_fetch_assoc($result_image);
                    // $hinhanh = $image_row ? $image_row['hinhanh'] : 'default_image.jpg';
            
                    echo "<tr>";
                    echo "<td style='width: 0%'><img src='/project/LTWEB/CKI/" . htmlspecialchars($row["hinhanh"]) . "' class='cart-image' alt='Hình ảnh truyện' /></td>";
                    echo "<td style='width: 20%; text-align: center'>" . htmlspecialchars($tentruyen) . "</td>";
                    echo "<td style='width: 20%; text-align: center'>" . htmlspecialchars($taptruyen) . "</td>";
                    echo "<td style='width: 0%; text-align: center'><input style='text-align: center' type='number' name='soluong[" . htmlspecialchars($row["id"]) . "]' value='" . htmlspecialchars($soluong) . "' min='1' /></td>";
                    echo "<td style='width: 10%; text-align: center'>" . number_format(htmlspecialchars($gia), 0, '', ',') . "đ</td>";
                    echo "<td style='width: 10%; text-align: center'>" . number_format(htmlspecialchars($amount), 0, '', ',') . "đ</td>";
                    echo "<td style='width: 20%; text-align: center'>" . htmlspecialchars($row["ngaythem"]) . "</td>";

                    //nếu số lượng trong giỏ hàng lớn hơn số lượng tồn kho thì không thể mua và ngược lại
                    $truyvan_sltk = "SELECT * FROM danhsachtruyen WHERE ten = '$tentruyen' AND taptruyen = '$taptruyen'";
                    $thuchien_sltk = mysqli_query($conn, $truyvan_sltk);
                    if ($thuchien_sltk) {
                        $row_sltk = mysqli_fetch_array($thuchien_sltk);
                        if ($row_sltk['soluongtonkho'] < $soluong) {
                            echo "<td style='width: 20%; text-align: center'><a href='giohang.php?action=delete&id=" . htmlspecialchars($row["id"]) . "'>Xóa</a> | <a>Kho không đủ</a></td>";
                        } else {
                            echo "<td style='width: 10%; text-align: center'><a href='giohang.php?action=delete&id=" . htmlspecialchars($row["id"]) . "'>Xóa</a> | <a href='/project/LTWEB/CKI/html/danhmuc/buy.php?id=" . htmlspecialchars($row["id"]) . "'>Mua</a></td>";
                        }
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Giỏ hàng trống</td></tr>";
            }
            ?>
        </table>
        <h3>Tổng thành tiền: <?php echo htmlspecialchars(number_format($totalAmount, 0, '', ',')); ?> VND</h3>
        <input type="submit" value="Cập nhật giỏ hàng" />
    </form>
    <a href="trangchu.php">Tiếp tục mua sắm</a>
    <a href="/project/LTWEB/CKI/html/danhmuc/buy.php">Thanh toán tất cả</a>

    <?php mysqli_close($conn); ?>

    <!-- Footer -->
    <?php include ("../form/footer.php"); ?>
</body>

</html>