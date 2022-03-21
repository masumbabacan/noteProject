-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Mar 2022, 12:12:56
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `noteproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'masum@gmail.com', '1234'),
(2, 'admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departments`
--

CREATE TABLE `departments` (
  `departmentCode` int(11) NOT NULL,
  `facultyCode` int(11) NOT NULL,
  `departmentName` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `departments`
--

INSERT INTO `departments` (`departmentCode`, `facultyCode`, `departmentName`, `status`) VALUES
(1418402, 1735638, 'Elektrik Elektronik Mühendisliği', 1),
(1537379, 1735638, 'Endüstri Mühendisliği', 1),
(5683109, 1735638, 'Yazılım Mühendisliği', 1),
(6418037, 9275551, 'Arkeoloji', 1),
(6847851, 9275551, 'Mütercim-Tercümanlık', 1),
(7153986, 5667758, 'Astronomi ve Uzay Bilimleri', 1),
(7977085, 9275551, 'Felsefe ', 1),
(9273380, 5667758, 'İstatistik', 1),
(9367638, 5667758, 'Fizik', 1),
(9600080, 5667758, 'Biyoloji', 1),
(9748410, 1735638, 'Abc bölümü', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `faculties`
--

CREATE TABLE `faculties` (
  `facultyCode` int(11) NOT NULL,
  `facultyName` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `faculties`
--

INSERT INTO `faculties` (`facultyCode`, `facultyName`, `status`) VALUES
(1735638, 'Mühendislik Fakütesi deneme', 1),
(2041635, 'Hukuk Fakültesi', 1),
(4544530, 'Diş Hekimliği Fakültesi', 1),
(5667758, 'Fen Fakültesi deneme', 1),
(6792148, 'abc abc', 1),
(7485547, 'abc fakültesi 2', 0),
(8479720, 'Bilişim Teknolojileri Fakültesi', 1),
(9275551, 'Edebiyat Fakültesi', 1),
(9914186, 'Tıp Fakültesi', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lessons`
--

CREATE TABLE `lessons` (
  `lessonCode` int(11) NOT NULL,
  `lessonDepartmentCode` int(11) NOT NULL,
  `lessonName` varchar(50) NOT NULL,
  `lessonPeriod` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `lessons`
--

INSERT INTO `lessons` (`lessonCode`, `lessonDepartmentCode`, `lessonName`, `lessonPeriod`, `status`) VALUES
(1652310, 1537379, 'Akademik İngilizce', 1, 1),
(2917311, 1418402, 'Atatürk İlke Ve İnkılapları', 1, 1),
(3572378, 1418402, 'Elektrik Devreleri', 1, 1),
(3767463, 1418402, 'Elektronik Kodlama', 1, 1),
(5155142, 1418402, 'Fizik', 1, 1),
(5742984, 1537379, 'Genel Kimya', 1, 1),
(6253602, 1418402, 'Elektronik', 1, 0),
(6551652, 1537379, 'Fizik', 1, 1),
(7341229, 1537379, 'Mühendislikte Çizim', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `studentlessons`
--

CREATE TABLE `studentlessons` (
  `studentLessonId` int(11) NOT NULL,
  `studentNumber` int(11) NOT NULL,
  `lessonCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `studentlessons`
--

INSERT INTO `studentlessons` (`studentLessonId`, `studentNumber`, `lessonCode`) VALUES
(19, 199797, 1652310),
(20, 199797, 2917311),
(21, 199797, 3572378),
(22, 199797, 3767463),
(23, 199797, 5155142),
(24, 199797, 5742984),
(25, 199797, 6253602),
(26, 199797, 6551652),
(27, 199797, 7341229),
(37, 2624045, 1652310),
(38, 2624045, 2917311),
(39, 2624045, 3572378),
(40, 2624045, 3767463),
(41, 2624045, 5155142),
(42, 2624045, 5742984),
(43, 2624045, 6253602),
(44, 2624045, 6551652),
(45, 2624045, 7341229),
(1, 6665733, 1652310),
(2, 6665733, 2917311),
(3, 6665733, 3572378),
(4, 6665733, 3767463),
(5, 6665733, 5155142),
(6, 6665733, 5742984),
(7, 6665733, 6253602),
(8, 6665733, 6551652),
(9, 6665733, 7341229),
(28, 7476997, 1652310),
(29, 7476997, 2917311),
(30, 7476997, 3572378),
(31, 7476997, 3767463),
(32, 7476997, 5155142),
(33, 7476997, 5742984),
(34, 7476997, 6253602),
(35, 7476997, 6551652),
(36, 7476997, 7341229),
(10, 8682027, 1652310),
(11, 8682027, 2917311),
(12, 8682027, 3572378),
(13, 8682027, 3767463),
(14, 8682027, 5155142),
(15, 8682027, 5742984),
(16, 8682027, 6253602),
(17, 8682027, 6551652),
(18, 8682027, 7341229);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `studentnotes`
--

CREATE TABLE `studentnotes` (
  `id` int(11) NOT NULL,
  `studentNumber` int(11) NOT NULL,
  `lessonCode` int(11) NOT NULL,
  `vize` float DEFAULT NULL,
  `final` float DEFAULT NULL,
  `average` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `studentnotes`
--

INSERT INTO `studentnotes` (`id`, `studentNumber`, `lessonCode`, `vize`, `final`, `average`) VALUES
(1, 6665733, 1652310, NULL, NULL, NULL),
(2, 6665733, 2917311, 50, 60, 56),
(3, 6665733, 3572378, NULL, NULL, NULL),
(4, 6665733, 3767463, NULL, NULL, NULL),
(5, 6665733, 5155142, 50, 96, 77.6),
(6, 6665733, 5742984, NULL, NULL, NULL),
(7, 6665733, 6253602, NULL, NULL, NULL),
(8, 6665733, 6551652, NULL, NULL, NULL),
(9, 6665733, 7341229, NULL, NULL, NULL),
(10, 8682027, 1652310, NULL, NULL, NULL),
(11, 8682027, 2917311, 50, 70, 62),
(12, 8682027, 3572378, NULL, NULL, NULL),
(13, 8682027, 3767463, NULL, NULL, NULL),
(14, 8682027, 5155142, 72, 56, 62.4),
(15, 8682027, 5742984, NULL, NULL, NULL),
(16, 8682027, 6253602, NULL, NULL, NULL),
(17, 8682027, 6551652, NULL, NULL, NULL),
(18, 8682027, 7341229, NULL, NULL, NULL),
(19, 199797, 1652310, NULL, NULL, NULL),
(20, 199797, 2917311, 100, 70, 82),
(21, 199797, 3572378, NULL, NULL, NULL),
(22, 199797, 3767463, NULL, NULL, NULL),
(23, 199797, 5155142, 50, 86, 71.6),
(24, 199797, 5742984, NULL, NULL, NULL),
(25, 199797, 6253602, NULL, NULL, NULL),
(26, 199797, 6551652, NULL, NULL, NULL),
(27, 199797, 7341229, NULL, NULL, NULL),
(28, 7476997, 1652310, NULL, NULL, NULL),
(29, 7476997, 2917311, 100, 83, 89.8),
(30, 7476997, 3572378, NULL, NULL, NULL),
(31, 7476997, 3767463, NULL, NULL, NULL),
(32, 7476997, 5155142, 50, 72, 63.2),
(33, 7476997, 5742984, NULL, NULL, NULL),
(34, 7476997, 6253602, NULL, NULL, NULL),
(35, 7476997, 6551652, NULL, NULL, NULL),
(36, 7476997, 7341229, NULL, NULL, NULL),
(37, 2624045, 1652310, NULL, NULL, NULL),
(38, 2624045, 2917311, 100, 81, 88.6),
(39, 2624045, 3572378, NULL, NULL, NULL),
(40, 2624045, 3767463, NULL, NULL, NULL),
(41, 2624045, 5155142, 50, 76, 65.6),
(42, 2624045, 5742984, NULL, NULL, NULL),
(43, 2624045, 6253602, NULL, NULL, NULL),
(44, 2624045, 6551652, NULL, NULL, NULL),
(45, 2624045, 7341229, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `studentNumber` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`studentNumber`, `firstName`, `lastName`, `phoneNumber`, `email`, `password`, `status`) VALUES
(199797, 'Mert', 'Özkaymak', '0555 555 55 55', 'mertozkaymak@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(2624045, 'Burak', 'Aydoğan', '0555 555 55 55', 'burak@nanoyazilim.com.tr', '178885ddfda37e168a5c900075a8d060726f6457', 1),
(6665733, 'Masum', 'Babacan', '0555 555 55 55', 'masum1cocuxx@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(7476997, 'Furkan ', 'Koçyiğit', '0555 555 55 55', 'furkankocyigit18@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0),
(8682027, 'İlayda', 'Malatya', '0555 555 55 55', 'ilaydamalatya5877@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teacherlessons`
--

CREATE TABLE `teacherlessons` (
  `teacherLessonId` int(11) NOT NULL,
  `teacherNumber` int(11) NOT NULL,
  `lessonNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `teacherlessons`
--

INSERT INTO `teacherlessons` (`teacherLessonId`, `teacherNumber`, `lessonNumber`) VALUES
(5, 2527236, 2917311),
(1, 2527236, 5155142),
(2, 2527236, 7341229),
(3, 5439448, 3572378),
(4, 5439448, 3767463),
(6, 7813989, 2917311);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teachers`
--

CREATE TABLE `teachers` (
  `teacherNumber` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `teachers`
--

INSERT INTO `teachers` (`teacherNumber`, `firstName`, `lastName`, `title`, `email`, `password`, `status`) VALUES
(2527236, 'Fahri', 'Yılmaz', 'Profesör', 'fahri@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(5439448, 'Ali', 'Bayar', 'Doçent', 'ali@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(7813989, 'masum', 'babacan', 'prof', '1234@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentCode`),
  ADD KEY `facultyCode` (`facultyCode`);

--
-- Tablo için indeksler `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`facultyCode`);

--
-- Tablo için indeksler `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lessonCode`),
  ADD KEY `lessonDepartmentCode` (`lessonDepartmentCode`);

--
-- Tablo için indeksler `studentlessons`
--
ALTER TABLE `studentlessons`
  ADD PRIMARY KEY (`studentLessonId`),
  ADD KEY `studentNumber` (`studentNumber`,`lessonCode`),
  ADD KEY `lessonCode` (`lessonCode`);

--
-- Tablo için indeksler `studentnotes`
--
ALTER TABLE `studentnotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentNumber` (`studentNumber`,`lessonCode`),
  ADD KEY `lessonCode` (`lessonCode`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentNumber`);

--
-- Tablo için indeksler `teacherlessons`
--
ALTER TABLE `teacherlessons`
  ADD PRIMARY KEY (`teacherLessonId`),
  ADD KEY `teacherNumber` (`teacherNumber`,`lessonNumber`),
  ADD KEY `lessonNumber` (`lessonNumber`);

--
-- Tablo için indeksler `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherNumber`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `studentlessons`
--
ALTER TABLE `studentlessons`
  MODIFY `studentLessonId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Tablo için AUTO_INCREMENT değeri `studentnotes`
--
ALTER TABLE `studentnotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Tablo için AUTO_INCREMENT değeri `teacherlessons`
--
ALTER TABLE `teacherlessons`
  MODIFY `teacherLessonId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`facultyCode`) REFERENCES `faculties` (`facultyCode`);

--
-- Tablo kısıtlamaları `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`lessonDepartmentCode`) REFERENCES `departments` (`departmentCode`);

--
-- Tablo kısıtlamaları `studentlessons`
--
ALTER TABLE `studentlessons`
  ADD CONSTRAINT `studentlessons_ibfk_1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`),
  ADD CONSTRAINT `studentlessons_ibfk_2` FOREIGN KEY (`lessonCode`) REFERENCES `lessons` (`lessonCode`);

--
-- Tablo kısıtlamaları `studentnotes`
--
ALTER TABLE `studentnotes`
  ADD CONSTRAINT `studentnotes_ibfk_1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`),
  ADD CONSTRAINT `studentnotes_ibfk_2` FOREIGN KEY (`lessonCode`) REFERENCES `lessons` (`lessonCode`);

--
-- Tablo kısıtlamaları `teacherlessons`
--
ALTER TABLE `teacherlessons`
  ADD CONSTRAINT `teacherlessons_ibfk_1` FOREIGN KEY (`lessonNumber`) REFERENCES `lessons` (`lessonCode`),
  ADD CONSTRAINT `teacherlessons_ibfk_2` FOREIGN KEY (`teacherNumber`) REFERENCES `teachers` (`teacherNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
