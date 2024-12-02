-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 08:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25
DROP DATABASE IF EXISTS k72_nhom33;
create database k72_nhom33;
use k72_nhom33;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_admissions`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `major_id` int(11) NOT NULL,
  `score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`score`)),
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `img_cccd` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`img_cccd`)),
  `img_hoc_ba` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`img_hoc_ba`)),
  `phone` int(10) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `review_status` enum('approved','rejected','not_reviewed') DEFAULT 'not_reviewed',
  `review_comments` text DEFAULT NULL,
  `teacher_review` varchar(255) DEFAULT NULL,
  `reviewer_by_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `program_id`, `major_id`, `score`, `status`, `img_cccd`, `img_hoc_ba`, `phone`, `address`, `review_status`, `review_comments`, `teacher_review`, `reviewer_by_id`, `created_at`) VALUES
(13, 7, 15, 8, '{\"block\":\"A00\",\"subjects\":{\"To\\u00e1n\":\"9.8\",\"L\\u00fd\":\"9\",\"H\\u00f3a\":\"10\"}}', 'approved', '[\"uploads\\/img_cccd\\/66d9b5063203c_285ceb11-bd3d-4bfa-a117-bd34337a33fc.jpg\",\"uploads\\/img_cccd\\/66d9b506322b2_572ef4d1-fa2c-4801-906f-c87e4660dc70.jpg\"]', '[\"uploads\\/img_hoc_ba\\/66d9b506324bf_3da55b93-069e-4849-a615-347a0f750593.jpg\",\"uploads\\/img_hoc_ba\\/66d9b506326ac_63dffbf5-99e8-41da-ab89-56681050e2f3.png\"]', 2147483647, 'Nam Định', 'not_reviewed', '', 'Đã tiếp nhận hồ sơ', 5, '2024-09-05 20:41:26'),
(14, 7, 15, 13, '{\"block\":\"A04\",\"subjects\":{\"To\\u00e1n\":\"8\",\"H\\u00f3a\":\"7.8\",\"Sinh\":\"9.2\"}}', 'approved', '[\"uploads\\/img_cccd\\/66d9b549231f3_55ce1f52-0487-4fea-b9b2-6cdf983fd491.jpg\",\"uploads\\/img_cccd\\/66d9b54923583_63dffbf5-99e8-41da-ab89-56681050e2f3.png\"]', '[\"uploads\\/img_hoc_ba\\/66d9b549238dd_75f62063-7a97-4e1d-9f23-f8cdac3a404e.jpg\",\"uploads\\/img_hoc_ba\\/66d9b54923d06_572ef4d1-fa2c-4801-906f-c87e4660dc70.jpg\"]', 983646728, 'Nam Định', 'not_reviewed', '', 'Đã tiếp nhận hồ sơ', 1, '2024-09-05 20:42:33'),
(16, 8, 15, 9, '{\"block\":\"A01\",\"subjects\":{\"To\\u00e1n\":\"8\",\"L\\u00fd\":\"9\",\"Anh\":\"8\"}}', 'pending', '[\"uploads\\/img_cccd\\/66ecc3277bfb3_285ceb11-bd3d-4bfa-a117-bd34337a33fc.jpg\"]', '[\"uploads\\/img_hoc_ba\\/66d9cf1ba2dcb_Screenshot 2024-07-15 124727.png\",\"uploads\\/img_hoc_ba\\/66d9cf1ba3008_Screenshot 2024-07-15 124944.png\",\"uploads\\/img_hoc_ba\\/66d9cf1ba3256_Screenshot 2024-07-15 125406.png\",\"uploads\\/img_hoc_ba\\/66d9cf1ba3461_Screenshot 2024-07-15 130158.png\",\"uploads\\/img_hoc_ba\\/66d9cf1ba3666_Screenshot 2024-07-15 134640.png\"]', 985362418, 'Nghệ An', 'not_reviewed', '', 'Ảnh CCCD sai', 5, '2024-09-05 22:32:43'),
(17, 8, 15, 11, '{\"block\":\"A01\",\"subjects\":{\"To\\u00e1n\":\"9.8\",\"L\\u00fd\":\"7.8\",\"Anh\":\"9.6\"}}', 'rejected', '[\"uploads\\/img_cccd\\/66d9cf4b774ef_Screenshot 2024-07-14 181340.png\",\"uploads\\/img_cccd\\/66d9cf4b77782_Screenshot 2024-07-15 124204.png\"]', '[\"uploads\\/img_hoc_ba\\/66d9cf4b7797b_1.png\",\"uploads\\/img_hoc_ba\\/66d9cf4b77be8_anh2.png\"]', 2147483647, 'Thanh Hóa', 'not_reviewed', '', 'admin hủy phê duyệt vì thiếu ảnh CCCD', 1, '2024-09-05 22:33:31'),
(18, 3, 15, 8, '{\"block\":\"A00\",\"subjects\":{\"To\\u00e1n\":\"9.8\",\"L\\u00fd\":\"4\",\"H\\u00f3a\":\"7.8\"}}', 'approved', '[\"uploads\\/img_cccd\\/674ac08e9ca60_gogeta-pictures-pl6i7et1iq15wop3.jpg\",\"uploads\\/img_cccd\\/674ac08e9cb48_Screenshot 2024-11-15 214627.png\"]', '[\"uploads\\/img_hoc_ba\\/674ac08e9cbd6_4d2e6c3e-e36a-4c00-a179-b132e377d7aa.jpg\",\"uploads\\/img_hoc_ba\\/674ac08e9cd1a_drb.jpg\"]', 816243725, 'Nghệ An', 'not_reviewed', '', 'Đã tiếp nhận hồ sơ', 5, '2024-11-30 14:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `exam_blocks`
--

CREATE TABLE `exam_blocks` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_blocks`
--

INSERT INTO `exam_blocks` (`id`, `code`, `name`) VALUES
(1, 'A00', 'Toán, Lý, Hóa'),
(2, 'A01', 'Toán, Lý, Anh'),
(3, 'A02', 'Toán, Lý, Sinh'),
(4, 'A03', 'Toán, Lý, GDCD'),
(5, 'A04', 'Toán, Hóa, Sinh'),
(6, 'A05', 'Toán, Hóa, GDCD'),
(7, 'A06', 'Toán, Sinh, GDCD'),
(8, 'B00', 'Toán, Sinh, Hóa'),
(9, 'B01', 'Toán, Sinh, GDCD'),
(10, 'B02', 'Toán, Sinh, Văn'),
(11, 'B03', 'Toán, Sinh, Anh'),
(12, 'C00', 'Văn, Sử, Địa'),
(13, 'C01', 'Văn, Sử, GDCD'),
(14, 'C02', 'Văn, Địa, GDCD'),
(15, 'C03', 'Văn, Địa, Anh'),
(16, 'D01', 'Văn, Anh, Toán'),
(17, 'D02', 'Văn, Anh, Hóa'),
(18, 'D03', 'Văn, Anh, Sinh'),
(19, 'D04', 'Văn, Anh, GDCD'),
(20, 'D05', 'Văn, Anh, Sử'),
(21, 'E01', 'Toán, Anh, Sử'),
(22, 'E02', 'Toán, Anh, Địa'),
(23, 'E03', 'Toán, Anh, GDCD\r\n'),
(24, 'E04', 'Toán, Anh, Sinh'),
(25, 'E05', 'Toán, Anh, Hóa'),
(26, 'M01', 'Toán, Lý, Hóa, Sinh'),
(27, 'M02', 'Toán, Lý, Hóa, GDCD'),
(28, 'M03', 'Toán, Lý, Sinh, GDCD'),
(29, 'M04', 'Văn, Sử, Địa, Anh'),
(30, 'M05', 'Văn, Sử, Địa, Toán');

-- --------------------------------------------------------

--
-- Table structure for table `exam_block_major`
--

CREATE TABLE `exam_block_major` (
  `major_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `exam_block_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_block_major`
--

INSERT INTO `exam_block_major` (`major_id`, `id`, `exam_block_id`) VALUES
(15, 28, 3),
(15, 29, 4),
(15, 30, 9),
(15, 31, 10),
(16, 32, 5),
(16, 33, 6),
(16, 34, 11),
(16, 35, 12),
(18, 40, 1),
(18, 41, 2),
(18, 42, 5),
(18, 43, 6),
(19, 44, 3),
(19, 45, 4),
(19, 46, 7),
(19, 47, 8),
(20, 48, 5),
(20, 49, 6),
(20, 50, 9),
(20, 51, 10),
(21, 52, 11),
(21, 53, 12),
(21, 54, 13),
(21, 55, 14),
(22, 56, 1),
(22, 57, 3),
(22, 58, 5),
(22, 59, 6),
(23, 60, 2),
(23, 61, 4),
(23, 62, 7),
(23, 63, 8),
(24, 64, 7),
(24, 65, 8),
(24, 66, 10),
(24, 67, 11),
(25, 68, 9),
(25, 69, 10),
(25, 70, 12),
(25, 71, 13),
(26, 72, 13),
(26, 73, 14),
(26, 74, 15),
(26, 75, 16),
(17, 88, 1),
(17, 89, 2),
(17, 90, 3),
(17, 91, 4),
(31, 93, 1),
(30, 95, 1),
(11, 107, 1),
(11, 108, 2),
(14, 117, 1),
(14, 118, 2),
(14, 119, 7),
(14, 120, 8),
(9, 131, 1),
(9, 132, 2),
(10, 133, 1),
(10, 134, 2),
(12, 135, 1),
(12, 136, 2),
(12, 137, 3),
(12, 138, 4),
(13, 139, 1),
(13, 140, 2),
(13, 141, 5),
(13, 142, 6),
(8, 153, 1),
(8, 154, 2);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `industry_code` varchar(250) NOT NULL,
  `ten_nganh` varchar(250) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_major` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `industry_code`, `ten_nganh`, `description`, `img_major`, `created_at`, `updated_at`) VALUES
(8, 'CNTT', 'Công nghệ thông tin Việt-Nhật', 'Ngành công nghệ định hướng việt nhật ', 'uploads/majors/66d6b45ec5962_imgtuyensinh.png', '2024-08-28 20:46:00', '2024-08-28 20:46:16'),
(9, 'IT01', 'Ngành Công Nghệ Thông Tin', 'Chuyên ngành về công nghệ thông tin và phần mềm.', 'uploads/majors/66d16de6bd50d_cntta.jfif', '2024-08-28 21:05:33', '2024-08-28 21:05:33'),
(10, 'ET01', 'Ngành Điện Tử Viễn Thông', 'Chuyên ngành về điện tử và viễn thông.', 'uploads/majors/66d16df24eaa2_dientuvienthong.jfif', '2024-08-28 21:05:33', '2024-08-28 21:05:33'),
(11, 'CS01', 'Ngành Khoa Học Máy Tính', 'Chuyên ngành về khoa học máy tính và toán học.', 'uploads/majors/66d144126789c_c520a177-1cf5-42f3-899e-5e8f5483d81e.png', '2024-08-28 21:05:33', '2024-08-28 21:05:33'),
(12, 'EN01', 'Ngành Kỹ Thuật Xây Dựng', 'Chuyên ngành về kỹ thuật xây dựng và quản lý công trình.', 'uploads/majors/66d16e03aaafa_download.jfif', '2024-08-28 21:17:48', '2024-08-28 21:17:48'),
(13, 'ME01', 'Ngành Cơ Khí', 'Chuyên ngành về cơ khí và kỹ thuật cơ khí.', 'uploads/majors/66d16e1675148_khmt.jfif', '2024-08-28 21:17:48', '2024-08-28 21:17:48'),
(14, 'AR01', 'Ngành Kiến Trúc', 'Chuyên ngành về thiết kế kiến trúc và xây dựng.', 'uploads/majors/66d144371e0c9_c98ca234-b0d0-4670-9b3d-5bf5712bab83.jpg', '2024-08-28 21:17:48', '2024-08-28 21:17:48'),
(15, 'BI01', 'Ngành Sinh Học', 'Chuyên ngành về sinh học và công nghệ sinh học.', NULL, '2024-08-28 21:17:48', '2024-08-28 21:17:48'),
(16, 'EC01', 'Ngành Kinh Tế', 'Chuyên ngành về kinh tế và quản trị doanh nghiệp.', NULL, '2024-08-28 21:17:48', '2024-08-28 21:17:48'),
(17, 'PH01', 'Ngành Vật Lý', 'Chuyên ngành về vật lý và ứng dụng trong kỹ thuật.', '', '2024-08-28 21:18:46', '2024-08-28 21:18:46'),
(18, 'CH01', 'Ngành Hóa Học', 'Chuyên ngành về hóa học và công nghệ hóa học.', NULL, '2024-08-28 21:18:46', '2024-08-28 21:18:46'),
(19, 'MA01', 'Ngành Toán Học', 'Chuyên ngành về toán học và ứng dụng toán học.', NULL, '2024-08-28 21:18:46', '2024-08-28 21:18:46'),
(20, 'PH02', 'Ngành Kỹ Thuật Hóa Học', 'Chuyên ngành về kỹ thuật hóa học và quản lý sản xuất.', NULL, '2024-08-28 21:18:46', '2024-08-28 21:18:46'),
(21, 'ED01', 'Ngành Giáo Dục', 'Chuyên ngành về giáo dục và quản lý giáo dục.', NULL, '2024-08-28 21:18:46', '2024-08-28 21:18:46'),
(22, 'AR01', 'Ngành Kiến Trúc', 'Chuyên ngành về thiết kế kiến trúc và xây dựng.', NULL, '2024-08-28 21:20:02', '2024-08-28 21:20:02'),
(23, 'ME01', 'Ngành Cơ Khí', 'Chuyên ngành về cơ khí và công nghệ chế tạo máy.', NULL, '2024-08-28 21:20:02', '2024-08-28 21:20:02'),
(24, 'AE01', 'Ngành Kỹ Thuật Ô Tô', 'Chuyên ngành về kỹ thuật ô tô và công nghệ sửa chữa.', NULL, '2024-08-28 21:20:02', '2024-08-28 21:20:02'),
(25, 'ED02', 'Ngành Sư Phạm', 'Chuyên ngành về sư phạm và giáo dục trẻ em.', NULL, '2024-08-28 21:20:02', '2024-08-28 21:20:02'),
(26, 'BI01', 'Ngành Sinh Học', 'Chuyên ngành về sinh học và nghiên cứu môi trường.', NULL, '2024-08-28 21:20:02', '2024-08-28 21:20:02'),
(30, 'test', 'dsasf', 'hh', 'uploads/majors/66d14374eae1d_k.png', '2024-08-30 10:22:59', '2024-08-30 10:22:59'),
(31, 'CNTT001a', 'admission score', 'b', 'uploads/majors/66d140b43abd6_3.png', '2024-08-30 10:23:42', '2024-08-30 10:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `application_id`, `message`, `is_read`, `created_at`) VALUES
(29, 7, 13, 'Điểm trúng tuyển cho chương trình đã được cập nhật. Vui lòng kiểm tra.', 1, '2024-09-05 20:44:40'),
(30, 7, 14, 'Hồ sơ của bạn đã được duyệt', 0, '2024-09-05 20:51:32'),
(31, 7, 13, 'Hồ sơ của bạn đã được duyệt', 0, '2024-09-05 20:55:23'),
(33, 8, 16, 'Hồ sơ của bạn đã bị từ chối. Lý do: Ảnh CCCD sai', 0, '2024-09-05 22:34:24'),
(34, 8, 17, 'Hồ sơ của bạn đã bị từ chối. Lý do: Ảnh CCCD bị mờ', 0, '2024-11-25 23:40:27'),
(35, 7, 14, 'Hồ sơ của bạn đã bị từ chối. Lý do: lỗi', 0, '2024-11-26 00:27:32'),
(36, 7, 14, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:29:44'),
(37, 7, 14, 'Hồ sơ của bạn đã bị từ chối. Lý do: Lõi ảnh admin check', 0, '2024-11-26 00:33:09'),
(38, 7, 14, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:48:19'),
(39, 7, 14, 'Hồ sơ của bạn đã bị từ chối. Lý do: admin ko duyệt', 0, '2024-11-26 00:48:34'),
(40, 7, 14, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:50:28'),
(41, 7, 14, 'Hồ sơ của bạn đã bị từ chối. Lý do: admin ko duyệt', 0, '2024-11-26 00:51:11'),
(42, 7, 14, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:51:21'),
(43, 8, 17, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:51:30'),
(44, 8, 17, 'Hồ sơ của bạn đã bị từ chối. Lý do: adin ko duyệt', 0, '2024-11-26 00:51:44'),
(45, 7, 14, 'Hồ sơ của bạn đã bị từ chối. Lý do: ko nha', 0, '2024-11-26 00:53:13'),
(46, 7, 14, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:53:21'),
(47, 8, 17, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-26 00:53:28'),
(48, 8, 17, 'Hồ sơ của bạn đã bị từ chối. Lý do: admin hủy phê duyệt vì thiếu ảnh CCCD', 0, '2024-11-26 00:53:51'),
(51, 3, 18, 'Hồ sơ của bạn đã được duyệt', 0, '2024-11-30 14:37:07'),
(52, 7, 14, 'Điểm trúng tuyển cho chương trình đã được cập nhật. Vui lòng kiểm tra.', 0, '2024-11-30 14:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `year`, `start_date`, `end_date`, `status`) VALUES
(7, 'Tuyển sinh đại học -2023\r\n', 2023, '2023-08-29', '2023-11-29', 'inactive'),
(14, 'Tuyển sinh đại học -2022', 2022, '2022-07-22', '2022-09-22', 'inactive'),
(15, 'Tuyển sinh đại học -2024', 2024, '2024-09-09', '2025-01-09', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `program_majors`
--

CREATE TABLE `program_majors` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `cut_off_score` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_majors`
--

INSERT INTO `program_majors` (`id`, `program_id`, `major_id`, `cut_off_score`, `status`) VALUES
(114, 7, 8, NULL, 'inactive'),
(115, 7, 9, NULL, 'inactive'),
(116, 7, 10, NULL, 'inactive'),
(117, 7, 11, NULL, 'inactive'),
(118, 7, 12, NULL, 'inactive'),
(119, 7, 13, NULL, 'inactive'),
(120, 7, 14, NULL, 'inactive'),
(121, 7, 15, NULL, 'inactive'),
(122, 7, 16, NULL, 'inactive'),
(123, 7, 17, NULL, 'inactive'),
(124, 7, 18, NULL, 'inactive'),
(125, 7, 19, NULL, 'inactive'),
(126, 7, 20, NULL, 'inactive'),
(127, 7, 21, NULL, 'inactive'),
(128, 7, 22, NULL, 'inactive'),
(129, 7, 23, NULL, 'inactive'),
(130, 7, 24, NULL, 'inactive'),
(131, 7, 25, NULL, 'inactive'),
(132, 7, 26, NULL, 'inactive'),
(133, 7, 30, NULL, 'inactive'),
(134, 7, 31, NULL, 'inactive'),
(261, 14, 8, NULL, 'inactive'),
(262, 14, 9, NULL, 'inactive'),
(263, 14, 10, NULL, 'inactive'),
(264, 14, 11, NULL, 'inactive'),
(265, 14, 12, NULL, 'inactive'),
(266, 14, 13, NULL, 'inactive'),
(267, 14, 14, NULL, 'inactive'),
(268, 14, 15, NULL, 'inactive'),
(269, 14, 16, NULL, 'inactive'),
(270, 14, 17, NULL, 'inactive'),
(271, 14, 18, NULL, 'inactive'),
(272, 14, 19, NULL, 'inactive'),
(273, 14, 20, NULL, 'inactive'),
(274, 14, 21, NULL, 'inactive'),
(275, 14, 22, NULL, 'inactive'),
(276, 14, 23, NULL, 'inactive'),
(277, 14, 24, NULL, 'inactive'),
(278, 14, 25, NULL, 'inactive'),
(279, 14, 26, NULL, 'inactive'),
(280, 14, 30, NULL, 'inactive'),
(281, 14, 31, NULL, 'inactive'),
(282, 15, 8, '{\"A00 - To\\u00e1n, L\\u00fd, H\\u00f3a\":\"27\",\"A01 - To\\u00e1n, L\\u00fd, Anh\":\"29.8\"}', 'active'),
(283, 15, 9, NULL, 'inactive'),
(284, 15, 10, NULL, 'active'),
(285, 15, 11, NULL, 'active'),
(286, 15, 12, NULL, 'active'),
(287, 15, 13, '{\"A00 - To\\u00e1n, L\\u00fd, H\\u00f3a\":\"27\",\"A01 - To\\u00e1n, L\\u00fd, Anh\":\"28\",\"A04 - To\\u00e1n, H\\u00f3a, Sinh\":\"25\",\"A05 - To\\u00e1n, H\\u00f3a, GDCD\":\"29\"}', 'active'),
(288, 15, 14, NULL, 'active'),
(289, 15, 15, NULL, 'active'),
(290, 15, 16, NULL, 'active'),
(291, 15, 17, NULL, 'active'),
(292, 15, 18, NULL, 'active'),
(293, 15, 19, NULL, 'active'),
(294, 15, 20, NULL, 'active'),
(295, 15, 21, NULL, 'active'),
(296, 15, 22, NULL, 'active'),
(297, 15, 23, NULL, 'active'),
(298, 15, 24, NULL, 'active'),
(299, 15, 25, NULL, 'active'),
(300, 15, 26, NULL, 'active'),
(301, 15, 30, NULL, 'active'),
(302, 15, 31, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assignment`
--

CREATE TABLE `teacher_assignment` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_assignment`
--

INSERT INTO `teacher_assignment` (`id`, `teacher_id`, `major_id`, `assigned_at`) VALUES
(15, 5, 8, '2024-08-29 02:32:45'),
(16, 5, 9, '2024-08-29 02:32:45'),
(17, 5, 10, '2024-08-29 02:32:45'),
(24, 2, 13, '2024-08-29 15:55:50'),
(25, 2, 12, '2024-08-29 15:55:50'),
(26, 2, 11, '2024-08-29 15:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hashpassword` varchar(250) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL,
  `img_user` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `hashpassword`, `role`, `img_user`, `created_at`) VALUES
(1, 'Nguyễn Trọng ', 'stu715105224@hnue.edu.vn', 'admin123', '$2y$10$8fUiReUDtYFVZWz6CoskFuo/vUPtYb1hKVB84bSrGhAtsvwqfcT4i', 'admin', '/uploads/img_users/user-no-avatar.jpg', '2024-08-28 08:09:35'),
(2, 'Nguyễn Minh Trang', 'teacher2@gmail.com', '12345678', '$2y$10$F29msVhJb0QSXAe.7NWleeMzVSKyY54akgCJ6JhcFRk2vLMUXRB1.', 'teacher', 'uploads/img_users/d04cc2ba-bdd3-4a05-854f-bc1760d4a3fe.jpg', '2024-08-28 08:16:22'),
(3, 'hoanhango NguyenLong', 'user1@gmail.com', '12345678', '$2y$10$Irez.RaYT0N3gevMCw6P6ueISMkKHsZk2J3Iunpj5SWT8AIe4KVAm', 'student', 'uploads/img_users/4d2e6c3e-e36a-4c00-a179-b132e377d7aa.jpg', '2024-08-28 08:30:20'),
(5, 'Nguyễn Trọng ', 'teacher1@gmail.com', '12345678', '$2y$10$KHGO/R16HiNxATnDwahvxur0zktvZeeb6pWFl8MI82wtVDsVmSx0C', 'teacher', 'uploads/img_users/drb.jpg', '2024-08-28 16:17:33'),
(6, 'Trần Linh', 'teacher3@gmail.com', '123456', '$2y$10$9t4kd9dfsWBBBw49tZkrO.2zk8Hx7PctXpC1cFBpghxSIHnbrzRve', 'teacher', 'uploads/img_users/f2e206c2-4f09-46b5-a026-f7102cb7ef6c.jpg', '2024-08-28 16:18:11'),
(7, 'Trần Long', 'user2@gmail.com', '12345678a', '$2y$10$TXAzJZ29Mdo6KvL2Y1iAru3/wU/cCncf9PtoOjH9xI2alFzY4AG0G', 'student', 'uploads/img_users/7e95eeea-f7a0-4a68-a3f5-8e5b8141db51.jpg', '2024-09-05 10:08:25'),
(8, 'Minh Quang', 'user3@gmail.com', '12345678', '$2y$10$WOtVvD8MFJJhDEIK8e29nuDtMdxwM.ylPg9gkW2n3o07YEDNc8hrK', 'student', '/uploads/img_users/user-no-avatar.jpg', '2024-09-05 15:31:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `reviewer_id` (`reviewer_by_id`);

--
-- Indexes for table `exam_blocks`
--
ALTER TABLE `exam_blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `exam_block_major`
--
ALTER TABLE `exam_block_major`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_block_id` (`exam_block_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_majors`
--
ALTER TABLE `program_majors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `teacher_assignment`
--
ALTER TABLE `teacher_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exam_blocks`
--
ALTER TABLE `exam_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `exam_block_major`
--
ALTER TABLE `exam_block_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `program_majors`
--
ALTER TABLE `program_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `teacher_assignment`
--
ALTER TABLE `teacher_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`reviewer_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `exam_block_major`
--
ALTER TABLE `exam_block_major`
  ADD CONSTRAINT `exam_block_major_ibfk_1` FOREIGN KEY (`exam_block_id`) REFERENCES `exam_blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_block_major_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_majors`
--
ALTER TABLE `program_majors`
  ADD CONSTRAINT `program_majors_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `program_majors_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_assignment`
--
ALTER TABLE `teacher_assignment`
  ADD CONSTRAINT `teacher_assignment_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_assignment_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
