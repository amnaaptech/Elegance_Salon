-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 01:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hair_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Years` varchar(255) DEFAULT NULL,
  `Add_Tittle_1` varchar(255) DEFAULT NULL,
  `Add_Tittle_2` varchar(255) DEFAULT NULL,
  `Add_Tittle_3` varchar(255) DEFAULT NULL,
  `Experience` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `Image`, `Years`, `Add_Tittle_1`, `Add_Tittle_2`, `Add_Tittle_3`, `Experience`) VALUES
(1, 'about.jpg', '24 YEARS', 'More Than Just A Haircut. Learn More About Us!', 'Since 2000', '1000+ clients', 'EXPERIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `services` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `viewed` tinyint(1) DEFAULT 0,
  `user_view` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `fullname`, `contact`, `email`, `date`, `services`, `total_price`, `status`, `viewed`, `user_view`) VALUES
(44, 'Danish Tahmoor', '0311-5469785', 'danish132@gmail.com', '2024-11-25', '1:HAIRCUT,4:Beard,7:Grooming', 950.00, 'Declined', 1, 0),
(45, 'Tahmoor Baig', '0308-5124462', 'baig77652@gmail.com', '2024-11-21', '2:Hair Dye,3:Hair Wash,4:Beard,6:Head Massage', 1350.00, 'Declined', 1, 0),
(46, 'Haris Muneer', '0323-1202214', 'harismuneer453@gmail.com', '2024-11-20', '1:HAIRCUT,3:Hair Wash,7:Grooming', 850.00, 'Accepted', 1, 0),
(47, 'Asim Jameel', '0334-8123277', 'asim32@gmail.com', '2024-11-20', '2:Hair Dye,3:Hair Wash,6:Head Massage,7:Grooming', 1400.00, 'Accepted', 1, 1),
(48, 'Malik Riyaz', '0311-0022014', 'malikriyazofficial@gmail.com', '2024-11-21', '1:HAIRCUT,6:Head Massage,9:Facials ', 1200.00, 'Accepted', 1, 0),
(49, 'Umar Bashir', '0311-2145789', 'ub77165@gmail.com', '2024-11-21', '1:HAIRCUT,9:Facials ', 950.00, 'Accepted', 1, 1),
(50, 'Ali Akbar', '0321-4561237', 'akbar32@gmail.com', '2024-11-21', '3:Hair Wash,6:Head Massage,7:Grooming', 700.00, 'Accepted', 1, 1),
(51, 'Asim Jameel', '0334-8123277', 'asim32@gmail.com', '2024-11-23', '1:HAIRCUT,5:Shaving,7:Grooming', 850.00, 'Declined', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `price`, `image`, `name`) VALUES
(20, 26, 8, 1, 1500.00, 'shampoo + conditioner.webp ', '  Shampoo + Conditioner');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `message`) VALUES
(1, 'Haris Muneer', '0323-1202214', 'haris@gmail.com', 'I need to complain that your barbers are not good at haircut.'),
(2, 'Ali', '0300-2560122', 'ali@gmail.com', 'I need help');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(200) NOT NULL,
  `Client_Name` varchar(200) NOT NULL,
  `Message` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `Client_Name`, `Message`, `Email`, `image`) VALUES
(1, 'Umar Bashir', 'Providing unbiased written detailed description that makes it valuable', 'umer@gmail.com', 'testimonial-1.jpg'),
(2, 'Haris Muneer', 'Execellent service is provided in a professional and friendly way. Booking are made easy thanks to a well developed app.', 'haris@gmail.com', 'testimonial-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `index_banner`
--

CREATE TABLE `index_banner` (
  `id` int(11) NOT NULL,
  `Banner_title` varchar(255) DEFAULT NULL,
  `Banner_Adress` varchar(255) DEFAULT NULL,
  `Banner_Number` varchar(255) DEFAULT NULL,
  `Banner_Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `index_banner`
--

INSERT INTO `index_banner` (`id`, `Banner_title`, `Banner_Adress`, `Banner_Number`, `Banner_Image`) VALUES
(1, 'LIFE ISN\'T PERFECT BUT YOUR HAIR CAN BE', '  C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi', '+92 323-1202214', 'carousel 3.jpg'),
(2, 'GREAT HAIR DOESN\'T HAPPEN BY CAHNCE. IT HAPPENS BY APPOINTMENT.  ', '  C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi', '+92 323-1202214', 'carousel 1.webp'),
(3, 'Transform Your Hair, Transform Your Life.', ' C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi', '+92 323-1202214', 'carousel 2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `our-team`
--

CREATE TABLE `our-team` (
  `id` int(225) NOT NULL,
  `person_iamges` text NOT NULL,
  `persom_name` text NOT NULL,
  `profession` text NOT NULL,
  `shifts` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our-team`
--

INSERT INTO `our-team` (`id`, `person_iamges`, `persom_name`, `profession`, `shifts`) VALUES
(21, 'adam.jpg', 'Adam Stone', 'Stylist', '9-5'),
(22, 'alex.jpg', 'Alex Brown', 'Stylist', '1-9'),
(23, 'michael.jpg', 'Michael Smith', 'Stylist', '9-5'),
(24, '94784 (1).jpg', 'Thomas Williams', 'Stylist', '1-9');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Product_Title` varchar(255) DEFAULT NULL,
  `Product_Description` varchar(255) DEFAULT NULL,
  `Product_Price` varchar(255) DEFAULT NULL,
  `product_Image` varchar(255) DEFAULT NULL,
  `prod_quantity` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Product_Title`, `Product_Description`, `Product_Price`, `product_Image`, `prod_quantity`) VALUES
(7, 'Anti-Hairfall Shampoo', 'Infused with high-quality natural oils such as Sweet Almond Oil and Sunflower Oil which strengthen your hair and eventually stop them from falling out.', '700', 'anti hairfall shampoo.webp', 30),
(8, '  Shampoo + Conditioner', '  shampoo and conditioner is specially formulated to reduce hair breakage and lock in moisture by combining the benefits of both shampoo and conditioner.   ', '1500', 'shampoo + conditioner.webp ', 25),
(9, 'Anti-Hairfall Oil', ' Anti Hair Fall Oil is a powerful blend of natural ingredients that helps to strengthen hair roots and reduce hair fall.', '1300', 'Anti-Hairfall Oil.webp', 35),
(10, 'De-Tan Face Wash', 'Reverses skin tan and damage caused by sun exposure\r\n', '800', 'De-Tan Face Wash.webp', 40),
(11, 'Beard Growth Oil', 'Nourishes the facial hair with Avocado Oil aka “beard food”', '1200', 'Beard_Growth_oil.webp', 15),
(12, 'Charcoal Face Scrub', 'Dari Mooch\'s activated charcoal face scrub helps deep clean your skin removing dead skin cell and all impurities, giving you a more polished looking complexion.', '1100', 'Charcoal-Face-Scrub.webp', 35),
(13, 'Hair Clay Wax', 'Dari Mooch\'s matte finish Hair Clay Wax provides a natural, textured look. ', '1000', 'Hair Clay Wax.webp', 28),
(14, 'De-tan Sunscreen', 'We understand that a man’s skin is tough, but remember it will always be vulnerable against the sun.', '600', 'De-tan Sunscreen.webp', 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_banner`
--

CREATE TABLE `product_banner` (
  `id` int(225) NOT NULL,
  `Product_Title` varchar(255) DEFAULT NULL,
  `Adress` varchar(255) DEFAULT NULL,
  `Number` varchar(255) DEFAULT NULL,
  `Product_Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_banner`
--

INSERT INTO `product_banner` (`id`, `Product_Title`, `Adress`, `Number`, `Product_Image`) VALUES
(1, 'Beauty collection', ' C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi', '+92 323-1202214', 'pbg2.jpeg'),
(5, 'Beauty Products', ' C 26/1, Block 10 A Gulshan-e-Iqbal, Karachi', '+92 323-1202214', 'productsbg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `role` enum('receptionist','barber','user') DEFAULT 'user',
  `Contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `Name`, `Email`, `Password`, `role`, `Contact`) VALUES
(11, 'Danish Tahmoor', 'danish132@gmail.com', 'Danish99544', 'user', '0311-5469785'),
(12, 'Tahmoor Baig', 'baig77652@gmail.com', 'baig@123', 'user', '0308-5124462'),
(13, 'Haris Muneer', 'harismuneer453@gmail.com', 'Haris@123', 'user', '0323-1202214'),
(14, 'Abdul Hadi', 'siddiqui.hadi0104@gmail.com', 'siddqui@$1', 'user', '0344-5289284'),
(15, 'Umar Bashir', 'ub77165@gmail.com', 'UmarBashir@123', 'user', '0311-2145789'),
(16, 'Malik Riyaz', 'malikriyazofficial@gmail.com', 'riyazM321', 'user', '0311-0022014'),
(17, 'Salman Naseer', 'naseer@gmail.com', 'Slamanweb12', 'user', '0325-6987452'),
(18, 'Tabish Hashmi', 'tabishofficial@gmail.com', 'official@0000', 'user', '0345-1436879'),
(19, 'Sahil Ahmed', 'ahmed452@gmail.com', 'sunny@7777', 'user', '0308-2144447'),
(20, 'Ali Akbar', 'akbar32@gmail.com', 'akbarali876', 'user', '0321-4561237'),
(25, 'Ayesha Ali', 'ayesha12@gmail.com', ' recepayesha1 ', 'receptionist', '0300-11780122'),
(26, 'Asim Jameel', 'asim32@gmail.com', 'Asim@Khan', 'user', '0334-8123277'),
(27, 'Michael Smith', 'michael61@gmail.com', ' michaelstylist321 ', 'barber', '0325-5289284'),
(28, 'Alex Brown', 'alex356@gmail.com', ' alexstylist ', 'barber', '0300-2178478'),
(29, 'Adam Stone', 'stone71@gmail.com', ' stylistadam1 ', 'barber', '0325-1085456'),
(30, 'Thomas Williams', 'williams675@gmail.com', ' Williamsstylist@1 ', 'barber', '0321-4578147');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `Image`, `Title`, `Description`, `Price`) VALUES
(1, 'haircut.jpg', 'HAIRCUT', 'Your Style, Our Expertise!', '400'),
(2, 'hair dye.jpg', 'Hair Dye', 'Color Your World, Define Your Style!', '700'),
(3, 'hair wash.jpg', 'Hair Wash', 'Wash Away the Day, Shine Tomorrow!', '150'),
(4, 'beard trim.webp', 'Beard', 'Where Precision Meets Style: Perfect Your Beard!', '250'),
(5, 'shave.jpg', 'Shaving', 'Smooth faces every time.', '150'),
(6, 'head massage.webp', 'Head Massage', 'Soothing Your Mind, One Massage at a Time.', '250'),
(7, 'groom.jfif', 'Grooming', 'Good things happen to those who grooms.', '300'),
(9, 'spa.jpg', 'Facials ', 'A facial cleanses and rejuvenates the skin for a healthy, glowing look.', '550');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Image` (`Image`),
  ADD UNIQUE KEY `Years` (`Years`),
  ADD UNIQUE KEY `Add_Tittle_1` (`Add_Tittle_1`),
  ADD UNIQUE KEY `Add_Tittle_2` (`Add_Tittle_2`),
  ADD UNIQUE KEY `Add_Tittle_3` (`Add_Tittle_3`),
  ADD UNIQUE KEY `Experience` (`Experience`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `index_banner`
--
ALTER TABLE `index_banner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Banner_title` (`Banner_title`),
  ADD UNIQUE KEY `Banner_Image` (`Banner_Image`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `our-team`
--
ALTER TABLE `our-team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Product_Title` (`Product_Title`),
  ADD UNIQUE KEY `Product_Description` (`Product_Description`),
  ADD UNIQUE KEY `product_Image` (`product_Image`);

--
-- Indexes for table `product_banner`
--
ALTER TABLE `product_banner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Product_Title` (`Product_Title`),
  ADD UNIQUE KEY `Product_Image` (`Product_Image`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Image` (`Image`),
  ADD UNIQUE KEY `Title` (`Title`),
  ADD UNIQUE KEY `Description` (`Description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `index_banner`
--
ALTER TABLE `index_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `our-team`
--
ALTER TABLE `our-team`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_banner`
--
ALTER TABLE `product_banner`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
