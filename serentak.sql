-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2015 at 11:29 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `serentak`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_genre`) VALUES
(1, 'Pendidikan & Kepemudaan'),
(2, 'Sosial & Lingkungan'),
(3, 'Hobi'),
(4, 'Teknologi'),
(5, 'Seni dan Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE IF NOT EXISTS `komunitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_komunitas` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_jadi` date DEFAULT NULL,
  `basecamp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `situs` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `id_kategori` int(11) NOT NULL,
  `avg_rate` float(3,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id`, `nama_komunitas`, `slug`, `ringkasan`, `deskripsi`, `tanggal_jadi`, `basecamp`, `telepon`, `surel`, `situs`, `facebook`, `twitter`, `gplus`, `foto`, `id_kategori`, `avg_rate`, `created_at`, `updated_at`) VALUES
(9, 'Komunitas Mozilla Indonesia', 'komunitas-mozilla-indonesia', 'Kita semua adalah Mozilla Firefox. Kita tidak hanya sekadar peramban yang berbeda. Kita adalah peramban yang membuat perbedaan.', 'Kita semua adalah Mozilla Firefox. Kita tidak hanya sekadar peramban yang berbeda. Kita adalah peramban yang membuat perbedaan.', '2004-11-01', '(soon to be) MozSpace', '081234567890', 'info@mozilla.web.id', 'http://mozilla.web.id', '', 'https://twitter.com/id_mozilla', '', 'komunitas-komunitas-mozilla-indonesia.jpeg', 4, 0.00, '2015-02-26 08:12:18', '2015-06-09 18:56:44'),
(10, 'Dinus Open Source Community', 'dinus-open-source-community', 'Komunitas penggiat open source semarang, UDINUS', 'Komunitas penggiat open source semarang, UDINUS', '0000-00-00', 'Udinus', '+6283863111105', 'sekretariat@doscom.org', 'http://doscom.org/', 'https://www.facebook.com/groups/doscomedia/', 'https://twitter.com/doscomedia', '', 'komunitas-dinus-open-source-community.png', 4, 0.00, '2015-02-26 08:35:23', '2015-06-09 18:56:48'),
(11, 'Nusantara Muda', 'nusantara-muda', 'Gather youth in Indonesia to build a movement, @FLSummit is our annual conference.', 'Gather youth in Indonesia to build a movement, @FLSummit is our annual conference.', '0000-00-00', 'Semarang', '081234567890', '', 'http://blog.futureleadersummit.org', '', 'https://twitter.com/nusamudaid', '', 'komunitas-nusantara-muda.png', 1, 0.00, '2015-02-27 19:38:20', '2015-06-09 20:26:27'),
(12, 'Internet Club', 'internet-club', 'Komunitas IT Unisbank', 'Komunitas IT Unisbank', '0000-00-00', 'Unisbank', '+6285727820890', 'staff@internetclub.or.id', 'http://internetclub.or.id/', '', 'https://twitter.com/internetclub_id', '', 'komunitas-internet-club.png', 4, 0.00, '2015-03-07 05:55:29', '2015-06-09 18:56:53'),
(13, 'WPAP Semarang', 'wpap-semarang', 'Wedha''s Pop Art Portrait', 'Wedha''s Pop Art Portrait', '0000-00-00', '', '+628567123233', 'wpapcommunity@gmail.com', 'http://wpapcommunity.com/site/', 'https://www.facebook.com/groups/WPAP.Chapter.Semarang', 'https://twitter.com/WPAPSemarang', '', 'komunitas-wpap-semarang.jpeg', 5, 0.00, '2015-03-07 06:03:56', '2015-06-09 20:25:39'),
(14, 'Orat - Oret', 'orat-oret', 'Komunitas seniman Semarang (Drawing esp)', 'Komunitas seniman Semarang (Drawing esp)', '0000-00-00', '', '+62885433180', '', 'http://orartoret.blogspot.com/ ', 'https://www.facebook.com/pages/ORArT-ORET/172753932753395', 'https://twitter.com/ORArT_ORET', '', 'komunitas-orat-oret.jpeg', 5, 0.00, '2015-03-07 06:06:04', '2015-06-09 20:25:52'),
(15, 'Jazz Ngisor Ringin', 'jazz-ngisor-ringin', 'Komunitas musisi & penggemar musik di Semarang dari segala genre, status & level yang belajar berkomunikasi dalam genre Jazz dg', 'Komunitas musisi & penggemar musik di Semarang dari segala genre, status & level yang belajar berkomunikasi dalam genre Jazz dg cara yg mudah dan bersahabat', '0000-00-00', '', '', 'jazzngisoringin@gmail.com', 'http://jazzngisoringin.com/', 'http://www.facebook.com/JAZZNGiSORiNGiN', 'https://twitter.com/JAZZNGiSORiNGiN', '', 'komunitas-jazz-ngisor-ringin.jpeg', 5, 0.00, '2015-03-07 06:07:54', '2015-06-09 18:57:47'),
(16, 'Semarang Akustik', 'semarang-akustik', 'Komunitas Semarang Akustik dengan segala jenis genre musik yg dikemas secara akustik', 'Komunitas Semarang Akustik dengan segala jenis genre musik yg dikemas secara akustik', '0000-00-00', '', '+6208174158406', '', 'http://sekustik.blogspot.com', '', 'https://twitter.com/sekustik', '', 'komunitas-semarang-akustik.jpeg', 5, 0.00, '2015-03-07 06:09:19', '2015-05-02 00:24:42'),
(17, 'Akademi Berbagi SMG', 'akademi-berbagi-smg', 'Ruang Berbagi dan Belajar | Karena Berbagi Bikin Happy! Topik yang diusung tiap eventnya beda2 seputar dunia online, digital, kreatif,', 'Ruang Berbagi dan Belajar | Karena Berbagi Bikin Happy! Topik yang diusung tiap eventnya beda2 seputar dunia online, digital, kreatif, fotografi, dll.', '0000-00-00', '', '+6285642232369', 'akbersmg@gmail.com', 'http://akbersmg.blogspot.com/', 'https://www.facebook.com/AkberSMG', 'https://twitter.com/AkberSMG', '', 'komunitas-akber-smg.jpeg', 1, 0.00, '2015-03-07 06:11:54', '2015-06-09 18:53:15'),
(18, 'Youth EmPowering SMG', 'youth-empowering-smg', 'YEP!Semarang is a NEW part of @YouthEmPowering. Unique combinations of various fields which connect and bond us as one youth', 'YEP!Semarang is a NEW part of @YouthEmPowering. Unique combinations of various fields which connect and bond us as one youth movement | #YEPvoice #JES #BSSMG', '0000-00-00', '', '', '', 'http://youthempowering.org/', '', 'https://twitter.com/YEPsemarang', '', 'komunitas-youth-empowering-smg.jpeg', 1, 0.00, '2015-03-07 06:13:53', '2015-06-09 18:53:34'),
(19, 'Komunitas Fotografer Semarang', 'komunitas-fotografer-semarang', 'KFS adalah komunitas pecinta seni Fotografi di Semarang. Dalam komunitas ini kami tidak mengenal lagi pembeda-pembeda yang membuat terkotak-kotak, tidak', 'KFS adalah komunitas pecinta seni Fotografi di Semarang. Dalam komunitas ini kami tidak mengenal lagi pembeda-pembeda yang membuat terkotak-kotak, tidak ada beda status sosial, tidak ada pembeda merk camera, tidak ada pembeda dari club manapun, tidak ada pembeda antara senior dan junior, tidak ada pembeda asal daerah, tidak ada pembeda profesional dan amatir, dan pembeda-pembeda lainnya.', '0000-00-00', 'Jl. Moch Suyudi 191 - Semarang, Indonesia', '', 'info@kfsemarang.com', 'http://kfsemarang.com/', '', '', '', 'komunitas-komunitas-fotografer-semarang.jpeg', 3, 0.00, '2015-03-07 06:14:37', '2015-03-29 11:10:01'),
(20, 'FFISemarang', 'ffisemarang', '(Forum for Indonesia - Chapter Semarang) | A forum which prepares today’s youth, for tomorrow’s challenges.', '(Forum for Indonesia - Chapter Semarang) | A forum which prepares today’s youth, for tomorrow’s challenges.', '0000-00-00', '', '085640016755', 'FFISemarang@gmail.com', 'http://www.ffisemarang.org/', '', 'https://twitter.com/ffisemarang', '', 'komunitas-ffisemarang.jpeg', 1, 0.00, '2015-03-07 06:16:31', '2015-06-09 18:53:42'),
(22, 'Komunitas Satoe Atap', 'komunitas-satoe-atap', 'Komunitas sosial # Mengajar anak jalanan & kaum miskin kota', 'Komunitas sosial # Mengajar anak jalanan & kaum miskin kota', '2007-04-12', '', '+6285741715751', 'satoeatapsmg@gmail.com', 'https://instagram.com/satoeatap/', '', 'https://twitter.com/satoeatap', '', 'komunitas-komunitas-satoe-atap.jpg', 2, 0.00, '2015-03-07 06:22:00', '2015-06-09 18:54:32'),
(23, 'Coin A Chance Semarang', 'coin-a-chance-semarang', 'Semarang Coin A Chance! merupakan lanjutan sebuah gerakan sosial yang diawali di Jakarta pada tanggal 18 Desember 2008. Melalui gerakan', 'Semarang Coin A Chance! merupakan lanjutan sebuah gerakan sosial yang diawali di Jakarta pada tanggal 18 Desember 2008. Melalui gerakan ini, kami berusaha mengajak kawan-kawan, kerabat, keluarga, juga para netters (blogger, plurker, facebooker…) untuk mengumpulkan ‘recehan’ atau uang logam yang bertumpuk dan mungkin jarang digunakan. Uang yang terkumpul akan ditukarkan dengan ’sebuah kesempatan’ bagi anak-anak yang kurang mampu agar mereka dapat melanjutkan sekolah lagi.', '0000-00-00', '', '087832617373', 'coinsemarang@gmail.com', 'http://coinsemarang.blogspot.com/', 'http://www.facebook.com/groups/cacsemarang/', 'https://twitter.com/cacsemarang', '', 'komunitas-coin-a-chance-semarang.jpg', 1, 0.00, '2015-03-07 06:23:54', '2015-06-09 18:54:19'),
(24, 'Backpaker Indonesia Chapter Semarang (BPI Semarang)', 'backpaker-indonesia-chapter-semarang-bpi-semarang', 'Backpacker Semarang low budget traveler', 'Backpacker Semarang low budget traveler', '0000-00-00', '', '085697404518', 'backpackersemarang@ymail.com', 'http://backpackersemarang.blogspot.com', 'https://www.facebook.com/groups/246484468789293/', 'https://twitter.com/bpisemarang', '', 'komunitas-backpaker-indonesia-chapter-semarang-bpi-semarang.jpg', 3, 0.00, '2015-03-29 09:45:33', '2015-05-04 02:44:47'),
(25, 'Lopen Semarang', 'lopen-semarang', 'Siapa bilang belajar sejarah itu gak asik? Bersama sadar akan kepemilikan sejarah.', 'Siapa bilang belajar sejarah itu gak asik? Bersama sadar akan kepemilikan sejarah.', '0000-00-00', 'Jl. Singosari Raya 29, Semarang', '08995910946', '', 'http://komunitaslopensemarang.blogspot.com ', '', 'https://twitter.com/lopenSMG', '', 'komunitas-lopen-semarang.png', 3, 0.00, '2015-03-29 09:48:48', '2015-06-09 18:56:23'),
(26, 'SMGBerkebun', 'smgberkebun', 'Bagian dari @idberkebun . Yok ProKonco Melu Berkebun rasane Happy Tenan !', 'Bagian dari @idberkebun . Yok ProKonco Melu Berkebun rasane Happy Tenan !', '0000-00-00', '', '', 'smgberkebun@gmail.com', 'http://indonesiaberkebun.org', '', 'https://twitter.com/smgberkebun', '', 'komunitas-smgberkebun.jpg', 3, 0.00, '2015-03-29 09:50:59', '2015-05-02 09:39:04'),
(27, 'SMG Runner', 'smg-runner', 'komunitas lari di Semarang. Playon Kemis Bengi #PKB . Playon Minggu Isuk #PMI . join us and be healthy with', 'komunitas lari di Semarang. Playon Kemis Bengi #PKB . Playon Minggu Isuk #PMI . join us and be healthy with SmgRunners #ayomlayu', '0000-00-00', '', '+6285640325234', 'slams.riyadi@gmail.com', 'http://semarang-runners.com', 'https://www.facebook.com/groups/521098357940820/?fref=nf', 'https://twitter.com/SmgRunners', '', 'komunitas-smg-runner.jpeg', 3, 0.00, '2015-03-29 09:54:04', '2015-06-09 20:26:18'),
(28, 'Save Street Child', 'save-street-child', 'Komunitas peduli anak jalanan di Semarang. FROM US FOR THEIR SMILE', 'Komunitas peduli anak jalanan di Semarang. FROM US FOR THEIR SMILE', '0000-00-00', '', '085694412405', 'ssc_semarang@yahoo.com', 'http://savestreetchild.org', '', 'https://twitter.com/SSCSemarang', '', 'komunitas-save-street-child.jpeg', 2, 0.00, '2015-03-29 10:02:11', '2015-06-09 18:54:37'),
(29, 'Care Environmental Organization (CEO)', 'care-environmental-organization-ceo', 'We are a community of youth who have enthusiast on green lifestyle and environment. Leading the Green Lifestyle.', 'We are a community of youth who have enthusiast on green lifestyle and environment. Leading the Green Lifestyle.', '0000-00-00', '', '', 'careenvironmentalorg@gmail.com', 'http://ceosemarang.com/', '', 'https://twitter.com/CEOsemarang', '', 'komunitas-care-environmental-organization-ceo.jpg', 2, 0.00, '2015-03-29 10:06:30', '2015-06-09 18:54:43'),
(30, 'Kelompok Kerja Mangrove Kota Semarang', 'kelompok-kerja-mangrove-kota-semarang', 'KKMKS merupakan sebuah forum silaturahmi dan kerjasama antara para penggiat mangrove yang ada di kota Semarang dan sekitarnya, yang anggotanya', 'KKMKS merupakan sebuah forum silaturahmi dan kerjasama antara para penggiat mangrove yang ada di kota Semarang dan sekitarnya, yang anggotanya terdiri dari berbagai lapisan masyarakat. Anggota KKMKS membentuk sebuah jaringan mangrove di kota Semarang yang berfungsi mengkoordinasikan program dan proyek mangrove yang sudah, sedang dan akan dijalankan.', '2010-01-01', 'Jl.Pemuda No 175 Semarang 50139 Jawa Tengah.', '+62243547998', 'info@kkmks.org', 'http://www.kkmks.org/', 'https://www.facebook.com/KKMKS', 'https://twitter.com/KKMKotaSemarang', '', 'komunitas-kelompok-kerja-mangrove-kota-semarang.png', 2, 0.00, '2015-03-29 10:10:57', '2015-03-29 10:11:14'),
(31, 'Komunitas SMG Aksi', 'komunitas-smg-aksi', '#WeCareWeShare . Mari PEDULI Mari BERBAGI | Aksi dan donasi »  327166D1 ☎✉ 085641243249', '#WeCareWeShare . Mari PEDULI Mari BERBAGI | Aksi dan donasi »  327166D1 ☎✉ 085641243249', '0000-00-00', 'Semarang, Jawa Tengah', '085641243249', '', '', 'https://www.facebook.com/komunitas.semarangaksi', 'https://twitter.com/SobatKomsik', '', 'komunitas-komunitas-smg-aksi.jpeg', 2, 0.00, '2015-03-29 10:13:48', '2015-03-29 10:14:02'),
(32, 'Kaskus Regional Semarang', 'kaskus-regional-semarang', 'Komunitas Kaskus Semarang', 'Komunitas Kaskus Semarang', '0000-00-00', '', '+6285641238930', 'manusiabumie@gmail.com', 'http://www.kaskus.co.id/forum/111/semarang', '', '', '', 'komunitas-kaskus-regional-semarang.jpeg', 4, 0.00, '2015-03-29 10:15:56', '2015-03-29 10:25:09'),
(33, 'Komunitas Blogger Loenpia', 'komunitas-blogger-loenpia', 'Loenpia dot net adalah wadah bagi para blogger Semarang dan sekitarnya, yang berdiri pada 15 Oktober 2005. Dengan tujuan bisa', 'Loenpia dot net adalah wadah bagi para blogger Semarang dan sekitarnya, yang berdiri pada 15 Oktober 2005. Dengan tujuan bisa menjadi media bagi blogger yang mempunyai keahlian dan kreatifitas dalam bidang apapun, untuk bersama membangun citra Kota Semarang menjadi lebih baik dan maju.', '2005-10-15', '', '', 'admin@loenpia.net', 'http://loenpia.net/blog/', 'https://www.facebook.com/groups/loenpia/', '', '', 'komunitas-komunitas-blogger-loenpia.jpg', 4, 0.00, '2015-03-29 10:28:02', '2015-06-09 18:57:35'),
(34, 'Karamba Art', 'karamba-art', 'Karamba Art Movement is a community that focuses on visual art Based in Semarang, Indonesia, we have a mission to', 'Karamba Art Movement is a community that focuses on visual art Based in Semarang, Indonesia, we have a mission to make creative process then recorded and published it. We expand our network with a variety of individuals and communities for developing ideas and make some collaborations. http://karambaartmovement.com ', '0000-00-00', 'semarang, indonesia', '087746541369', 'karambaartmovement@gmail.com', 'http://issuu.com/karamba_art', 'https://www.facebook.com/karambaartmovement', 'https://twitter.com/karamba_art', '', 'komunitas-karamba-art.jpeg', 5, 0.00, '2015-03-29 10:32:39', '2015-06-09 18:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas_event`
--

CREATE TABLE IF NOT EXISTS `komunitas_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_komunitas` int(11) NOT NULL,
  `judul_acara` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `tempat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `pendaftaran` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `komunitas_event`
--

INSERT INTO `komunitas_event` (`id`, `id_komunitas`, `judul_acara`, `slug`, `deskripsi`, `tempat`, `tanggal`, `pendaftaran`, `poster`, `created_at`, `updated_at`) VALUES
(2, 9, 'Firefox OS App Days', 'firefox-os-app-days', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.', 'Sumba Room Hotel Borobudur Jakarta', '2013-01-21', '-', 'Acara-2.jpg', '2015-02-26 08:51:02', '2015-02-27 08:56:24'),
(3, 10, 'Software Freedom Day', 'software-freedom-day', 'You’re hidden in a place where I can’t see you The pain you received for me When my anger becomes one I’ll chase the lost memories from the deep sleep I want to find the real me that is not you But the bruises in my heart are too big I try hiding it but they hide in my heart and wake me up I met you on the other side of my horrible memories', 'Gd. E Lt.3 UDINUS ', '2015-06-15', '-', 'Acara-syemarang-blogger-day.png', '2015-02-27 19:45:21', '2015-04-04 04:33:09'),
(4, 0, 'Semarang Night Carnival 2015', 'semarang-night-carnival-2015', 'The Biggest Annual Cultural Night Carnival at Semarang City Anniversary', 'Kawasan Kota Lama', '2015-05-03', '', 'Acara-semarang-night-carnival-2015.jpg', '2015-05-01 08:18:34', '2015-05-01 08:29:09'),
(5, 0, 'Loenpia Jazz 2015', 'loenpia-jazz-2015', 'Panggung apresiasi & Event tahunan musik Jazz ala Semarang | Ulang Tahun @JAZZNGiSORiNGiN (Aku ngejazz mergo kowe)', 'Puri Maerakaca', '2015-06-07', 'Gratis!', 'Acara-loenpia-jazz-2015.jpg', '2015-06-02 21:13:07', '2015-06-02 21:20:14'),
(6, 0, 'Future Leader Summit 2015 #BeraniBeraksi', 'future-leader-summit-2015-beraniberaksi', 'Pada tahun 2015, acara FLS kembali digelar. Bertempat di Kota Semarang, FLS akan diadakan dari hari Jumat hingga Minggu (18-20/9). Tema yang diusung kali ini adalah “Aksi Nyata untuk Indonesia”.', 'Coming Soon', '2015-06-14', 'Coming Soon >> www.futureleadersummit.org', 'Acara-future-leader-summit-2015-beraniberaksi.png', '2015-06-03 00:10:58', '2015-06-03 00:19:06'),
(7, 0, 'Bukber Mozillian', 'bukber-mozillian', 'Celebrating the launch of FIrefox 38 with #FoxYeah video', 'Coming Soon', '2015-06-26', 'Coming soon', 'Acara-bukber-mozillian.png', '2015-06-03 00:14:47', '2015-06-03 00:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas_member`
--

CREATE TABLE IF NOT EXISTS `komunitas_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_komunitas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `komunitas_member`
--

INSERT INTO `komunitas_member` (`id`, `id_user`, `id_komunitas`, `created_at`, `updated_at`) VALUES
(8, 12, 11, '2015-03-06 07:43:00', '2015-03-06 07:43:00'),
(9, 14, 9, '2015-03-12 20:57:50', '2015-03-12 20:57:50'),
(10, 11, 9, '2015-03-28 08:45:09', '2015-03-28 08:45:09'),
(11, 11, 10, '2015-04-14 07:07:58', '2015-04-14 07:07:58'),
(12, 17, 17, '2015-04-28 07:55:44', '2015-04-28 07:55:44'),
(14, 21, 25, '2015-05-02 10:29:59', '2015-05-02 10:29:59'),
(15, 21, 20, '2015-05-02 10:30:30', '2015-05-02 10:30:30'),
(16, 11, 14, '2015-05-04 02:37:39', '2015-05-04 02:37:39'),
(17, 24, 22, '2015-05-04 02:47:48', '2015-05-04 02:47:48'),
(18, 24, 20, '2015-05-04 02:48:19', '2015-05-04 02:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas_ratepredict`
--

CREATE TABLE IF NOT EXISTS `komunitas_ratepredict` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_komunitas` int(11) NOT NULL,
  `rate_predict` float(3,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `komunitas_similarity`
--

CREATE TABLE IF NOT EXISTS `komunitas_similarity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kom1` int(11) NOT NULL,
  `id_kom2` int(11) NOT NULL,
  `similarity` float(3,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_depan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_belakang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telpon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gplus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fbid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fbname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fbemail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `slug`, `nama_depan`, `nama_belakang`, `surel`, `tanggal_lahir`, `gender`, `bio`, `foto`, `alamat`, `telpon`, `facebook`, `twitter`, `gplus`, `level`, `created_at`, `updated_at`, `fbid`, `fbname`, `fbemail`) VALUES
(4, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'Rizki Dwi', 'Kelimutu', 'admin@serentak.org', '1993-08-26', 2, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.', 'avatar-4.jpg', 'Nakula 1 no 84', '081234567890', 'http://facebook.com/rizki.d.kelimutu', 'http://twitter.com/kelimuttu', 'https://plus.google.com/u/0/+RizkiDwiKelimutu26', 'admin', '2015-02-20 09:03:25', '2015-02-27 07:24:45', '', '', ''),
(11, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'Rizki Dwi', 'Kelimutu', 'kelimutu.rizki@gmail.com', '1993-08-26', 2, 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.', 'avatar-11.jpg', 'Jl. Nakula 1 no. 84', '081217799226', 'https://www.facebook.com/rizki.d.kelimutu', 'https://twitter.com/kelimuttu', 'https://plus.google.com/u/0/+RizkiDwiKelimutu26', 'user', '2015-02-25 22:33:19', '2015-04-20 08:42:21', '', '', ''),
(19, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'User 1', '', 'user1@serentak.org', '0000-00-00', 1, '', 'user-19.png', '', '0987654321', '', '', '', 'user', '2015-05-02 00:33:16', '2015-05-19 08:17:16', '', '', ''),
(20, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'User 2', '', 'user2@serentak.org', '0000-00-00', 1, '', 'user-20.png', '', '0987654321', '', '', '', 'user', '2015-05-02 00:34:48', '2015-05-19 08:19:26', '', '', ''),
(21, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'User 3', '', 'user3@serentak.org', '0000-00-00', 2, '', 'user-21.png', '', '08123456789', '', '', '', 'user', '2015-05-02 00:37:08', '2015-05-19 08:24:51', '', '', ''),
(22, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'User 4', '', 'user4@serentak.org', '0000-00-00', 2, '', 'user-22.png', '', '08123456789', '', '', '', 'user', '2015-05-02 00:38:24', '2015-05-19 08:23:04', '', '', ''),
(23, '0e42e6a3ba9a8e34754222b5d19bb7aa', '', 'User 5', '', 'user5@serentak.org', '0000-00-00', 1, '', 'user-23.png', '', '08123456789', '', '', '', 'user', '2015-05-02 00:39:20', '2015-05-19 08:24:09', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_avgrate`
--

CREATE TABLE IF NOT EXISTS `user_avgrate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `avg_rate` float(3,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_avgrate`
--

INSERT INTO `user_avgrate` (`id`, `id_user`, `avg_rate`, `created_at`, `updated_at`) VALUES
(1, 19, 0.00, '2015-06-10 03:23:19', '2015-06-09 19:08:08'),
(2, 20, 0.00, '2015-06-10 03:23:33', '2015-06-09 19:10:05'),
(3, 21, 0.00, '2015-06-10 02:01:09', '2015-05-02 10:29:21'),
(4, 22, 0.00, '2015-06-10 02:01:21', '2015-05-02 10:35:49'),
(5, 23, 0.00, '2015-06-10 02:01:44', '2015-05-02 10:43:39'),
(6, 4, 0.00, '2015-05-02 08:22:03', '0000-00-00 00:00:00'),
(7, 11, 0.00, '2015-06-10 02:00:32', '2015-05-04 02:42:39'),
(8, 24, 0.00, '2015-06-10 02:01:49', '2015-05-04 02:48:28'),
(9, 25, 0.00, '2015-05-05 22:37:15', '2015-05-05 22:37:15'),
(10, 26, 0.00, '2015-05-28 23:35:34', '2015-05-28 23:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_event`
--

CREATE TABLE IF NOT EXISTS `user_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_acara` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_event`
--

INSERT INTO `user_event` (`id`, `id_user`, `id_acara`, `created_at`, `updated_at`) VALUES
(1, 11, 2, '2015-02-28 03:54:07', '2015-02-28 03:54:07'),
(6, 11, 3, '2015-05-01 08:48:07', '2015-05-01 08:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE IF NOT EXISTS `user_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_komunitas` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
