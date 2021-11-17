-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 10:04 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountkh`
--

CREATE TABLE `accountkh` (
  `TK` varchar(30) NOT NULL,
  `MK` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accountkh`
--

INSERT INTO `accountkh` (`TK`, `MK`) VALUES
('hoaitan0', '10102000'),
('hoaitan1', '10102000'),
('hoaitan2', '10102000'),
('hoaitan3', '10102000'),
('hoaitan4', '10102000');

-- --------------------------------------------------------

--
-- Table structure for table `accountnv`
--

CREATE TABLE `accountnv` (
  `TKhoan` varchar(16) NOT NULL,
  `Mkhau` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accountnv`
--

INSERT INTO `accountnv` (`TKhoan`, `Mkhau`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` varchar(50) NOT NULL,
  `MSHH` varchar(50) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` decimal(10,0) NOT NULL,
  `GiamGia` int(11) DEFAULT NULL,
  `SoDienThoai` int(11) NOT NULL,
  `MaDC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`, `SoDienThoai`, `MaDC`) VALUES
('DH-618de199c159b', 'SP-618d0a117461a', 1, '550000', 0, 379586235, ''),
('DH-618de199ca9d0', 'SP-618d0a93e5ab2', 1, '250000', 0, 379586235, ''),
('DH-618de199d7a63', 'SP-618d0d3194bdf', 1, '55000', 0, 379586235, ''),
('DH-618e8494d9e04', 'SP-618d0a117461a', 2, '1100000', 0, 379586235, '');

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` varchar(50) NOT NULL,
  `MSKH` varchar(50) NOT NULL,
  `MSNV` varchar(50) DEFAULT NULL,
  `NgayDH` date NOT NULL DEFAULT curdate(),
  `NgayGH` date NOT NULL DEFAULT curdate() CHECK (`NgayGH` > `NgayDH`),
  `TrangThaiDH` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES
('DH-618de199c159b', 'MSKHTest-123456', 'NV001', '2021-11-12', '2021-11-17', 1),
('DH-618de199ca9d0', 'MSKHTest-123456', 'NV001', '2021-11-12', '2021-11-17', 1),
('DH-618de199d7a63', 'MSKHTest-123456', 'NV001', '2021-11-12', '2021-11-17', 1),
('DH-618e8494d9e04', 'MSKHTest-123457', 'NV001', '2021-11-12', '2021-11-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` varchar(30) NOT NULL,
  `DiaChi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MSKH` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
('DC-6188ae5a102b4', 'huyện Châu Phú, tỉnh An Giang', 'MSKHTest-123456'),
('DC-61890512611e6', 'KTX B, Đại học Cần Thơ', 'MSKHTest-123456');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Id_feedback` varchar(50) NOT NULL,
  `MSKH` varchar(50) DEFAULT NULL,
  `MSHH` varchar(50) DEFAULT NULL,
  `NgayFB` date NOT NULL DEFAULT curdate(),
  `Noidung` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Id_feedback`, `MSKH`, `MSHH`, `NgayFB`, `Noidung`) VALUES
('Feedback-618e7dde86b38', 'MSKHTest-123456', 'SP-618d0a117461a', '0000-00-00', 'Sản phẩm đẹp, giày tốt, sẽ còn ủng hộ shop tiếp tục trong thời gian tới ^^'),
('Feedback-618e84b7517f9', 'MSKHTest-123457', 'SP-618d0a117461a', '0000-00-00', 'Giày này rất đẹp, các bạn nên mua ạ'),
('Feedback-6190ceba47e8f', 'MSKHTest-123456', 'SP-618d0a117461a', '0000-00-00', '123');

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` varchar(50) NOT NULL,
  `TenHH` varchar(255) NOT NULL,
  `QuyCach` text NOT NULL,
  `Gia` decimal(10,0) NOT NULL,
  `SoLuongHang` int(11) NOT NULL CHECK (`SoLuongHang` >= 0),
  `MaLoaiHang` varchar(10) NOT NULL,
  `DateCreated` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `DateCreated`) VALUES
('SP-618d089db8865', 'Giày Thể Thao XSPORT Nike Jordan 1 High Hồng Trắng F1', '<p>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</p><p>Chất liệu: Vải da</p><p>Độ cao: 3cm</p><p>Màu sắc: hồng trắngKích cỡ: 36-39</p><p>Chất liệu vải da, dễ làm sạch, êm ái.</p><p>Độ đàn hồi, co dãn tốt, ôm khít vừa chân</p><p>Đế đúc cao su nguyên</p>', '400000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d0a117461a', 'Giày XSPORT ADD Ultra Boost 6.0 REP', '<p>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</p><ul><li>Kiểu dáng:&nbsp;Giày sneaker, giày thể thao</li><li>Độ cao:3cm</li><li>Màu sắc: Hồng, đen, trắng, ghi, full đen, đen vàng</li><li>Kích cỡ: 36-43</li><li>Chất vải dệt knitt, êm ái</li><li>Độ đàn hồi, co dãn tốt, ôm khít vừa chân</li><li>Đế đúc cao su nguyên khối, chắc chắn.</li></ul>', '550000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d0a93e5ab2', 'Giày Thể Thao XSPORT Pu.ma F1', '<p>Thiết kế đẹp mắt, gọn gàng, màu sắc đẹp, trang nhã.</p><p>Màu sắc: trắng phản quang, trắng đen, mũi bạc, full trắng, mũi nhũ bạc, mũi nhũ 7 màu</p><p>Size: 36-43</p><p>Chất liệu: Da trơn</p><p>Phối màu tinh tế và đẹp mắt, phù hợp với mọi loại trang phục.</p>', '250000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d0afe5e66a', 'Giày Thể Thao XSPORT MCQ Da Trắng Dior SF', '<p>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</p><ul><li>Kiểu dáng:&nbsp;Giày sneaker, giày thể thao</li><li>Chất liệu: Vải da</li><li>Độ cao: 3cm</li><li>Màu sắc: trắng</li><li>Kích cỡ: 36-43</li><li>Chất liệu vải da, dễ làm sạch, êm chân</li><li>Độ đàn hồi, co dãn tốt, ôm khít vừa chân</li><li>Đế đúc cao su nguyên khối, chắc chắn.</li></ul>', '300000', 70, 'SNK-SHOES', '2021-11-14'),
('SP-618d0beb30b75', 'Giày Thể Thao XSPORT Adi.das EQT Bask Adv REP Black', '', '550000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d0cb113ec1', 'Giày Thể Thao XSPORT Adi.das EQT Bask Adv REP White', '', '550000', 60, 'SNK-SHOES', '2021-11-14'),
('SP-618d0d3194bdf', 'Giày Thể Thao XSPORT Adi.das EQT Bask Adv REP', '', '55000', 90, 'SNK-SHOES', '2021-11-14'),
('SP-618d0d472debe', 'Giày Thể Thao XSPORT Adi.das EQT Bask Adv REP Blue', '<p>nhập mô tả sản phẩm</p>', '550000', 70, 'SNK-SHOES', '2021-11-14'),
('SP-618d0d6f8331c', 'Giày Thể Thao XSPORT Ni.ke air shadow Rep 1:1', '<p>nhập mô tả sản phẩm</p>', '500000', 40, 'SNK-SHOES', '2021-11-14'),
('SP-618d0da82ae97', 'Giày Thể Thao XSPORT MCQ REP 1:1', '<p>nhập mô tả sản phẩm</p>', '500000', 120, 'SNK-SHOES', '2021-11-14'),
('SP-618d0e394f069', 'Giày Thể Thao XSPORT Adi.das Alpha.bounce beyond Rep', '<p>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</p><ul><li>Upper với thiết kế lưới nguyên khối hỗ trợ tuyệt vời cho các chuyển động đa chiều.</li><li>Đệm midsole ” phản ứng nhanh” ở phần mu trước và gót chân tạo nên sự chắc chắn cho các bài tập sức mạnh.</li></ul>', '600000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d0e79e6b7f', 'Giày Thể Thao XSPORT Conver.se cao cổ 1970s REP Black', '<ul><li>Chất vải canvas dày dặn 340g, form giày cứng cáp.</li><li>Đế giày cao 3.5cm màu trắng ngà và được phủ bóng để dễ dàng dễ vệ sinh.</li><li>Đệm chân Ortholite mềm mại hỗ trợ đi lại cả ngày.</li><li>Khoen xỏ lỗ giày và khoen bên hông giày được làm từ kim loại cao cấp chống rỉ sét.</li></ul>', '300000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d0ef89e55c', 'Giày Thể Thao XSPORT Conver.se cao cổ 1970s REP Red', '<ul><li>Chất vải canvas dày dặn 340g, form giày cứng cáp.</li><li>Đế giày cao 3.5cm màu trắng ngà và được phủ bóng để dễ dàng dễ vệ sinh.</li><li>Đệm chân Ortholite mềm mại hỗ trợ đi lại cả ngày.</li><li>Khoen xỏ lỗ giày và khoen bên hông giày được làm từ kim loại cao cấp chống rỉ sét.</li></ul>', '300000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d0f33268b4', 'Giày Thể Thao XSPORT Conver.se cao cổ 1970s REP White', '<ul><li>Chất vải canvas dày dặn 340g, form giày cứng cáp.</li><li>Đế giày cao 3.5cm màu trắng ngà và được phủ bóng để dễ dàng dễ vệ sinh.</li><li>Đệm chân Ortholite mềm mại hỗ trợ đi lại cả ngày.</li><li>Khoen xỏ lỗ giày và khoen bên hông giày được làm từ kim loại cao cấp chống rỉ sét.</li></ul>', '300000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d0f8926a9f', 'Giày Thể Thao XSPORT Conver.se cao cổ 1970s REP Yellow', '<ul><li>Chất vải canvas dày dặn 340g, form giày cứng cáp.</li><li>Đế giày cao 3.5cm màu trắng ngà và được phủ bóng để dễ dàng dễ vệ sinh.</li><li>Đệm chân Ortholite mềm mại hỗ trợ đi lại cả ngày.</li><li>Khoen xỏ lỗ giày và khoen bên hông giày được làm từ kim loại cao cấp chống rỉ sét.</li></ul>', '300000', 120, 'SNK-SHOES', '2021-11-14'),
('SP-618d103b1ff56', 'Giày Thể Thao XSPORT Pu.ma F1', '<p>Thiết kế đẹp mắt, gọn gàng, màu sắc đẹp, trang nhã.</p><p>Chất liệu: Da trơn</p><p>Phối màu tinh tế và đẹp mắt, phù hợp với mọi loại trang phục.</p>', '350000', 60, 'SNK-SHOES', '2021-11-14'),
('SP-618d10bf5cfe8', 'Giày Thể Thao XSPORT Ni.ke force 1 shadow F1', '<ul><li>Mang hơi hướng Streetstyle, kiểu dáng phá cách.</li><li>Có thể mix đẹp dễ dàng với hầu hết tất cả các bộ quần áo, nhiều phong cách khác nhau</li><li>Mỗi sản phẩm đều mang các đặc trưng, các gam màu hợp trend</li></ul>', '450000', 130, 'SNK-SHOES', '2021-11-14'),
('SP-618d11a85ebcf', 'Giày Thể Thao XSPORT Adi.das Yeezy 700 V2 Static REP', '<p>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</p><ul><li>Đế giày giúp tăng chiều cao của bạn.</li><li>Dây phản quang làm bạn nổi bật giữa đám đông.</li><li>Sử dụng công nghệ đệm Boost tiên tiến, đảm bảo độ nảy cao, đàn hồi tốt, cân bằng lực tương tác ổn định, giúp người sử dụng đi nhẹ nhàng hơn, nhanh hơn&nbsp;</li></ul>', '550000', 90, 'SNK-SHOES', '2021-11-14'),
('SP-618d11d52a5d5', 'Giày Thể Thao XSPORT Gu.cci Sneaker Rhyton Cream F1', '<ul><li>Dễ dàng biến hóa trang phục đa dạng, từ váy ngắn, quần ống rộng, quần thể thao, quần bóng rổ,…</li><li>Chất liệu da cao cấp, mềm mại, thanh thoát và rất trẻ trung.</li><li>Thiết kế tối giản, mang vẻ đẹp xa xỉ</li></ul>', '360000', 70, 'SNK-SHOES', '2021-11-14'),
('SP-618d121153d44', 'Giày Thể Thao XSPORT Van.s Old Skool Phản Quang SF', '<ul><li>Giày Vans kiểu dáng phù hợp với nhiều loại trang phục, kết hợp tuyệt vời nhất với đồ jean, quần vải và legging</li><li>Chất liệu vải cao cấp, bền đẹp và rất giặt sạch, kẻ phản quang phát sáng nổi bật.</li><li>Đế giày cao su đúc nguyên khối êm chân thoải mái</li></ul>', '300000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d1269b1318', 'Giày XSPORT ADD Alphabounce Beyond REP Xám Hồng', '<p>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</p><ul><li>Đế giày giúp tăng chiều cao của bạn.</li><li>Dây phản quang làm bạn nổi bật giữa đám đông.</li><li>Sử dụng công nghệ đệm Boost tiên tiến, đảm bảo độ nảy cao, đàn hồi tốt, cân bằng lực tương tác ổn định, giúp người sử dụng đi nhẹ nhàng hơn, nhanh hơn</li></ul>', '600000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d131c21926', 'Giày Thể Thao XSPORT Adi.das 350 V2 Static Full Phản Quang REP', '<ul><li>Với đế boost, đôi giày cực kì êm luôn.</li><li>Chất liệu prime knit trên upper, đôi giày sẽ mềm hơn qua thời gian.</li><li>Không chỉ cải tiến mạnh mẽ về thiết kế,&nbsp;Adidas Yeezy 350 V2 còn đảm bảo tính thoải mái cho người dùng. Thiết kế lưỡi gà và gót sau giày cao hơn một bậc, rộng, hỗ trợ cho quá trình mang/ tháo giày dễ dàng và nhanh chóng hơn.</li></ul>', '450000', 70, 'SNK-SHOES', '2021-11-14'),
('SP-618d19653d6a0', 'Giày Thể Thao XSPORT Adi.das 350 V2 Static Full Phản Quang REP', '<ul><li>Với đế boost, đôi giày cực kì êm luôn.</li><li>Chất liệu prime knit trên upper, đôi giày sẽ mềm hơn qua thời gian.</li><li>Không chỉ cải tiến mạnh mẽ về thiết kế,&nbsp;Adidas Yeezy 350 V2 còn đảm bảo tính thoải mái cho người dùng. Thiết kế lưỡi gà và gót sau giày cao hơn một bậc, rộng, hỗ trợ cho quá trình mang/ tháo giày dễ dàng và nhanh chóng hơn.</li></ul>', '450000', 70, 'SNK-SHOES', '2021-11-14'),
('SP-618d1988bcfa0', 'Giày Thể Thao XSPORT Adi.das Yeezy boost sesame REP', '<ul><li>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</li><li>Chất vải primeknit co dãn linh hoạt, siêu nhẹ, siêu êm.</li><li>Outfit mang đậm vẻ hiện đại, cuốn hút.</li><li>Đế boost tạo độ nảy cao, đàn hồi tốt, bước đi nhẹ nhàng.</li></ul>', '450000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d19cc8fd94', 'Giày Thể Thao XSPORT Adi.das A918', '<ul><li>Kiểu dáng:&nbsp;Giày sneaker, giày thể thao</li><li>Chất liệu: Vải dệt Knitt</li><li>Độ cao: 3cm</li><li>Màu sắc: xanh navy, đen, đen xanh, xám cam</li><li>Kích cỡ: 40-44</li><li>Chất liệu vải dệt, dễ làm sạch, êm chân</li><li>Độ đàn hồi, co dãn tốt, ôm khít vừa chân</li><li>Đế đúc cao su nguyên khối, chắc chắn.</li></ul>', '450000', 75, 'SNK-SHOES', '2021-11-14'),
('SP-618d1a9b337a4', 'Giày Thể Thao XSPORT Prophere Rep Red', '<p>Thật sự Adidas đã tạo ra một sản phẩm thú vị dành cho các sneakerhead trên toàn thế giới: không giới hạn, không giá trị, chỉ đơn giản là đẹp và chất lượng</p><ul><li>&nbsp;Bạn hoàn toàn có thể mang đôi giày cho bất kì hoạt động thường ngày nào: đi làm, đi học, đi bar và cả tập gym</li><li>Đế Chunky năng động, mạnh mẽ và hầm hố</li></ul>', '500000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d1b15a0e96', 'Giày Thể Thao XSPORT Prophere Rep Grey Blue', '<ul><li>Thật sự Adidas đã tạo ra một sản phẩm thú vị dành cho các sneakerhead trên toàn thế giới: không giới hạn, không giá trị, chỉ đơn giản là đẹp và chất lượng</li><li>&nbsp;Bạn hoàn toàn có thể mang đôi giày cho bất kì hoạt động thường ngày nào: đi làm, đi học, đi bar và cả tập gym</li><li>Đế Chunky năng động, mạnh mẽ và hầm hố</li></ul>', '500000', 70, 'SNK-SHOES', '2021-11-14'),
('SP-618d1b5c1ea84', 'Giày Thể Thao XSPORT Prophere Rep White', '<ul><li>Thật sự Adidas đã tạo ra một sản phẩm thú vị dành cho các sneakerhead trên toàn thế giới: không giới hạn, không giá trị, chỉ đơn giản là đẹp và chất lượng</li><li>&nbsp;Bạn hoàn toàn có thể mang đôi giày cho bất kì hoạt động thường ngày nào: đi làm, đi học, đi bar và cả tập gym</li><li>Đế Chunky năng động, mạnh mẽ và hầm hố</li></ul>', '500000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d1b99333e2', 'Giày Thể Thao XSPORT Prophere Rep Blue', '<ul><li>Thật sự Adidas đã tạo ra một sản phẩm thú vị dành cho các sneakerhead trên toàn thế giới: không giới hạn, không giá trị, chỉ đơn giản là đẹp và chất lượng</li><li>&nbsp;Bạn hoàn toàn có thể mang đôi giày cho bất kì hoạt động thường ngày nào: đi làm, đi học, đi bar và cả tập gym</li><li>Đế Chunky năng động, mạnh mẽ và hầm hố</li></ul>', '500000', 80, 'SNK-SHOES', '2021-11-14'),
('SP-618d1cab9318e', 'Giày Thể Thao XSPORT Ni.ke Air Max 97', '<ul><li>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</li><li>Toàn bộ đế giày được lót đệm khí.</li><li>Vừa cổ điển vừa hiện đại, năng động, sáng tạo là tất cả những gì có thể nói về<strong>&nbsp;Air Max 97</strong>&nbsp;– sở hữu vẻ đặc trưng , nổi bật không thể lẫn lộn.</li></ul>', '500000', 100, 'SNK-SHOES', '2021-11-14'),
('SP-618d1f6352520', 'Giày Thể Thao XSPORT Ni.ke Air Max 97 White', '<ul><li>Chất liệu cao cấp, bền đẹp theo thời gian. Thiết kế thời trang. Kiểu dáng phong cách. Độ bền cao. Dễ phối đồ.</li><li>Toàn bộ đế giày được lót đệm khí.</li><li>Vừa cổ điển vừa hiện đại, năng động, sáng tạo là tất cả những gì có thể nói về<strong>&nbsp;Air Max 97</strong>&nbsp;– sở hữu vẻ đặc trưng , nổi bật không thể lẫn lộn.</li></ul>', '500000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-618d1f988662e', 'Giày Thể Thao XSPORT Ni.ke Air Jordan 4 Retro Off White Kem REP 1:1', '<ul><li>Kiểu dáng:&nbsp;Giày sneaker, giày thể thao</li><li>Chất liệu: Da trơn</li><li>Độ cao: 3cm</li><li>Màu sắc: kem</li><li>Kích cỡ: 36-43</li><li>Chất liệu vải da, dễ làm sạch, êm chân</li><li>Độ đàn hồi, co dãn tốt, ôm khít vừa chân</li><li>Đế đúc cao su nguyên khối, chắc chắn.</li></ul>', '500000', 50, 'SNK-SHOES', '2021-11-14'),
('SP-619090c1236d1', 'Giày Thể Thao XSPORT Ni.ke Air Force 1 Full Trắng REP', '<ul><li>Được làm từ chất liệu da đặc trưng với chất lượng hoàn hảo</li><li>Nike Air Force 1 được thiết kế hướng tới sự đơn giản nhưng vô cùng tinh tế. Đây là sự lựa chọn hoàn hảo cho các tín đồ yêu thể thao khi có thể dễ dàng phối hợp trang phục hằng ngày để khẳng định phong cách thời trang.</li><li>Phối màu đơn giản nhưng vô cùng tinh tế.</li></ul>', '400000', 150, 'SNK-SHOES', '2021-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `MaHinh` varchar(30) NOT NULL,
  `TenHinh` varchar(100) NOT NULL,
  `MSHH` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
('ImG-618d0a7f94303', 'z2215120610216_ec8968e2dcb1b5ee56f1f2489391d2ff-scaled.jpg', 'SP-618d0a117461a'),
('ImG-618d0a7f95429', 'z2215120610217_345af4987e79975601887a80c809903e-scaled.jpg', 'SP-618d0a117461a'),
('ImG-618d0a7f9957a', 'z2215120615074_580d0e51e84225dc3891e9e47c25e860-scaled.jpg', 'SP-618d0a117461a'),
('ImG-618d0afd25a2c', 'z2083832612868_3179073c1dcbffb412eb43d88d4f0421.jpg', 'SP-618d0a93e5ab2'),
('ImG-618d0afd294fa', 'z2083832645487_0610f1977792e64d00c50323b7b2318b.jpg', 'SP-618d0a93e5ab2'),
('ImG-618d0b6edd00f', 'z2261641083002_92b12a525cbb7d5590e96b57e25def12-scaled.jpg', 'SP-618d0afe5e66a'),
('ImG-618d0b6ee171a', 'z2261641140414_ac0f1ba618012e057c8e8c994bf50b82-scaled.jpg', 'SP-618d0afe5e66a'),
('ImG-618d0cafd2155', 'MG_8423.jpg', 'SP-618d0beb30b75'),
('ImG-618d0cafd36d6', 'MG_8425.jpg', 'SP-618d0beb30b75'),
('ImG-618d0ce12a990', 'MG_6033.jpg', 'SP-618d0cb113ec1'),
('ImG-618d0ce12fa43', 'MG_6035.jpg', 'SP-618d0cb113ec1'),
('ImG-618d0d4591ac5', 'MG_7078.jpg', 'SP-618d0d3194bdf'),
('ImG-618d0d4598191', 'MG_7081.jpg', 'SP-618d0d3194bdf'),
('ImG-618d0d6e4567a', 'MG_7085.jpg', 'SP-618d0d472debe'),
('ImG-618d0d6e493e0', 'MG_7087.jpg', 'SP-618d0d472debe'),
('ImG-618d0da61a7f5', 'z2077503029753_3c3dc8d68f95c74dc9127b97c3b3882c.jpg', 'SP-618d0d6f8331c'),
('ImG-618d0da61e2d4', 'z2077503060485_74d0a291ea703a05059f653862d93af4.jpg', 'SP-618d0d6f8331c'),
('ImG-618d0e00c8494', 'z2139139865106_2024117860cf747b640985d6fd22c951.jpg', 'SP-618d0da82ae97'),
('ImG-618d0e00cbff6', 'z2139139865652_c83d23a23dc17674563201ad0bd785c1.jpg', 'SP-618d0da82ae97'),
('ImG-618d0e00d03ae', 'z2139139865654_a52d65f6e7d10491daadab265ec0acc3-1636634112.jpg', 'SP-618d0da82ae97'),
('ImG-618d0e77aecc6', 'MG_5975.jpg', 'SP-618d0e394f069'),
('ImG-618d0e77b2468', 'MG_5977.jpg', 'SP-618d0e394f069'),
('ImG-618d0ef7315b7', 'MG_6944.jpg', 'SP-618d0e79e6b7f'),
('ImG-618d0ef7357ce', 'MG_6945.jpg', 'SP-618d0e79e6b7f'),
('ImG-618d0ef739033', 'MG_6947.jpg', 'SP-618d0e79e6b7f'),
('ImG-618d0f31de6c7', 'MG_6950.jpg', 'SP-618d0ef89e55c'),
('ImG-618d0f31e24e0', 'MG_6951.jpg', 'SP-618d0ef89e55c'),
('ImG-618d0f31e6847', 'MG_6953.jpg', 'SP-618d0ef89e55c'),
('ImG-618d0f87b224e', 'MG_6933.jpg', 'SP-618d0f33268b4'),
('ImG-618d0f87b6b56', 'MG_6935.jpg', 'SP-618d0f33268b4'),
('ImG-618d1039ab752', 'MG_6938.jpg', 'SP-618d0f8926a9f'),
('ImG-618d1039aee8b', 'MG_6939.jpg', 'SP-618d0f8926a9f'),
('ImG-618d1039b2970', 'MG_6941.jpg', 'SP-618d0f8926a9f'),
('ImG-618d10bdf1739', 'z2083832555351_7c28caa1be5e093224dbe022d47f81e8.jpg', 'SP-618d103b1ff56'),
('ImG-618d10bdf28a1', 'z2083832645487_0610f1977792e64d00c50323b7b2318b (1).jpg', 'SP-618d103b1ff56'),
('ImG-618d11385f33c', 'MG_8964.jpg', 'SP-618d10bf5cfe8'),
('ImG-618d11d3c4f79', 'MG_5963.jpg', 'SP-618d11a85ebcf'),
('ImG-618d11d3c5dd8', 'MG_5965.jpg', 'SP-618d11a85ebcf'),
('ImG-618d120fac987', 'MG_4996.jpg', 'SP-618d11d52a5d5'),
('ImG-618d120fb0800', 'MG_4997.jpg', 'SP-618d11d52a5d5'),
('ImG-618d120fb42b1', 'MG_4999.jpg', 'SP-618d11d52a5d5'),
('ImG-618d12680bb77', 'MG_6731.jpg', 'SP-618d121153d44'),
('ImG-618d12680cb87', 'MG_6733.jpg', 'SP-618d121153d44'),
('ImG-618d131aa0670', 'z2216608000317_c329b4c6e585192cefe08bf730972861-scaled.jpg', 'SP-618d1269b1318'),
('ImG-618d131aa4193', 'z2216608094559_420bcff1462e2a20165bebceb9100fbf-scaled.jpg', 'SP-618d1269b1318'),
('ImG-618d1963c0214', 'MG_7102.jpg', 'SP-618d131c21926'),
('ImG-618d1963c415f', 'MG_7103.jpg', 'SP-618d131c21926'),
('ImG-618d19871bad8', 'MG_7108.jpg', 'SP-618d19653d6a0'),
('ImG-618d19871f408', 'MG_7109.jpg', 'SP-618d19653d6a0'),
('ImG-618d1987233e7', 'MG_7111.jpg', 'SP-618d19653d6a0'),
('ImG-618d19cb1f31b', 'MG_4531.jpg', 'SP-618d1988bcfa0'),
('ImG-618d19cb230ff', 'MG_4532.jpg', 'SP-618d1988bcfa0'),
('ImG-618d19cb26e19', 'MG_4534.jpg', 'SP-618d1988bcfa0'),
('ImG-618d1a3fe976e', 'z2137211991788_fdf5d52bb638c5b72a5a2d2dd77d710e-1.jpg', 'SP-618d19cc8fd94'),
('ImG-618d1a3ff0481', 'z2137211993039_ecf5d5c519343e14aff3b193296beeb2-1.jpg', 'SP-618d19cc8fd94'),
('ImG-618d1b142b9a6', 'MG_4330.jpg', 'SP-618d1a9b337a4'),
('ImG-618d1b142f477', 'MG_4331.jpg', 'SP-618d1a9b337a4'),
('ImG-618d1b143331d', 'MG_4334.jpg', 'SP-618d1a9b337a4'),
('ImG-618d1b5a9fbdd', 'MG_6027.jpg', 'SP-618d1b15a0e96'),
('ImG-618d1b5aa63de', 'MG_6028.jpg', 'SP-618d1b15a0e96'),
('ImG-618d1b9775b1c', 'MG_4361.jpg', 'SP-618d1b5c1ea84'),
('ImG-618d1b977969c', 'MG_4362.jpg', 'SP-618d1b5c1ea84'),
('ImG-618d1c56d393c', 'MG_4990.jpg', 'SP-618d1b99333e2'),
('ImG-618d1c56d7797', 'MG_4991.jpg', 'SP-618d1b99333e2'),
('ImG-618d1c56db807', 'MG_4993.jpg', 'SP-618d1b99333e2'),
('ImG-618d1f43de259', 'MG_4974.jpg', 'SP-618d1cab9318e'),
('ImG-618d1f43e1b5f', 'MG_4975.jpg', 'SP-618d1cab9318e'),
('ImG-618d1f8b241c7', 'MG_5858.jpg', 'SP-618d1f6352520'),
('ImG-618d1f8b27ae2', 'MG_5859.jpg', 'SP-618d1f6352520'),
('ImG-618d1f8b2b8ba', 'MG_5861.jpg', 'SP-618d1f6352520'),
('ImG-618d1fe3600f2', 'z2220226635266_d928b1eeb3a5e7cdd1bcdc180617b0bb-scaled.jpg', 'SP-618d1f988662e'),
('ImG-618d1fe364776', 'z2220226635281_f63bc0e0929b8ba5aa47e903738bddae-scaled.jpg', 'SP-618d1f988662e'),
('ImG-6190910463328', 'MG_5047.jpg', 'SP-619090c1236d1'),
('ImG-6190910469a5b', 'MG_5049.jpg', 'SP-619090c1236d1'),
('MImG-618d093be0721', 'z2797230006186_c802e5c5f746ba191c63a302d11f1bb7-scaled.jpg', 'SP-618d089db8865'),
('MImG-618d0a7f92f2d', 'z2215120610214_3d9b9d73ac3fcc76a1e701cc9d4a141d-scaled.jpg', 'SP-618d0a117461a'),
('MImG-618d0afd1ea5a', 'z2083832563700_14bc4b3b9891ee3f1507568e841b00ce.jpg', 'SP-618d0a93e5ab2'),
('MImG-618d0b6edb129', 'z2261641090407_9a527dfa37fa44a1b8cfd0fd14d1ca77-scaled.jpg', 'SP-618d0afe5e66a'),
('MImG-618d0cafd1280', 'MG_8421.jpg', 'SP-618d0beb30b75'),
('MImG-618d0ce129ddd', 'MG_6030.jpg', 'SP-618d0cb113ec1'),
('MImG-618d0d459041f', 'MG_7077.jpg', 'SP-618d0d3194bdf'),
('MImG-618d0d6e41902', 'MG_7083.jpg', 'SP-618d0d472debe'),
('MImG-618d0da614a26', 'z2077503002271_01faf21b4b4c32f91923383638f5b371.jpg', 'SP-618d0d6f8331c'),
('MImG-618d0e00c36d2', 'z2139139865654_a52d65f6e7d10491daadab265ec0acc3.jpg', 'SP-618d0da82ae97'),
('MImG-618d0e77a989f', 'MG_5973.jpg', 'SP-618d0e394f069'),
('MImG-618d0ef72d5c6', 'MG_6943.jpg', 'SP-618d0e79e6b7f'),
('MImG-618d0f31d8eff', 'MG_6949.jpg', 'SP-618d0ef89e55c'),
('MImG-618d0f87b15df', 'MG_6931.jpg', 'SP-618d0f33268b4'),
('MImG-618d1039a7db1', 'MG_6937.jpg', 'SP-618d0f8926a9f'),
('MImG-618d10bdeb3d1', 'z2083832563700_14bc4b3b9891ee3f1507568e841b00ce-1636634813.jpg', 'SP-618d103b1ff56'),
('MImG-618d11385a38e', 'MG_8962.jpg', 'SP-618d10bf5cfe8'),
('MImG-618d11d3bfc94', 'MG_5961.jpg', 'SP-618d11a85ebcf'),
('MImG-618d120fa826b', 'MG_4995.jpg', 'SP-618d11d52a5d5'),
('MImG-618d1268080d8', 'MG_6729.jpg', 'SP-618d121153d44'),
('MImG-618d131a9c7b9', 'z2216607970275_b8fe23be35a5fc16cfec3e744cd6f6ca-scaled.jpg', 'SP-618d1269b1318'),
('MImG-618d1963b97e5', 'MG_7101.jpg', 'SP-618d131c21926'),
('MImG-618d1987160c9', 'MG_7107.jpg', 'SP-618d19653d6a0'),
('MImG-618d19cb1bba4', 'MG_4530.jpg', 'SP-618d1988bcfa0'),
('MImG-618d1a3fe4c7a', 'z2137211992802_a850ba37932daa96870ad7b545238407-1.jpg', 'SP-618d19cc8fd94'),
('MImG-618d1b142614e', 'MG_4329.jpg', 'SP-618d1a9b337a4'),
('MImG-618d1b5a9eedb', 'MG_6024.jpg', 'SP-618d1b15a0e96'),
('MImG-618d1b976fdf5', 'MG_4359.jpg', 'SP-618d1b5c1ea84'),
('MImG-618d1c56cfb0e', 'MG_4989.jpg', 'SP-618d1b99333e2'),
('MImG-618d1f43d9d88', 'MG_4973.jpg', 'SP-618d1cab9318e'),
('MImG-618d1f8b205b3', 'MG_5857.jpg', 'SP-618d1f6352520'),
('MImG-618d1fe35f542', 'z2220226635250_4d426abccf008e8034bcd741b5ba5dd5-scaled.jpg', 'SP-618d1f988662e'),
('MImG-619091046252a', 'MG_5045 (1).jpg', 'SP-619090c1236d1');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` varchar(50) NOT NULL,
  `TK` varchar(30) DEFAULT NULL,
  `HoTenKH` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `SoFax` varchar(30) DEFAULT NULL,
  `TenCongTy` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `TK`, `HoTenKH`, `SoDienThoai`, `SoFax`, `TenCongTy`, `Avatar`) VALUES
('guest-61854b1dcc036', NULL, 'test cart', '123', '', '', NULL),
('guest-61893cf2ddfb8', NULL, 'Nguyễn Hoài Tân', '0379586235', '', 'CTU', NULL),
('guest-6189433f93df7', NULL, 'Nguyễn Văn A', '0379586235', '', '', NULL),
('MSKHTest-123456', 'hoaitan0', 'Nguyễn Hoài Tân', '0379586235', '', 'CTU', 'z2734672265749_2f838548391cd7815aa617c309e6c1b0.jpg'),
('MSKHTest-123457', 'hoaitan1', 'Nguyễn Hoài Tân', '0379586235', NULL, NULL, 'IMG_20200608_232518_721.jpg'),
('MSKHTest-123458', 'hoaitan2', 'Trần Thị Cẩm Hương', '0379586235', NULL, NULL, NULL),
('MSKHTest-123459', 'hoaitan3', 'Nguyễn Văn Hiếu', '0379586235', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` varchar(10) NOT NULL,
  `TenLoaiHang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
('SNK-SHOES', 'Giày Sneaker');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` varchar(50) NOT NULL,
  `HoTenNV` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ChucVu` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `TKhoan` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `TKhoan`) VALUES
('NV001', 'Nguyễn Hoài Tân', 'Administrator', 'Can Tho', '0379586235', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountkh`
--
ALTER TABLE `accountkh`
  ADD PRIMARY KEY (`TK`);

--
-- Indexes for table `accountnv`
--
ALTER TABLE `accountnv`
  ADD PRIMARY KEY (`TKhoan`);

--
-- Indexes for table `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SoDonDH`,`MSHH`);

--
-- Indexes for table `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`);

--
-- Indexes for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Id_feedback`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang` (`MaLoaiHang`);

--
-- Indexes for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Indexes for table `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Constraints for table `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `hinhhanghoa_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
