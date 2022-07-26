-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 01:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catid` int(11) NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `category`) VALUES
(1, 'Motherboard'),
(7, 'CPU '),
(8, 'GPU'),
(9, 'Case'),
(10, 'Cooler'),
(11, 'Power Supply'),
(12, 'Storage'),
(13, 'Memory'),
(15, 'Other Accessories'),
(17, 'Headset'),
(18, 'Mouse'),
(19, 'Keyboard'),
(20, 'Monitor');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `customer_name`, `order_date`, `subtotal`, `tax`, `discount`, `total`, `paid`, `due`, `payment_type`) VALUES
(8, 'mario', '2022-07-22', 800, 40, 0, 840, 850, -10, 'Cash'),
(9, 'yoshi', '2022-07-22', 800, 40, 0, 840, 1600, -760, 'Cash'),
(10, 'ninja', '2022-07-22', 1050, 52.5, 0, 1102.5, 1600, -497.5, 'Cash'),
(12, 'test_one', '2022-07-23', 800, 40, 0, 840, 850, -10, 'Card'),
(13, 'test_three', '2022-07-23', 800, 40, 0, 840, 850, -10, 'Check'),
(14, 'gecko moria', '2022-07-24', 2400, 120, 0, 2520, 2500, 20, 'Cash'),
(15, 'yami', '2022-07-24', 500, 25, 0, 525, 550, -25, 'Card');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_details`
--

CREATE TABLE `tbl_invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_invoice_details`
--

INSERT INTO `tbl_invoice_details` (`id`, `invoice_id`, `product_id`, `product_name`, `qty`, `price`, `order_date`) VALUES
(11, 8, 2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 1, 800, '2022-07-22'),
(12, 9, 2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 1, 800, '2022-07-22'),
(13, 10, 2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 1, 800, '2022-07-22'),
(14, 10, 8, 'CORSAIR Vengeance 32GB', 1, 250, '2022-07-22'),
(17, 12, 2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 1, 800, '2022-07-23'),
(18, 13, 2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 1, 800, '2022-07-23'),
(19, 13, 13, 'LG UltraGear 27GL83A-B', 50, 1000, '2022-07-23'),
(20, 14, 2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 3, 800, '2022-07-24'),
(22, 15, 8, 'CORSAIR Vengeance 32GB', 2, 250, '2022-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcategory` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchaseprice` float NOT NULL,
  `saleprice` float NOT NULL,
  `pstock` int(11) NOT NULL,
  `pdescription` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pimage` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `pname`, `pcategory`, `purchaseprice`, `saleprice`, `pstock`, `pdescription`, `pimage`) VALUES
(1, 'GIGABYTE Z690 AORUS MASTER', 'Motherboard', 399, 420, 10, 'Easy to setup, tons of ports, and other bells and whistles, m.2 support, etc. Built like a brick sh!thouse. Amazingly beefy board, can definitely feel the build quality. I\'ve built dozens of PC\'s and this is one of the nicest boards to work on.      ', '62cd849158a24.jpg'),
(2, 'ASUS TUF Gaming GeForce RTX 3070 Ti ', 'GPU', 699, 800, 0, '8GB 256-Bit GDDR6X\r\nOC mode: 1815MHz (Boost Clock)\r\nGaming mode: 1785 MHz (Boost Clock)\r\n2 x HDMI 3 x DisplayPort 1.4a\r\n6144 CUDA Cores\r\nPCI Express 4.0 x16', '62cad08b47540.jpg'),
(3, 'Intel Core i9-11900K ', 'CPU', 1000, 1500, 5, '14nm Rocket Lake 125W\r\n16MB L3 Cache\r\nIntel UHD Graphics 750\r\nWindows 11 Supported', '62cad0dd4891b.jpg'),
(4, 'Cooler Master NR200 ', 'Case', 436, 450, 10, ' SFF Small Form Factor Mini-ITX Case with Vented Panel, Triple-slot GPU, Tool-Free and 360 Degree Accessibility', '62cbb3b812db1.jpg'),
(5, 'EVGA CLC 360 400-HY-CL36-V1 ', 'Cooler', 110, 150, 29, '500 - 2400 RPM 74.82 CFM (MAX)\r\nRadiator Dim. 396mm x 122mm x 28mm\r\nFan Dim. 120.00 x 120.00 x 25.00 mm\r\nFan Noise 16.0 dB(A) (MIN) - 39.9 dB(A) (MAX)\r\nLGA 1700 brackets included    ', '62cbb4e87e4ca.jpg'),
(6, 'Seasonic PRIME 1300W 80+ ', 'Power Supply', 299, 350, 50, 'ATX12V / EPS12V\r\nFull Modular\r\n80 PLUS PLATINUM Certified\r\n100 - 240 V 50/60 Hz\r\n+3.3V@25A, +5V@25A, +12V@108A, -12V@0.3A, +5VSB@3A    ', '62cbb5dd95fdb.jpg'),
(7, 'KingSpec SSD  ', 'Storage', 100, 150, 50, 'KingSpec 2.5 Inch SATA SSD fit with most of computers. It\'s 10x faster than typical HDD, the speed can up to 560Mb/s.\r\nHigh Performance: SATA III 6Gb/s transfer interface. Faster reading, writing and respond speed of data.Quick Boot , Faster Loading.', '62cbb64626c86.jpg'),
(8, 'CORSAIR Vengeance 32GB', 'Memory', 229, 250, 8, 'Capacity	32GB (2 x 16GB)\r\nType	288-Pin PC RAM\r\nSpeed	DDR5 5600 (PC5 44800)\r\nCAS Latency	36\r\nTiming	36-36-36-76\r\nVoltage	1.25V\r\nChipset	Intel XMP 3.0\r\nColor	Black\r\nLED Color	None', '62cbb6ba067d7.jpg'),
(9, 'Razer BlackShark V2 Pro Wireless  ', 'Headset', 179, 200, 10, 'The #1 Best-Selling Gaming Peripherals Brand: Source - The NPD Group, Inc. U.S. Retail Tracking Service: Gaming Keyboards, Gaming Mice, Gaming Headsets, Gaming Peripherals; Based on dollar sales, Jan-Sept. 2021 combined\r\nTHX 7.1 Surround Sound Capabl', '62cbb775d9ca6.jpg'),
(10, 'Logitech - PRO X SUPERLIGHT', 'Mouse', 299, 320, 10, 'Included Items Logitech G PRO X SUPERLIGHT Wireless Gaming Mouse Lightspeed wireless receiver Charging/data cable Receiver extension adapter Optional grip tape Cloth wipe for grip tape prep Optional aperture door with PTFE foot Owner\'s manual Feature', '62cbb7f2e1301.jpg'),
(11, 'Keychron K3 V2 84 Keys ', 'Keyboard', 84, 90, 10, 'Keychron K3, a compact 75% layout ultra-slim wireless mechanical keyboard built for peak productivity and a great tactile typing experience.    ', '62cbbb472ae7b.jpg'),
(13, 'LG UltraGear 27GL83A-B', 'Other Accessories', 900, 1000, 50, '2560 x 1440 (2K) 144 Hz\r\n1 ms (GtG at Faster)\r\nHDMI DisplayPort\r\n1,000:1\r\n1.07 Billion\r\nHeight, Pivot, Tilt\r\nVESA 100 x 100\r\n                                        ', '62cbbb8b23abd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `useremail` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `useremail`, `password`, `role`) VALUES
(1, 'yoshi', 'yoshi@mail.com', 'asdf', 'Admin'),
(2, 'mario', 'mario@mail.com', 'asdf', 'User'),
(3, 'ninja', 'ninja@mail.com', 'asdf', 'User'),
(4, 'bean', 'bean@mail.com', 'asdf', 'User'),
(5, 'macro', 'macro@mail.com', 'asdf', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
