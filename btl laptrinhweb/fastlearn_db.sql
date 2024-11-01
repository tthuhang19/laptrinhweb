-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 29, 2024 lúc 12:48 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fastlearn_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhoi`
--

CREATE TABLE `cauhoi` (
  `id` int(11) NOT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `id_sinh_vien` int(11) DEFAULT NULL,
  `noi_dung_cau_hoi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cauhoi`
--

INSERT INTO `cauhoi` (`id`, `id_khoa_hoc`, `id_sinh_vien`, `noi_dung_cau_hoi`) VALUES
(12, 5, 8, 'Sự khác biệt giữa thuật toán tìm kiếm tuyến tính và tìm kiếm nhị phân là gì? Khi nào nên sử dụng mỗi loại?'),
(13, 5, 10, 'Các kỹ thuật học máy phổ biến là gì, và khi nào nên sử dụng mỗi loại?'),
(14, 5, 11, 'Những phương pháp phân tích dữ liệu nào phổ biến, và cách chúng được áp dụng trong thực tế?');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cautraloi`
--

CREATE TABLE `cautraloi` (
  `id` int(11) NOT NULL,
  `id_cau_hoi` int(11) DEFAULT NULL,
  `noi_dung_tra_loi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cautraloi`
--

INSERT INTO `cautraloi` (`id`, `id_cau_hoi`, `noi_dung_tra_loi`) VALUES
(15, 12, 'Thuật toán tìm kiếm tuyến tính (linear search) duyệt qua từng phần tử trong danh sách cho đến khi tìm thấy phần tử cần tìm, có độ phức tạp \r\n𝑂\r\n(\r\n𝑛\r\n)\r\nO(n), thích hợp cho các danh sách nhỏ hoặc chưa sắp xếp.\r\n\r\nTìm kiếm nhị phân (binary search) yêu cầu danh sách phải được sắp xếp trước, hoạt động bằng cách chia đôi danh sách để so sánh, với độ phức tạp \r\n𝑂\r\n(\r\nlog\r\n⁡\r\n𝑛\r\n)\r\nO(logn). Phương pháp này hiệu quả hơn với các danh sách lớn và đã sắp xếp.'),
(16, 14, 'Các phương pháp phân tích dữ liệu phổ biến bao gồm:\r\n\r\nPhân tích mô tả (Descriptive Analysis): Tóm tắt dữ liệu quá khứ để hiểu rõ hơn về hiệu suất hoặc xu hướng. Áp dụng trong báo cáo doanh thu hàng tháng, tỷ lệ tăng trưởng khách hàng.'),
(17, 13, 'Các kỹ thuật học máy phổ biến bao gồm:\r\n\r\nHọc có giám sát (Supervised Learning): Sử dụng khi có dữ liệu gắn nhãn rõ ràng; phù hợp cho các bài toán phân loại (classification) và hồi quy (regression), như dự đoán giá nhà hoặc phân loại email spam.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangkykhoahoc`
--

CREATE TABLE `dangkykhoahoc` (
  `id` int(11) NOT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `id_sinh_vien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dangkykhoahoc`
--

INSERT INTO `dangkykhoahoc` (`id`, `id_khoa_hoc`, `id_sinh_vien`) VALUES
(23, 5, 8),
(24, 17, 8),
(25, 5, 10),
(26, 17, 10),
(27, 5, 11),
(28, 18, 11),
(29, 17, 11),
(30, 16, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_va_ten` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`id`, `ten_dang_nhap`, `mat_khau`, `ho_va_ten`, `ngay_sinh`, `email`, `sdt`, `ngay_tao`) VALUES
(4, 'trinhyen', '04df4d434d481c5bb723be1b6df1ee65', 'Trịnh Thị Yến', '1996-08-07', 'haiyen87@gmail.com', '0373976926', '2024-10-25 08:46:02'),
(5, 'ngoclan', '04df4d434d481c5bb723be1b6df1ee65', 'Nguyễn Ngọc Lan', '2000-06-01', '222001445@daihocthudo.edu.vn', '037397692633', '2024-10-25 08:46:38'),
(6, 'dangtrung', '04df4d434d481c5bb723be1b6df1ee65', 'Nguyễn Đăng Trung', '1998-11-20', 'dangtrung@gmail.com', '0987654321', '2024-10-25 09:09:21'),
(7, 'khacluong', '04df4d434d481c5bb723be1b6df1ee65', 'Nguyễn Khắc Lượng', '2002-05-11', 'khacluong@gmail.com', '0987651234', '2024-10-25 09:10:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoahoc`
--

CREATE TABLE `khoahoc` (
  `id` int(11) NOT NULL,
  `ten_khoa_hoc` varchar(255) NOT NULL,
  `hinh_anh` varchar(200) DEFAULT NULL,
  `id_giang_vien` int(11) DEFAULT NULL,
  `mo_ta_khoa_hoc` text DEFAULT NULL,
  `thoi_luong` int(11) DEFAULT NULL,
  `chi_phi` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoahoc`
--

INSERT INTO `khoahoc` (`id`, `ten_khoa_hoc`, `hinh_anh`, `id_giang_vien`, `mo_ta_khoa_hoc`, `thoi_luong`, `chi_phi`) VALUES
(5, 'Khoa học máy tính', '1729847012_OIP.jpg', 6, 'Khóa học Khoa học Máy tính cung cấp kiến thức nền tảng về nguyên lý và ứng dụng của máy tính, bao gồm các lĩnh vực như lập trình, cấu trúc dữ liệu và giải thuật, hệ điều hành, cơ sở dữ liệu, mạng máy tính, và trí tuệ nhân tạo. Sinh viên sẽ học cách giải quyết vấn đề bằng các thuật toán hiệu quả, phát triển phần mềm và hiểu sâu về cách thức vận hành của các hệ thống máy tính. Mục tiêu của khóa học là trang bị cho sinh viên khả năng tư duy logic, kỹ năng lập trình và nền tảng kiến thức để phát triển các ứng dụng công nghệ thông tin trong nhiều lĩnh vực.', 72, 10000000.00),
(15, 'Truyền thông đại chúng', '1730200733_pexels-photo-4144294.webp', 5, 'Khóa học Truyền thông Đại chúng trang bị cho sinh viên kiến thức và kỹ năng về việc truyền tải thông tin đến công chúng thông qua các phương tiện như báo chí, truyền hình, radio, và truyền thông số. Nội dung khóa học bao gồm các lĩnh vực như lý thuyết truyền thông, kỹ thuật sản xuất nội dung, quan hệ công chúng, và phân tích truyền thông. Sinh viên sẽ được học cách nghiên cứu thị trường, tạo dựng thông điệp hiệu quả, và sử dụng các nền tảng truyền thông hiện đại để thu hút và tương tác với công chúng. Mục tiêu của khóa học là đào tạo các chuyên gia truyền thông hiểu biết và có khả năng sáng tạo, đáp ứng nhu cầu của ngành công nghiệp truyền thông.', 120, 5000000.00),
(16, 'Thương mại điện tử', '1730200779_R (2).jpg', 4, 'Khóa học Thương mại Điện tử trang bị cho sinh viên kiến thức và kỹ năng cần thiết để hoạt động trong môi trường kinh doanh trực tuyến. Nội dung khóa học bao gồm các chủ đề như xây dựng và quản lý website thương mại, tiếp thị số (digital marketing), thanh toán trực tuyến, quản lý chuỗi cung ứng, và phân tích dữ liệu người dùng. Sinh viên sẽ học cách ứng dụng công nghệ thông tin để tối ưu hóa quy trình kinh doanh và phát triển chiến lược kinh doanh trên các nền tảng số. Mục tiêu của khóa học là giúp sinh viên hiểu rõ về môi trường thương mại điện tử và có thể triển khai, quản lý hiệu quả các hoạt động kinh doanh trên Internet.', 200, 1200000.00),
(17, ' Tiếng Trung cho người mới bắt đầu', '1730200872_R (1).jpg', 6, 'Khóa học tiếng Trung cho người mới bắt đầu tập trung vào việc xây dựng nền tảng ngôn ngữ căn bản, bao gồm phát âm, từ vựng, và ngữ pháp cơ bản. Sinh viên sẽ được học hệ thống phát âm **Pinyin**, các nét và bộ thủ trong chữ Hán, cùng với các kỹ năng nghe, nói, đọc, viết cơ bản. Khóa học thường bao gồm các chủ đề giao tiếp hàng ngày như chào hỏi, giới thiệu bản thân, mua sắm, và các tình huống sinh hoạt. Mục tiêu của khóa học là giúp người học tự tin giao tiếp ở mức độ cơ bản và làm quen với văn hóa Trung Quốc.', 2500, 10000000.00),
(18, 'Quản trị kinh doanh', '1730200938_R.jpg', 7, 'Khóa học Quản trị Kinh doanh tập trung vào việc trang bị cho sinh viên kiến thức và kỹ năng cần thiết để quản lý và điều hành một doanh nghiệp. Nội dung bao gồm các lĩnh vực như quản lý tài chính, marketing, quản trị nhân sự, chiến lược kinh doanh, và quản lý sản xuất. Khóa học thường cung cấp các phương pháp phân tích, kỹ năng lãnh đạo và ra quyết định, giúp sinh viên nắm bắt được cách thức hoạt động của doanh nghiệp và có thể áp dụng kiến thức vào thực tiễn kinh doanh.', 100, 5000000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanhoi`
--

CREATE TABLE `phanhoi` (
  `id` int(11) NOT NULL,
  `id_sinh_vien` int(11) DEFAULT NULL,
  `noi_dung_phan_hoi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanhoi`
--

INSERT INTO `phanhoi` (`id`, `id_sinh_vien`, `noi_dung_phan_hoi`) VALUES
(19, 8, 'Tôi đánh giá cao tốc độ xử lý yêu cầu của dịch vụ. Thời gian chờ đợi vừa phải và quy trình diễn ra suôn sẻ.'),
(20, 8, 'Rất cảm ơn giảng viên và ban tổ chức khóa học! Đây là một trải nghiệm học tập ý nghĩa và bổ ích với tôi.'),
(21, 10, 'Giảng viên rất giỏi trong việc truyền đạt kiến thức, phương pháp giảng dạy lôi cuốn và tạo động lực học tập. Các tài liệu học tập cũng rất chi tiết và hữu ích.'),
(22, 11, 'Khóa học rất hữu ích và cung cấp nhiều kiến thức mới mẻ. Giảng viên giảng dạy rõ ràng, dễ hiểu và có nhiều ví dụ thực tế giúp tôi nắm vững kiến thức hơn. Rất cảm ơn khóa học này!');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quantrivien`
--

CREATE TABLE `quantrivien` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quantrivien`
--

INSERT INTO `quantrivien` (`id`, `ten_dang_nhap`, `mat_khau`, `email`, `sdt`) VALUES
(1, 'admin', '04df4d434d481c5bb723be1b6df1ee65', 'admin@gmail.com', '0999888777');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_va_ten` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`id`, `ten_dang_nhap`, `mat_khau`, `ho_va_ten`, `ngay_sinh`, `email`, `sdt`, `ngay_tao`) VALUES
(8, 'thuhang', '04df4d434d481c5bb723be1b6df1ee65', 'Trần Thu Hằng', '2004-11-19', 'haqthu@outlook.com.vn', '0373976926', '2024-10-25 08:47:10'),
(9, 'ninhchi', '04df4d434d481c5bb723be1b6df1ee65', 'Trịnh Thị Ninh Chi', '2000-02-03', 'haiyen87@gmail.com', '027484374747', '2024-10-25 08:47:43'),
(10, 'anhtuyet', '04df4d434d481c5bb723be1b6df1ee65', 'Nguyễn Ánh Tuyết', '1996-11-01', 'anhtuyet@gmail.com', '0368545535', '2024-10-29 11:38:23'),
(11, 'huonggiang', '04df4d434d481c5bb723be1b6df1ee65', 'Phí Hương Giang', '2002-03-12', 'huonggiang@gmail.com', '037397692633', '2024-10-29 11:39:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tailieukhoahoc`
--

CREATE TABLE `tailieukhoahoc` (
  `id` int(11) NOT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `noi_dung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tailieukhoahoc`
--

INSERT INTO `tailieukhoahoc` (`id`, `id_khoa_hoc`, `noi_dung`) VALUES
(3, 5, '<h3>T&agrave;i Liệu Kh&oacute;a Học: Tr&iacute; Tuệ Nh&acirc;n Tạo (AI)<br />\r\n<img alt=\"Công nghệ trí tuệ nhân tạo (AI) - VDigital\" src=\"https://vdigital.vn/wp-content/uploads/2023/04/cong-nghe-tri-tue-nhan-tao-1024x538.png\" /></h3>\r\n\r\n<p>Mục ti&ecirc;u kh&oacute;a học</p>\r\n\r\n<ul>\r\n	<li>Hiểu r&otilde; kh&aacute;i niệm v&agrave; lịch sử ph&aacute;t triển của tr&iacute; tuệ nh&acirc;n tạo.</li>\r\n	<li>Nắm vững c&aacute;c thuật to&aacute;n v&agrave; kỹ thuật cơ bản trong AI.</li>\r\n	<li>&Aacute;p dụng AI v&agrave;o c&aacute;c b&agrave;i to&aacute;n thực tế.</li>\r\n</ul>\r\n\r\n<p>Nội dung kh&oacute;a học</p>\r\n\r\n<p><strong>1. Giới thiệu về Tr&iacute; Tuệ Nh&acirc;n Tạo</strong></p>\r\n\r\n<ul>\r\n	<li>Kh&aacute;i niệm v&agrave; định nghĩa AI.</li>\r\n	<li>Lịch sử v&agrave; ph&aacute;t triển của AI.</li>\r\n	<li>Ph&acirc;n loại AI: AI hẹp v&agrave; AI tổng qu&aacute;t.</li>\r\n</ul>\r\n\r\n<p><strong>2. C&aacute;c th&agrave;nh phần ch&iacute;nh của AI</strong></p>\r\n\r\n<ul>\r\n	<li>Học m&aacute;y (Machine Learning)\r\n	<ul>\r\n		<li>Giới thiệu về học m&aacute;y v&agrave; c&aacute;c thuật to&aacute;n học m&aacute;y cơ bản.</li>\r\n		<li>Ph&acirc;n loại: Học c&oacute; gi&aacute;m s&aacute;t, học kh&ocirc;ng gi&aacute;m s&aacute;t, v&agrave; học tăng cường.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Mạng nơ-ron (Neural Networks)\r\n	<ul>\r\n		<li>Cấu tr&uacute;c v&agrave; nguy&ecirc;n l&yacute; hoạt động của mạng nơ-ron.</li>\r\n		<li>C&aacute;c loại mạng nơ-ron: Mạng nơ-ron t&iacute;ch chập (CNN), mạng nơ-ron hồi tiếp (RNN).</li>\r\n	</ul>\r\n	</li>\r\n	<li>Xử l&yacute; ng&ocirc;n ngữ tự nhi&ecirc;n (Natural Language Processing)\r\n	<ul>\r\n		<li>Kh&aacute;i niệm v&agrave; ứng dụng của xử l&yacute; ng&ocirc;n ngữ tự nhi&ecirc;n.</li>\r\n		<li>C&aacute;c kỹ thuật cơ bản: ph&acirc;n t&iacute;ch c&uacute; ph&aacute;p, ph&acirc;n loại văn bản, tạo sinh văn bản.</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong>3. Ứng dụng của AI</strong></p>\r\n\r\n<ul>\r\n	<li>AI trong chăm s&oacute;c sức khỏe: chẩn đo&aacute;n bệnh, ph&acirc;n t&iacute;ch h&igrave;nh ảnh y khoa.</li>\r\n	<li>AI trong giao th&ocirc;ng: xe tự l&aacute;i, tối ưu h&oacute;a lộ tr&igrave;nh.</li>\r\n	<li>AI trong t&agrave;i ch&iacute;nh: dự đo&aacute;n thị trường, quản l&yacute; rủi ro.</li>\r\n</ul>\r\n\r\n<p><strong>4. Th&aacute;ch thức v&agrave; triển vọng của AI</strong></p>\r\n\r\n<ul>\r\n	<li>Đạo đức v&agrave; tr&aacute;ch nhiệm trong ph&aacute;t triển AI.</li>\r\n	<li>C&aacute;c vấn đề về bảo mật v&agrave; quyền ri&ecirc;ng tư.</li>\r\n	<li>Tương lai của AI v&agrave; xu hướng ph&aacute;t triển.</li>\r\n</ul>\r\n\r\n<p><strong>5. Thực h&agrave;nh v&agrave; Dự &aacute;n</strong></p>\r\n\r\n<ul>\r\n	<li>Thực h&agrave;nh với c&aacute;c thư viện AI phổ biến như TensorFlow, Keras, hoặc PyTorch.</li>\r\n	<li>Thực hiện dự &aacute;n nhỏ &aacute;p dụng AI v&agrave;o một b&agrave;i to&aacute;n cụ thể.</li>\r\n</ul>\r\n\r\n<p>T&agrave;i liệu tham khảo</p>\r\n\r\n<ul>\r\n	<li>&quot;Artificial Intelligence: A Modern Approach&quot; - Stuart Russell &amp; Peter Norvig.</li>\r\n	<li>C&aacute;c b&agrave;i b&aacute;o nghi&ecirc;n cứu v&agrave; t&agrave;i liệu hướng dẫn từ c&aacute;c trang web học trực tuyến như Coursera, edX.</li>\r\n</ul>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n'),
(9, 15, '<p><img alt=\"\" src=\"https://cdn.vietnambiz.vn/2020/1/8/photo-1578425418771-15784254187751493262483.jpg\" style=\"height:210px; width:250px\" /></p>\r\n\r\n<h2>Truyền th&ocirc;ng đại ch&uacute;ng</h2>\r\n\r\n<p><strong>Kh&aacute;i niệm</strong></p>\r\n\r\n<p><strong>Truyền th&ocirc;ng đại ch&uacute;ng</strong>&nbsp;trong tiếng Anh l&agrave;<strong>&nbsp;Mass Communications.</strong></p>\r\n\r\n<p><strong>Truyền th&ocirc;ng đại ch&uacute;ng</strong>&nbsp;được hiểu l&agrave; hoạt động truyền th&ocirc;ng được thực hiện th&ocirc;ng qua c&aacute;c phương tiện truyền th&ocirc;ng đại ch&uacute;ng như b&aacute;o, đ&agrave;i, ph&aacute;t thanh, truyền h&igrave;nh&hellip; hướng tới những nh&oacute;m c&ocirc;ng ch&uacute;ng lớn.</p>\r\n\r\n<h3>Đặc điểm của truyền th&ocirc;ng đại ch&uacute;ng</h3>\r\n\r\n<p>Đặc điểm của hoạt động truyền th&ocirc;ng đại ch&uacute;ng l&agrave; th&ocirc;ng điệp được truyền tải đến c&ocirc;ng ch&uacute;ng một c&aacute;ch nhanh ch&oacute;ng. Tuy nhi&ecirc;n, truyền th&ocirc;ng đại ch&uacute;ng lại l&agrave; hoạt động lu&ocirc;n chịu t&aacute;c động từ nhiều ph&iacute;a: c&aacute;c nh&oacute;m c&ocirc;ng ch&uacute;ng x&atilde; hội rộng lớn, c&aacute;c thiết chế x&atilde; hội m&agrave; phương tiện l&agrave; c&ocirc;ng cụ (b&aacute;o, đ&agrave;i&hellip; của c&aacute;c tổ chức ch&iacute;nh trị x&atilde; hội); v&agrave; c&aacute;c cơ quan quản l&iacute; nh&agrave; nước.</p>\r\n\r\n<p>Ng&agrave;y nay, hệ thống truyền th&ocirc;ng đại ch&uacute;ng c&oacute; vai tr&ograve; quan trọng trong việc h&igrave;nh th&agrave;nh v&agrave; thể hiện dư luận x&atilde; hội, tuy nhi&ecirc;n, sự t&aacute;c động c&aacute;c phương tiện truyền th&ocirc;ng đại ch&uacute;ng rất kh&aacute;c nhau do kh&aacute;c biệt về địa vị x&atilde; hội, quyền lợi giai cấp, nh&acirc;n tố t&acirc;m l&iacute; v&agrave; cường độ giao tiếp đối với phương tiện truyền th&ocirc;ng.</p>\r\n\r\n<h3>Vai tr&ograve; của truyền th&ocirc;ng đại ch&uacute;ng</h3>\r\n\r\n<p>Mặc d&ugrave; c&aacute;c loại h&igrave;nh truyền th&ocirc;ng c&aacute; nh&acirc;n hay t&ugrave;y chỉnh c&oacute; gi&aacute; trị nhất định trong ng&agrave;nh c&ocirc;ng nghiệp dịch vụ th&ocirc;ng qua sự tiếp x&uacute;c trực tiếp với kh&aacute;ch h&agrave;ng, tuy nhi&ecirc;n hoạt động của truyền th&ocirc;ng đại ch&uacute;ng vẫn c&oacute; tầm quan trọng nhất định trong c&aacute;c ng&agrave;nh c&ocirc;ng nghiệp dịch vụ.</p>\r\n\r\n<p>Việc tiếp x&uacute;c trực tiếp giữa nh&acirc;n vi&ecirc;n dịch vụ với kh&aacute;ch h&agrave;ng th&ocirc;ng qua hoạt động truyền th&ocirc;ng c&aacute; nh&acirc;n hay t&ugrave;y chỉnh chủ yếu hướng tới kh&aacute;ch h&agrave;ng hiện tại hay kh&aacute;ch h&agrave;ng tiềm năng của một nh&agrave; cung cấp dịch vụ hiện tại.</p>\r\n\r\n<p>Hầu hết kh&aacute;ch h&agrave;ng tiềm năng kh&ocirc;ng c&oacute; mối quan hệ tốt đẹp với nh&agrave; cung cấp dịch vụ. Chi ph&iacute; để c&oacute; được th&ecirc;m một kh&aacute;ch h&agrave;ng th&ocirc;ng qua hoạt động truyền th&ocirc;ng c&aacute; nh&acirc;n hay tuỳ chỉnh c&oacute; thể sẽ cao hơn so với truyền th&ocirc;ng đại ch&uacute;ng.&nbsp;</p>\r\n\r\n<p>Doanh nghiệp c&ograve;n đối mặt với kh&oacute; khăn trong việc thu thập th&ocirc;ng tin của kh&aacute;ch h&agrave;ng khi số lượng kh&aacute;ch h&agrave;ng tiềm năng lớn. Truyền th&ocirc;ng đại ch&uacute;ng c&oacute; thể giải quyết được hạn chế tr&ecirc;n th&ocirc;ng qua hiện c&aacute;c hoạt động truyền th&ocirc;ng hướng tới từng đoạn thị trường.</p>\r\n\r\n<p>Ở g&oacute;c độ gi&aacute; trị, h&igrave;nh ảnh thương hiệu l&agrave; yếu tố quan trọng ảnh hưởng tới nhận thức, cảm x&uacute;c v&agrave; h&agrave;nh vi của kh&aacute;ch h&agrave;ng. Trong đ&oacute;, truyền th&ocirc;ng đại ch&uacute;ng l&agrave; đ&ograve;n bẩy quan trọng trong x&acirc;y dựng gi&aacute; trị thương hiệu, do đ&oacute;, truyền th&ocirc;ng đại ch&uacute;ng c&oacute; gi&aacute; trị trong ng&agrave;nh c&ocirc;ng nghiệp dịch vụ.</p>\r\n\r\n<p>Nhiệm vụ quan trọng của truyền th&ocirc;ng đại ch&uacute;ng l&agrave; cụ thể h&oacute;a c&aacute;c dịch vụ v&ocirc; h&igrave;nh trong nhận thức kh&aacute;ch h&agrave;ng (th&ocirc;ng qua c&aacute;c yếu tố vật chất , qui tr&igrave;nh hay kết quả của dịch vụ).</p>\r\n'),
(10, 16, '<p><img alt=\"\" src=\"https://bizweb.dktcdn.net/thumb/medium/100/414/002/articles/images-documents-tai-lieu-trong-nuoc-giao-trinh-tmdt-2013.jpg?v=1609318697233\" style=\"height:240px; width:159px\" /></p>\r\n\r\n<p>Thương mại&nbsp;điện tử&nbsp;đang l&agrave; xu thế tất yếu v&agrave;&nbsp;đang ph&aacute;t triển b&ugrave;ng nổ tại Việt Nam. Tuy nhi&ecirc;n, việc&nbsp;đưa Thương mại&nbsp;điện tử v&agrave;o giảng dạy ch&iacute;nh thức tại c&aacute;c trường&nbsp;đại học, cao&nbsp;đẳng vẫn chưa thực sự phổ biến. Nắm bắt&nbsp;được xu thế cũng như nhu cầu ph&aacute;t triển,&nbsp;Đại học Ngoại Thương H&agrave; Nội l&agrave; một trong những trường&nbsp;đi&nbsp;đầu trong c&ocirc;ng t&aacute;c giảng dạy về Thương mại&nbsp;điện tử. Ph&aacute;t triển từ Gi&aacute;o tr&igrave;nh Thương mại&nbsp;điện tử căn bản của PGS. TS. NGƯT Nguyễn Văn Hồng v&agrave; TS. Nguyễn Văn Thoan chủ bi&ecirc;n, xuất bản năm 2012, Gi&aacute;o tr&igrave;nh Thương mại&nbsp;điện tử 2013&nbsp;đ&atilde; c&oacute; nhiều cập nhật, bổ sung cho ph&ugrave; hợp với t&igrave;nh h&igrave;nh v&agrave; tốc&nbsp;độ ph&aacute;t triển của thương mại&nbsp;điện tử Việt Nam hiện nay.</p>\r\n'),
(11, 17, ''),
(12, 18, '<p><img alt=\"\" src=\"https://vietbooks.info/attachments/upload_2023-10-31_23-4-17-png.28434/\" style=\"height:225px; width:150px\" /></p>\r\n\r\n<p>Quản trị doanh nghiệp l&agrave; m&ocirc;n học vượt thời giAN V&agrave; MANG TỚNH NH&Otilde;N BẢN - NH&Otilde;N BẢN VỠ CHỚNH CON NGười l&agrave;m quản trị. Mọi th&agrave;nh tựu của doanh nghiệp l&agrave; th&agrave;nh tựu của nh&agrave; quản trị. Mọi thất bại của quản trị doanh nghiệp l&agrave; thất bại của nh&agrave; quản trị. Tầm nhỠN, SỰ TẬN T&Otilde;M, V&agrave; TỚNH CHỚNH TRỰC CỦA NH&agrave; QUẢN TRị sẽ quyết định quản trị doanh nghiệp đ&uacute;ng hay sai.<br />\r\nTrong bối cảnh kinh doanh lu&ocirc;n biến động như hiện nay, quản trị doanh nghiệp đ&atilde; c&oacute; nhiều thay đổi, đ&ograve;i hỏi c&aacute;c nh&agrave; quản trị phải thực sự năng động v&agrave; c&oacute; kỹ năng giỏi, mang t&iacute;nh chuy&ecirc;n nghiệp. Thực hiện chủ trương đổi mới mục ti&ecirc;u đ&agrave;o tạo, nội dung chương tr&igrave;nh, gi&aacute;o tr&igrave;nh của Bộ Gi&aacute;o dục v&agrave; Đ&agrave;o tạo v&agrave; của Trường Đại học Kinh tế Quốc d&acirc;n, Bộ m&ocirc;n quản trị doanh nghiệp đ&atilde; tập trung bi&ecirc;n soạn lại v&agrave; cho t&aacute;i bản gi&aacute;o tr&igrave;nh m&ocirc;n học Quản trị doanh nghiệp.</p>\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `noi_dung_thong_bao` text DEFAULT NULL,
  `ngay_tao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`id`, `title`, `noi_dung_thong_bao`, `ngay_tao`) VALUES
(3, 'Thông báo nghỉ lễ', 'Nhân ngày 20/10 chúng tôi sẽ tạm ngưng các dịch vụ. Chúc các bạn có 1 ngày lễ thật vui vẻ!', '2024-10-11'),
(7, '🍂 Chào Thu với Ưu Đãi Đặc Biệt: Giảm Giá Khóa Học! 🍂', 'Chào mừng mùa thu với chương trình khuyến mãi đặc biệt, giảm giá cho tất cả các khóa học của chúng tôi. Đây là cơ hội tuyệt vời để bạn nâng cao kỹ năng và kiến thức của mình.Hãy liên hệ với chúng tôi để biết thêm chi tiết.', '2024-10-25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `traloiphanhoi`
--

CREATE TABLE `traloiphanhoi` (
  `id` int(11) NOT NULL,
  `id_phan_hoi` int(11) NOT NULL,
  `noi_dung` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `traloiphanhoi`
--

INSERT INTO `traloiphanhoi` (`id`, `id_phan_hoi`, `noi_dung`) VALUES
(5, 19, 'Cám ơn bạn đã tin tưởng và ủng hộ FastLearn.');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cauhoi_ibfk_1` (`id_khoa_hoc`),
  ADD KEY `cauhoi_ibfk_2` (`id_sinh_vien`);

--
-- Chỉ mục cho bảng `cautraloi`
--
ALTER TABLE `cautraloi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cautraloi_ibfk_1` (`id_cau_hoi`);

--
-- Chỉ mục cho bảng `dangkykhoahoc`
--
ALTER TABLE `dangkykhoahoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dangkykhoahoc_ibfk_1` (`id_khoa_hoc`),
  ADD KEY `dangkykhoahoc_ibfk_2` (`id_sinh_vien`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoahoc_ibfk_1` (`id_giang_vien`);

--
-- Chỉ mục cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phanhoi_ibfk_1` (`id_sinh_vien`);

--
-- Chỉ mục cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tailieukhoahoc`
--
ALTER TABLE `tailieukhoahoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tailieukhoahoc_ibfk_1` (`id_khoa_hoc`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `traloiphanhoi`
--
ALTER TABLE `traloiphanhoi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ph` (`id_phan_hoi`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `cautraloi`
--
ALTER TABLE `cautraloi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `dangkykhoahoc`
--
ALTER TABLE `dangkykhoahoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tailieukhoahoc`
--
ALTER TABLE `tailieukhoahoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `traloiphanhoi`
--
ALTER TABLE `traloiphanhoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD CONSTRAINT `cauhoi_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoahoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cauhoi_ibfk_2` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cautraloi`
--
ALTER TABLE `cautraloi`
  ADD CONSTRAINT `cautraloi_ibfk_1` FOREIGN KEY (`id_cau_hoi`) REFERENCES `cauhoi` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dangkykhoahoc`
--
ALTER TABLE `dangkykhoahoc`
  ADD CONSTRAINT `dangkykhoahoc_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoahoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dangkykhoahoc_ibfk_2` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD CONSTRAINT `khoahoc_ibfk_1` FOREIGN KEY (`id_giang_vien`) REFERENCES `giangvien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD CONSTRAINT `phanhoi_ibfk_1` FOREIGN KEY (`id_sinh_vien`) REFERENCES `sinhvien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tailieukhoahoc`
--
ALTER TABLE `tailieukhoahoc`
  ADD CONSTRAINT `tailieukhoahoc_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoahoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `traloiphanhoi`
--
ALTER TABLE `traloiphanhoi`
  ADD CONSTRAINT `fk_ph` FOREIGN KEY (`id_phan_hoi`) REFERENCES `phanhoi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
