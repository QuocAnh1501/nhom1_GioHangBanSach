-- Tao va chon dung co so du lieu de tranh loi #1046 - No database selected
CREATE DATABASE IF NOT EXISTS `qlgiohang` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `qlgiohang`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2026 lúc 03:01 PM
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
-- Cơ sở dữ liệu: `qlgiohang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_donhang`
--

CREATE TABLE `chitiet_donhang` (
  `ma_chitiet` int(11) NOT NULL,
  `ma_donhang` int(11) NOT NULL,
  `ma_sanpham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 1,
  `don_gia` decimal(12,2) NOT NULL DEFAULT 0.00,
  `thanh_tien` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_donhang`
--

INSERT INTO `chitiet_donhang` (`ma_chitiet`, `ma_donhang`, `ma_sanpham`, `so_luong`, `don_gia`, `thanh_tien`) VALUES
(1, 1, 1, 1, 120000.00, 120000.00),
(2, 1, 5, 2, 85000.00, 170000.00),
(3, 2, 3, 1, 180000.00, 180000.00),
(4, 2, 2, 1, 150000.00, 150000.00),
(5, 3, 4, 2, 95000.00, 190000.00),
(6, 4, 6, 1, 90000.00, 90000.00),
(7, 4, 8, 1, 80000.00, 80000.00),
(8, 4, 1, 1, 120000.00, 120000.00),
(9, 4, 7, 1, 70000.00, 70000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `ma_danhmuc` int(11) NOT NULL,
  `ten_danh_muc` varchar(100) NOT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`ma_danhmuc`, `ten_danh_muc`, `mo_ta`) VALUES
(1, 'Sách lập trình', 'Sách về lập trình và phát triển phần mềm'),
(2, 'Sách giáo trình', 'Sách phục vụ học tập và nghiên cứu'),
(3, 'Sách kỹ năng', 'Sách phát triển kỹ năng cá nhân'),
(4, 'Sách văn học', 'Truyện và tác phẩm văn học');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `ma_donhang` int(11) NOT NULL,
  `ma_khachhang` int(11) NOT NULL,
  `ngay_dat` datetime DEFAULT current_timestamp(),
  `tong_tien` decimal(12,2) NOT NULL DEFAULT 0.00,
  `ma_trangthai` int(11) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `phuong_thuc_thanh_toan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`ma_donhang`, `ma_khachhang`, `ngay_dat`, `tong_tien`, `ma_trangthai`, `ghi_chu`, `phuong_thuc_thanh_toan`) VALUES
(1, 1, '2026-10-21 19:46:51', 290000.00, 1, 'Đơn hàng mẫu của khách hàng An', 'Tiền mặt'),
(2, 2, '2026-10-21 19:46:51', 330000.00, 2, 'Đơn hàng mẫu của khách hàng Bình', 'Chuyển khoản'),
(3, 3, '2026-10-21 19:46:51', 190000.00, 3, 'Đơn hàng mẫu của khách hàng Cường', 'Tiền mặt'),
(4, 4, '2026-10-21 19:46:51', 355000.00, 1, 'Đơn hàng mẫu của khách hàng Mai', 'Chuyển khoản');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ma_khachhang` int(11) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `mat_khau` varchar(255) DEFAULT NULL,
  `ngay_dang_ky` datetime DEFAULT current_timestamp(),
  `trang_thai` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ma_khachhang`, `ho_ten`, `email`, `so_dien_thoai`, `dia_chi`, `mat_khau`, `ngay_dang_ky`, `trang_thai`) VALUES
(1, 'Nguyễn Văn An', 'an.demo@example.com', '0900000001', 'Trà Vinh', NULL, '2026-10-21 19:46:51', 1),
(2, 'Trần Thị Bình', 'binh.demo@example.com', '0900000002', 'Cần Thơ', NULL, '2026-10-21 19:46:51', 1),
(3, 'Lê Văn Cường', 'cuong.demo@example.com', '0900000003', 'Vĩnh Long', NULL, '2026-10-21 19:46:51', 1),
(4, 'Phạm Thị Mai', 'mai.demo@example.com', '0900000004', 'Sóc Trăng', NULL, '2026-10-21 19:46:51', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_sanpham` int(11) NOT NULL,
  `ma_danhmuc` int(11) NOT NULL,
  `ten_san_pham` varchar(200) NOT NULL,
  `tac_gia` varchar(150) NOT NULL,
  `nha_xuat_ban` varchar(150) DEFAULT NULL,
  `nam_xuat_ban` year(4) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia_ban` decimal(12,2) NOT NULL DEFAULT 0.00,
  `so_luong_ton` int(11) NOT NULL DEFAULT 0,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ma_sanpham`, `ma_danhmuc`, `ten_san_pham`, `tac_gia`, `nha_xuat_ban`, `nam_xuat_ban`, `isbn`, `mo_ta`, `gia_ban`, `so_luong_ton`, `hinh_anh`, `trang_thai`) VALUES
(1, 1, 'Lập trình PHP cơ bản', 'Nguyễn Văn A', 'NXB Giáo dục Việt Nam', '2024', '9786040000001', 'Sách nhập môn lập trình PHP dành cho người mới học.', 120000.00, 30, NULL, 1),
(2, 1, 'Học MySQL từ cơ bản đến nâng cao', 'Trần Văn B', 'NXB Thông tin và Truyền thông', '2023', '9786040000002', 'Giới thiệu cơ sở dữ liệu và ngôn ngữ truy vấn SQL.', 150000.00, 25, NULL, 1),
(3, 1, 'Lập trình Website với Laravel', 'Lê Văn C', 'NXB Khoa học và Kỹ thuật', '2024', '9786040000003', 'Tài liệu minh họa xây dựng Website bằng Laravel.', 180000.00, 20, NULL, 1),
(4, 2, 'Giáo trình cơ sở dữ liệu', 'Phạm Văn D', 'NXB Đại học Quốc gia', '2022', '9786040000004', 'Kiến thức nền tảng về thiết kế và quản lý cơ sở dữ liệu.', 95000.00, 40, NULL, 1),
(5, 3, 'Đắc nhân tâm', 'Dale Carnegie', 'NXB Tổng hợp TP.HCM', '2023', '9786040000005', 'Sách về giao tiếp và cách ứng xử trong cuộc sống.', 85000.00, 35, NULL, 1),
(6, 3, 'Tuổi trẻ đáng giá bao nhiêu', 'Rosie Nguyễn', 'NXB Hội Nhà văn', '2022', '9786040000006', 'Chia sẻ về học tập, trải nghiệm và phát triển bản thân.', 90000.00, 28, NULL, 1),
(7, 4, 'Dế Mèn phiêu lưu ký', 'Tô Hoài', 'NXB Kim Đồng', '2023', '9786040000007', 'Tác phẩm văn học thiếu nhi nổi tiếng của Việt Nam.', 70000.00, 50, NULL, 1),
(8, 4, 'Cho tôi xin một vé đi tuổi thơ', 'Nguyễn Nhật Ánh', 'NXB Trẻ', '2023', '9786040000008', 'Tác phẩm gợi nhớ về tuổi thơ và những kỷ niệm.', 80000.00, 32, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai_donhang`
--

CREATE TABLE `trang_thai_donhang` (
  `ma_trangthai` int(11) NOT NULL,
  `ten_trangthai` varchar(100) NOT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `trang_thai_donhang`
--

INSERT INTO `trang_thai_donhang` (`ma_trangthai`, `ten_trangthai`, `mo_ta`) VALUES
(1, 'Chờ xử lý', 'Đơn hàng đang chờ xác nhận'),
(2, 'Đang xử lý', 'Đơn hàng đang được chuẩn bị'),
(3, 'Hoàn thành', 'Đơn hàng đã giao thành công'),
(4, 'Đã hủy', 'Đơn hàng đã bị hủy');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD PRIMARY KEY (`ma_chitiet`),
  ADD KEY `fk_ctdh_donhang` (`ma_donhang`),
  ADD KEY `fk_ctdh_sanpham` (`ma_sanpham`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`ma_danhmuc`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ma_donhang`),
  ADD KEY `fk_donhang_khachhang` (`ma_khachhang`),
  ADD KEY `fk_donhang_trangthai` (`ma_trangthai`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ma_khachhang`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_sanpham`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `fk_sanpham_danhmuc` (`ma_danhmuc`);

--
-- Chỉ mục cho bảng `trang_thai_donhang`
--
ALTER TABLE `trang_thai_donhang`
  ADD PRIMARY KEY (`ma_trangthai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  MODIFY `ma_chitiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `ma_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ma_donhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ma_khachhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `trang_thai_donhang`
--
ALTER TABLE `trang_thai_donhang`
  MODIFY `ma_trangthai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD CONSTRAINT `fk_ctdh_donhang` FOREIGN KEY (`ma_donhang`) REFERENCES `donhang` (`ma_donhang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ctdh_sanpham` FOREIGN KEY (`ma_sanpham`) REFERENCES `sanpham` (`ma_sanpham`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_donhang_khachhang` FOREIGN KEY (`ma_khachhang`) REFERENCES `khachhang` (`ma_khachhang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donhang_trangthai` FOREIGN KEY (`ma_trangthai`) REFERENCES `trang_thai_donhang` (`ma_trangthai`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`ma_danhmuc`) REFERENCES `danh_muc` (`ma_danhmuc`) ON UPDATE CASCADE;
COMMIT;

-- --------------------------------------------------------
-- Bo sung bang gio hang va chi tiet gio hang
-- Trang thai giohang: 0 = chua thanh toan, 1 = da thanh toan
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `giohang` (
  `id_giohang` int(11) NOT NULL AUTO_INCREMENT,
  `thoigian_giohang` datetime NOT NULL DEFAULT current_timestamp(),
  `ma_khachhang` int(11) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_giohang`),
  KEY `idx_giohang_khachhang` (`ma_khachhang`),
  CONSTRAINT `fk_giohang_khachhang`
    FOREIGN KEY (`ma_khachhang`) REFERENCES `khachhang` (`ma_khachhang`)
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `chitiet_giohang` (
  `id_chitiet` int(11) NOT NULL AUTO_INCREMENT,
  `id_giohang` int(11) NOT NULL,
  `ma_sanpham` int(11) NOT NULL,
  `so_luong_mua` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_chitiet`),
  KEY `idx_ctgh_giohang` (`id_giohang`),
  KEY `idx_ctgh_sanpham` (`ma_sanpham`),
  CONSTRAINT `fk_ctgh_giohang`
    FOREIGN KEY (`id_giohang`) REFERENCES `giohang` (`id_giohang`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ctgh_sanpham`
    FOREIGN KEY (`ma_sanpham`) REFERENCES `sanpham` (`ma_sanpham`)
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Du lieu mau: cac ma khach hang 1-4 va ma san pham 1-8 da co trong file goc.
INSERT INTO `giohang` (`id_giohang`, `thoigian_giohang`, `ma_khachhang`, `trang_thai`) VALUES
  (1, '2026-10-21 10:00:00', 1, 0),
  (2, '2026-10-21 10:15:00', 2, 0),
  (3, '2026-10-21 11:00:00', 3, 1),
  (4, '2026-10-21 11:30:00', 4, 0);

INSERT INTO `chitiet_giohang` (`id_chitiet`, `id_giohang`, `ma_sanpham`, `so_luong_mua`) VALUES
  (1, 1, 1, 1),
  (2, 1, 5, 2),
  (3, 2, 3, 1),
  (4, 3, 4, 2),
  (5, 3, 2, 1),
  (6, 4, 8, 1);

ALTER TABLE `giohang` AUTO_INCREMENT = 5;
ALTER TABLE `chitiet_giohang` AUTO_INCREMENT = 7;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

