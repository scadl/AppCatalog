-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 11:22 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_personal`
--

-- --------------------------------------------------------

--
-- Table structure for table `fmindex`
--

CREATE TABLE `fmindex` (
  `appid` int(15) NOT NULL,
  `app` char(250) DEFAULT NULL,
  `descr` text,
  `size` float DEFAULT NULL,
  `targetos` char(50) DEFAULT NULL,
  `package` char(150) DEFAULT NULL,
  `license` char(70) DEFAULT NULL,
  `price` int(15) DEFAULT NULL,
  `link` text,
  `linktype` char(50) DEFAULT NULL,
  `icon` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fmindex`
--

INSERT INTO `fmindex` (`appid`, `app`, `descr`, `size`, `targetos`, `package`, `license`, `price`, `link`, `linktype`, `icon`) VALUES
(1, 'Portable WinApplication', 'Some sample app', 1, 'win16', 'ispk', 'trial', 0, 'http://stor.com/app.zip', 'authtor', '/MyPHP/fmico/folder_vertical_zipper.png'),
(4, 'Linux Application', 'OpenSource Application', 3, 'win9x', 'innpk', 'sharware', 0, 'http://somelnx/app2.lzm', 'sstor', '/MyPHP/fmico/freebsd.png'),
(7, 'WindowsGame', 'Some Sample Game', 358, 'winnt', 'smi', 'Freeware', 150, 'http://gamedeveloporg.com/wingame.html', 'authtor', '/MyPHP/fmico/board_game.png'),
(9, 'ÐŸÑ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ', 'ÐžÐ¿Ð¸ÑÐ°Ð½Ð¸Ðµ Ñ€ÑƒÑÑÐºÐ¾ÑÐ·Ñ‹Ñ‡Ð½Ð¾Ð³Ð¾ Ð¿Ñ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ñ', 39, 'winv7', 'irs', 'trial', 17, '', 'authtor', '/MyPHP/fmico/coins_add.png'),
(12, 'Application - ÐŸÑ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ', 'NSIS pack', 0, 'allwin', 'nsis', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(13, 'Application - ÐŸÑ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ', '', 0, 'unix', 'iapkg', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(14, 'Application - ÐŸÑ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ', '', 0, 'lxdeb', 'zip', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(15, 'Application - ÐŸÑ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ', '', 0, 'lxrpm', 'deb', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(16, 'Application - ÐŸÑ€Ð¸Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ', '', 0, 'lxrh', 'rpm', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(17, '', '', 0, 'lxsrc', 'ebd', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(18, '', '', 0, 'alllx', 'lxpkg', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(19, '', '', 0, 'solaris', 'pisi', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(20, '', '', 0, 'osx', 'lzm', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(21, '', '', 0, 'macos', 'pet', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(22, '', '', 0, 'wm', 'dmg', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(23, '', '', 0, 'lxand', 'app', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(24, '', '', 0, 'maem', 'macpkg', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(25, '', '', 0, 'wp7', 'tgz', 'GPL', 0, '', 'authtor', '/MyPHP/fmico/'),
(26, '', '', 0, 'wp8', 'apk', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(27, '', '', 0, 'ios', 'wpx', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/'),
(28, '', '', 0, 'ios', 'ipa', 'Freeware', 0, '', 'authtor', '/MyPHP/fmico/');

-- --------------------------------------------------------

--
-- Table structure for table `fmusers`
--

CREATE TABLE `fmusers` (
  `uid` int(5) NOT NULL,
  `uname` char(15) DEFAULT NULL,
  `upasswd` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fmusers`
--

INSERT INTO `fmusers` (`uid`, `uname`, `upasswd`) VALUES
(1, 'Alex', '1234'),
(2, 'Alina', '456'),
(3, 'user', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fmindex`
--
ALTER TABLE `fmindex`
  ADD PRIMARY KEY (`appid`),
  ADD KEY `appid` (`appid`);

--
-- Indexes for table `fmusers`
--
ALTER TABLE `fmusers`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fmindex`
--
ALTER TABLE `fmindex`
  MODIFY `appid` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `fmusers`
--
ALTER TABLE `fmusers`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
