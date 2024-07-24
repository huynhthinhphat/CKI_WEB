<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbansach";

// Kết nối đến MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo " " . $conn->error;
}

//biến để quyết định thực hiện hàm
$action = isset($_GET['action']) ? $_GET['action'] : '';

//biến login(tk,mk)
$inputAcc = isset($_POST['inputAcc']) ? $_POST['inputAcc'] : '';
$inputPas = isset($_POST['inputPas']) ? $_POST['inputPas'] : '';
$inputHo = isset($_POST['inputHo']) ? $_POST['inputHo'] : '';
$inputTen = isset($_POST['inputTen']) ? $_POST['inputTen'] : '';

//biến limit xem thêm dữ liệu
$limit_iw = isset($_POST['limit_iw']) ? $_POST['limit_iw'] : 5;
$limit_sph = isset($_POST['limit_sph']) ? $_POST['limit_sph'] : 5;

switch ($action) {
    case 'login':
        login($conn, $inputAcc, $inputPas);
        break;
    case 'logout':
        logout($conn);
        break;
    case 'reg':
        reg($conn, $inputHo, $inputTen, $inputAcc, $inputPas);
        break;
    case 'loadlistinweek':
        loadlistinweek($conn, $limit_iw);
        break;
    case 'loadlistSPH':
        loadlistSPH($conn, $limit_sph);
        break;
    default:
        echo "Yêu cầu không đúng";
        break;
}
function logout($conn)
{
    unset($_SESSION['taikhoan']);
    header('Location: trangchu.php');
}

function login($conn, $inputAcc, $inputPas)
{
    //tìm kiếm tài khoản
    $truyvan_check = "SELECT * FROM taikhoan WHERE BINARY taikhoan = '$inputAcc' AND BINARY matkhau = '$inputPas'";
    $thuchien_check = mysqli_query($conn, $truyvan_check);

    //đếm số lượng sản phẩm trong giỏ hàng của người dùng
    $truyvan_giohang = "SELECT COUNT(*) AS quantity_product FROM giohang WHERE BINARY taikhoan = '$inputAcc'";
    $thuchien_giohang = mysqli_query($conn, $truyvan_giohang);

    //đếm số tiền của giỏ hàng
    $truyvan_totalAmount = "SELECT SUM(thanhtien) AS totalAmount FROM giohang WHERE BINARY taikhoan = '$inputAcc'";
    $thuchien_totalAmount = mysqli_query($conn, $truyvan_totalAmount);

    //kiểm tra truy vấn thành công hay không
    if ($thuchien_check && $thuchien_giohang && $thuchien_totalAmount) {
        //kiểm tra có dữ liệu cần tìm không || nếu có thì số dòng trả về sẽ lớn hơn 1
        if (mysqli_num_rows($thuchien_check) > 0) {

            //lấy một hàng từ kết quả trả về dưới dạng mảng
            $row_check = mysqli_fetch_assoc($thuchien_check);

            //gắn biến toàn cục
            $_SESSION['taikhoan'] = $row_check['taikhoan'];
            $_SESSION['ten'] = $row_check['ten'];
            $_SESSION['loai'] = $row_check['loai'];


            //đếm số hàng trả về của sản phẩm trong giỏ hàng
            $_SESSION['quantity_product'] = mysqli_fetch_array($thuchien_giohang)['quantity_product'];


            //nếu tổng tiền > 0 thì lấy tổng trả về, ngược lại < 0 => totalAmount = 0;
            if (mysqli_num_rows($thuchien_totalAmount) > 0) {
                $row_totalAmount = mysqli_fetch_assoc($thuchien_totalAmount);
                $_SESSION['totalAmount'] = $row_totalAmount['totalAmount'];
            } else {
                $_SESSION['totalAmount'] = 0;
            }

            echo "ok";
        } else {
            echo "Không";
        }
    } else {
        echo " " . $conn->error;
    }
}

function reg($conn, $inputHo, $inputTen, $inputAcc, $inputPas)
{
    $truyvan = "SELECT * FROM taikhoan WHERE BINARY taikhoan = '$inputAcc' AND BINARY matkhau = '$inputPas'";
    $thuchien = mysqli_query($conn, $truyvan);

    //kiểm tra truy vấn thành công hay không
    if ($thuchien) {
        //kiểm tra có dữ liệu cần tìm không || nếu có thì số dòng trả về sẽ lớn hơn 1
        if (mysqli_num_rows($thuchien) > 0) {
            echo "Không";
        } else {
            //thêm tài khoản mới vào sql
            $add = "INSERT INTO taikhoan (ho, ten, taikhoan, matkhau, loai) VALUES ('$inputHo', '$inputTen','$inputAcc', '$inputPas', 1)";
            $thuchien_add = mysqli_query($conn, $add);

            if ($thuchien_add) {
                //gắn biến toàn cục
                $_SESSION['taikhoan'] = $inputAcc;
                $_SESSION['ten'] = $inputTen;
                $_SESSION['loai'] = 1;
            }
        }
    }
}

function loadlistinweek($conn, $limit_iw)
{
    $truyvan_quantitybooks = "SELECT COUNT(ten) AS quantitybooks FROM danhsachtruyen";
    $thuchien_quantitybooks = mysqli_query($conn, $truyvan_quantitybooks);

    //đếm số lượng truyện trong table danhsachtruyen
    $_SESSION['quantity_books'] = mysqli_fetch_array($thuchien_quantitybooks)['quantitybooks'];

    $truyvan_taikhoan = "SELECT COUNT(taikhoan) AS taikhoan FROM taikhoan";
    $thuchien_taikhoan = mysqli_query($conn, $truyvan_taikhoan);

    //đếm số lượng taikhoan trong table taikhoan
    $_SESSION['quantity_accounts'] = mysqli_fetch_array($thuchien_taikhoan)['taikhoan'];

    $truyvan_all = "SELECT * FROM danhsachtruyen WHERE ngay >= DATE_SUB(CURDATE(), INTERVAL 20 DAY) AND soluongtonkho > 0 AND soluongdaban > 0";
    $thuchien_all = mysqli_query($conn, $truyvan_all);

    $truyvan_iw = $truyvan_all . " ORDER BY ngay DESC LIMIT $limit_iw";
    $thuchien_iw = mysqli_query($conn, $truyvan_iw);

    if ($thuchien_iw && $thuchien_all) {

        $rows_all = mysqli_num_rows($thuchien_all);
        $rows_iw = mysqli_num_rows($thuchien_iw);

        if ($rows_iw > 0) {
            while ($row = mysqli_fetch_assoc($thuchien_iw)) {
                $ten = $row['ten'];
                $taptruyen = $row['taptruyen'];
                $hinhanh = $row['hinhanh'];
                $gia = number_format($row['gia'], 0, '', ',') . "<u>đ</u>";

                echo "<div id-product='$row[id]' class='item_book'>";
                echo "<div class='name_book'>";
                echo "<p>$ten $taptruyen</p>";
                echo "<p>$gia</p>";
                echo "</div>";
                echo "<div class='img_book'>";
                echo "<img src='../$hinhanh'>";
                echo "</div>";
                echo "<div class='add_book'>";
                echo "<button class='btn_themgiohang' id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                echo "</div>";
                echo "</div>";
            }
            if ($rows_iw < $rows_all) {
                $quantity_pro = $rows_all - $rows_iw;
                echo "<div class='container_btn_loadlistinweek'><button class='btn_more_iw'>Xem thêm $quantity_pro sản phẩm khác</div>";
            }
        }
    } else {
        echo "Không thể truy vấn dữ liệu";
    }
}

function loadlistSPH($conn, $limit_sph)
{
    $truyvan_all = "SELECT * FROM danhsachtruyen WHERE soluongtonkho = 0 AND soluongdaban = 0";
    $thuchien_all = mysqli_query($conn, $truyvan_all);

    $truyvan_sph = $truyvan_all . " ORDER BY ngay DESC LIMIT $limit_sph";
    $thuchien_sph = mysqli_query($conn, $truyvan_sph);

    if ($thuchien_sph && $thuchien_all) {

        $rows_all = mysqli_num_rows($thuchien_all);
        $rows_sph = mysqli_num_rows($thuchien_sph);

        if ($rows_sph > 0) {
            while ($row = mysqli_fetch_assoc($thuchien_sph)) {
                $ten = $row['ten'];
                $taptruyen = $row['taptruyen'];
                $hinhanh = $row['hinhanh'];
                $gia = number_format($row['gia'], 0, '', ',') . "<u>đ</u>";

                echo "<div id-product='$row[id]' class='item_book'>";
                echo "<div class='name_book'>";
                echo "<p>$ten $taptruyen</p>";
                echo "<p>$gia</p>";
                echo "</div>";
                echo "<div class='img_book'>";
                echo "<img src='../$hinhanh'>";
                echo "</div>";
                echo "<div class='add_book'>";
                echo "<button class='btn_themgiohang' id-product='$row[id]'>THÊM VÀO GIỎ</button>";
                echo "</div>";
                echo "</div>";
            }
            if ($rows_sph < $rows_all) {
                $quantity_pro = $rows_all - $rows_sph;
                echo "<div class='container_btn_loadlistSPH'><button class='btn_more_sph'>Xem thêm $quantity_pro sản phẩm khác</div>";
            }
        }
    } else {
        echo "Không thể truy vấn dữ liệu";
    }
}


// Sau khi kết thúc công việc, đóng kết nối
mysqli_close($conn);
?>