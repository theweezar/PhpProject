-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 14, 2019 lúc 06:11 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctgh`
--

CREATE TABLE `ctgh` (
  `mgh` varchar(100) NOT NULL,
  `mh` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `ctgh`
--

INSERT INTO `ctgh` (`mgh`, `mh`, `soluong`) VALUES
('mgh1', 'ts01', 3),
('mgh1', 'ts03', 2),
('mgh1', 'ts07', 2),
('mgh1', 'ts09', 5),
('mgh2', 'ts01', 5),
('mgh2', 'ts03', 2),
('mgh2', 'ts09', 4),
('mgh2', 'ts05', 2),
('mgh2', 'ts07', 3),
('mgh2', 'ts04', 1),
('mgh3', 'ts01', 1),
('mgh4', 'ts02', 2),
('mgh4', 'ts04', 2),
('mgh4', 'ts03', 1),
('mgh5', 'ts01', 1),
('mgh5', 'ts07', 2),
('mgh5', 'ts04', 1),
('mgh5', 'ts08', 1),
('mgh6', 'ts02', 3),
('mgh6', 'ts08', 2),
('mgh6', 'ts07', 2),
('mgh7', 'ts05', 2),
('mgh7', 'ts07', 2),
('mgh7', 'ts03', 1),
('mgh7', 'ts09', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `mgh` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pay` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`mgh`, `username`, `pay`) VALUES
('mgh1', 'dai', 1),
('mgh2', 'admin', 1),
('mgh3', 'admin', 1),
('mgh4', 'admin', 1),
('mgh5', 'admin', 1),
('mgh6', 'dai', 0),
('mgh7', 'admin', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `mahd` varchar(100) NOT NULL,
  `mgh` varchar(100) NOT NULL,
  `thanhtien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `mgh`, `thanhtien`) VALUES
('hd1', 'mgh2', 32112),
('hd2', 'mgh3', 1000),
('hd3', 'mgh4', 14900),
('hd4', 'mgh1', 23390),
('hd5', 'mgh5', 12200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trasua`
--

CREATE TABLE `trasua` (
  `mh` varchar(100) NOT NULL,
  `tenh` text NOT NULL,
  `gia` int(11) NOT NULL,
  `con` tinyint(1) NOT NULL,
  `hinh` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `trasua`
--

INSERT INTO `trasua` (`mh`, `tenh`, `gia`, `con`, `hinh`) VALUES
('ts01', 'Tra Sua H&C', 1000, 1, 'p1.png'),
('ts02', 'Hong Tra Machiato', 5000, 1, 'p8.png'),
('ts03', 'Tra Dao', 1500, 1, 'p11.png'),
('ts04', 'Tra Dao Sa', 1700, 1, 'p12.png'),
('ts05', 'Tra Sua Thach Dua', 2500, 1, 'p6.png'),
('ts06', 'Tra Sua Chan Chau Hong', 2000, 1, 'p5.png'),
('ts07', 'Tra Sua Thai', 2500, 1, 'p4_love.png'),
('ts08', 'Tra sua chan chau duong den', 4500, 1, 'p15.png'),
('ts09', 'Hong tra nho', 2478, 1, 'p9.png'),
('ts10', 'Tra chanh', 1700, 1, 'p2.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `sdt` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `client` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `password`, `fname`, `sdt`, `email`, `client`) VALUES
('admin', 'admin', 'Mai Ngoc Huy', '0924508367', 'poohpro99@gmail.com', 0),
('dai', 'dai', 'Phan Dai', '91923', 'di@mg.com', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ctgh`
--
ALTER TABLE `ctgh`
  ADD KEY `mgh` (`mgh`),
  ADD KEY `mh` (`mh`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`mgh`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahd`),
  ADD KEY `mgh` (`mgh`);

--
-- Chỉ mục cho bảng `trasua`
--
ALTER TABLE `trasua`
  ADD PRIMARY KEY (`mh`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `sdt` (`sdt`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ctgh`
--
ALTER TABLE `ctgh`
  ADD CONSTRAINT `ctgh_ibfk_1` FOREIGN KEY (`mgh`) REFERENCES `giohang` (`mgh`),
  ADD CONSTRAINT `ctgh_ibfk_2` FOREIGN KEY (`mh`) REFERENCES `trasua` (`mh`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`mgh`) REFERENCES `giohang` (`mgh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
