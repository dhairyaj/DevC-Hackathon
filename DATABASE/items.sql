-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: shareddb-g.hosting.stackcp.net
-- Generation Time: Jan 26, 2018 at 09:33 AM
-- Server version: 10.1.14-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vastukosh-32353f7f`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `iid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `cname` text NOT NULL,
  `iname` text NOT NULL,
  `itype` text NOT NULL,
  `isubtype` text NOT NULL,
  `iimage` text NOT NULL,
  `duration` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `rent` int(11) NOT NULL,
  `sell` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`iid`, `id`, `cname`, `iname`, `itype`, `isubtype`, `iimage`, `duration`, `status`, `rent`, `sell`, `price`) VALUES
(10031, 30, 'Siddhartha Dhar Choudhury', 'Kurl-On Bed Set', 'Furniture', 'Bed', '1.jpg', 2, 0, 1, 0, 500),
(10033, 33, 'Dhairya Jain', 'Marvel Series', 'Books', 'Comics', '2.jpg', 0, 0, 0, 1, 120),
(10034, 34, 'Sudipta Dhar Choudhury', 'Azealia Coffee Table', 'Furniture', 'Table', '3.jpg', 0, 0, 0, 0, 0),
(10035, 35, 'Reema Duttavarman', 'Adidas', 'Clothes', 'Rainwear', '4.jpg', 0, 0, 0, 0, 0),
(10036, 36, 'Bhavik Singhal', 'R.S Sedha', 'Books', 'Science', '5.jpg', 0, 0, 0, 0, 0),
(10037, 38, 'Shaique Solanki', 'Puma', 'Clothes', 'T-Shirts & Polos', '6.jpg', 0, 0, 0, 0, 0),
(10039, 42, 'Etishree Sahu', 'Oak Wood Imported', 'Furniture', 'Cupboard', '7.jpg', 6, 0, 1, 0, 650),
(10040, 46, 'Ashutosh Singh', 'Damion Linen', 'Furniture', 'Trunk', '8.jpg', 0, 0, 0, 0, 0),
(10041, 47, 'Shruti Jain', 'Lord of the Rings', 'Books', 'Trilogy', '9.jpg', 1, 0, 1, 0, 50),
(10042, 48, 'Janvee Meghrajini', 'Twilight', 'Books', 'Trilogy', '10.jpg', 0, 0, 0, 0, 0),
(10043, 49, 'Ananthu Nair', 'Puma', 'Clothes', 'Rainwear', '11.jpg', 0, 0, 0, 0, 0),
(10044, 50, 'Vaibhav Jain', 'Adidas', 'Clothes', 'Rainwear', '12.jpg', 0, 0, 0, 1, 238),
(10045, 51, 'Soham Bhowmick', 'The Invisible Man', 'Books', 'Science Fiction', '13.jpg', 0, 0, 0, 0, 0),
(10046, 52, 'Shalin Shandilya', 'LG', 'Home Appliance', 'Microwave Oven', '14.jpg', 0, 0, 0, 0, 0),
(10047, 53, 'Ateet Tiwari', 'Voltas', 'Home Appliance', 'Invertor', '15.jpg', 2, 0, 1, 0, 360),
(10048, 55, 'Nitish Jain', 'Rosewood Authentic Wood', 'Furniture', 'Bookcase', '16.jpg', 0, 0, 0, 0, 0),
(10049, 56, 'Harimangal Pandey', 'Rajasthani Costume', 'Clothes', 'Ethnic Wear', '17.jpg', 0, 0, 0, 0, 0),
(10050, 57, 'Sanjay Jain', 'ESL Pro Comfort', 'Furniture', 'Chair', '18.jpg', 10, 0, 1, 0, 180),
(10051, 58, 'Rajsi Jain', 'Resnik Haliday Walker', 'Books', 'Science', '19.jpg', 0, 0, 0, 1, 200),
(10052, 59, 'Agnibha Biswas', 'Honda', 'Home Appliance', 'Generator', '20.jpg', 0, 0, 0, 0, 0),
(10053, 62, 'Srilekha V', 'Teak Wood', 'Furniture', 'Desk', '21.jpg', 0, 0, 0, 0, 0),
(10055, 65, 'Shashank Pandey', 'Syska', 'Furniture', 'Table Lamp', '22.jpg', 0, 0, 0, 0, 0),
(10056, 66, 'Rushil Gupta', 'Indus Valley Civilisation', 'Books', 'History', '23.jpg', 0, 0, 0, 0, 0),
(10057, 67, 'Amol Agrawal', 'IFB', 'Home Appliance', 'Washing Machine', '24.jpg', 0, 0, 0, 1, 13000),
(10061, 75, 'Anup Sharma', 'US Polo', 'Clothes', 'Jackets', '25.jpg', 0, 0, 0, 0, 0),
(10062, 76, 'Anjali Thakur', 'Teakwood Sleak Furnished', 'Furniture', 'Cupboard', '26.jpg', 0, 0, 0, 0, 0),
(10065, 79, 'Soumen Dhar Choudhary', 'Glass-Top Dining Table', 'Furniture', 'Table', '27.jpg', 0, 0, 0, 1, 5600),
(10067, 82, 'Neha Bathra', 'The Diary of a Young Girl- Anne Frank', 'Books', 'Autobiographies', '28.jpg', 0, 0, 0, 0, 0),
(10068, 84, 'Harsh Jha', 'Puma', 'Clothes', 'Rainwear', '29.jpg', 0, 0, 0, 1, 800),
(10069, 86, 'Mili Das Mohapatra', 'Sinmag', 'Home Appliance', 'Toaster', '30.jpg', 0, 0, 0, 0, 0),
(10070, 87, 'Madhup Upadhyay', 'NilKamal Durable Plastic Chair', 'Furniture', 'Chair', '31.jpg', 0, 0, 0, 1, 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`iid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10071;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
