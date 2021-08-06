-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 08:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah_kucing`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_duration` (IN `v_bookingid` INT)  BEGIN
DECLARE  V_NIGHTS INT default 0;
SELECT datediff(check_out,check_in)
INTO V_NIGHTS
FROM BOOKING 
WHERE BOOKING_ID = v_bookingid;

UPDATE BOOKING SET NIGHTS = V_NIGHTS WHERE BOOKING_ID = V_BOOKINGID;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(10) NOT NULL,
  `Admin_username` varchar(255) NOT NULL,
  `Admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_username`, `Admin_password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_ID` int(10) NOT NULL,
  `Cust_ID` int(10) NOT NULL,
  `Room_ID` int(10) NOT NULL,
  `QuantityofCats` int(11) NOT NULL,
  `Booking_Date` date NOT NULL,
  `Booking_Status` varchar(255) NOT NULL,
  `Check_in` date NOT NULL,
  `Check_out` date NOT NULL,
  `Remarks` varchar(500) NOT NULL,
  `Serv_ID` int(10) NOT NULL,
  `Nights` int(10) DEFAULT NULL,
  `QuantityofBooking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `Cust_ID`, `Room_ID`, `QuantityofCats`, `Booking_Date`, `Booking_Status`, `Check_in`, `Check_out`, `Remarks`, `Serv_ID`, `Nights`, `QuantityofBooking`) VALUES
(42, 1, 1, 3, '2021-06-14', 'Paid', '2021-06-15', '2021-06-18', 'Angry', 2, 3, 1),
(56, 7, 1, 2, '2021-06-16', 'Pending', '2021-06-17', '2021-06-20', 'Always hungry', 3, 3, 1),
(57, 7, 1, 3, '2021-06-16', 'Pending', '2021-06-28', '2021-06-30', '', 1, 2, 1),
(58, 1, 1, 1, '2021-06-28', 'Pending', '2021-07-13', '2021-07-15', '', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `Breed_ID` int(10) NOT NULL,
  `Breed_Name` varchar(255) NOT NULL,
  `Breed_Desc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`Breed_ID`, `Breed_Name`, `Breed_Desc`) VALUES
(1, 'Persian Cat', 'Long-haired breed of cat characterized by its round face and short muzzle'),
(2, 'British Shorthair', 'Pedigreed version of the traditional British domestic cat, with a distinctively stocky body, dense coat, and broad face.'),
(3, 'Sphynx Cat', 'A breed of cat known for its lack of coat (fur). '),
(4, 'Maine Coon', 'The largest domesticated cat breed. It has a distinctive physical appearance and valuable hunting skills'),
(5, 'Siamese Cat', 'The Siamese cat is one of the first distinctly recognized breeds of Asian cat. Derived from the Wichianmat landrace, one of several varieties of cat native to Thailand, the original Siamese became one of the most popular breeds in Europe and North America in the 19th century.'),
(6, 'American Shorthair', 'The American Shorthair is a breed of domestic cat believed to be descended from European cats brought to North America by early settlers to protect valuable cargo from mice and rats.'),
(7, 'Ragdoll', 'The Ragdoll is a cat breed with a color point coat and blue eyes. They are large and muscular semi-longhair cats with a soft and silky coat.'),
(8, 'Bengal Cat', 'The Bengal cat is a domesticated cat breed created from hybrids of domestic cats, especially the spotted Egyptian Mau, with the Asian leopard cat.'),
(11, 'Russian Blue', 'The Russian Blue is a cat breed that comes in colors varying from a light shimmering silver to a darker, slate grey.'),
(12, 'Exotic Shorthair', 'The Exotic Shorthair is a breed of cat developed as a short-haired version of the Persian.'),
(13, 'Burmese Cat', 'The Burmese cat is a breed of domestic cat, originating in Burma, believed to have its roots near the Thai-Burma border and developed in the United States and Britain.'),
(14, 'Munchkin Cat', 'The Munchkin cat or Sausage cat is a relatively new breed of cat characterized by its very short legs, which are caused by a genetic mutation.'),
(15, 'Savannah Cat', 'The Savannah is a hybrid cat breed. It is a cross between a serval and a domestic cat.');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_ID`, `Category_Name`) VALUES
(1, 'Pet Food'),
(2, 'Pet Toys'),
(3, 'Pet Furniture'),
(4, 'Litter & Toilet'),
(5, 'Fashion Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_ID` int(10) NOT NULL,
  `Cust_Fname` varchar(255) NOT NULL,
  `Cust_Lname` varchar(255) NOT NULL,
  `Cust_PhoneNo` varchar(12) NOT NULL,
  `Cust_Email` varchar(255) NOT NULL,
  `Cust_DOB` date NOT NULL,
  `Cust_Address` varchar(255) NOT NULL,
  `Cust_Gender` varchar(10) NOT NULL,
  `Cust_Password` varchar(255) NOT NULL,
  `Images_Name` varchar(255) NOT NULL,
  `Images_Location` varchar(255) NOT NULL,
  `Images_Datatype` blob NOT NULL,
  `Token` varchar(255) NOT NULL,
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_Fname`, `Cust_Lname`, `Cust_PhoneNo`, `Cust_Email`, `Cust_DOB`, `Cust_Address`, `Cust_Gender`, `Cust_Password`, `Images_Name`, `Images_Location`, `Images_Datatype`, `Token`, `Create_at`) VALUES
(1, 'Zul', 'azri', '01121258100', 'zulazrizulkarnain@gmail.com', '1999-01-03', 'no 8 tu 10 taman tasik utama', 'Male', '$2y$10$s1J7nhEixnvmXj.Rsq2wsOAvDqCNSe1tPtJAOKWhEe6BIVh0DW2Ru', 'donut.png', '../images/user profile picture/donut.png', 0x646f6e75742e706e67, '160d9d5392ca85', '2021-01-17 09:34:19'),
(2, 'Rashida', 'Arisya', '01119970966', 'shidarisya@gmail.com', '1999-08-02', 'Lot 123, Taman Melati', 'Female', '$2y$10$xMSkO4UPxwzyJQ9vABCGJOvspT88RvfoICxU/R7uS18jLtntl3SIC', '', '../images/user profile picture/default_profile.png', '', '', '2021-01-17 10:23:19'),
(3, 'Nur Fatini Amirah', 'Saad', '01110344140', 'fatiniamirah39@gmail.com', '1999-09-03', '23, Jalan Seri Pagi 27, SU', 'Female', '$2y$10$l9wkPyVvJAtS..ZlKdhoCevQSG8tI7jnP46kJMxR.o3l2CNbQAD4y', '', '../images/user profile picture/default_profile.png', '', '', '2021-01-17 11:06:34'),
(4, 'Siti Hajar', 'Mohd Taufek', '01918273645', 'hajar@gmail.com', '1997-05-05', 'Parit Buntar, Perak', 'Female', '$2y$10$uQCRbb0KejywWjvi2ecdCulmtuFABOdfHpRU9x0m0RevVtku.vMqW', '', '../images/user profile picture/default_profile.png', '', '', '2021-01-18 11:28:45'),
(5, 'test', 'testing', '0123456789', 'test@gmail.com', '2006-04-12', 'Taman Kajang', 'Male', '$2y$10$FTMFw9fijFZxHg/Xy6pYzOcFDsXPWBhr9pXj6f8.db9q/VjPkHnxG', '', '../images/user profile picture/default_profile.png', '', '1600990bfe99ab', '2021-01-21 06:31:24'),
(7, 'Amir', 'Amirul', '0117284947', 'amiramirul997@gmail.com', '1999-11-06', 'No 203 TU 3 Taman Tasik Utama', 'Male', '$2y$10$Q775XDE6e12ZRsvoZFp6QuVk1QbFxKOWrlqAQA4eq4dNW/lgLYe0i', 'girl.jpg', '../images/user profile picture/girl.jpg', 0x6769726c2e6a7067, '', '2021-05-27 00:35:11'),
(8, 'bo', 'boy', '01121258100', 'sdnajd@gmail.com', '1222-12-02', 'asjdnakjndkajdnakjdnakndkjdn', 'Male', '$2y$10$xK41l/TV1aBcNfMPFlX4V./TZEP8uATbT91lsqQHT.oU9dp5GWzIO', 'default_profile.png', '../images/user profile picture/default_profile.png', 0x64656661756c745f70726f66696c652e706e67, '', '2021-06-06 17:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(10) NOT NULL,
  `Cust_ID` int(10) NOT NULL,
  `Total` decimal(6,2) NOT NULL,
  `Payment_Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Cust_ID`, `Total`, `Payment_Timestamp`) VALUES
(21, 1, '215.00', '2021-03-15 15:27:51'),
(25, 7, '333.00', '2021-06-15 20:26:21'),
(26, 1, '100.00', '2021-06-26 18:35:15'),
(27, 1, '100.00', '2021-06-26 18:57:47'),
(28, 1, '0.00', '2021-06-26 18:57:57'),
(29, 1, '475.00', '2021-06-27 02:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `Pet_ID` int(10) NOT NULL,
  `Cust_ID` int(10) NOT NULL,
  `Pet_Name` varchar(255) NOT NULL,
  `Pet_Colour` varchar(255) NOT NULL,
  `Pet_Sex` varchar(10) NOT NULL,
  `Breed_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`Pet_ID`, `Cust_ID`, `Pet_Name`, `Pet_Colour`, `Pet_Sex`, `Breed_ID`) VALUES
(1, 2, 'Leeon', 'Yellowish', 'Male', 15),
(3, 1, 'Momo', 'Pink', 'Male', 14),
(4, 1, 'Mimi', 'Yellow', 'Female', 12),
(13, 7, 'Oyen', 'orange', 'Male', 1),
(18, 1, 'Tompok', 'black and white', 'Male', 8);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Prod_ID` int(10) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Prod_Name` varchar(255) NOT NULL,
  `Prod_Price` decimal(5,2) NOT NULL,
  `Prod_Status` varchar(255) NOT NULL,
  `Prod_Images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Prod_ID`, `Category_ID`, `Prod_Name`, `Prod_Price`, `Prod_Status`, `Prod_Images`) VALUES
(1, 1, 'Royal Canin Fit 32', '70.00', 'Not available', '../images/products/rc_fit_32.png'),
(2, 1, 'Royal Canin Hairball', '70.00', 'Not available', '../images/products/rc_hairball.png'),
(3, 1, 'Royal Canin Bengal', '50.00', 'Available', '../images/products/rc_bengal.png'),
(4, 1, 'Royal Canin Urinary', '90.00', 'Available', '../images/products/rc_urinary.png'),
(5, 1, 'Royal Canin Babycat', '20.00', 'Available', '../images/products/rc_mother&babycat.png'),
(6, 1, 'Royal Canin British Shorthair', '33.00', 'Available', '../images/products/rc_british_shorthair.png'),
(7, 1, 'Royal Canin Digestive', '25.00', 'Available', '../images/products/rc_digestive.png'),
(8, 1, 'Royal Canin Ragdoll', '34.00', 'Available', '../images/products/rc_ragdoll.png'),
(9, 1, 'Royal Canin Hair & Skin', '52.00', 'Available', '../images/products/rc_hair&skin.png'),
(12, 1, 'Royal Canin Wet Kitten', '30.00', 'Available', '../images/products/rc_kitten.png'),
(13, 1, 'Royal Canin Protein Exigent', '77.00', 'Available', '../images/products/rc_protein_exigent.png'),
(14, 1, 'Royal Canin Aroma Exigent', '90.00', 'Available', '../images/products/rc_aroma_exigent.png'),
(15, 2, 'Bird Teaser with Feathers Cat Toy', '4.99', 'Available', '../images/products/toy2.JPG'),
(16, 2, 'Basic Plush Mice Cat Toy', '3.89', 'Available', '../images/products/toy3.JPG'),
(17, 2, 'Interactive Electric Flopping Fish Cat Toy with Catnip', '36.79', 'Available', '../images/products/toy4.JPG'),
(18, 2, 'Birthday Scratcher Cat Toy', '28.00', 'Available', '../images/products/toy5.JPG'),
(19, 2, 'Cat Tracks Butterfly Cat Toy', '32.69', 'Available', '../images/products/toy1.JPG'),
(20, 2, 'Fabric Teaser Cat Toy', '4.99', 'Available', '../images/products/toy6.JPG'),
(21, 2, 'Peek-a-Boo Cat Chute Cat Toy, Colorful Tri-Tunnel', '48.50', 'Available', '../images/products/toy7.JPG'),
(22, 2, 'Ethical Pet Laser Exerciser Original 2 in 1 Cat Toy', '20.39', 'Available', '../images/products/toy8.JPG'),
(23, 2, 'Bergan Scratcher Replacement Pads', '24.80', 'Available', '../images/products/toy9.JPG'),
(24, 2, 'SmartyKat Flutter Balls Feathery Cat Toy', '9.99', 'Available', '../images/products/toy10.JPG'),
(25, 2, 'Ethical Pet Sponge Soccer Ball Cat Toy', '8.50', 'Available', '../images/products/toy11.JPG'),
(26, 3, 'Milo Cat Tree', '200.00', 'Available', '../images/products/tuft-paw-milo-cat-tree-2_f1257422-e1e7-45d8-ac8d-f332f60f607d_1200x.jpg'),
(27, 3, 'The Groove Tower', '156.99', 'Available', '../images/products/05-Grove-Tower-24-Ash-9307-web_1200x.jpg'),
(28, 3, 'Frond Tower Black', '137.99', 'Available', '../images/products/02-Frond-Tower-Black-11730-web_1200x.jpg'),
(29, 3, 'The Plateau Perch Ash', '99.99', 'Available', '../images/products/TP-Plateau-Perch-Ash-9568_01-min_1200x.jpg'),
(30, 3, 'Happy Camper Tent Bed Scratching', '59.99', 'Available', '../images/products/HappyCamper-TentBed-Ash-10089-web_1_1200x.jpg'),
(31, 3, 'Zip Walnut Scratching', '47.99', 'Available', '../images/products/TP-Zip-Post-Walnut-12137_01_1200x.jpg'),
(32, 3, 'Scratching Board', '29.99', 'Available', '../images/products/01-Tab-Board-WhiteAsh-11517-web_1200x_506b956f-eeb2-4bb4-b399-5f0ddafd3f15_1200x.jpg'),
(33, 3, 'Beckon Bed ', '78.69', 'Available', '../images/products/02-Beckon-Bed-Walnut-10877-web_1200x.jpg'),
(34, 3, 'Stellar Bed Ivory', '70.00', 'Available', '../images/products/02-Stellar-Bed-Ivory-10984-web_1200x.jpg'),
(35, 3, 'Puff Bed Ivory', '35.99', 'Available', '../images/products/Puff-Bed-Ivory-9718-web_1200x.jpg'),
(36, 3, 'Kip Cushion Small Bed', '27.00', 'Available', '../images/products/Kip-Cushion-Small-Ivory-8915-web_1200x.jpg'),
(37, 3, 'Sunday Bed Misty', '25.00', 'Available', '../images/products/Sunday-Bed-Misty-10148-web_1200x.jpg'),
(38, 3, 'Peekaboo Tent Bed', '36.99', 'Available', '../images/products/06-Peekaboo-TentBed-16264-web-min_1200x.jpg'),
(39, 4, 'Cove Shelter Gray Litter', '28.00', 'Available', '../images/products/Cove-Shelter-Gray-10378-web_1200x.jpg'),
(40, 4, 'Haven Litter Box', '44.69', 'Available', '../images/products/02-Haven-LitterBox-Ash-15937-web-min_1200x.jpg'),
(41, 4, 'Tuft Paw Modern Cat Litter', '65.99', 'Available', '../images/products/tuft-paw-modern-cat-furniture-128_1200x.jpg'),
(42, 4, 'Litter Box Scoop Set', '15.99', 'Available', '../images/products/LitterBoxScoop_Brush_DustpanSet_1200x.jpg'),
(43, 5, 'Cheshire Wain Rigby', '24.79', 'Available', '../images/products/Cheshire_WainRigby-min_1200x_84d6515b-d5eb-4145-9519-28330c971d36_1200x.jpg'),
(44, 5, 'Candyfloss Pink Collar', '17.99', 'Available', '../images/products/tuft-and-paw-Candyfloss-Pink-Collar_1200x_09985f67-1885-4c62-844c-4fa8c84d47c8_1200x.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `Cart_ID` int(10) NOT NULL,
  `Cust_ID` int(10) NOT NULL,
  `Prod_ID` int(10) NOT NULL,
  `Prod_Name` varchar(255) NOT NULL,
  `Prod_Price` decimal(5,2) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Total_Price` decimal(5,2) NOT NULL,
  `Prod_Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_cart`
--

INSERT INTO `product_cart` (`Cart_ID`, `Cust_ID`, `Prod_ID`, `Prod_Name`, `Prod_Price`, `Quantity`, `Total_Price`, `Prod_Status`) VALUES
(14, 1, 4, 'Royal Canin Urinary', '90.00', 1, '90.00', 'Paid'),
(17, 1, 1, 'Royal Canin Fit 32', '110.00', 204, '999.99', 'Paid'),
(18, 1, 8, 'Royal Canin Ragdoll', '34.00', 2, '68.00', 'Paid'),
(19, 1, 9, 'Royal Canin Hair & Skin', '52.00', 1, '52.00', 'Paid'),
(21, 7, 6, 'Royal Canin British Shorthair', '33.00', 1, '33.00', 'Paid'),
(22, 7, 2, 'Royal Canin Hairball', '70.00', 2, '140.00', 'Pending'),
(23, 7, 3, 'Royal Canin Bengal', '50.00', 1, '50.00', 'Pending'),
(24, 7, 4, 'Royal Canin Urinary', '90.00', 1, '90.00', 'Pending'),
(25, 7, 3, 'Royal Canin Bengal', '50.00', 5, '250.00', 'Pending'),
(26, 7, 3, 'Royal Canin Bengal', '50.00', 1, '50.00', 'Pending'),
(27, 7, 3, 'Royal Canin Bengal', '50.00', 1, '50.00', 'Pending'),
(46, 1, 42, 'Litter Box Scoop Set', '15.99', 1, '15.99', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `Room_ID` int(10) NOT NULL,
  `Room_Type` varchar(255) NOT NULL,
  `Room_Status` varchar(255) NOT NULL,
  `Room_Price` decimal(5,2) NOT NULL,
  `Room_Slot` int(10) NOT NULL,
  `Room_Images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_ID`, `Room_Type`, `Room_Status`, `Room_Price`, `Room_Slot`, `Room_Images`) VALUES
(1, 'Premium Room', 'Available', '30.00', 34, '../images/room1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `Serv_ID` int(10) NOT NULL,
  `Serv_Name` varchar(255) NOT NULL,
  `Serv_Desc` varchar(500) NOT NULL,
  `Serv_Fee` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`Serv_ID`, `Serv_Name`, `Serv_Desc`, `Serv_Fee`) VALUES
(1, 'Basic Grooming', 'Include bath, nail trim, hair brush, premium shampoo and ear, eyes & nose cleaning', '55.00'),
(2, 'Lion Cut & Trimming', 'Trimming cat fur', '30.00'),
(3, 'Beauty & Wellness Spa', 'Include sea mud & de-flea treatment, aromatic salt bath, oatmeal scrub and collagen essence bath', '70.00'),
(4, 'No', '', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` int(10) NOT NULL,
  `Staff_Name` varchar(255) NOT NULL,
  `Staff_PhoneNo` varchar(12) NOT NULL,
  `Staff_Address` varchar(255) NOT NULL,
  `Staff_Email` varchar(255) NOT NULL,
  `Staff_Gender` varchar(10) NOT NULL,
  `Staff_Images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `Staff_Name`, `Staff_PhoneNo`, `Staff_Address`, `Staff_Email`, `Staff_Gender`, `Staff_Images`) VALUES
(2, 'Siti Hajar', '0192837465', 'Parit Buntar, Perak', 'staffpawshajar@gmail.com', 'Female', '../images/user profile picture/default_profile.png'),
(5, 'ismat azmy', '01121258100', 'taman melawati', 'mat@gmail.com', 'Male', '../images/user profile picture/default_profile.png'),
(7, 'User', '0123456789', 'no 8 tu 10 taman tasik utama', 'user@gmail.com', 'Female', '../images/user profile picture/default_profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `Pet_ID` (`Cust_ID`),
  ADD KEY `Room_ID` (`Room_ID`),
  ADD KEY `Serv_ID` (`Serv_ID`);

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`Breed_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`Pet_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`),
  ADD KEY `Breed_ID` (`Breed_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Prod_ID`),
  ADD KEY `category_namefk` (`Category_ID`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`Cart_ID`),
  ADD KEY `cart_fk1` (`Cust_ID`),
  ADD KEY `cart_fk2` (`Prod_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`Room_ID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`Serv_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Booking_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `Breed_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cust_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `Pet_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Prod_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `Cart_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `Room_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `Serv_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Staff_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`Room_ID`) REFERENCES `room` (`Room_ID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`Serv_ID`) REFERENCES `service` (`Serv_ID`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`Breed_ID`) REFERENCES `breed` (`Breed_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `category_namefk` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`Category_ID`);

--
-- Constraints for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD CONSTRAINT `cart_fk1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`),
  ADD CONSTRAINT `cart_fk2` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
