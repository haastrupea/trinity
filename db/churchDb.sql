-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2019 at 04:24 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `churchDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Action_log`
--

CREATE TABLE `Action_log` (
  `id` int(11) NOT NULL,
  `action` varchar(500) NOT NULL,
  `date_logged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`user_id`, `user_name`, `user_email`, `user_password`, `role_id`, `created`, `last_update`) VALUES
(1, 'trinity', 'haastrupea@gmail.com', '$2y$10$3tVCutKB8BeYk4WTIcTG5.DjI7T1YfVbUlpgk2WQbWuMvSZlt9SIO', 1, '2019-05-01 08:57:08', '2019-06-21 20:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `role_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `role`, `role_description`) VALUES
(1, 'Admin', 'have full control over the operations of trinity');

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE `bulletin` (
  `bulletin_id` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `Issue` int(11) NOT NULL,
  `publish_status` enum('now','later','until') NOT NULL DEFAULT 'now',
  `publish_date` date DEFAULT NULL,
  `keyword` varchar(500) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bulletin_file` varchar(100) NOT NULL,
  `bulletin_title_id` int(11) NOT NULL,
  `dl_counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulletin`
--

INSERT INTO `bulletin` (`bulletin_id`, `volume`, `Issue`, `publish_status`, `publish_date`, `keyword`, `added_by`, `added_on`, `last_modified`, `bulletin_file`, `bulletin_title_id`, `dl_counter`) VALUES
(9, 1, 1, 'now', '2019-06-21', 'grace, holiness, sermon,holy ghost service, redeem christian church of Godh', 1, '2019-06-21 17:30:27', '2019-06-21 17:30:27', 'Herod of His grace_vol_1_issue_1.pdf', 10, 0),
(10, 2, 1, 'now', '2019-06-24', 'grace, holiness, sermon,holy ghost service, redeem christian church of Godh', 1, '2019-06-24 14:57:02', '2019-06-24 14:57:02', 'Herod of His grace_vol_2_issue_1.pdf', 10, 0),
(11, 2, 2, 'now', '2019-06-24', 'grace, holiness, sermon,holy ghost service, redeem christian church of Godh', 1, '2019-06-24 14:57:25', '2019-06-24 14:57:25', 'Herod of His grace_vol_2_issue_2.pdf', 10, 0),
(12, 1, 1, 'until', '2019-06-26', 'grace, holiness, sermon,holy ghost service, redeem christian church of God,life,love', 1, '2019-06-24 22:08:41', '2019-06-24 22:08:41', 'herald of His glory_vol_1_issue_1.pdf', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bulletin_title`
--

CREATE TABLE `bulletin_title` (
  `title_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `last_modefied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(500) NOT NULL,
  `publish` set('daily','weekly','monthly','yearly') NOT NULL DEFAULT 'monthly',
  `pub_freq` int(11) NOT NULL DEFAULT '1',
  `publish_status` enum('published','pending') NOT NULL DEFAULT 'pending',
  `date_published` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulletin_title`
--

INSERT INTO `bulletin_title` (`title_id`, `title`, `date_created`, `created_by`, `last_modefied`, `description`, `publish`, `pub_freq`, `publish_status`, `date_published`) VALUES
(10, 'Herod of His grace', '2019-06-21 16:27:01', 1, '2019-07-03 05:38:37', 'Stack Overflow\r\nProducts\r\nCustomers\r\nUse cases\r\nSearchâ€¦\r\nLog in Sign up\r\nBy using our site, you acknowledge that you have read and understand our Cookie Policy, Privacy Policy, and our Terms of Service.\r\n\r\nHome\r\nPUBLIC\r\nStack Overflow\r\nTags\r\nUsers\r\nJobs\r\nTEAMS\r\nWhatâ€™s this?\r\n\r\n\r\n\r\nQ&A for work\r\nHow to update MySql timestamp column manually to current timestamp through PHP\r\nAsk Question\r\n\r\n30\r\n\r\n\r\n6\r\nI want to update the MySQL columns of data type timestamp manually through my PHP code.\r\n\r\nCa', 'monthly', 1, 'pending', '2019-07-03 05:38:37'),
(11, 'herald of His glory', '2019-06-24 22:07:50', 1, '2019-06-25 14:19:20', 'hxzdfhqewfdljsdflwqifdlweqgujebdjkvxdabjJK', 'weekly', 1, 'pending', '2019-06-25 14:19:20'),
(12, 'testing', '2019-06-27 03:23:42', 1, '2019-06-27 03:23:42', 'h', 'monthly', 1, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `church_history`
--

CREATE TABLE `church_history` (
  `church_id` int(11) NOT NULL,
  `founding_date` date NOT NULL,
  `church_History` text,
  `video_doc` varchar(200) DEFAULT NULL,
  `mission` varchar(500) DEFAULT NULL,
  `vision` varchar(500) DEFAULT NULL,
  `vs_ms_youtube_link` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `church_history`
--

INSERT INTO `church_history` (`church_id`, `founding_date`, `church_History`, `video_doc`, `mission`, `vision`, `vs_ms_youtube_link`) VALUES
(2, '2001-09-04', 'WOW', 'http://youtube.com/channels', 'wow', 'defender', 'http://wow.com');

-- --------------------------------------------------------

--
-- Table structure for table `church_info`
--

CREATE TABLE `church_info` (
  `id` int(11) NOT NULL,
  `ch_name` varchar(100) NOT NULL,
  `ch_address` varchar(250) NOT NULL,
  `ch_email` varchar(50) NOT NULL,
  `ch_phone_1` int(20) NOT NULL,
  `ch_phone_2` int(20) DEFAULT NULL,
  `ch_phone_3` int(20) DEFAULT NULL,
  `ch_phone_4` int(20) DEFAULT NULL,
  `ch_box_number` varchar(20) DEFAULT NULL,
  `ch_post_office` varchar(100) DEFAULT NULL,
  `ch_fax` int(25) DEFAULT NULL,
  `ch_fb_pg` varchar(50) DEFAULT NULL,
  `ch_twitter` varchar(50) DEFAULT NULL,
  `ch_instagram` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `church_info`
--

INSERT INTO `church_info` (`id`, `ch_name`, `ch_address`, `ch_email`, `ch_phone_1`, `ch_phone_2`, `ch_phone_3`, `ch_phone_4`, `ch_box_number`, `ch_post_office`, `ch_fax`, `ch_fb_pg`, `ch_twitter`, `ch_instagram`) VALUES
(2, 'The redeemed christian church of God', 'ebute-meta lagos state, Nigeria', 'rccg_info@rccg.org', 1234534678, NULL, NULL, NULL, '123', 'Ile-ife', 23445566, 'https://facebook.com/hello', 'http://twitter.com/hello', 'http://instagram.com/hello');

-- --------------------------------------------------------

--
-- Table structure for table `church_pastor`
--

CREATE TABLE `church_pastor` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(20) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `about` text,
  `gender` set('male','female','') DEFAULT NULL,
  `welcome_address` varchar(500) DEFAULT NULL,
  `fb_page` varchar(150) DEFAULT NULL,
  `ig_page` varchar(150) DEFAULT NULL,
  `twitter_page` varchar(150) DEFAULT NULL,
  `is_founder` tinyint(1) NOT NULL DEFAULT '0',
  `post` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `church_pastor`
--

INSERT INTO `church_pastor` (`id`, `title`, `firstname`, `middlename`, `lastname`, `picture`, `about`, `gender`, `welcome_address`, `fb_page`, `ig_page`, `twitter_page`, `is_founder`, `post`) VALUES
(5, 'rev', 'Oyewole', 'Adejare', 'wole', 'Mr._O.A_wole.jpeg', 'wow', 'male', 'Welcome to our church where we love, care and preach the word of God that is able to make you skillful in your spiritual Journey', 'ok', 'ok', 'ok', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `Ev_events`
--

CREATE TABLE `Ev_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `venue` varchar(150) NOT NULL,
  `event_description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_all_day` tinyint(1) NOT NULL DEFAULT '1',
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_event_id` int(11) DEFAULT NULL,
  `use_event_name` tinyint(1) NOT NULL DEFAULT '1',
  `flyer_file_name` varchar(100) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ev_events`
--

INSERT INTO `Ev_events` (`id`, `event_name`, `venue`, `event_description`, `start_date`, `end_date`, `start_time`, `end_time`, `is_all_day`, `is_recurring`, `created_by`, `created_on`, `parent_event_id`, `use_event_name`, `flyer_file_name`, `last_update`) VALUES
(2, 'June holyghost service(swimming in glory 6)', 'Km 46 lagos-ibadan expressway, ogun state, Nigeria', 'a monthly miracle service', '2019-06-17', '2019-06-18', '19:00:00', '02:00:00', 0, 0, 1, '2019-06-18 02:59:54', NULL, 1, NULL, '2019-06-18 02:59:54'),
(3, 'June holyghost service(swimming in glory 6)', 'Km 46 lagos-ibadan expressway, ogun state, Nigeria', 'k', '2019-06-22', '2019-06-22', NULL, NULL, 1, 0, 1, '2019-06-21 23:10:24', NULL, 1, NULL, '2019-06-21 23:10:24'),
(4, 'Ayanfe\'s birthday', 'wherever there is greatness', 'belle\'s birthday', '2019-08-24', NULL, NULL, NULL, 1, 1, 1, '2019-06-24 22:25:19', NULL, 1, NULL, '2019-06-24 22:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `Ev_repeat_exception`
--

CREATE TABLE `Ev_repeat_exception` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rescheduled` tinyint(1) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_all_day` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ev_repeat_pattern`
--

CREATE TABLE `Ev_repeat_pattern` (
  `event_id` int(11) NOT NULL,
  `repeat_type` int(11) NOT NULL,
  `occurencies` int(11) DEFAULT NULL,
  `interval_sep` int(10) NOT NULL DEFAULT '1',
  `day_of_week` set('1','2','3','4','5','6','7') DEFAULT NULL,
  `week_of_month` set('1','2','3','4') DEFAULT NULL,
  `day_of_month` set('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31') DEFAULT NULL,
  `month_of_year` set('1','2','3','4','5','6','7','8','9','10','11','12') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ev_repeat_pattern`
--

INSERT INTO `Ev_repeat_pattern` (`event_id`, `repeat_type`, `occurencies`, `interval_sep`, `day_of_week`, `week_of_month`, `day_of_month`, `month_of_year`) VALUES
(4, 4, NULL, 1, NULL, NULL, '24', '8');

-- --------------------------------------------------------

--
-- Table structure for table `Ev_repeat_type`
--

CREATE TABLE `Ev_repeat_type` (
  `id` int(11) NOT NULL,
  `repeat_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ev_repeat_type`
--

INSERT INTO `Ev_repeat_type` (`id`, `repeat_type`) VALUES
(1, 'daily'),
(2, 'weekly'),
(3, 'monthly'),
(4, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `picture_gallery`
--

CREATE TABLE `picture_gallery` (
  `id` int(11) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `outside_view` varchar(100) DEFAULT NULL,
  `inside_view` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picture_gallery`
--

INSERT INTO `picture_gallery` (`id`, `picture`, `logo`, `outside_view`, `inside_view`) VALUES
(8, NULL, 'logo.png', 'outside view.jpeg', 'inside view.png');

-- --------------------------------------------------------

--
-- Table structure for table `preachers`
--

CREATE TABLE `preachers` (
  `preachers_id` int(11) NOT NULL,
  `preacher_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preachers`
--

INSERT INTO `preachers` (`preachers_id`, `preacher_name`) VALUES
(23, 'Pst E.A Adeboye'),
(24, 'Pst E.A'),
(25, 'mremem');

-- --------------------------------------------------------

--
-- Table structure for table `sermons`
--

CREATE TABLE `sermons` (
  `sermon_id` int(11) NOT NULL,
  `sermon_topic` varchar(100) NOT NULL,
  `sermon_preacher_id` int(11) NOT NULL,
  `preached_on` date NOT NULL,
  `sermon_publish_status` enum('now','later','until') NOT NULL DEFAULT 'now',
  `sermon_publish_date` date DEFAULT NULL,
  `sermon_description` varchar(500) DEFAULT NULL,
  `sermon_audio_file` varchar(100) DEFAULT NULL,
  `sermon_cover_image` varchar(100) DEFAULT NULL,
  `sermon_youtube_vld` varchar(300) DEFAULT NULL,
  `sermon_keywords` varchar(500) DEFAULT NULL,
  `folder_hash_key` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sermons`
--

INSERT INTO `sermons` (`sermon_id`, `sermon_topic`, `sermon_preacher_id`, `preached_on`, `sermon_publish_status`, `sermon_publish_date`, `sermon_description`, `sermon_audio_file`, `sermon_cover_image`, `sermon_youtube_vld`, `sermon_keywords`, `folder_hash_key`, `created_by`) VALUES
(280, 'grace in time of weekness', 23, '2019-06-12', 'now', '2019-06-12', 'Sermon During match holy ghost service', '816f665f345dcba61de2.mp3', NULL, NULL, 'grace, holiness, sermon,holy ghost service, redeem christian church of God', '7f00ab3647da28cdf237', 1),
(281, 'TOASTING PALAVA (GHENGHENJOKES)', 23, '2019-05-23', 'now', '2019-06-12', 'Toasting Palava, but on more serious note shey kojo no try for the english  ni #lol .Download ghneghen stickers for free herewww.ghenghenstudio.comFor sponsorship and advert Call+2348164543336 Follow usFacebook: www.facebook.com/GhenghenjokesInstagram: @ghenghenjokes#Kojostickers #Ghenghenjokes', NULL, NULL, 'b--Lnx0_aLU', 'ghenghenjokes,ghenghenanimation,kojo,okpako,nigeria,lagos,world,london,southafrica,ghana,ajangbadi,okoko,school,pry,college,2danimation,aftereffect,trending,jokes,comedy,funny,savage,education,teacher,student,wednesday,film,houseofajebo,splendid,disney,markangel,gig,weeklyjoke,ghenghen,studios,france,italy,togo,subject,english,warriboy,pidgin,kid,cartoonnetwork,toast,woo', NULL, 1),
(282, 'Tom & Jerry | The Best Father & Son Duo Ever! | Classic Cartoon Compilation | WB Kids', 24, '2019-01-15', 'now', '2019-06-12', 'Need a bit more Father and Son kind of love? Not to worry, Spike and Tyke got you covered!Catch up with Tom & Jerry as they chase each other, avoid Spike, and play with friends like Little Quacker and Butch the cat.WBKids is the home of all of your favorite clips featuring characters from the Looney Tunes, Scooby-Doo, Tom and Jerry and More!Tom & Jerry is available now on DVD!Watch now: https://play.google.com/store/tv/show/The_Tom_and_Jerry_Show?id=pbNtn5J4o5kStream Scooby-Doo, Looney Tunes, To', NULL, NULL, 'Og2FX9hJ1UM', 'Scooby-Doo!,Tom,Jerry,Looney,Tunes,Bugs,Bunny,Compilation,Cartoons,Classic,Animation,full,episodes,Scooby,doo,where,chuck,jones,Mel,Blanc,Spike,Dog,Daffy,Duck,Porky,Pig,Coyote,&,Roadrunner,T&J2018,CLASSIC2018', NULL, 1),
(283, 'Tom y Jerry en EspaÃ±ol | Little Quacker  + Down and Outing | Dibujos animados para niÃ±os', 23, '2018-10-23', 'now', '2019-06-12', 'Tom y Jerry en EspaÃ±ol | Little Quacker  + Down and Outing | Dibujos animados para niÃ±os HD', NULL, NULL, 'IFncZA5k_1k', 'tom,jerry,completos,Tom,y,Jerry,en,EspaÃ±ol,Capitulos,Completos,2016,espaÃ±ol,capitulos,viejos,ØªÙˆÙ…,ÙˆØ¬ÙŠØ±ÙŠ,Ù…Ø¶Ø­Ùƒ,ÙŠÙ…Ù†ÙŠ,all,episodes,show,n,video,Ø¨Ø§Ù„ÙŠÙ…Ù†ÙŠ,Ø´Ùˆ,Little,Quacker,Down,Outing,talking,angela,friends,funny,cat', NULL, 1),
(284, 'grace in time of weekness wowfff', 23, '2019-06-14', 'now', '2019-06-14', 'Sermon During match holy ghost service', 'fdea390eb98fa6791cfc.mp3', NULL, NULL, 'grace, holiness, sermon,holy ghost service, redeem christian church of God', '8819adbbf1a54f94b5ae', 1),
(285, 'The Three Beautiful Princesses - African Movie 2019 Nigerian Movies', 23, '2019-06-07', 'now', '2019-06-14', 'African Movies Latest Nigerian Movies 2019 Nigerian Movies Nollywood Free Full MoviesThey are sisters who have common interest in a man, they are willing to step on each others toes just to be him. Who will be the chosen one?Starring: Cha Cha Eke, Oge Okoye, Lizzy Gold#YouTubeng #nigerianmovies #africanmovies #nollywoodmovies #nollygreatmoviesNigerian movies: Nigerian movies are known to be the best of  movies you would love.To stay up to date with our   SUBSCRIBE http://bit.ly/21fOcaDIf you app', NULL, NULL, 'BnpefmGLWFQ', 'african,movies,nigerian,latest,yoruba,2019,2018,lagos,nollywood,full,nigeria,regina,daniels,new,sistersstrife,cZ0FIyr96u', NULL, 1),
(286, 'Michael Jackson - You Rock My World (Official Video)', 25, '2009-10-03', 'now', '2019-07-03', 'The short film to', NULL, NULL, '1-7ABIM2qjU', 'invincible,rock,my,world,music,video,official,rodney,jerkins,final,album,sixth,chris,tucker,marlon,brando,paul,hunter,epic,records,extended,version,Epic,Michael,Jackson,Pop,You,Rock,My,World', NULL, 1),
(287, 'Seyi Shay - Surrender (Official Video) ft. Kizz Daniel', 23, '2018-07-11', 'now', '2019-07-20', 'Music is very personal and I have realized this more with my #ElectricPackage EP. The intimacy of music is what makes it truly magical and I feel like weâ€™ve lost that in todayâ€™s world. I know this might get me in trouble with my team but Iâ€™ve decided to share the visuals of â€˜Surrenderâ€™ with yâ€™all without any teasers and promotional nonsense because itâ€™s such a special song to me. Making this song with Kizz took me back to the old days when I first fell in love... (with music)A girl', NULL, NULL, 'bA9jju9xupA', 'Seyi,Shay,Surrender,(Official,Video),Stargurl,World,seyi,shay,surrender,vevo', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sermon_transcription`
--

CREATE TABLE `sermon_transcription` (
  `language` enum('en') DEFAULT 'en',
  `transcription` text NOT NULL,
  `sermon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Action_log`
--
ALTER TABLE `Action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_by` (`action_by`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`bulletin_id`),
  ADD UNIQUE KEY `bulletin_file` (`bulletin_file`),
  ADD KEY `bulletin_created_by` (`added_by`),
  ADD KEY `number` (`Issue`),
  ADD KEY `bulletin_title_id` (`bulletin_title_id`),
  ADD KEY `dl_counter` (`dl_counter`);

--
-- Indexes for table `bulletin_title`
--
ALTER TABLE `bulletin_title`
  ADD PRIMARY KEY (`title_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `church_history`
--
ALTER TABLE `church_history`
  ADD PRIMARY KEY (`church_id`),
  ADD UNIQUE KEY `church_id` (`church_id`),
  ADD KEY `church_id_2` (`church_id`);

--
-- Indexes for table `church_info`
--
ALTER TABLE `church_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `church_pastor`
--
ALTER TABLE `church_pastor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Ev_events`
--
ALTER TABLE `Ev_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_event_id` (`parent_event_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `Ev_repeat_exception`
--
ALTER TABLE `Ev_repeat_exception`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `Ev_repeat_pattern`
--
ALTER TABLE `Ev_repeat_pattern`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `repeat_type` (`repeat_type`);

--
-- Indexes for table `Ev_repeat_type`
--
ALTER TABLE `Ev_repeat_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_gallery`
--
ALTER TABLE `picture_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preachers`
--
ALTER TABLE `preachers`
  ADD PRIMARY KEY (`preachers_id`);

--
-- Indexes for table `sermons`
--
ALTER TABLE `sermons`
  ADD PRIMARY KEY (`sermon_id`),
  ADD UNIQUE KEY `sermon_id` (`sermon_id`),
  ADD UNIQUE KEY `sermon_youtube_link` (`sermon_youtube_vld`),
  ADD UNIQUE KEY `sermon_audio_file` (`sermon_audio_file`),
  ADD UNIQUE KEY `folder_hash_key` (`folder_hash_key`),
  ADD UNIQUE KEY `sermon_youtube_vld` (`sermon_youtube_vld`),
  ADD KEY `sermon_preacher_id` (`sermon_preacher_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `sermon_transcription`
--
ALTER TABLE `sermon_transcription`
  ADD PRIMARY KEY (`sermon_id`),
  ADD UNIQUE KEY `sermon_id_2` (`sermon_id`),
  ADD KEY `sermon_id` (`sermon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Action_log`
--
ALTER TABLE `Action_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `bulletin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bulletin_title`
--
ALTER TABLE `bulletin_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `church_info`
--
ALTER TABLE `church_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `church_pastor`
--
ALTER TABLE `church_pastor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Ev_events`
--
ALTER TABLE `Ev_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Ev_repeat_type`
--
ALTER TABLE `Ev_repeat_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `picture_gallery`
--
ALTER TABLE `picture_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `preachers`
--
ALTER TABLE `preachers`
  MODIFY `preachers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sermons`
--
ALTER TABLE `sermons`
  MODIFY `sermon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Action_log`
--
ALTER TABLE `Action_log`
  ADD CONSTRAINT `Action_log_ibfk_1` FOREIGN KEY (`action_by`) REFERENCES `Admin` (`user_id`);

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`);

--
-- Constraints for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD CONSTRAINT `bulletin_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `Admin` (`user_id`),
  ADD CONSTRAINT `bulletin_ibfk_2` FOREIGN KEY (`bulletin_title_id`) REFERENCES `bulletin_title` (`title_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bulletin_title`
--
ALTER TABLE `bulletin_title`
  ADD CONSTRAINT `bulletin_title_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `church_history`
--
ALTER TABLE `church_history`
  ADD CONSTRAINT `church_history_ibfk_1` FOREIGN KEY (`church_id`) REFERENCES `church_info` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ev_events`
--
ALTER TABLE `Ev_events`
  ADD CONSTRAINT `Ev_events_ibfk_1` FOREIGN KEY (`parent_event_id`) REFERENCES `Ev_events` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `Ev_events_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ev_repeat_exception`
--
ALTER TABLE `Ev_repeat_exception`
  ADD CONSTRAINT `Ev_repeat_exception_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Ev_events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ev_repeat_exception_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Ev_repeat_pattern`
--
ALTER TABLE `Ev_repeat_pattern`
  ADD CONSTRAINT `Ev_repeat_pattern_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Ev_events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ev_repeat_pattern_ibfk_2` FOREIGN KEY (`repeat_type`) REFERENCES `Ev_repeat_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sermons`
--
ALTER TABLE `sermons`
  ADD CONSTRAINT `sermons_ibfk_1` FOREIGN KEY (`sermon_preacher_id`) REFERENCES `preachers` (`preachers_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sermons_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `Admin` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sermon_transcription`
--
ALTER TABLE `sermon_transcription`
  ADD CONSTRAINT `sermon_transcription_ibfk_1` FOREIGN KEY (`sermon_id`) REFERENCES `sermons` (`sermon_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
