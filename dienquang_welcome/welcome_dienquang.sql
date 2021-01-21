-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 03:31 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welcome_dienquang`
--

-- --------------------------------------------------------

--
-- Table structure for table `thumbnail`
--

CREATE TABLE `thumbnail` (
  `id` int(11) NOT NULL,
  `thumbnail_link` text DEFAULT NULL,
  `embed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thumbnail`
--

INSERT INTO `thumbnail` (`id`, `thumbnail_link`, `embed_id`) VALUES
(1, '/upload/thumbnail_big-vid.png', 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$6DnkfgOVhkB2QSSUIqQz9uCDraP.eJX7vTdahma0G0285jLwq4DGO');

-- --------------------------------------------------------

--
-- Table structure for table `web_content`
--

CREATE TABLE `web_content` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_content`
--

INSERT INTO `web_content` (`id`, `name`, `content`, `type`) VALUES
(1, 'logo_1', '/upload/left-nav-dienquang.png', 2),
(2, 'logo_2', '/upload/VietNam-Value-logo.png', 2),
(3, 'slogan_here', 'TỰ HÀO THƯƠNG HIỆU VIỆT NAM', 1),
(4, 'introduce', 'Điện Quang được thành lập từ năm 1973, là Thương Hiệu Quốc gia duy nhất trong ngành chiếu sáng; đang chuyển mình mạnh mẽ theo định hướng trở thành tập đoàn công nghệ đa quốc gia chuyên sâu trong lĩnh vực chiếu sáng, thiết bị điện và điều khiển thông minh.', 1),
(5, 'more', 'Lorem ipsum dolor sit amet Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci. Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci. Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.', 1),
(6, 'nav_1_trang_chu', 'Trang chủ', 1),
(7, 'nav_2_ngon_ngu', 'Ngôn ngữ', 1),
(8, 'nav_3_lien_he', 'Liên hệ', 1),
(9, 'company_name', 'CÔNG TY CỔ PHẦN BÓNG ĐÈN ĐIỆN QUANG', 1),
(10, 'address', '125 Hàm Nghi, Phường Nguyễn Thái Bình, Quận 1, Hồ Chí Minh', 1),
(11, 'hotline', 'hotline', 19001257),
(12, 'email', 'info@dienquang.com', 1),
(13, 'website', 'https://dienquang.com', 1),
(14, 'introduce_en', 'Dien Quang was established in 1973, is the only National Brand in the lighting industry; is transforming strongly towards becoming a multinational technology corporation specializing in lighting, electrical equipment and smart control.', 1),
(15, 'more_en', 'Lorem ipsum dolor sit amet Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci. Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt quia eveniet cumque neque, distinctio tempora excepturi voluptatum modi veritatis animi pariatur cum perspiciatis ullam facilis commodi quos blanditiis nam adipisci. Aperiam qui rerum a atque! Obcaecati magni dolorum rem repellendus sit suscipit reiciendis necessitatibus, quidem corrupti exercitationem vel nulla dolorem repellat autem nobis laudantium earum natus quo. Nemo, alias maxime.', 1),
(16, 'embed', 'https://www.youtube.com/embed/5mhasaD8jzg', 3),
(18, 'logo_3', '/upload/95bd6d6.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `thumbnail`
--
ALTER TABLE `thumbnail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_content`
--
ALTER TABLE `web_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `thumbnail`
--
ALTER TABLE `thumbnail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_content`
--
ALTER TABLE `web_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
