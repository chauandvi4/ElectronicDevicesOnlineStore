-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 07:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `image_url` text DEFAULT NULL,
  `status` text NOT NULL,
  `category` text NOT NULL,
  `rate` int(11) NOT NULL,
  `freeShip` tinyint(1) NOT NULL,
  `height` float NOT NULL,
  `length` float NOT NULL,
  `weight` float NOT NULL,
  `width` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `status`, `category`, `rate`, `freeShip`, `height`, `length`, `weight`, `width`, `created_at`, `updated_at`) VALUES
(1, 'Apple Watch Series 5', 'Where does it come from?\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 10000000, 'https://www.trumiwatch.vn/wp-content/uploads/2020/08/Apple-Watch-Series-5-Vang-Hong.jpg', 'In Stock', 'Watch', 4, 1, 50, 20, 1000, 20, '2021-11-13 03:36:25', '2021-11-19 01:17:34'),
(2, 'iPhone 13 Pro Max', 'Nội dung tính năng\niPhone 13 Pro Max. Một nâng cấp hệ thống camera chuyên nghiệp hoành tráng chưa từng có. Màn hình Super Retina XDR với ProMotion cho cảm giác nhanh nhạy hơn. Chip A15 Bionic thần tốc. Mạng 5G siêu nhanh.1 Thiết kế bền bỉ và thời lượng pin dài nhất từng có trên iPhone.2\n\nPháp lý\n1Cần có gói cước dữ liệu. Mạng 5G chỉ khả dụng ở một số thị trường và được cung cấp qua một số nhà mạng. Tốc độ có thể thay đổi tùy địa điểm và nhà mạng. Để biết thông tin về hỗ trợ mạng 5G, vui lòng liên hệ nhà mạng và truy cập apple.com/iphone/cellular.\n\n2Thời lượng pin khác nhau tùy theo cách sử dụng và cấu hình. Truy cập apple.com/batteries để biết thêm thông tin. \n\nDung Lượng Lưu Trữ: Dung lượng khả dụng nhỏ hơn và có thể thay đổi do nhiều yếu tố. Cấu hình tiêu chuẩn sử dụng khoảng 11GB đến 14GB dung lượng (bao gồm iOS và các ứng dụng cài sẵn) tùy vào dòng sản phẩm và cài đặt. Các ứng dụng cài sẵn chiếm khoảng 4GB, và bạn có thể xóa các ứng dụng này và phục hồi lại chúng. Dung lượng lưu trữ có thể thay đổi tùy phiên bản phần mềm và có thể khác nhau tùy theo từng thiết bị.', 33990000, 'https://cdn.tgdd.vn/Products/Images/42/230529/s16/iphone-13-pro-max-grey-650x650.png', 'Pre-Order', 'iPhone', 5, 1, 50, 20, 1000, 20, '2021-11-14 06:07:34', '2021-11-19 01:17:49'),
(3, 'iPhone 13', 'Nội dung tính năng\niPhone 13. Hệ thống camera kép tiên tiến nhất từng có trên iPhone. Chip A15 Bionic thần tốc. Bước nhảy vọt về thời lượng pin. Thiết kế bền bỉ. Mạng 5G siêu nhanh.1 Cùng với màn hình Super Retina XDR sáng hơn.\n\nPháp lý\n1Cần có gói cước dữ liệu. Mạng 5G chỉ khả dụng ở một số thị trường và được cung cấp qua một số nhà mạng. Tốc độ có thể thay đổi tùy địa điểm và nhà mạng. Để biết thông tin về hỗ trợ mạng 5G, vui lòng liên hệ nhà mạng và truy cập apple.com/iphone/cellular.', 24990000, 'https://cdn.tgdd.vn/Products/Images/42/223602/s16/iphone-13-blue-650x650.png', 'Pre-Order', 'iPhone', 3, 0, 50, 20, 1000, 20, '2021-11-14 06:08:47', '2021-11-19 01:18:02'),
(4, 'MacBook Pro 16 inch M1 Pro 2021', 'Công nghệ CPU:\nApple M1 Pro - Hãng không công bố\nSố nhân:\n10\nSố luồng:\nHãng không công bố\nTốc độ CPU:\n200GB/s memory bandwidth\nTốc độ tối đa:\nHãng không công bố\nBộ nhớ đệm:\nHãng không công bố', 69990000, 'https://cdn.tgdd.vn/Products/Images/44/253706/s16/macbook-pro-16-m1-pro-2021-xam-650x650.png', 'Out Of Stock', 'Mac', 4, 0, 50, 20, 1000, 20, '2021-11-14 06:28:03', '2021-11-19 01:18:15'),
(5, 'MacBook Pro 14 inch M1 Pro 2021', 'Công nghệ CPU:\nApple M1 Pro - Hãng không công bố\nSố nhân:\n10\nSố luồng:\nHãng không công bố\nTốc độ CPU:\n200GB/s memory bandwidth\nTốc độ tối đa:\nHãng không công bố\nBộ nhớ đệm:\nHãng không công bố', 64990000, 'https://cdn.tgdd.vn/Products/Images/44/253703/s16/apple-macbook-pro-14-m1-pro-2021-xam-thumb-650x650.png', 'In Stock', 'Mac', 5, 1, 50, 20, 1000, 20, '2021-11-14 06:29:01', '2021-11-19 01:18:45'),
(6, 'iPad Pro M1 12.9 inch WiFi + Cellular', 'Nội dung về tính năng\niPad Pro sở hữu chip Apple M1 mạnh mẽ, vươn tầm hiệu năng đẳng cấp mới cùng thời lượng pin bền bỉ cả ngày1. Màn hình Liquid Retina XDR 12.9 inch sống động để xem, chỉnh sửa video và hình ảnh HDR2. Các phiên bản hỗ trợ Cellular giúp bạn duy trì đường truyền ổn định ngay khi không có Wi-Fi3. Đồng thời, camera trước với tính năng Trung Tâm Sân Khấu sẽ tự động canh chỉnh để bạn luôn ở giữa khung hình trong suốt cuộc gọi video. iPad Pro sở hữu hệ camera chuyên nghiệp và LiDAR Scanner giúp bạn chụp ảnh và quay video tuyệt đẹp, cũng như trải nghiệm công nghệ thực tế ảo tăng cường sống động. Cổng Thunderbolt kết nối với các phụ kiện hiệu năng cao. Bạn có thể sử dụng thêm Apple Pencil để ghi chú, vẽ và đánh dấu tài liệu, còn Magic Keyboard sẽ mang lại cho bạn trải nghiệm bàn di và gõ phím nhanh nhạy4.\n\nTính năng nổi bật\n• Chip Apple M1 nâng hiệu suất lên một đẳng cấp mới.\n\n• Màn hình Liquid Retina XDR 12.9 inch lộng lẫy2 với ProMotion, True Tone và dải màu rộng P3.\n\n• Hệ thống camera TrueDepth với camera trước Ultra Wide tích hợp tính năng Trung Tâm Sân Khấu.\n\n• Camera Wide 12MP, camera Ultra Wide 10MP và LiDAR Scanner cho trải nghiệm thực tế ảo tăng cường sống động.\n\n• Luôn kết nối với Wi-Fi 6 siêu nhanh và mạng LTE3.\n\n• Làm được nhiều việc hơn với thời lượng pin bền bỉ cả ngày1.\n\n• Cổng Thunderbolt cho kết nối nhanh với bộ nhớ ngoài, màn hình và dock.\n\n• Xác thực bảo mật với Face ID.\n\n• Bốn loa âm thanh và năm micro chuẩn studio.\n\n• Hỗ trợ Apple Pencil (thế hệ thứ 2), Magic Keyboard và Smart Keyboard Folio4.\n\n• iPadOS mạnh mẽ, trực quan và được thiết kế riêng cho iPad.\n\n• Hơn 1 triệu ứng dụng trên App Store dành riêng cho iPad.\n\nPháp lý\nỨng dụng có sẵn trên App Store. Nội dung được cung cấp có thể thay đổi. \n\n1Thời lượng pin khác nhau tùy theo cách sử dụng và cấu hình. Truy cập apple.com/batteries để biết thêm thông tin.\n\n2Màn hình có các góc bo tròn. Khi tính theo hình chữ nhật, kích thước màn hình iPad Pro 12.9 inch \nlà 12.9 inch theo đường chéo. Diện tích hiển thị thực tế nhỏ hơn.\n\n3Cần có gói cước dữ liệu. Liên hệ với nhà mạng tại thị trường của bạn để biết thêm chi tiết. Tốc độ có thể thay đổi tùy địa điểm.\n\n4Phụ kiện được bán riêng. Khả năng tương thích tùy thuộc thế hệ sản phẩm.', 36290000, 'https://cdn.tgdd.vn/Products/Images/522/238649/s16/ipad-pro-m1-129-inch-wifi-cellular-gray-650x650.png', 'Out Of Stock', 'iPad', 3, 0, 50, 20, 1000, 20, '2021-11-14 06:30:00', '2021-11-19 01:18:28'),
(8, 'test', 'dad', 123, 'https://web.quangtuan.me/images/61a3c9d9106b27.50322451.jpg', 'In Stock', 'iPhone', 5, 0, 0, 0, 0, 0, '2021-11-28 18:26:36', '2021-11-28 18:26:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
