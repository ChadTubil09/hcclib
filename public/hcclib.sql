-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 03:21 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcclib`
--

-- --------------------------------------------------------

--
-- Table structure for table `accession`
--

CREATE TABLE `accession` (
  `accid` int(11) NOT NULL,
  `accno` varchar(255) NOT NULL,
  `accbookid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `isdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accession`
--

INSERT INTO `accession` (`accid`, `accno`, `accbookid`, `status`, `isdel`) VALUES
(1, 'AC0000001', 2, 1, 0),
(2, 'AC0000002', 1, 0, 0),
(3, 'AC0000003', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `audittrail`
--

CREATE TABLE `audittrail` (
  `atid` int(11) NOT NULL,
  `atuid` int(11) NOT NULL,
  `ataction` varchar(255) NOT NULL,
  `atmessage` varchar(255) NOT NULL,
  `atdatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audittrail`
--

INSERT INTO `audittrail` (`atid`, `atuid`, `ataction`, `atmessage`, `atdatetime`) VALUES
(1, 1, 'Borrow', 'Borrow process with book accession no. of (AC0000001)', '2023-08-27 07:55:05'),
(2, 1, 'Add', 'Add a copy of book with accession no. of(AC0000002)', '2023-08-27 08:04:43'),
(3, 1, 'Update', 'Updated a book (Harry Potter and the Sorcerer\'s Stone)', '2023-08-27 08:05:38'),
(4, 1, 'Update', 'Updated a book (Harry Potter and the Sorcerer\'s Stone)', '2023-08-27 08:07:21'),
(5, 1, 'Add', 'Add a copy of book with accession no. of(AC0000003)', '2023-08-27 08:09:50'),
(6, 1, 'Update', 'Updated a book (Harry Potter and the Goblet of Fire)', '2023-08-27 08:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `edition` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `issn` varchar(255) NOT NULL,
  `callnumber` varchar(255) NOT NULL,
  `publication` varchar(255) NOT NULL,
  `placeofpub` varchar(255) NOT NULL,
  `dateofpub` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `subaddedentry` text NOT NULL,
  `notes` text NOT NULL,
  `contents` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `bookcatid` int(11) NOT NULL,
  `copies` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `isdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `title`, `authors`, `edition`, `isbn`, `issn`, `callnumber`, `publication`, `placeofpub`, `dateofpub`, `description`, `subaddedentry`, `notes`, `contents`, `image`, `bookcatid`, `copies`, `status`, `isdel`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling, Olly Moss', '', '9781781100486', '', '1', 'Pottermore', '', '2015', 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling.', 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling.', 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling.', 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling.', 'http://hcclib.edu.ph/public/uploaded/1692845972_e2983053e782a5da32a4.jpg', 8, 1, 0, 0),
(2, 'Harry Potter and the Chamber of Secrets', 'J.K. Rowling', '', '9781781100509', '', '2', 'Pottermore', '', '0000-00-00', 'Harry Potter and the Chamber of Secrets is a fantasy novel written by British author J. K. Rowling and the second novel in the Harry Potter series.', 'Harry Potter and the Chamber of Secrets is a fantasy novel written by British author J. K. Rowling and the second novel in the Harry Potter series.', 'Harry Potter and the Chamber of Secrets is a fantasy novel written by British author J. K. Rowling and the second novel in the Harry Potter series.', 'Harry Potter and the Chamber of Secrets is a fantasy novel written by British author J. K. Rowling and the second novel in the Harry Potter series.', 'http://hcclib.edu.ph/public/uploaded/1692846257_48acce277841b9deb19b.jpg', 10, 0, 0, 0),
(3, 'Harry Potter and the Prisoner of Azkaban', 'J.K. Rowling', '', '9781781100516', '', '3', 'Pottermore', '', '0000-00-00', 'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series. The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry.', 'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series. The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry.', 'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series. The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry.', 'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J. K. Rowling and is the third in the Harry Potter series. The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry.', 'http://hcclib.edu.ph/public/uploaded/1692691503_b867dfdae2c569d18f30.jpg', 9, 0, 0, 0),
(4, 'Harry Potter and the Goblet of Fire', 'J.K. Rowling', '', '9781781100523', '', '4', 'Pottermore', '', '2015', 'Harry Potter and the Goblet of Fire is a fantasy novel written by British author J. K. Rowling and the fourth novel in the Harry Potter series.', 'Harry Potter and the Goblet of Fire is a fantasy novel written by British author J. K. Rowling and the fourth novel in the Harry Potter series.', 'Harry Potter and the Goblet of Fire is a fantasy novel written by British author J. K. Rowling and the fourth novel in the Harry Potter series.', 'Harry Potter and the Goblet of Fire is a fantasy novel written by British author J. K. Rowling and the fourth novel in the Harry Potter series.', 'http://hcclib.edu.ph/public/uploaded/1692691457_c178888644b360f8317a.jpg', 6, 1, 0, 0),
(5, 'Harry Potter and the Order of the Phoenix', 'J.K. Rowling', '', '9781781100530', '', '5', 'Pottermore', '', '0000-00-00', 'Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series.', 'Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series.', 'Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series.', 'Harry Potter and the Order of the Phoenix is a fantasy novel written by British author J. K. Rowling and the fifth novel in the Harry Potter series.', 'http://hcclib.edu.ph/public/uploaded/1692691491_2910415ac4489dee99d0.jpg', 1, 0, 0, 0),
(6, 'Harry Potter and the Half-Blood Prince', 'J.K. Rowling', '', '9781781100547', '', '6', 'Pottermore', '', '0000-00-00', 'Harry Potter and the Half-Blood Prince is a fantasy novel written by British author J. K. Rowling and the sixth and penultimate novel in the Harry Potter series.', 'Harry Potter and the Half-Blood Prince is a fantasy novel written by British author J. K. Rowling and the sixth and penultimate novel in the Harry Potter series.', 'Harry Potter and the Half-Blood Prince is a fantasy novel written by British author J. K. Rowling and the sixth and penultimate novel in the Harry Potter series.', 'Harry Potter and the Half-Blood Prince is a fantasy novel written by British author J. K. Rowling and the sixth and penultimate novel in the Harry Potter series.', 'http://hcclib.edu.ph/public/uploaded/1692691471_dadf59ea6574c83eed8f.jpg', 5, 0, 0, 0),
(7, 'Harry Potter and the Deathly Hallows', 'J.K. Rowling', '', '9781781102435', '', '7', 'Pottermore', '', '0000-00-00', 'Harry Potter and the Deathly Hallows is a fantasy novel written by British author J. K. Rowling and the seventh and final novel in the Harry Potter series. It was released on 21 July 2007 in the United Kingdom by Bloomsbury Publishing, in the United States by Scholastic, and in Canada by Raincoast Books.', 'Harry Potter and the Deathly Hallows is a fantasy novel written by British author J. K. Rowling and the seventh and final novel in the Harry Potter series. It was released on 21 July 2007 in the United Kingdom by Bloomsbury Publishing, in the United States by Scholastic, and in Canada by Raincoast Books.', 'Harry Potter and the Deathly Hallows is a fantasy novel written by British author J. K. Rowling and the seventh and final novel in the Harry Potter series. It was released on 21 July 2007 in the United Kingdom by Bloomsbury Publishing, in the United States by Scholastic, and in Canada by Raincoast Books.', 'Harry Potter and the Deathly Hallows is a fantasy novel written by British author J. K. Rowling and the seventh and final novel in the Harry Potter series. It was released on 21 July 2007 in the United Kingdom by Bloomsbury Publishing, in the United States by Scholastic, and in Canada by Raincoast Books.', 'http://hcclib.edu.ph/public/uploaded/1692691445_d033c8412f50401310ed.jpg', 2, 0, 0, 0),
(8, 'Harry Potter and the Cursed Child', 'Jack Thorne, J. K. Rowling, John Tiffany', '', '9781338099133', '', '8', 'Arthur A. Levine Books', '', '0000-00-00', 'Harry Potter and the Cursed Child is a play written by Jack Thorne, based on an original story written by J. K. Rowling, John Tiffany, and Thorne. The story is set nineteen years after the events of Harry Potter and the Deathly Hallows.', 'Harry Potter and the Cursed Child is a play written by Jack Thorne, based on an original story written by J. K. Rowling, John Tiffany, and Thorne. The story is set nineteen years after the events of Harry Potter and the Deathly Hallows.', 'Harry Potter and the Cursed Child is a play written by Jack Thorne, based on an original story written by J. K. Rowling, John Tiffany, and Thorne. The story is set nineteen years after the events of Harry Potter and the Deathly Hallows.', 'Harry Potter and the Cursed Child is a play written by Jack Thorne, based on an original story written by J. K. Rowling, John Tiffany, and Thorne. The story is set nineteen years after the events of Harry Potter and the Deathly Hallows.', 'http://hcclib.edu.ph/public/uploaded/1692691434_e3c3089c171a76d7f44f.jpg', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrowid` int(11) NOT NULL,
  `baccid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `studentno` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `duedateofreturn` date NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `borrowdate` date NOT NULL,
  `returndate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrowid`, `baccid`, `name`, `studentno`, `grade`, `section`, `duedateofreturn`, `contactno`, `borrowdate`, `returndate`, `status`) VALUES
(1, 1, 'Charles Reynald San Jose Tubil', 'S123', '12', 'Star', '2023-08-27', '09123456789', '2023-08-27', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `isdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`, `isdel`) VALUES
(1, '000 - Computer Science, Information & General Works', 0),
(2, '100 - Philosophy & Psychology', 0),
(3, '200 - Religion', 0),
(4, '300 - Social Sciences', 0),
(5, '400 - Language', 0),
(6, '500 - Science', 0),
(7, '600 - Technology', 0),
(8, '700 - Arts & Recreation', 0),
(9, '800 - Literature', 0),
(10, '900 - History & Geography', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `ebid` int(11) NOT NULL,
  `ebtitle` varchar(255) NOT NULL,
  `ebauthors` varchar(255) NOT NULL,
  `eblink` text NOT NULL,
  `ebstatus` int(11) NOT NULL,
  `ebisdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`ebid`, `ebtitle`, `ebauthors`, `eblink`, `ebstatus`, `ebisdel`) VALUES
(1, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling, Olly Moss', 'https://docenti.unimc.it/antonella.pascali/teaching/2018/19055/files/ultima-lezione/harry-potter-and-the-philosophers-stone', 0, 0),
(2, ' Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 'https://www.vinayaksiddhacollege.edu.np/public/uploads/file/1645543909.pdf', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `posid` int(11) NOT NULL,
  `posname` varchar(255) NOT NULL,
  `posisdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`posid`, `posname`, `posisdel`) VALUES
(1, 'Administrator', 0),
(2, 'Head Librarian', 0),
(3, 'Staff Librarian', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userposid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `isdel` int(11) NOT NULL,
  `acbooks` int(11) NOT NULL,
  `acborrow` int(11) NOT NULL,
  `acreturn` int(11) NOT NULL,
  `aclogs` int(11) NOT NULL,
  `acsystem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `userposid`, `name`, `email`, `mobile`, `status`, `isdel`, `acbooks`, `acborrow`, `acreturn`, `aclogs`, `acsystem`) VALUES
(1, 'misadmin', '123456', 1, 'MIS Admin', 'mis@hccp.com', '09123456', 0, 0, 1, 1, 1, 1, 1),
(2, 'librarian', '123456', 2, 'Head Librarian', 'librarian@hccp.com', '09123456789', 0, 0, 1, 1, 1, 1, 0),
(3, 'staff', '123456', 3, 'Staff Librarian', 'staff@hccp.com', '09123456789', 0, 0, 1, 0, 0, 0, 0),
(4, 'chad', '123456', 1, 'Charles Reynald San Jose Tubil', 'chadtubil.work@gmail.com', '09123456789', 0, 0, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accession`
--
ALTER TABLE `accession`
  ADD PRIMARY KEY (`accid`);

--
-- Indexes for table `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`atid`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrowid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`ebid`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`posid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accession`
--
ALTER TABLE `accession`
  MODIFY `accid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `atid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `ebid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `posid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
