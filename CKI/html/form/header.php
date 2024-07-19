<?php
session_start();
?>
<header>
    <div>
        <a href="trangchu.php"><img src="../img/logo/logo.png" alt="Ảnh logo"></a>
    </div>
    <div>
        <form>
            <input type="text" id="header_search" placeholder="Nhập từ khóa tìm kiếm...">
            <button type="button"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div>
        <li>
            <div>
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div>
                <?php
                if (!isset($_SESSION['taikhoan'])) {
                    ?>
                    <div id="taikhoan_xinchao"><span>Tài khoản</span></div>
                    <ul>
                        <li><a href="login_reg.php">Đăng nhập</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <div id="taikhoan_xinchao"><span>Xin chào</span></div>
                    <div id="tennguoidung"><?php echo $_SESSION['ten']; ?></div>
                    <?php if ($_SESSION['loai'] == 0) { ?>
                        <ul>
                            <li><a href="#">Quản lý tài khoản</a></li>
                            <li><a href="#">Quản lý sản phẩm</a></li>
                            <li><a href="#">Quản lý doanh thu</a></li>
                            <li><a href="#">Đổi mật khẩu</a></li>
                            <li><a href="api.php?action=logout">Đăng xuất</a></li>
                        </ul>
                    <?php } else { ?>
                        <ul>
                            <li><a href="#">Giỏ hàng</a></li>
                            <li><a href="#">Thông tin tài khoản</a></li>
                            <li><a href="api.php?action=logout">Đăng xuất</a></li>
                        </ul><?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
        </li>
        <li>
            <div>
                <i class="fa fa-cart-shopping"></i>
            </div>
            <div>
                <div id="giohang"><span>Giỏ hàng (0)</span></div>
                <div id="tiengiohong">0đ</div>
            </div>
        </li>
    </div>
</header>
<nav>
    <li><a href="#">Danh mục</a></li>
    <li><a href="#">Danh mục</a></li>
    <li><a href="#">Danh mục</a></li>
    <li><a href="#">Danh mục</a></li>
    <li><a href="#">Danh mục</a></li>
</nav>