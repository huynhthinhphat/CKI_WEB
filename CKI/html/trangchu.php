<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/trangchu.js"></script>
</head>

<body>
    <!-- Header -->
    <?php
    include ("form/header.php");
    ?>

    <!-- Body -->
    <div id="container_img">
        <img src="../img/logo/anh_trangchu.webp" alt="">
    </div>

    <div id="container_introduce">
        <div>
            <div>
                <p><i class="fa fa-book"></i></p>
                <p>Những bản manga mới nhất</p>
                <p>3000+</p>
            </div>
        </div>
        <div>
            <div>
                <p><i class="fa fa-user"></i></p>
                <p>Khách hàng thân thiết</p>
                <p>999+</p>
            </div>
        </div>
        <div>
            <div>
                <p><i class="fa fa-heart"></i></p>
                <p>Thế giới truyện tranh</p>
                <p>300+</p>
            </div>
        </div>
    </div>

    <div class="container_newbook">
        <div>
            <h2>Mới nhất trong tuần</h2>
            <img src="../img/logo/header_title.png" alt="">
            <p><i>Cùng tìm hiểu truyện mới nhất của chúng tôi</i></p>
        </div>

        <!-- Hiển thị dữ liệu ảnh đăng mới nhất -->
        <div id="books"></div>
    </div>

    <div class="container_newbook">
        <div>
            <h2>Sắp phát hành</h2>
            <img src="../img/logo/header_title.png" alt="">
            <p><i>Truyện dự kiến được phát hành trong thời gian tới</i></p>
        </div>

        <!-- Hiển thị dữ liệu ảnh săp phát hàng -->
        <div id="books_sph"></div>
    </div>

    <div class="container_img_members_books">
        <img src="http://file.hstatic.net/1000266609/file/bgparallax-04.jpg" alt="">
        <div class="container_members_books">
            <div class="container_members">
                <div>
                    <i class="fa fa-users"></i>
                </div>
                <div>
                    <div>Thành viên</div>
                    <div>
                        <p>
                            <?php
                            if (isset($_SESSION['quantity_accounts'])) {
                                echo $_SESSION['quantity_accounts'];
                            } else {
                                echo "0";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="container_quantity_books">
                <div>
                    <i class="fa fa-book"></i>
                </div>
                <div>
                    <div>Sản phẩm</div>
                    <div>
                        <p>
                            <?php
                            if (isset($_SESSION['quantity_books'])) {
                                echo $_SESSION['quantity_books'];
                            } else {
                                echo "0";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include ("form/footer.php");
    ?>
</body>

</html>