-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 24, 2024 lúc 09:32 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbansach`
--

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `chitietsanpham`
--
CREATE TABLE `chitietsanpham` (
    `id` int(11) NOT NULL,
    `ten` varchar(255) NOT NULL,
    `taptruyen` varchar(255) NOT NULL,
    `hinhanh` text NOT NULL,
    `theloai` varchar(255) NOT NULL,
    `tentacgia` varchar(255) NOT NULL,
    `dichgia` varchar(255) NOT NULL,
    `hoasi` varchar(255) NOT NULL,
    `xuatsu` varchar(255) NOT NULL,
    `series` varchar(255) NOT NULL,
    `gia` int(11) NOT NULL,
    `ngay` date NOT NULL,
    `soluong` int(11) NOT NULL,
    `luotmua` int(11) NOT NULL,
    `mota` varchar(555) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;
--
-- Đang đổ dữ liệu cho bảng `chitietsanpham`
--
INSERT INTO `chitietsanpham` (`id`, `ten`,`taptruyen`, `hinhanh`, `theloai`, `tentacgia`, `dichgia`, `hoasi`, `xuatsu`, `series`, `gia`, `ngay`, `soluong`, `luotmua`, `mota`) VALUES
(2, 'CHÚ THUẬT HỒI CHIẾN','TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 'img/truyen/chuthuathoichientap11.webp', 'Action', 'Tác giả 1', 'Dịch giả 1', 'Họa sĩ 1', 'Nhật Bản', 'Series 1', 100000, '2024-07-12', 15, 3, 'Mô tả chi tiết cho sản phẩm 1'),
(3, 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 12: BIẾN CỐ SHIBUYA - GIÁNG LINH', 'img/truyen/chuthuathoichientap12.jpg', 'Action', 'Tác giả 2', 'Dịch giả 2', 'Họa sĩ 2', 'Nhật Bản', 'Series 2', 250000, '2024-07-09', 0, 0, 'Mô tả chi tiết cho sản phẩm 2'),
(5, 'DRAGON BALL SUPER', 'TẬP 1: CÁC CHIẾN BINH CỦA VŨ TRỤ THỨ 6',' img/truyen/dragonballsupertap1.webp', 'Action', 'Tác giả 3', 'Dịch giả 3', 'Họa sĩ 3', 'Nhật Bản', 'Series 3', 25000, '2024-07-09', 35, 55, 'Mô tả chi tiết cho sản phẩm 3'),
(6, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 10: LỄ HỘI ĐÊM','img/truyen/chuthuathoichientap10.jpg', 'Action', 'Tác giả 4', 'Dịch giả 4', 'Họa sĩ 4', 'Nhật Bản', 'Series 4', 25000, '2024-07-12', 0, 0, 'Mô tả chi tiết cho sản phẩm 4'),
(7, 'CHÚ THUẬT HỒI CHIẾN',' TẬP 17: NGẬM NGỌN CỎ LAU', 'img/truyen/chuthuathoichientap6.jpg', 'Action', 'Tác giả 5', 'Dịch giả 5', 'Họa sĩ 5', 'Nhật Bản', 'Series 5', 250000, '2024-07-09', 17, 12, 'Mô tả chi tiết cho sản phẩm 5'),
(8, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 3: CÁ CON VÀ TRỪNG PHẠT NGƯỢC','img/truyen/chuthuathoichientap3.jpg', 'Action', 'Tác giả 6', 'Dịch giả 6', 'Họa sĩ 6', 'Nhật Bản', 'Series 6', 480000, '2024-07-12', 34, 56, 'Mô tả chi tiết cho sản phẩm 6'),
(9, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 14 - BIẾN CỐ SHIBUYA – ĐÚNG SAI', 'img/truyen/chuthuathoichientap14.jpg', 'Action', 'Tác giả 7', 'Dịch giả 7', 'Họa sĩ 7', 'Nhật Bản', 'Series 7', 149000, '2024-07-09', 0, 0, 'Mô tả chi tiết cho sản phẩm 7'),
(10, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 15: BIẾN CỐ SHIBUYA -BIẾN THÂN', 'img/truyen/chuthuathoichientap15.jpg', 'Action', 'Tác giả 8', 'Dịch giả 8', 'Họa sĩ 8', 'Nhật Bản', 'Series 8', 250000, '2024-07-12', 0, 0, 'Mô tả chi tiết cho sản phẩm 8'),
(11, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 16: BIẾN CỐ SHIBUYA -BẾ MÔN', 'img/truyen/chuthuathoichientap16.webp', 'Action', 'Tác giả 9', 'Dịch giả 9', 'Họa sĩ 9', 'Nhật Bản', 'Series 9', 250000, '2024-07-09', 12, 123, 'Mô tả chi tiết cho sản phẩm 9'),
(12, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 6: HẮC THIỂM', 'img/truyen/chuthuathoichientap6.jpg', 'Action', 'Tác giả 10', 'Dịch giả 10', 'Họa sĩ 10', 'Nhật Bản', 'Series 10', 25000, '2024-07-09', 12, 5, 'Mô tả chi tiết cho sản phẩm 10'),
(13, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 19: KẾT GIỚI TOKYO SỐ 1 -NGƯỜI ĐÀN ÔNG GIẬN DỮ', 'img/truyen/chuthuathoichientap19.webp', 'Action', 'Tác giả 11', 'Dịch giả 11', 'Họa sĩ 11', 'Nhật Bản', 'Series 11', 250000, '2024-07-09', 25, 5, 'Mô tả chi tiết cho sản phẩm 11'),
(16, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 18: NHIỆT', 'img/truyen/chuthuathoichientap18.webp', 'Action', 'Tác giả 12', 'Dịch giả 12', 'Họa sĩ 12', 'Nhật Bản', 'Series 12', 250000, '2024-07-09', 123, 12, 'Mô tả chi tiết cho sản phẩm 12'),
(19, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 9: NGỌC CHIẾT', 'img/truyen/chuthuahoichientap9.jpg', 'Action', 'Tác giả 13', 'Dịch giả 13', 'Họa sĩ 13', 'Nhật Bản', 'Series 13', 1, '2024-07-13', 0, 0, 'Mô tả chi tiết cho sản phẩm 13'),
(20, 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 6: HẮC THIỂM', 'img/truyen/chuthuathoichientap6.jpg', 'Action', 'Tác giả 14', 'Dịch giả 14', 'Họa sĩ 14', 'Nhật Bản', 'Series 14', 25000, '2024-07-13', 0, 0, 'Mô tả chi tiết cho sản phẩm 14');

--
-- Cấu trúc bảng cho bảng `danhsachtruyen`
--

CREATE TABLE `danhsachtruyen` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `taptruyen` varchar(255) NOT NULL,
  `hinhanh` text NOT NULL,
  `theloai` varchar(255) NOT NULL,
  `gia` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `soluongtonkho` int(11) NOT NULL,
  `soluongdaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachtruyen`
--

INSERT INTO `danhsachtruyen` (`id`, `ten`, `taptruyen`, `hinhanh`, `theloai`, `gia`, `ngay`, `soluongtonkho`, `soluongdaban`) VALUES
(2, 'CHÚ THUẬT HỒI CHIẾN', 'TẬP 11: BIẾN CỐ SHIBUYA - KHAI MÔN', 'img/truyen/chuthuathoichientap11.webp', 'Arts', 100000, '2024-07-12', 15, 3),
(3, 'CHÚ THUẬT HỒI CHIẾN ', 'TẬP 12: BIẾN CỐ SHIBUYA - GIÁNG LINH', 'img/truyen/chuthuathoichientap12.jpg', 'Action', 250000, '2024-07-09', 0, 0),
(5, 'DRAGON BALL SUPER ', 'TẬP 1: CÁC CHIẾN BINH CỦA VŨ TRỤ THỨ 6', 'img/truyen/dragonballsupertap1.webp', 'Cổ Đại', 25000, '2024-07-09', 35, 55),
(6, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 10: LỄ HỘI ĐÊM', 'img/truyen/chuthuathoichientap10.jpg', 'Action', 25000, '2024-07-12', 0, 0),
(7, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 17: NGẬM NGỌN CỎ LAU', 'img/truyen/chuthuathoichientap6.jpg', 'Hiện Đại', 250000, '2024-07-09', 17, 12),
(8, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 3: CÁ CON VÀ TRỪNG PHẠT NGƯỢC', 'img/truyen/chuthuathoichientap3.jpg', 'Action', 480000, '2024-07-12', 34, 56),
(9, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 14 - BIẾN CỐ SHIBUYA – ĐÚNG SAI', 'img/truyen/chuthuathoichientap14.jpg', 'Action', 149000, '2024-07-09', 0, 0),
(10, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 15: BIẾN CỐ SHIBUYA -BIẾN THÂN', 'img/truyen/chuthuathoichientap15.jpg', 'Action', 250000, '2024-07-12', 0, 0),
(11, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 16: BIẾN CỐ SHIBUYA -BẾ MÔN', 'img/truyen/chuthuathoichientap16.webp', 'Action', 250000, '2024-07-09', 12, 123),
(12, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 6: HẮC THIỂM', 'img/truyen/chuthuathoichientap6.jpg', 'Action', 25000, '2024-07-09', 12, 5),
(13, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 19: KẾT GIỚI TOKYO SỐ 1 -NGƯỜI ĐÀN ÔNG GIẬN DỮ', 'img/truyen/chuthuathoichientap19.webp', 'Action', 250000, '2024-07-09', 25, 5),
(16, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 18: NHIỆT', 'img/truyen/chuthuathoichientap18.webp', 'Action', 250000, '2024-07-09', 123, 12),
(19, 'CHÚ THUẬT HỒI CHIẾN', ' TẬP 9: NGỌC CHIẾT', 'img/truyen/chuthuahoichientap9.jpg', 'Action', 1, '2024-07-13', 0, 0),
(20, 'CHÚ THUẬT HỒI CHIẾN ', 'TẬP 6: HẮC THIỂM', 'img/truyen/chuthuathoichientap6.jpg', 'Action', 25000, '2024-07-13', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanhthu`
--

CREATE TABLE `doanhthu` (
  `id` int(11) NOT NULL,
  `taikhoan` varchar(50) NOT NULL,
  `tentruyen` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` float NOT NULL,
  `thanhtien` float NOT NULL,
  `ngaymua` date NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `tentruyen` text NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` float NOT NULL,
  `thanhtien` float NOT NULL,
  `ngaythem` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `ho` varchar(255) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `matkhau` varchar(55) NOT NULL,
  `loai` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `ho`, `ten`, `taikhoan`, `matkhau`, `loai`) VALUES
(1, 'Huỳnh Thịnh', 'Admin', 'admin', '1', 0),
(2, 'rt', 'rt', 'rt', 'rt', 1),
(3, 'Anh ', 'Tài', 'tai123', '123', 1),
(4, 'Trương Thị', 'Thanh Tâm', 'tam123', 'thanhtam132', 1),
(5, 'Quốc', 'Việt', 'vietngu', '1230897145', 1),
(14, 'b', 'b', 'b', 'b', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id` int(11) NOT NULL,
  `theloai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id`, `theloai`) VALUES
(1, 'Action'),
(2, 'Arts'),
(3, 'Cổ Đại'),
(4, 'Hiện Đại'),
(5, 'Historical\r\n'),
(6, 'Horror'),
(7, 'Huyền Nguyễn'),
(8, 'Kiếm Hiệp'),
(9, 'Quân Sự'),
(10, 'Romance'),
(11, 'School Life'),
(12, 'Truyện Teen'),
(13, 'Xuyên Không'),
(14, 'Comedy'),
(15, 'Manga'),
(16, 'Manhua'),
(17, 'Manhwa'),
(18, 'Hài Hước'),
(19, 'One Shot'),
(20, 'Phiêu lưu\r\n'),
(21, 'Truyện Màu');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhsachtruyen`
--
ALTER TABLE `danhsachtruyen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `doanhthu`
--
ALTER TABLE `doanhthu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhsachtruyen`
--
ALTER TABLE `danhsachtruyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `doanhthu`
--
ALTER TABLE `doanhthu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
