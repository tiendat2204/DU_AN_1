-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2023 at 10:13 AM
-- Server version: 8.0.33
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopcuco_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(71, 5, 'shattered', 30, 1, 'shattered.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'dongvat'),
(2, 'tamly'),
(3, 'kinhdi'),
(4, 'doisong');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `message` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `product_id`, `message`, `created_at`) VALUES
(5, 6, 3, 'ndahsuhdiusa', '2023-10-04 15:11:34'),
(27, 6, 4, 'test', '2023-10-05 02:29:57'),
(28, 6, 4, 'test', '2023-10-05 02:30:35'),
(29, 6, 7, 'testbl', '2023-10-05 02:30:50'),
(30, 6, 7, 'testbl', '2023-10-05 02:31:06'),
(31, 6, 7, 'ngu', '2023-10-05 02:33:39'),
(32, 6, 6, 'sách hay', '2023-10-05 02:34:05'),
(33, 6, 3, 'dsa', '2023-10-05 02:34:51'),
(34, 6, 3, 'gà', '2023-10-05 02:57:30'),
(35, 6, 8, 'hay', '2023-10-05 02:58:40'),
(36, 6, 13, 'nice', '2023-10-05 03:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(11, 2, 'user01', 'user01@gmail.com', '123456789', 'Hi, this is testing');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `total_products` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(12, 2, 'user01', '123456789', 'user01@gmail.com', 'cash on delivery', 'flat no. 154, Da Nang, Da Nang, Việt Nam - 1223', ', darknet (1) , clever lands (2) , bee well bee (3) ', 88, '22-Sep-2023', 'completed'),
(13, 6, 'TRIỆU TIẾN ĐẠT', '0354411541', 'Datboyngeo@gmail.com', 'cash on delivery', 'flat no. 0354411541, 256/1/6 duong quang ham, TP HCM, HỒ CHÍ MINH, Vietnam - 13000', 'shattered (1) ', 30, '01-Oct-2023', 'pending'),
(14, 6, 'TRIỆU TIẾN ĐẠT', '0354411541', 'tiendat220404@gmail.com', 'cash on delivery', 'flat no. 0000, 9999, TP HCM, 13000, Vietnam - 2932', 'shattered (1) ', 30, '01-Oct-2023', 'pending'),
(15, 6, 'TRIỆU TIẾN ĐẠT', '0354411541', 'tiendat220404@gmail.com', 'cash on delivery', 'flat no. 32, 3213, TP HCM, HỒ CHÍ MINH, Vietnam - 3333', 'shattered (1) , darknet (1) ', 46, '05-Oct-2023', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `in4` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`, `in4`) VALUES
(1, 'the world of art', 25, 'the_world.jpg', 1, '\r\nQuyển sách The World of Art của tác giả E.H. Gombrich là một cuốn sách bách khoa về lịch sử nghệ thuật phương Tây. Quyển sách được xuất bản lần đầu tiên vào năm 1950 và đã được tái bản nhiều lần.\r\n\r\nQuyển sách bắt đầu bằng việc giới thiệu về các nền văn minh cổ đại, bao gồm Ai Cập, Hy Lạp và La Mã. Gombrich sau đó đi sâu vào các phong trào nghệ thuật khác nhau, bao gồm Gothic, Phục hưng, Baroque, Rococo, Tân cổ điển, Lãng mạn, Hiện thực, Ấn tượng, Hậu ấn tượng, Xu hướng hiện đại và Hiện đại.\r\n\r\nGombrich kết thúc bằng một cuộc thảo luận về nghệ thuật đương đại. Ông lập luận rằng nghệ thuật là một quá trình sáng tạo liên tục, và nó không thể được hiểu chỉ bằng cách nhìn vào quá khứ.'),
(2, 'happy lemons', 10, 'the_happy_lemon.jpg', 4, '\r\nQuyển sách Happy Lemons của tác giả Nguyễn Ngọc Thạch là một tiểu thuyết tình yêu, lãng mạn, hài hước. Quyển sách được xuất bản lần đầu tiên vào năm 2016.\r\n\r\nCâu chuyện kể về hai nhân vật chính là Linh và Huy, hai người bạn thân từ thời cấp ba. Linh là một cô gái xinh đẹp, thông minh và mạnh mẽ. Huy là một chàng trai hài hước, lãng mạn và ấm áp.\r\n\r\nSau khi tốt nghiệp đại học, Linh và Huy chia tay nhau vì những lý do khác nhau. Linh đi du học ở nước ngoài, còn Huy ở lại Việt Nam.\r\n\r\nBảy năm sau, Linh trở về Việt Nam và gặp lại Huy. Cả hai đều đã trưởng thành và thay đổi, nhưng tình cảm của họ vẫn còn nguyên vẹn.'),
(3, 'shattered', 30, 'shattered.jpg', 3, 'Quyển sách Shattered của tác giả Karen Robards là một tiểu thuyết lãng mạn, hư cấu, thần bí, hồi hộp lãng mạn. Quyển sách được xuất bản lần đầu tiên vào năm 2010.\r\n\r\nCâu chuyện kể về Lisa Grant, một luật sư đang điều tra vụ mất tích của một bé gái 28 năm trước. Khi điều tra, Lisa bắt đầu nghi ngờ rằng chính mình là cô bé mất tích. Điều này khiến cuộc sống của Lisa trở thành một vòng xoáy của những bí ẩn và nguy hiểm.'),
(4, 'darknet', 16, 'darknet.jpg', 3, '\r\nQuyển sách Darknet của tác giả Jamie Bartlett là một cuốn sách phi hư cấu khám phá thế giới ngầm của internet. Quyển sách được xuất bản lần đầu tiên vào năm 2014 và đã được cập nhật hai lần, lần gần nhất là vào năm 2022.\r\n\r\nQuyển sách bắt đầu bằng việc giới thiệu về lịch sử và sự phát triển của darknet. Darknet là một phần của internet mà chỉ có thể truy cập được thông qua phần mềm đặc biệt. Nó được sử dụng cho nhiều mục đích khác nhau, bao gồm các hoạt động bất hợp pháp như mua bán ma túy và vũ khí, và các hoạt động hợp pháp như bảo vệ quyền riêng tư.\r\n\r\nBartlett sau đó dành phần lớn quyển sách để khám phá các hoạt động diễn ra trên darknet. Ông viết về các chợ đen, nơi người dùng có thể mua bán hàng hóa bất hợp pháp; các dịch vụ mã hóa, giúp người dùng ẩn danh trên internet; và các diễn đàn, nơi người dùng có thể chia sẻ thông tin và ý kiến.\r\n\r\nQuyển sách kết thúc bằng một cuộc thảo luận về tác động của darknet đối với xã hội. Bartlett lập luận rằng darknet có thể được sử dụng cho '),
(5, 'clever lands', 18, 'clever_lands.jpg', 4, 'Quyển sách này vẫn luôn là một trong những tác phẩm vĩ đại của lĩnh vực phát triển cá nhân. Hàng triệu người đã thay đổi cuộc sống của họ nhờ áp dụng các nguyên tắc trong quyển sách này. Trong vô số các quyển sách về chiến lược, cách thức và chiêu trò để đạt thành công, quyển sách này đặt nền tảng với nguyên tắc đi từ bên trong ra ngoài, tăng cường nội lực trước khi học các kỹ năng. Đây là một quyển sách không thể thiếu đối với bất kỳ ai muốn đạt được thành công.'),
(6, 'bee well bee', 12, 'be_well_bee.jpg', 2, ' bee well bee thuộc dòng sách “Amazing Pop-Up Fun” đem đến những câu chuyện ngộ nghĩnh về các loài động vật đáng mến với minh họa pop-up 3D nổi bật. Đây là lựa chọn lý tưởng cho những câu chuyện kể trước giờ đi ngủ, đưa bé vào những giấc mộng đẹp đẽ và thú vị.'),
(7, 'red queen', 45, 'red_queen.jpg', 3, 'Đây là tập đầu của series Red Queen, best-seller trong nhiều tuần, rating trên goodreads cũng khá cao. Bối cảnh của cuốn sách là một tương lai khi con người chia thành hai chủng tộc, chủng tộc máu Bạc và chủng tộc máu Đỏ. Người máu bạc được coi là ưu việt, họ là những ông vua, hoàng hậu, công chúa, hoàng tử... tóm lại là tầng lớp quý tộc, họ có khả năng điều khiến nước, lửa, gió... Còn người máu đỏ thì ngược lại, họ không có khả năng đặc biệt, bị coi là thấp kém. Nhưng sau này xuất hiện nhân vật Mare, dù là người máu đỏ nhưng lại có khả năng điều khiển sấm sét. Nội dung truyện không mới nhưng rất hay, rất nhiều plot twist, đọc bị lừa lần này sang lần khác. Bìa sách đẹp nhưng dễ quăn, sách nhẹ, giấy hơi mỏng, câu từ khá đơn giản, mình không giỏi tiếng Anh lắm nhưng vẫn đọc tốt. Mong Fahasa nhập về thêm nhiều cuốn như thế này.'),
(8, 'Đắc Nhân Tâm', 2, 'sach-dac-nhan-tam-kho-lon-tai-ban-2023-sbooks.jpg', 2, 'Đắc nhân tâm (Được lòng người), tên tiếng Anh là How to Win Friends and Influence People là một quyển sách nhằm tự giúp bản thân (self-help) bán chạy nhất từ trước đến nay. Quyển sách này do Dale Carnegie viết và đã được xuất bản lần đầu vào năm 1936, nó đã được bán 15 triệu bản trên khắp thế giới.'),
(10, 'Tuổi trẻ đáng giá bao nhiêu', 4, 'Screenshot 2023-09-30 121243.png', 4, 'Tuổi trẻ đáng giá bao nhiêu được ấn hành bởi Nhã Nam với giá bìa 70.000 đồng. Nhưng cái giá cho những điều nhận được từ nó thì nhiều hơn thế. Với cuốn sách này, chúng ta có thể tìm thấy những chiêm nghiệm đắt giá. Từ đó, bước vào cuộc đời theo cách nhẹ nhàng và đón nhận những thử thách mới dễ dàng hơn.'),
(11, 'Cây Cam Ngọt Của Tôi', 5, 'Screenshot 2023-09-30 121454.png', 2, 'Sách \"Cây cam ngọt của tôi\" là tự truyện về thời thơ ấu của cậu bé Zézé, mang bài học về sự thấu cảm và lòng trắc ẩn. Tiểu thuyết dày 244 trang, do José Mauro de Vasconcelos sáng tác (Nguyễn Bích Lan - Tô Yến Ly dịch). Trong nước, tác phẩm nằm trong top ấn phẩm bán chạy của các đơn vị sách năm 2022.'),
(12, 'Kỹ Năng Giao Tiếp Đỉnh Cao', 6, 'Screenshot 2023-09-30 121346.png', 4, '“Tâm Phật” là trái tim dịu dàng, mềm mại, thiện lành nhất. Còn “khẩu xà” là miệng lưỡi cay nghiệt, sắc nhọn, hung hãn nhất. Rõ ràng đã hy sinh rất nhiều, rõ ràng là quan tâm rất nhiều, nhưng chỉ vì cái miệng, chỉ vì vài câu nói, thành ra oán giận, thành ra thù hằn, như vậy có đáng không? Tất nhiên, nhiều người “khẩu xà” nhưng lòng dạ họ không xấu, thậm chí đa số họ đều là những người chính trực, thẳng thắn, khảng khái. Nhưng làm gì có ai có đủ kiên nhẫn để tìm hiểu sâu xa, cặn kẽ về tất cả mọi người mà họ tiếp xúc. Khuôn miệng của bạn chính là tấm danh thiếp đầu tiên bạn thảy ra ngoài xã hội, nếu vừa mở miệng đã như vung đao khua kiếm, bất luận tâm của bạn “tâm Phật” hay “tâm xà”, thì đối với người bị “đao kiếm” của bạn làm cho thương tổn, đều như nhau cả thôi. Nếu bạn có '),
(13, 'Thích Nhất Hạnh', 3, 'Screenshot 2023-09-30 121543.png', 2, 'Cuốn sách “Không diệt, không sinh đừng sợ hãi” gồm 219 trang và 9 chương, sách của thầy Nhất Hạnh luôn đem đến cho bạn đọc những góc nhìn rất sâu sắc về cuộc đời. Thầy gọi Trái Đất bằng cái tên rất thân thương “Đất Mẹ”, cách thầy thưởng thức cuộc sống cũng vô cùng thi vị, mỗi một bước chân, hoạt động hàng ngày cũng là mắt thương nhìn cuộc đời, với sự thấu hiểu đặc biệt sâu sắc của mình, thầy Thích Nhất Hạnh đã viết nên cuốn sách “Không diệt, không sinh đừng sợ hãi” một chân lý sống tự do, giảm bớt mọi muộn phiền về quan niệm sinh, tử mà bấy lâu nay ta vẫn bị mắc kẹt.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'admin1', 'admin1@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(2, 'user01', 'user01@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'dat', 'Datboyngeo@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(5, 'nhi', 'tiendat220404@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(6, 'alo', 'datttps31485@fpt.edu.vn', 'b706835de79a2b4e80506f582af3676a', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_ibfk_2` (`product_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
