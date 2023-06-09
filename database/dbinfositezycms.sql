-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 02:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbinfositezycms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(70) NOT NULL,
  `category_posts` int(11) NOT NULL,
  `guideline` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_posts`, `guideline`) VALUES
(3, 'Stories', -3, 'Must show the experience of the students during the expo'),
(4, 'News', -1, 'Must be relevant to the event'),
(5, 'Guides', 1, 'Must serve as a help or guide to attendees'),
(8, 'Featured Researches', 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `post_desc` varchar(5000) NOT NULL,
  `category` int(11) NOT NULL,
  `author` int(100) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_img` varchar(100) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_name`, `post_desc`, `category`, `author`, `post_date`, `post_img`, `status`) VALUES
(44, 'Web-based Tabulation System: Providing a Reliable System for You', 'The IT-MAWD strand has been working on their research papers to highlight their potential in their selected strand. A group from the IT strand has been working on a web-based tabulation system solely for this year’s Senior High School Expo. But what is a tabulation system and what is its purpose? How did they also produce this research? Are there also advantages and disadvantages to this system? \r\n\r\nBased on the group of researchers, a tabulation system is designed to submit a score to store the data that will be input on a program. A tabulation system is a computer program used for making calculations or controlling operations expressible in numerical or logical terms. Also, A tabulation system is also used to present data in the form of a table. Their purpose in working on a tabulation system is to grade the final works of Grade 12 students per strand during the SHS Expo. They produced this system because they distinguished that scoring a booth using the manual process will consume a lot of time and may also cause inaccurate submission of scores which may affect a booth\'s score. \r\n\r\nA tabulation system has the advantage of producing a set of presentation data that is straightforward and easy to read; emphasizing significant characteristics of data; making numerical data comparison easier; and, finally, assisting in statistical analysis. Meanwhile, one of the drawbacks of adopting a Web-Based Tabulation System is that it requires an internet connection and uses electricity. \r\n\r\nSounds interesting, right? Catch the complete system and its details in the upcoming Senior High School Expo 2023!  ', 8, 5, '2023-05-29 02:34:39', '646a386d0cb87ATLASNew_1.jpg', 'approved'),
(45, 'Online Sales Monitoring System: Taking your Sales to the Next Level with our Online Monitoring System', 'As STI College Marikina started hosting an annual Senior High School Exposition, a group of researchers have decided to conduct a survey to individuals with prior experience at the STI College Marikina Expo. After conducting this survey, they have found out that in all IT in Mobile App and Web Development projects made by its students, the individuals have reported the absence of an online sales monitoring system at the expo during their respective periods.  \r\n\r\nThat is where they decided to make an online sales monitoring system for the SHS Expo. A sales monitoring system is a software program or connected series of programs that tracks and manages a company\'s sales information. It can gather and compile information from multiple sources and store sales data about your customers and products. They believed that an online sales monitoring system would enable companies to access real-time sales data to guide their decision-making, reduce their workloads, and improve their overall business operations. \r\n\r\nDoesn\'t that seem intriguing? The whole system and its details will be on display at the next Senior High School Expo 2023! ', 8, 5, '2023-05-29 02:35:08', '646a39270a72f333246311_2183884398472734_8631868468087565291_n (3).png', 'approved'),
(46, 'Online Events Management System for Employees: Your Schedule, Our Priority ', 'STI College Marikina has a great reputation for arranging a wide variety of school events, including film screenings, talent shows, sporting competitions, and other activities. However, despite the college’s record of accomplishment of success, scheduling these events can still be a significant challenge. The lack of an efficient and effective scheduling process can result in last-minute changes, miscommunications, and conflicts among event organizers. \r\n\r\nBy creating an online event monitoring and scheduling tool, the Online Event Management Information System (OEMIS) enables the client and its clients to offer quicker and more effective service. The solution will increase efficiency for the STI College Marikina personnel by eradicating the time-consuming manual processes they presently use for event management.  \r\n\r\nDoesn\'t that seem intriguing? The full system, with all its details, will be on display at the 2023 Senior High School Expo! ', 8, 5, '2023-05-29 02:35:30', '646a39eb9cb20IMG_0513.jpg', 'approved'),
(47, 'Web-Based Booth Voting System Utilizing Quick Response Code (QRC) Technology: Reliable Voting System for Everyone', 'IT-MAWD has been working on research papers that show their capabilities in their selected strand. For the STI College Marikina Senior High School Expo 2023, a research group from the IT strand has been designing a Web-Based Booth Voting System Using Quick Response Code (QRC) Technology. What is the purpose of their research?  \r\n\r\nThe SHS EXPO event will be using a QRC for two purposes. The first purpose is for Attendance, the QRC will be scanned in the entrance of the venue and is proof of being an authorized visitor. The second use of the QRC is for voting. Visitors may use their QRC to vote amongst all the Research Studies made by all STI College Marikina SHS Strands.  \r\n\r\nDoesn\'t that seem interesting? The system and all its components will be on show at the Senior High School Expo 2023! ', 8, 5, '2023-05-29 02:35:31', '646a3afc01ea5demoQratic_logo.png', 'approved'),
(48, 'Online Registration System using Quick Response (QR) Code: Registration Without the Hassle', 'IT-MAWD has been working on research papers to demonstrate their skills in their chosen strand. A research group from the IT strand has been developing an Online Registration System for the STI College Marikina Senior High School Expo 2023 using Quick Response (QR) Code for SHS Expo. What is their primary purpose in making a QR code application? \r\n\r\nTo provide an efficient, quick, and simple register module service to event guests and students. The research will also cover the integration of several modules, such as the User Information Interface, which includes the name, e-mail address, and affiliation. \r\n\r\nDoesn\'t that seem intriguing? The entire system and its details will be on display at the next Senior High School Expo 2023!', 8, 5, '2023-06-01 19:34:02', '646a3b5519bfd20230521_142054_0002.png', 'approved'),
(49, 'Online Information System with Content Management System: Trusted Information for Everyone', 'As the COVID-19 Pandemic affected our way of living, events in all schools are no exception regarding how they will adapt with the protocols that need to be followed. Years later, everything is starting to adapt in the new normal. Schools have been allowed to return the face-to-face modality for students. STI College Marikina is one of the schools that are now having face-to-face classes. As STI adapts the new normal, it has been a tradition for the institution to have the Senior High School Expo to allow students to showcase their craft in their respective strands.  \r\n\r\nA group of researchers in the IT-MAWD strand have produced an Online Information System that can be used to disseminate information for the future attendees of the said event. Since it has been two years since the last face-to-face expo, many students are now unaware of what the SHS Expo is all about and what to see and expect in this event. To fully understand the system made by these researchers, let us discover how it works.  \r\n\r\nThe website will focus on increasing attendee engagement, along with providing essential information regarding the SHS Expo by implementing interactive modules, personalized content, and responsive designs, as well as displaying accurate, relevant, and timely information about the expo. \r\n\r\nSounds interesting, right? Catch the complete system in action in the upcoming Senior High School Expo 2023! ', 8, 5, '2023-05-29 06:31:19', '646a3bcf6daf4Minimal initial brand logo.png', 'approved'),
(50, 'History of STI\'s Senior High School Expo', 'STI Colleges is known for organizing various events and activities that promote academic excellence and showcase the skills and talents of its students. One of the events that STI colleges typically host is the senior high school expo. \r\n\r\nThe Senior High School Expo is a showcase of the achievements and capabilities of senior high school students enrolled in STI Colleges. During the expo, students present their research projects, thesis papers, and other academic outputs to the public. The expo is also an opportunity for senior high school students to showcase their talents and skills in various areas, such as music, dance, theater, and the visual arts. This allows students to develop their confidence, creativity, and leadership abilities while also providing them with an opportunity to engage with their peers and the wider community.\r\n\r\nIn the year 2015, STI College of Marikina launched its first senior high school expo at the Marikina Convention Center. The event was filled with grade 10 students from different schools around Marikina City, including Sto. Nino National High School, Barangka National High School, Fortune High School, etc., as well as parents, non-teaching and teaching personnel, and senior high school students of STI College Marikina. It was also filled with the amusement, knowledge, skills, and talents of every student that was there.\r\n\r\nAs years pass in the STI College Marikina, the senior high school expo is always the most anticipated big event, prepared by the grade 12 students every year. In the year 2018, they launched the STI EXPO with the theme “We are Future Ready: Knowledge to Application, Different Strands in Action,” which took place in the River Banks Center. The grade 12 students prepared different booths connected to their research products. The students who have shown their research products are the ones from HUMMS, ICT, CULART, RESBO, ABM, and TOPER strands.\r\n\r\nMoreover, the Senior High School Expo is an occasion for STI Colleges to promote its senior high school programs and attract potential students. The expo provides an opportunity for parents and guardians to learn more about the curriculum, facilities, and student activities offered by STI Colleges.\r\n\r\nOverall, the Senior High School Expo at STI Colleges is an excellent platform for senior high school students to showcase their academic and artistic skills, develop their confidence and leadership abilities, and promote the benefits of pursuing senior high school education at STI Colleges.', 3, 5, '2023-05-29 02:31:48', '646a3e560330dHISTORY OF STI\'S SENIOR HIGH SCHOOL EXPO.png', 'approved'),
(51, 'Effectiveness of Soy Wax Lavender Scented Candles to Reduce Perceived Stress', 'Stress has been present in a student\'s life in a variety of ways. Students are exposed to such stressors through activities in school such as homework, seatwork, and extracurricular activities. This study aims to know if lavender soy wax scented candles, using aromatherapy, could relieve perceived stress among Grade 12 STI College Marikina students who have moderate to high perceived stress. \r\n\r\nThis study utilizes the PSS-10, a well-known psychological perceived stress scale that asks a couple of questions regarding a person’s feelings towards a certain situation that may have affected them for the past week. Scores of this scale are grouped into three categories, namely: low stress, moderate stress, and high stress. \r\n\r\nWith this, the study supports an alternative method of reducing stress and eventually enhancing a student\'s overall performance, even outside of school and its many activities.', 8, 5, '2023-06-01 19:34:04', '646a3f6952226348356520_648100987333127_9037975266635382044_n.jpg', 'approved'),
(52, 'Development of Gel-Type Picaridin-Based Insect Repellent', 'This study talks about the development of an insect repellent that uses picaridin as its active ingredient. This type of insect repellent uses air fresheners as its concept for spreading chemicals in the air. It functions by spreading the active ingredient in the air through evaporation. The researchers chose to use an active ingredient as the product’s insect repellent instead of a scent, as this gives the product more flexibility for future development and expansion in terms of the scent it also contains. \r\n\r\nThis study aims to develop a product that would serve as an alternative to mosquito coils and insect repellents that are applied to the skin. Mosquito coils have a chance of becoming a fire hazard, while insect repellents that are applied to the skin may not be as universal due to skin sensitivities.', 8, 5, '2023-06-01 19:34:05', '646a3f8d42013346151996_911242046847652_4650877818901767828_n.jpg', 'approved'),
(53, 'The Senior High School Expo is charging up and ready to power on!', ' After 2 years of changing the learning modalities to protect the health of the students, teaching personnel and the non-teaching personnel. STI College Marikina conducted their last Senior High School Expo last year virtually. But, what is the Senior High School Expo all about? The Senior High School Expo is a nationwide exhibition that provides a platform for STI students to showcase their talents. Senior high students representing their strands expressed their creations based on innovative ideas. \r\n\r\nWhat to expect in the upcoming Senior High School Expo in the year 2023? Students from the IT-MAWD strand has been working on different systems that can help operate the event with a QR System, give the students the latest updates with the Information System, two Tabulation Systems that can help with the votings and a Sales System that can assist other strands. Other strands like HUMSS has been preparing a film for the said event and the ABM and Culinary Arts strand with their café. \r\n\r\nGetting excited? Catch the latest updates with this website! ', 4, 5, '2023-05-29 02:35:40', '646a43169514a346151993_809371757199727_3972239031703697499_n.png', 'approved'),
(65, 'CS801P Was Here', 'Testing their system', 8, 46, '2023-06-02 07:40:28', '64799cb7f2a6b.jpeg', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(70) NOT NULL,
  `upass` varchar(70) NOT NULL,
  `urole` int(11) NOT NULL,
  `u_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `upass`, `urole`, `u_posts`) VALUES
(1, 'Rhandie', '$2y$10$V8GfkzvwryTg0qfFbsz0B..s/KowlETTHjKvBNLP11nRfhejVUVoK', 0, 5),
(5, 'Ernestine', '$2y$10$sPSzp8T7knhtCXT57tjjWuZhAaDdMcz0ra2Bor8vsB/sS/HtR8Fd.', 0, 10),
(6, 'Michelle', '$2y$10$xUFksW8ynpf85JfBW1xuNODBvLK8zKP9VXxXxh1SufdLcA5Wj4S02', 0, 0),
(8, 'Allyssa', '$2y$10$ITcHS/ZqDD94b08uRUPPseR4EADXgm4/hhDtL7H6q7Mvvi5niy2Y.', 0, 0),
(9, 'Aleiya', '$2y$10$h7mVW6lHj/E7DhP.5nehy.JptAMAHR5nMkivqLBiKt0qUEMcQ96Qi', 0, 0),
(13, 'Test', '$2y$10$4eArLmSLEdfOsWO5dyqVFOfnsgJ8l0CXjnSHKgPr1cmk5ATB/PEDe', 1, 0),
(14, 'Rhandie0', '$2y$10$srVdDCvzbbIgIBf3BzV.nuegd4vZ6ZM9wM4ElSy/rICJR9IBMOMT2', 0, 1),
(27, 'test', '$2y$10$CWsGUtALA7OCcRTssrTANu6skd/rM3vx23iu4mmjwy5Ih3y.j390m', 2, 0),
(30, 'gfhf', '$2y$10$Mmz5MIeoPJ2DYfaIgtE9/OYO4mynSCm3/QzAiCD9XroNRvgJViGJS', 2, 0),
(31, 'glhf', '$2y$10$eXJnylM5sTEYitepkB686O4/0tAfDOhlIATs9ZbJfQwzI.nPjkz9.', 2, 0),
(32, 'url', '$2y$10$ACwHMJA5mPmft3WYeLIBC.xayBlJKmIkqOJtU11h3J.2i.uD7IZlG', 2, 0),
(33, 'ha', '$2y$10$asEScwmXSHuGn/VQi8XEsOVvHL0yApkr85A6xbK6x7HNYL28Akpdu', 2, 0),
(34, 'da', '$2y$10$xrdAzcfjgZsgiEhr7s19JOzfduYb3E95lSMU2hMInD3NsszimnUhi', 2, 0),
(36, 'sma', '$2y$10$4GqgJeR4SV/7ZDwjI00/l.sC.Q8U8qTDz9UFVZU.zRg.hGcrMkP7W', 2, 0),
(37, 'home', '$2y$10$UmvaEfFxtSDgBh8WbIcwJudiqx98FA5l0s/M8FJ5QnNGNjB5lgoVS', 2, 0),
(38, 'ada', '$2y$10$j5BoJeb2.OxMoMhnx6t3CuU0Dh1JdipSNGo4Ecdqi4guFmF3/6Bh2', 2, 0),
(39, 'never', '$2y$10$zUYxXopSlriX9oee61hKiuT2pdoBjELhktEcKvVnkDTk86ttQ/3.O', 2, 0),
(40, 'NormalUser', '$2y$10$mFd2y4rkXqOaWoKlGmD6Ue4JDtH4YKiMP/pcVixCO.LjWEm4Rze3a', 2, 0),
(41, 'jimin', '$2y$10$cSQI78Ct1m4Mg0jIcF1/C.1dgeQnLOYzg90etvZ5qbZS58umaEGPe', 2, -1),
(42, 'kamote', '$2y$10$5zQtu5/EzRCApzq..8lWUeToA6dlZZC8t.Kz1/fy3kCu3jR.bEXv6', 2, 0),
(43, 'Astrid', '$2y$10$mCKqKwCoN0P7vHeClv4Qqu2oFtzltH4iBe4.O.OqUNcBRcNd90.O2', 2, -1),
(44, 'TEST', '$2y$10$beDlXPtatYZWe/F2mKX1TODj6j2oLYvMwGTBAbPCJjkhb9UuDrvme', 2, 0),
(45, 'joSeph_15', '$2y$10$ynn.WetQy4sml6XEt/L1POXyUKbH.3NF1b83MJ5wq3lBvJtyC6eB2', 2, 0),
(46, 'chrystarin', '$2y$10$hDyZGDlKXWbH2xwlFmB.rO2Yjt1QeNJz3pOp6gZweW0NRBVlAyptK', 2, 0),
(47, 'sartdustin', '$2y$10$/WQWSmoXcnvflEWUP9.04OLpH3ww0uk2vjKNisYVWfW2Mz3Ob/lgi', 2, 0),
(48, 'elias', '$2y$10$i3KXaWu2a5tY41hJ38xvb.uIySpqtAA9CYtfgBEGexuZiKDo.sHzO', 2, 0),
(49, 'Argie', '$2y$10$WR7TQdzBzO5AFIXFMTkc4.NruwGnjmK6DYtEr5HFNmS8HJIvwzjmO', 2, 0),
(50, 'luna', '$2y$10$L/cLvjBjcIJDaEA8PYIvSueOFO3x.QMY8G6912UIgtZSf/YpfO7Zm', 2, 0),
(51, 'alliah', '$2y$10$.mEocLnunx4vJkF/FCUNXemclVPo5diLPLsxr6Tjh9iY3dxu8RiJq', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
