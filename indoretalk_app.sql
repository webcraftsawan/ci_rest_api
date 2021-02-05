-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 09:46 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indoretalk_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `token` text DEFAULT NULL,
  `type` varchar(225) NOT NULL DEFAULT '''admin''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `username`, `password`, `token`, `type`, `created_at`, `modified_at`) VALUES
(1, 'Webcraft Admin', 'webcraft@mailinator.com', '7896543211', 'admin', '$2y$10$kuMI3ghOUulcqfklMVpjvO4RbzKl3Lg/zrQx1qvfRjdA3DHKhRDp.', 'ffd0785554e8a1e5a54b1e9a43c72240a64dca6d', 'admin', '2020-12-01 10:10:17', '2020-12-02 10:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `bussiness_listing`
--

CREATE TABLE `bussiness_listing` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bussiness_listing`
--

INSERT INTO `bussiness_listing` (`id`, `name`, `phone`, `company`, `city`, `category_id`, `created_at`, `modified_at`) VALUES
(1, 'Webcraft Developer', '7896543211', 'Webcraft IT', 'Indore', 5, '2020-12-04 10:24:40', '2020-12-04 10:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `career_form`
--

CREATE TABLE `career_form` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `city` varchar(30) DEFAULT NULL,
  `file` text NOT NULL,
  `profile` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `career_form`
--

INSERT INTO `career_form` (`id`, `name`, `phone`, `city`, `file`, `profile`, `created_at`, `modified_at`) VALUES
(1, 'Mannu Sharma', '7896543211', 'Indore', '1607069058_ba512f3c81482e3db2b6.jpg', NULL, '2020-12-04 08:04:18', '2020-12-04 08:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent_id`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Top Talks', 0, 1, '2020-12-03 09:53:05', '2020-12-03 13:29:03'),
(2, 'Food Talks', 0, 1, '2020-12-03 09:53:43', '2020-12-03 10:02:06'),
(3, 'Education Talks', 0, 1, '2020-12-03 09:54:04', '2020-12-03 10:02:13'),
(4, 'Special Talks', 0, 1, '2020-12-03 09:54:36', '2020-12-03 09:54:36'),
(5, 'Street Food', 2, 1, '2020-12-03 10:04:17', '2020-12-03 10:04:17'),
(6, 'Restaurant', 2, 1, '2020-12-03 10:11:44', '2020-12-03 10:11:44'),
(7, 'Cafe', 2, 1, '2020-12-03 10:11:55', '2020-12-03 10:11:55'),
(8, 'Pub & Disc', 2, 1, '2020-12-03 10:12:15', '2020-12-03 10:12:15'),
(9, 'Coaching', 3, 1, '2020-12-03 10:13:05', '2020-12-03 10:13:05'),
(10, 'College', 3, 1, '2020-12-03 10:13:28', '2020-12-03 10:13:28'),
(11, 'School', 3, 1, '2020-12-03 10:13:38', '2020-12-03 10:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Indore', 1, '2020-12-04 10:32:16', '2020-12-04 10:32:16'),
(2, 'Bhopal', 1, '2020-12-04 10:32:16', '2020-12-04 10:32:16'),
(3, 'Gwalior', 1, '2020-12-04 10:32:16', '2020-12-04 10:32:16'),
(4, 'Satna', 1, '2020-12-04 10:32:16', '2020-12-04 10:40:36'),
(5, 'Jabalpur', 1, '2020-12-04 10:37:13', '2020-12-04 10:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `address` text NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(30) NOT NULL,
  `end_time` varchar(30) NOT NULL,
  `price` decimal(50,2) NOT NULL,
  `tags` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `city` varchar(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `description` varchar(225) NOT NULL,
  `file` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`id`, `name`, `phone`, `city`, `type`, `description`, `file`, `created_at`, `modified_at`) VALUES
(1, 'Bhawna Sharma', '7894563211', 'Indore', 'Help', 'Here are the description for the interact', '1607067093_9a405fa07fbb62286f61.jpg', '2020-12-04 07:31:33', '2020-12-04 07:31:33'),
(2, 'Manohar Pandey', '7894563255', 'Bhopal', 'Promotion', 'Here are the description for the interact', '1607067196_52614852e6e58b40fb0e.jpg', '2020-12-04 07:33:16', '2020-12-04 07:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `slug` varchar(30) DEFAULT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', ' <h1> Privacy Policy for [YOUR SITE TITLE]</h1>\r\n<p> If you require any more information or have any questions about our privacy policy, please feel free to contact us by email at [CONTACT@YOUREMAIL.COM].</p>\r\n<p>At [YOUR SITE URL] we consider the privacy of our visitors to be extremely important. This privacy policy document describes in detail the types of personal information is collected and recorded by [YOUR SITE URL] and how we use it. </p>\r\n<p> <b>Log Files</b><br> Like many other Web sites, [YOUR SITE URL] makes use of log files. These files merely logs visitors to the site – usually a standard procedure for hosting companies and a part of hosting services\'s analytics. The information inside the log files includes internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date/time stamp, referring/exit pages, and possibly the number of clicks. This information is used to analyze trends, administer the site, track user\'s movement around the site, and gather demographic information. IP addresses, and other such information are not linked to any information that is personally identifiable. </p>\r\n<p> <b>Cookies and Web Beacons</b><br>[YOUR SITE URL] uses cookies to store information about visitors\' preferences, to record user-specific information on which pages the site visitor accesses or visits, and to personalize or customize our web page content based upon visitors\' browser type or other information that the visitor sends via their browser. </p>\r\n<p><b>DoubleClick DART Cookie</b><br> </p>\r\n<p>\r\n→ Google, as a third party vendor, uses cookies to serve ads on [YOUR SITE URL].<br><br>\r\n→ Google\'s use of the DART cookie enables it to serve ads to our site\'s visitors based upon their visit to [YOUR SITE URL] and other sites on the Internet. <br><br>\r\n→ Users may opt out of the use of the DART cookie by visiting the Google ad and content network privacy policy at the following URL – <a href=\"http://www.google.com/privacy_ads.html\">http://www.google.com/privacy_ads.html</a> </p>\r\n<p><b>Our Advertising Partners</b><br> </p>\r\n<p> Some of our advertising partners may use cookies and web beacons on our site. Our advertising partners include ……. <br></p>\r\n<ul>\r\n<li>Google</li>\r\n<li>Commission Junction</li>\r\n<li>Amazon</li>\r\n<li>Adbrite</li>\r\n<li>Clickbank</li>\r\n<li>Yahoo! Publisher Network</li>\r\n<li>Chitika</li>\r\n<li>Kontera</li>\r\n</ul>\r\n<p><em>While each of these advertising partners has their own Privacy Policy for their site, an updated and hyperlinked resource is maintained here: <a href=\"https://www.privacypolicyonline.com/privacy-policy-links/\">Privacy Policy Links</a>.<br> <br>\r\nYou may consult this listing to find the privacy policy for each of the advertising partners of [YOUR SITE URL].</em></p>\r\n<p> These third-party ad servers or ad networks use technology in their respective advertisements and links that appear on [YOUR SITE URL] and which are sent directly to your browser. They automatically receive your IP address when this occurs. Other technologies (such as cookies, JavaScript, or Web Beacons) may also be used by our site\'s third-party ad networks to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on the site. </p>\r\n<p> [YOUR SITE URL] has no access to or control over these cookies that are used by third-party advertisers. </p>\r\n<p></p>\r\n<p><b>Third Party Privacy Policies</b><br>\r\nYou should consult the respective privacy policies of these third-party ad servers for more detailed information on their practices as well as for instructions about how to opt-out of certain practices. [YOUR SITE URL]\'s privacy policy does not apply to, and we cannot control the activities of, such other advertisers or web sites. You may find a comprehensive listing of these privacy policies and their links here: <a href=\"https://www.privacypolicyonline.com/privacy-policy-links/\" title=\"Privacy Policy Links\">Privacy Policy Links</a>.</p>\r\n<p> If you wish to disable cookies, you may do so through your individual browser options. More detailed information about cookie management with specific web browsers can be found at the browsers\' respective websites. <a href=\"https://www.privacypolicyonline.com/what-are-cookies/\">What Are Cookies?</a></p>\r\n<p><strong>Children\'s Information</strong><br>We believe it is important to provide added protection for children online. We encourage parents and guardians to spend time online with their children to observe, participate in and/or monitor and guide their online activity.<br>\r\n[YOUR SITE URL] does not knowingly collect any personally identifiable information from children under the age of 13.  If a parent or guardian believes that [YOUR SITE URL] has in its database the personally-identifiable information of a child under the age of 13, please contact us immediately (using the contact in the first paragraph) and we will use our best efforts to promptly remove such information from our records.</p>\r\n<p>\r\n<b>Online Privacy Policy Only</b><br>\r\nThis privacy policy applies only to our online activities and is valid for visitors to our website and regarding information shared and/or collected there.<br>\r\nThis policy does not apply to any information collected offline or via channels other than this website.</p>\r\n<p><b>Consent</b><br>\r\nBy using our website, you hereby consent to our privacy policy and agree to its terms.\r\n</p>\r\n<p><b>Update</b><br>This Privacy Policy was last updated on: Nov 1st, 2019. Should we update, amend or make any changes to our privacy policy, those changes will be posted here.</p>\r\n<p><!-- END of Privacy Policy || Generated by http://www.PrivacyPolicyOnline.com || --></p>\r\n<p></p>', 1, '2020-12-01 13:13:35', '2020-12-04 11:02:05'),
(2, 'Terms and Contitions', 'terms-and-contitions', '<p>Terms And Conditions page</p>', 1, '2020-12-02 05:29:58', '2020-12-02 07:32:17'),
(4, 'Help', 'help', '<p>Help</p>', 1, '2020-12-02 06:12:43', '2020-12-02 06:12:43'),
(5, 'About', 'about', '<p>About Indore Talk</p>', 1, '2020-12-02 06:14:30', '2020-12-02 06:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `pools`
--

CREATE TABLE `pools` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(225) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pools`
--

INSERT INTO `pools` (`id`, `title`, `description`, `start_date`, `end_date`, `status`, `created_at`, `modified_at`) VALUES
(1, '#kanganaranaut', 'What do you think is kangna is doing good for industry ?', '2020-12-10', '2020-12-16', 1, '2020-12-03 06:36:17', '2020-12-03 06:36:17'),
(2, '#IndoreTalk', 'What do you think is this wireframe is useful for us ?', '2020-12-10', '2020-12-14', 1, '2020-12-03 06:38:10', '2020-12-03 06:38:10'),
(3, '#Mynameisking23', 'what do you think about me 32?', '2020-12-17', '2020-12-19', 0, '2020-12-03 06:38:43', '2020-12-03 06:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(225) NOT NULL,
  `tags` text NOT NULL,
  `image` text NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `popups`
--

INSERT INTO `popups` (`id`, `title`, `description`, `tags`, `image`, `from`, `to`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Indore Modal Show', 'Indore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal ShowIndore Modal Show', '', '1606912914_6f21b334030b72cde19c.jpg', '2020-12-24', '2020-12-31', 1, '2020-12-02 12:41:54', '2020-12-02 13:41:25'),
(3, 'Aaron Sebastian Avatar of user', 'Aaron Sebastian\r\nAvatar of user Aaron Sebastian\r\nAaron Sebastian\r\nAvatar of user Aaron Sebastian', '', '1606913930_e940d17c71cc28f455d8.jpg', '2020-12-17', '2020-12-20', 1, '2020-12-02 12:58:50', '2020-12-02 13:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(225) DEFAULT NULL,
  `video_url` varchar(225) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive , 1 = Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiead_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`, `video_url`, `category_id`, `tags`, `status`, `created_at`, `modifiead_at`) VALUES
(1, '#MyCleanIndore', '#MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore #MyCleanIndore#MyCleanIndore#MyCleanIndore', '1607002127_b1ec6a37e48c8b40a7df.jpg', 'https://www.youtube.com/watch?v=zSdwzfBQFCw', 2, '[\"1\",\"2\",\"3\",\"4\"]', 1, '2020-12-03 12:43:45', '2020-12-03 13:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Education', '2020-12-03 11:07:30', '2020-12-03 11:09:10'),
(2, 'Coaching', '2020-12-03 11:09:23', '2020-12-03 11:09:23'),
(3, 'Entertainment', '2020-12-03 11:09:42', '2020-12-03 11:09:42'),
(4, 'College', '2020-12-03 11:10:05', '2020-12-03 11:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `google_login_data` text NOT NULL,
  `facebook_login_data` text NOT NULL,
  `token` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email_otp` varchar(5) NOT NULL,
  `sms_otp` varchar(5) NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `sms_verified` tinyint(1) NOT NULL DEFAULT 0,
  `admin_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `google_login_data`, `facebook_login_data`, `token`, `status`, `email_otp`, `sms_otp`, `email_verified`, `sms_verified`, `admin_verified`, `created_at`, `updated_at`) VALUES
(1, 'Manohar', 'Sharma', 'manohar2@mailinator.com', '7899879879', '$2y$10$rh14.N7HNtC6Z8FXeuGeau010AU19YueEUMQSmFC4pjqdsCdUfrnG', '', '', '', 0, '', '', 0, 0, 0, '2020-12-02 06:51:00', '2020-12-02 06:51:00'),
(2, 'Mannu', 'Bhopali', 'manohara2@mailinator.com', '7899879878', '$2y$10$1LyseewC7uIyIu3jY2vAWeJNTA0QopjmQS9TN8jgQ9Rg/bAvrbF/G', '', '', '', 0, '', '', 0, 0, 0, '2020-12-02 07:43:45', '2020-12-04 06:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `featured_tags` text NOT NULL,
  `from_date_time` datetime NOT NULL,
  `to_date_time` datetime NOT NULL,
  `video` text NOT NULL,
  `video_url` text NOT NULL,
  `cover_image` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `tags`, `featured_tags`, `from_date_time`, `to_date_time`, `video`, `video_url`, `cover_image`, `created_date`, `modified_date`) VALUES
(1, 'My Video Title', 'My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description My Video Description ', 'sawan, rahul, raju, kaju, gopu', 'bhopu, video, Alabama, New Hampshire', '2021-01-04 12:00:00', '2021-01-07 17:00:00', '1609752490_da9aa49816ceab5cd556.mp4', 'https://www.youtube.com/watch?v=1SnPKhCdlsU', '', '2021-01-04 09:28:11', '2021-01-04 09:28:11'),
(2, 'NEw Vid', 'NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption NeW DescRiption ', 'Tennessee, Texas, Delaware, New Hampshire, Oregon, ty, Massachusetts, Maine', 'Alaska, Arkansas, South Carolina, Kansas', '2021-01-05 12:00:00', '2021-01-06 14:00:00', '1609752957_31c3d434967d1f7dcd66.mp4', 'https://www.youtube.com/watch?v=1SnPKhCdlsU', '', '2021-01-04 09:35:57', '2021-01-04 09:35:57'),
(3, 'sfd gs', 'dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg dfgsdfg sdfg sdfgsdfgsdf gsd fgsd fg ', 'asdf, asdf asdf, a sdf, New Hampshire, sdf, as', 'asdfasdf, adsf, as, df, Alabama, sd, Florida, a, sdf, asd, California', '2021-01-04 12:00:00', '2021-01-04 13:07:00', '1609753264_f6967d4184a1c7198ee5.avi', 'https://www.youtube.com/watch?v=1SnPKhCdlsU', 'sasasasasas', '2021-01-04 09:41:04', '2021-01-04 09:41:04'),
(4, 'adf asdf ', 'asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf asdfasdf asdf sadf sadf sdasdf asf ', 'Colorado, Alaska', 'asdf, asd, Florida, California', '2021-01-04 12:00:00', '2021-01-04 15:04:00', '1609754425_14aa296b54b68f31e5b1.mp4', 'https://www.youtube.com/watch?v=1SnPKhCdlsU', '1609754425_5d6584f89308575bb672.png', '2021-01-04 10:00:25', '2021-01-04 10:00:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bussiness_listing`
--
ALTER TABLE `bussiness_listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_form`
--
ALTER TABLE `career_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pools`
--
ALTER TABLE `pools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bussiness_listing`
--
ALTER TABLE `bussiness_listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `career_form`
--
ALTER TABLE `career_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pools`
--
ALTER TABLE `pools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
