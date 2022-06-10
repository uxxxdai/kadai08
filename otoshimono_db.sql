-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2022 at 12:24 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otoshimono_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `otoshimono_table`
--

CREATE TABLE `otoshimono_table` (
  `id` int(12) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `hinmei` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `delete_flag` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otoshimono_table`
--

INSERT INTO `otoshimono_table` (`id`, `file_name`, `file_path`, `hinmei`, `color`, `size`, `brand`, `description`, `insert_date`, `update_date`, `latitude`, `longitude`, `delete_flag`) VALUES
(71, '7f505dcb-p.jpg', 'images/202206030404347f505dcb-p.jpg', '人形', '', '', '', '公園のベンチにそのまま置いてきました', '2022-06-03 13:04:34', '2022-06-09 19:05:37', '35.6590', '139.7217', 0),
(72, '2022060903335420220603040558shutterstock_662409262.jpg', 'images/202206090404042022060903335420220603040558shutterstock_662409262.jpg', '財布', '黒', '普通', 'プラダ', '麹町警察に届けた', '2022-06-03 13:05:58', '2022-06-09 19:14:02', '35.67', '139.73', 0),
(73, '落とし物.jpg', 'images/20220603041243落とし物.jpg', 'お金', '', '', '', 'とりあえず家に持ち帰りました。', '2022-06-03 13:12:43', '2022-06-08 13:08:39', '36.6590242', '139.9017861', 1),
(74, '落とし物.jpg', 'images/20220604041356落とし物.jpg', 'ddd', '', '', '', 'ddd', '2022-06-04 13:13:56', '2022-06-08 13:08:37', '35.6691299', '139.7029154', 1),
(75, 'shutterstock_662409262.jpg', 'images/20220604065501shutterstock_662409262.jpg', 'さいふ', '', '', '', 'もってかえりました', '2022-06-04 15:55:01', '2022-06-08 13:05:09', '35.6691267', '139.7028992', 1),
(76, 'pushpin2.png', 'images/20220607105757pushpin2.png', 'pushpin', 'あお', 'ちいさい', '不明', 'そのまま放置', '2022-06-07 19:57:57', '2022-06-08 13:03:16', '35.6590242', '139.7217861', 1),
(77, 'pushpin2.png', 'images/20220608035417pushpin2.png', 'ddd', '', '', '', 'ddd', '2022-06-08 12:54:17', '2022-06-08 13:04:21', '35.6590242', '139.7217861', 1),
(78, '20220603041243落とし物.jpg', 'images/2022060910041120220603041243落とし物.jpg', 'お金', '5万円', '', '', 'とりあえず持ち帰りました。', '2022-06-09 13:07:50', '2022-06-09 19:06:11', '35.66', '139.7', 0),
(79, 'jimen-no-fan_1000.jpg', 'images/20220609100840jimen-no-fan_1000.jpg', 'バナナの皮', '黄色黒', '', '', 'そのままにしました。', '2022-06-09 19:08:40', '2022-06-09 19:12:25', '35.6614682', '139.7295799', 0),
(80, 'sekishiro-special-01ss.jpg', 'images/20220609100950sekishiro-special-01ss.jpg', 'Suica', '普通のいろ', '', '', '六本木ヒルズの受付に届けました', '2022-06-09 19:09:50', '2022-06-09 19:12:32', '35.6604200', '139.7395666', 0),
(81, 'sekishiro-special-02.jpg', 'images/20220609101019sekishiro-special-02.jpg', '水菜', 'みどり', '', '', '持って帰って食べるところです。', '2022-06-09 19:10:19', '2022-06-09 19:12:41', '35.6604682', '139.7298300', 0),
(82, 'sekishiro-special-02.jpg', 'images/20220610001512sekishiro-special-02.jpg', 'ddd', '', '', '', 'dd', '2022-06-10 09:15:12', '2022-06-10 09:15:40', '35.6603992', '139.7295617', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otoshimono_table`
--
ALTER TABLE `otoshimono_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otoshimono_table`
--
ALTER TABLE `otoshimono_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
