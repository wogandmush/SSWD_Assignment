-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 17, 2019 at 09:45 PM
-- Server version: 5.6.43-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oisincod_labs`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `user_no` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `home_tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `membership` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`user_no`, `first_name`, `last_name`, `date_of_birth`, `gender`, `mobile`, `home_tel`, `email`, `address`, `membership`, `password`) VALUES
(24, 'dfgfdg', 'dfhdfhfd', '2019-03-11', 'male', '0874563457', '0852324323', 'joe@hotmail.com', 'dsgdsg sdg ssdg sdg dsg dsg sdg ds gds ds', 'Adult Yearly', '3463467347347'),
(14, 'agadsgdas', 'fdafaf', '2019-03-11', 'male', '014563457', '014563457', 'oisinmac45@hotmail.com', 'hgdfjdfjgdjgdfj dfgj dgj dfg jdj dgf j gfj ggdjg jdg jgdf fgj', 'Student Monthly', '54456536356'),
(32, 'dfgfdgdf', 'dfhdfhdfh', '2019-03-26', 'female', '014563457', '014563457', 'john@hotmail.com', 'sdfhdfshfdhf sdfhfdshfdsh sdfh fsdh sdfh df hss dfh dfsh', 'Adult Monthly', '435645625472547'),
(234, 'dfgfsgdfsg', 'fsdhsdfhfdh', '2019-03-13', 'male', '0874563457', '0874563457', 'jgfdgdf@gmail.com', 'gfsgdfsg sdfgjkdfjsghkfs gfdsgdflkghdfksl gdfksghjflsg', 'Adult Yearly', '345634634634'),
(2343, 'dsgdsgdsg', 'dsgdsgds', '2019-03-27', 'female', '0564534543', '0564534543', 'jgdsgds@gmail.com', 'gfsgfsd gfsdg dsfg gsdf gdfs gdsf gdsf g', 'Student Monthly', '34634634');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `member`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2344;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
