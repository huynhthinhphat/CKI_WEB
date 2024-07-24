<?php
session_start();

if (!isset($_SESSION["taikhoan"])) {
    echo "Đăng nhập để xem giỏ hàng";
} else {
    echo "Giỏ hàng bạn có cái nịt";
}

?>