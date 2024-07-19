<?php
session_start();
ob_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbansach";

// Kết nối đến MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

//biến để quyết định thực hiện hàm
$action = isset($_GET['action']) ? $_GET['action'] : '';

//biến login(tk,mk)
$inputAcc = isset($_POST['inputAcc']) ? $_POST['inputAcc'] : '';
$inputPas = isset($_POST['inputPas']) ? $_POST['inputPas'] : '';

switch ($action) {
    case 'login':
        login($conn, $inputAcc, $inputPas);
        break;
    case 'logout':
        logout($conn);
        break;
    default:
        echo "Yêu cầu không đúng";
        break;
}

function login($conn, $inputAcc, $inputPas)
{
    $truyvan = "SELECT * FROM taikhoan WHERE BINARY taikhoan = '$inputAcc' AND BINARY matkhau = '$inputPas'";
    $thuchien = mysqli_query($conn, $truyvan);

    //kiểm tra truy vấn thành công hay không
    if ($thuchien) {
        //kiểm tra có dữ liệu cần tìm không || nếu có thì số dòng trả về sẽ lớn hơn 1
        if (mysqli_num_rows($thuchien) > 0) {

            //lấy một hàng từ kết quả trả về dưới dạng mảng
            $row = mysqli_fetch_assoc($thuchien);

            //gắn biến toàn cục
            $_SESSION['taikhoan'] = $row['taikhoan'];
            $_SESSION['ten'] = $row['ten'];
            $_SESSION['loai'] = $row['loai'];

            // header('Location: ../html/trangchu.php');
            echo "ok";
        } else {
            echo "Không";
        }
    }
}

function logout($conn){
    unset($_SESSION['taikhoan']);
    header('Location: trangchu.php');
}

// Sau khi kết thúc công việc, đóng kết nối
mysqli_close($conn);
?>