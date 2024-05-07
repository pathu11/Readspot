-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 02:02 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `readspot02`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` enum('reject','restrict','approval','') NOT NULL DEFAULT 'approval',
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`, `profile_img`, `name`, `email`, `pass`, `status`, `restriction_date`) VALUES
(13, 130, '', 'admin', 'admin@gmail.com', '', '', NULL),
(15, 142, '', 'admin new', 'admin3@gmail.com', '', 'restrict', '2024-04-22 13:20:18');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `after_insert_admin` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_adminn` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_admin` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_adminn` AFTER UPDATE ON `admin` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `ISBN_no` varchar(50) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discounts` decimal(65,2) DEFAULT 0.00,
  `category` varchar(100) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `descript` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `publisher_id` int(11) DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `condition` varchar(100) NOT NULL,
  `published_year` int(11) NOT NULL,
  `price_type` varchar(100) NOT NULL,
  `booksIWant` varchar(255) DEFAULT NULL,
  `type` enum('new','used','exchanged') NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` enum('pending','approval','rejected') NOT NULL DEFAULT 'pending',
  `postal_name` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `district` varchar(40) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `NoOfPages` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `ISBN_no`, `author`, `price`, `discounts`, `category`, `weight`, `descript`, `quantity`, `publisher_id`, `img1`, `img2`, `img3`, `created_at`, `condition`, `published_year`, `price_type`, `booksIWant`, `type`, `customer_id`, `status`, `postal_name`, `street_name`, `town`, `district`, `postal_code`, `account_name`, `account_no`, `branch_name`, `bank_name`, `NoOfPages`) VALUES
(114, 'The Mother', '9786245946099', 'Maxim Gorki', '2000.00', '20.00', 'Thriller', '200', 'Mother, the immortal classic of Maxim Gorky, one of the world&#39;s best-loved writers, is the story of the radicalization of an uneducated woman. From her dull peasant existence into active participation in her people&#39;s struggle for justice.', 10, 28, 'The Mother-img1.jpg', 'The Mother-img2.jpg', '', '2024-01-28 09:57:13', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumi', 'godellaweela', 'tangalle', 'Matara', '82200', 'M.K.P.Ahinsa', '62000897', 'tangalle', 'peoples bank', NULL),
(115, 'Charitha Thunak (චරිත තුනක්)', '9789555540594', 'K.Jayathilake (කේ ජයතිලක)', '700.00', '0.00', 'History', '150', 'මගේ වැටහීම අනුව , කළු අච්චිගමගේ ජයතිලක , ඔහුගේ පාඨකයන් වඩාත් හොඳින් දන්නා පරිදි කේ. ජයතිලක , අද ඉහළම තලයෙහි සිටින නිර්මාණාත්මක ලේඛකයන් හා බුද්ධිමතුන් අතරෙහි ලා ගිණිය හැකි වේ. ප්‍රමුඛත්වය අතින් ඔහු දෙවෙනි වතොත් වන්නේ මාර්ටින් වික්‍රමසිංහට පමණකි.\r\n\r\nජයතිලකගේ නවකතා අතුරෙන් සියලු පාඨකයන්ගේ හදවත සසල කළා වූත් , ඔහුගේ ශ්‍රේෂ්ඨතම කෘතිය හැටියට විශ්ව සම්භාවිතාව වූත් නිර්මාණය චරිත තුනක්ය. 1963 දී මුලින්ම පළ කරන ලද එහි ජනප්‍රියත්වය කොතරම් විශාල වුවත් එහි තේමාව හෝ අන්තර්ගතය පිලිබඳ තීක්ෂණ අර්ථකතනයක් මෙතෙක් ප්‍රකාශයට පත් වී නොමැත. එය කියවන කියවන වාරයක් පාසා මුලින් ඇස ගැසුණාට වැඩි යමක් දක්නට ලැබෙයි.\r\n\r\n \r\n\r\nමහාචාර්ය එදිරිවීර සරච්චන්ද්‍ර\r\n(පුංචිරාළ  ඉංග්‍රීසි පරිවර්තනයට ලියූ ප්‍රස්තාවනාවෙනි)', 10, 28, 'Charitha Thunak (චරිත තුනක්)-img1.jpeg', 'Charitha Thunak (චරිත තුනක්)-img2.jpeg', '', '2024-01-28 09:59:42', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumee', 'godellaweela', 'tangalle', '', '82200', 'K.Swarna', '62000897', 'tangalle', 'BOC Bank', NULL),
(116, 'Forget Me Not(මල් කිණිත්තක පුරාත්තය)', '9786249468702', 'Charitha Prawardhi Bandara, Chathuri Damayanthi', '1200.00', '10.00', 'History', '169.97', 'බිඳුණු මිනිස්සුන්ට ආදරය කරන එක කොහෙත්ම ලේසි නෑ යුමී සං. කැබලි වෙච්ච ඔවුන්ව තදින් වැළඳගත යුතු වෙනවා. මෘදු නමුත් ස්ථිර ප්‍රේමයකින්. එත් ඒ තියුණු දාර සහිත බිඳුණු කැබලි, වැළඳගන්නා ආදරණීයයාව රිදවනවා. ඔහුවත් කපා දමනවා. මට හොඳටම විශ්වාසයි, “ආදරය කියන්නේ කැප කිරීමක් වග කියන්නට ඇත්තේ, මේ ලෝකයේ මුල් වතාවට බිඳුණු ගැහැණියකට ආදරය කරපු කරුණාවන්ත ඇහිපිය ඇති පිරිමියෙක්. කැබැලි වුණු පිරිමියෙකුට ප්‍රේම කළ විශාල හදවතක් ඇති ගැහැණියක්.', 7, 28, 'Forget Me Not(මල් කිණිත්තක පුරාත්තය)-img1.jpeg', 'Forget Me Not(මල් කිණිත්තක පුරාත්තය)-img2.jpeg', '', '2024-01-28 10:02:24', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumiiii', 'godellaweela', 'tangalle', 'Matale', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(117, 'Senkottan (සෙංකොට්ටං)', '9555540594', 'Mahinda Prasad Masibula(මහින්ද ප්‍රසාද් මස්ඉඹුල)', '949.76', '0.00', 'History', '230', 'Senkottan is a novel that reveals the old sri lankan society and how it treated towards the low castes,and how their lives went through with pain and mistreat. 📚a remarkable story. (සෙංකොට්‌ටං නවකතාව සිය විෂය භූමිය කර ගන්නේ සබරගමු පළාතේ, රත්නපුර දිස්‌ත්‍රික්‌කයේ, රිදීවිට නම් වූ ගම හා ඒ අවට පෙදෙසේ මීට දශක අටකට පමණ පෙර විසූ , සමාජයේ කුල ධුරාවලියේ අවම තැනක ස්‌ථානගත කරනු ලැබූ අව වරප්‍රසාදිත එකී මිනිසුන් මුහුණ දුන් පීඩනයයි. රිදීවිට ගමේ වීරප්පුලි හේනයා, ඔහුගේ බිරිඳ මල්මා රිදී, වැඩි වියපත් දූවරුන් වූ පොඩිනා සහ හීං රිදී, පොඩිනාගේ සැමියා වූ නම්බු හේනයා, පොඩිනා ඔහු සමග විවාහ වීමට පෙර අනගිහාමි නම් වූ කුලවතාට දාව ඈ වැදූ බබා හේනයා නම් ලත් අට හැවිරිදි දරුවා සෙංකොට්‌ටං හි ප්‍රධාන චරිත වෙති.)', 19, 28, 'Senkottan (සෙංකොට්ටං)-img1.jpg', 'Senkottan (සෙංකොට්ටං)-img2.jpg', '', '2024-01-28 10:04:50', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumi', 'godellaweela', 'tangalle', 'Matara', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(118, 'Harrypotter and the goblet fire', '9786555322521', 'J.K.Rowling', '3400.00', '0.00', 'Fantacy', '550', 'Goblet of Fire is almost twice the size of the first three books (the paperback edition was 636 pages). Rowling stated that she &#34;knew from the beginning it would be the biggest of the first four.', 4, 28, 'Harrypotter and the goblet fire-img1.jpeg', 'Harrypotter and the goblet fire-img2.jpeg', '', '2024-01-28 10:06:58', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumee', 'godellaweela', 'tangalle', '', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(119, 'Kali Yugaya (කලි යුගය)', '9789550201389', 'Martin Wickramasinghe - මාර්ටින් වික්‍රමසිංහ', '900.00', '5.00', 'History', '220', 'අනුලා දරුවන් බලා සොයා ගැනීම නිසා නන්දා වැඩි නිදහසක් විශ‍්‍රාමයක් හා සැනසුමක් ලැබුවාය. ඈ වඩ වඩාත් ඉහළ සමාජයේ ගැහැනුන් හා පිරිමින් ඇසුරු කරමින් සන්තෝෂ වීම එහි එක් ප‍්‍රතිඵලයක් විය. ඔවුන් හා කතාබහෙන් ඔවුන්ගේ උත්සවවලට යෑමෙන් නන්දා ලබන ආස්වාදය කිසිවකු මත්පැන් බීමෙන් ලබන ආස්වාදයට අසාමාන නොවීය.\r\n\r\n\r\n\r\n‘‘අගහිඟ නිසා අයිරින් හා මා දුක් විඳි පීඩාත් අයිරින් දුකින් මිය යෑම සිහිවන කල හරමානිස් බාස් මට මතක් වෙයි. මවුපියන් කරන නරක ක‍්‍රියාවල විපාක දරුවන් විඳිතියි කියනු මා නොයෙක් වර අසා තිබේ. ඒ කියුම් මා විශ්වාස නොකරන නමුත් මට මගේ සිතින් බැහැර කළ නොහැකිය.&#39;&#39;\r\n\r\n&#39;&#39;ධනවත් ගෑනුන් හා පිරිමින් සතියකට දෙතුන් වරක් ගෙදරට කැඳවාගෙන ඔබත්” තාත්තාත් ඔවුන් හා කතාබහ කරමින් සිනාසෙමින් කැවිලි කමින් තේ බොමින් සමහර විට පිටතින් පැමිණියන්ට මත්පැනින් සංග‍්‍රහ කරමින් සන්තෝෂ වූහ. ඇතැම් දවසක තාත්තාත් ඔවුන්ගේ යාළුවොත් මත්පැන් බොමින් ? බෝවනතෙක් සන්තෝෂ වූහ. ඇතැම් දවසක ඔබ වේලපහින් කන්නට දී අප නින්දට යැව්වාය. වරක් නින්දෙන් අවදි වූ චන්‍ද්‍රසෝම නත්තලට ලැබුණු රතික්‍ඳ්ක්‍ඳා පෙට්ටියක් ගෙන ගොස් ඔබත් තාත්තාත් අනෙක් ගැහැනුන් හා පිරිමින් කතාබහ කරමින් සිටි සාලයට පිවිසෙන එක් දොරටුවක් ළඟ තබා ගිනි තබන්නට සිතුවේය. මම චන්‍ද්‍රසෝමව එයින් වැළැක්වූයෙමි..&#39;&#39;', 6, 28, 'Kali Yugaya (කලි යුගය)-img1.jpg', 'Kali Yugaya (කලි යුගය)-img2.jpg', '', '2024-01-28 10:08:44', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumi', 'godellaweela', 'tangalle', 'Matara', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(120, 'MadolDoowa', '9789550201396', 'Martin Wickramasinghe - මාර්ටින් වික්‍රමසිංහ', '475.00', '10.00', 'Adventure', '220', 'අඩ සියවසකට අධික කාලයක් මේ රටේ පාඨක ජනතාවගේ ආදරය දිනාගත් මඩොල්දූව නවකථාවේ මෙම මුද්‍රණය අලුත් සැකැස්මකින් හා නව සිත්තම්වලින් සැරසී තිබේ.ශ්‍රී ලංකාවේ පමණක් පිටපත් දශලක්ෂයකට වැඩියෙන් අලෙවි වී ඇති මඩොල් දූව,මෙරට සිංහල හා දෙමළ දරුවන් වැඩිපුරම කියවන පොත ලෙස සැළකේ.රුසියන්,රුමේනියන්,චීන,බල්ගේරියන්,ඉංග්‍රීසි,ලන්දේසි,ජපන් ආදී භාෂා ගණනකට පරිවර්තනය වී ඇති මඩොල් දූව,එම රටවල ද බෙහෙවින් ජනප්‍රිය නවකථාවකි.', 5, 28, 'MadolDoowa-img1.jpg', 'MadolDoowa-img2.jpg', '', '2024-01-28 10:10:41', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumee', 'godellaweela', 'tangalle', '', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(122, 'Hathpana', '4325346346', 'Kumarathunga Munidasa', '600.00', '5.00', 'Fiction', '340', 'This is the English translation of &#39;Hath pana&#39; which is a wonderful story about Neraluwe village leader Kusal Hami&#39;s stupid son &#39;Kiri Hami&#39;. &#39;Hath pana&#39; is a masterpiece that delighted the childhood world of the creator Kumaratunga Munidasa who was awarded the title of &#39;Helaye Maha Isi&#39;', 0, NULL, 'Hathpana-1706437184-imgFront.jpeg', 'Hathpana-1706437184-imgBack.jpeg', 'Hathpana-1706437184-imgInside.jpeg', '2024-01-28 10:19:44', 'technology', 2002, 'Negotiable', NULL, 'used', 21, 'approval', '', '', 'Panadura', 'technology', '789944', 'R.M.S.Perera', '789564756567', 'Panadura', 'Peoples Bank', NULL),
(123, 'Wajra kasthuri  (වජ්‍ර කස්තුරි)', '9786245584260', 'ඉමේෂා මාධවී මල්ලවආරච්චි - Imesha Madhavi Mallawaarachchi', '1440.00', '0.00', 'Romance', '200', 'සතියක් පුරාවට සහභාගී වූ දේශන සියල්ලෙහිම මේඝ සිටියේ රාජකාරි මුහුණක් ඕනෑවටත් වඩා මවාගෙනයි. සිය ආචාර්යවරයාට රහසින් ප්‍රේම කරන යුවතියට අවසානයේ සිදුවුණේ ඒ මුහුණ දෙස බලා රහසින් සුසුම් හෙළන්න විතරයි. දේශනය අවසන් වන සැණින් සිය පරිගණකය අකුළාගෙන බෑගයට දාගන්න මේඝ එතනින් ඉවත්ව යන්නේ ශාලාවේ ළමයින්ගේ කෑගැහිල්ල මැදින්මයි.\r\nඉතින් විහේලිගේ කඳුළු පිරෙන දෑස් ඒ කාටවත් නොපෙනීම එක්තරා විදියක වාසනාවකි. ආපනශාලාවට හෝ පුස්තකාලයට යන බොහෝ දිනවල මේඝ සමග වාඩිවී ආහාර ගන්න, කතා කරන නිවේතාගේ දසුන විහේලි උපරිමයෙන් රිදවා තිබුණා....', 0, 28, 'Wajra kasthuri  (වජ්‍ර කස්තුරි)28-img1.jpg', 'Wajra kasthuri  (වජ්‍ර කස්තුරි)28-img2.jpg', '', '2024-04-03 06:27:16', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumi', 'godellaweela', 'tangalle', 'Matara', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(129, 'Six of Crows', '1627792120', 'Leigh Bardugo', NULL, NULL, 'Fantacy', '500', 'Ketterdam: a bustling hub of international trade where anything can be had for the right price―and no one knows that better than criminal prodigy Kaz Brekker. Kaz is offered a chance at a deadly heist that could make him rich beyond his wildest dreams. But he can&#39;t pull it off alone. . . .', 1, NULL, 'Six of Crows-1713520497-imgFront.jpeg', '', '', '2024-04-19 09:55:40', 'Used', 2015, '', 'Crooked Kingdom: A Sequel to Six of Crows (Six of Crows, 2)\r\nShadow and Bone (The Shadow and Bone Trilogy, 1)', 'exchanged', 24, 'rejected', NULL, NULL, 'Horana', 'Kalutara', '12410', NULL, NULL, NULL, NULL, NULL),
(134, 'Control System For BE/BTECH Courses 5th Edition', '978-9389185485', 'Nagoor Kani', '2300.00', '0.00', 'Science-Fiction', '120', 'good', 1, NULL, 'Control System For BE/BTECH Courses 5th Edition-1713747497-imgFront.jpg', 'Control System For BE/BTECH Courses 5th Edition-1713747497-imgBack.jpeg', 'Control System For BE/BTECH Courses 5th Edition-1713747497-imgInside.jpg', '2024-04-22 00:58:17', 'Used', 2000, 'Negotiable', NULL, 'used', 21, 'pending', NULL, NULL, 'Tanglle', 'Ampara', '78997', 'shayamali', '78956775', 'Tangalle', 'BOC', NULL),
(135, 'Romeo and Juliet', '0671722859', 'Shakespeare, William', '1600.00', '0.00', 'Romance', '200', 'In Romeo and Juliet, Shakespeare creates a violent world, in which two young people fall in love. It is not simply that their families disapprove; the Montagues and the Capulets are engaged in a blood feud.  In this death-filled setting, the movement from love at first sight to the lovers’ final union in death seems almost inevitable. And yet, this play set in an extraordinary world has become the quintessential story of young love. In part because of its exquisite language, it is easy to respond as if it were about all young love.', 5, 28, 'Romeo and Juliet28-img1.jpg', 'Romeo and Juliet28-img2.jpg', NULL, '2024-04-23 07:32:13', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumi', 'godellaweela', 'tangalle', 'Matara', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(136, 'Twisted Lies', '9780349434285', 'Ana Huang', '1000.00', '3.00', 'Romance', '200', 'Discover the addictive world of the Twisted series from Sunday Times bestselling author and TikTok sensation, Ana Huang! Read Twisted Lies now for a steamy fake dating romance.  He’ll do anything to have her . . . including lie.  Charming, deadly and smart enough to hide it, Christian Harper is a monster dressed in the perfectly tailored suits of a gentleman.  He has little use for morals and even less use for love, but he can’t deny the strange pull he feels toward the woman living just one floor below him.  She’s the object of his darkest desires, the only puzzle he can’t solve. And when the opportunity to get closer to her arises, he breaks his own rules to offer her a deal she can’t refuse.  Every monster has their weakness. She’s his.  His obsession. His addiction. His only exception.', 4, 28, 'Twisted Lies28-img1.jpg', 'Twisted Lies28-img2.jpg', NULL, '2024-04-23 07:39:51', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumee', 'godellaweela', 'tangalle', '', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(137, 'King of Pride', '9780349436340', 'Ana Huang', '2990.00', '5.00', 'Romance', '150', 'Meet the Kings of Sin . . . The must-read billionaire romance from the bestselling author of the Twisted series. Read King of Pride now for a steamy opposites attract romance.  She’s his opposite in every way . . . and the greatest temptation he’s ever known.  Reserved, controlled, and proper to a fault, Kai Young has neither the time nor inclination for chaos – and Isabella, with her purple hair and inappropriate jokes, is chaos personified.  With a crucial CEO vote looming and a media empire at stake, the billionaire heir can’t afford the distraction she brings.  Isabella is everything he shouldn’t want, but with every look and every touch, he’s tempted to break all his rules . . . and claim her as his own.', 3, 28, 'King of Pride28-img1.jpg', 'King of Pride28-img2.jpg', NULL, '2024-04-23 07:42:54', '', 0, '', NULL, 'new', NULL, 'approval', 'pathumiiii', 'godellaweela', 'tangalle', 'Matale', '82200', 'pathumi', '62000897', 'tangalle', 'peoples', NULL),
(141, 'Kalawakashaye Sirakaruwa (කාලාවකාශයේ සිරකරුවා)', 'ISBN : 978-955-656-365-8', 'දමිත් නිපුණජිත්', '1200.00', '10.00', 'Science-Fiction', '250', 'කාලාවකාශයේ සිරකරුවා - හිස මදක් ඔසවා බැලූ විට ඔහුට පෙනී ගියේ ලී ගැබලිති ගල් කෑලි වර්ෂාවක් ඔහු වටා වසිමින් තිබෙන බවයි. එහෙත් ඒ වැටෙනා දේ වලට සිදුවන දෙය ඔහුව පුදුමයට පත් කළේය. වැටෙනා සියලු දෙය ඔහු වැතිර හුන් පොළොව මතට වැටුණු සැණින් මීදුමෙන් කළ මතුපිටක් මතට වැටුණාත් මෙන් ඒ තුළ සම්පූර්ණයෙන්ම ගිලී නොපෙනී ගියේය. සංචාරක නියෝජිතයෝ - කෙසේ වෙතත් මා ඔහුව දුටු බව හඳුනාගත් සැණින් තඩි හිනාවකින් කට පුරවාගත් මේ චීනා, හීනයේ සිටියදී පවා මා පුදුමයට පත් කරන්නට හේ තු වූ පරිදි හොඳ සිංහලෙන් කතා කළේය.  &#34;කරුණාකරලා ඔය කණ්ණාඩියෙන් ඉස්සරහ ඉන්න වෙලාවක මාව මතක් කරනවද?&#34;  ගෞරවය - අද මම ඔබව රැගෙන යන්නේ ඒ මාවත් දෙක අතරින්ම විහිදුනු අපූරු මානයක් ඔස්සේයි. ඒ ගමන ඇරඹෙන්නේ බොහෝ දෙනකුට අසන්නට අමතක වූ, බොහෝ දෙනකුගේ සිතට කිසිදාක නොනැඟුණු ප්‍රශ්නයක් ඔස්සේයි.  &#34;පිටසක්වළ ජීවීන් යනු, අන් කවරකුවත් නොව කාලයාත්‍රිකයන්ම නම්?&#34;  ශ්‍රී ජයවර්ධනපුර විශ්ව විද්‍යාලයෙන් විද්‍යාවේදී උපාධිය ලබාගැනීමෙන් පසුව විද්‍යා සන්නිවේදකයෙකු ලෙස විදුසර පුවත්පතට සම්බන්ධ වූ දමිත 2010 වසරේ ශ්‍රී ලංකා විද්‍යාභිවර්ධන සංගමය විසින් පිිරිනමනු ලබන දිවයිනේ හොඳම විද්‍යා සන්නිවේදකයාට හිමි සම්මානය ගැනීමට සමත් විය. පරිපාලන සේවා විභාගය සමත් වී ශ්‍රී ලංකා පරිපාලන සේවයට තේරී පත්ව කලක් සහකාර ලේකම්වරයකු ලෙස කටයුතු කළ දමිත පසුව ඉන් ඉවත්ව යෝගාවචරයෙකු ලෙස අධ්‍යාත්මික ගවේෂණයක නිරත විය. ඉන් අනතුරුව නැවතත් විදුසරට සම්බන්ධ වී කරන ලද විද්‍යා සන්නිවේදන කටයුතු වෙනුවෙන් ඔහුට 2015 වසරේදී ශ්‍රී ලංකා වෛද්‍ය සංගමය විසින් පිරිනමන වසරේ හොඳම සෞඛ්‍ය විද්‍යා සන්නිවේදකයාට හිමි සම්මානය හිමි විිය. &#39;විස්මිත සිහ දකින්නා &#39; නමින් පළවු ඔහුගේ කුළුඳුල් විද්‍යා ප්‍රබන්ධ කෘතිය 2008 වසරේ හොඳම ස්වතන්ත්‍ර විද්‍යා ප්‍රබන්ධ කෘතිය සඳහා වූ රාජය සම්මානය හිමි කරගන්නා ලදි. ලේඛකත්ව හා ජනසන්නිවේදනය පිලිබඳ රාජ්‍ය පරිපාලනය පිළිබඳ ඩිප්ලෝමාධාරියෙකු වන දමිත දැනට බෞද්ධ අ්‍යයනය පිළිබඳ තම ශාස්ත්‍රපති උපාධිය හදාරමින් සිටියි.', 10, 28, 'Kalawakashaye Sirakaruwa (කාලාවකාශයේ සිරකරුවා)28-img1.jpg', 'Kalawakashaye Sirakaruwa (කාලාවකාශයේ සිරකරුවා)28-img2.jpg', NULL, '2024-04-27 11:25:31', '', 0, '', NULL, 'new', NULL, 'approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 'Madoldoowa', '978-3-16-148410-0', 'Martin Wickramasignhe', '500.00', '0.00', 'Science-Fiction', '123', 'validateISBN()', NULL, NULL, 'Madoldoowa-1714297172-imgFront.png', 'Madoldoowa-1714297172-imgBack.png', 'Madoldoowa-1714297172-imgInside.png', '2024-04-28 09:39:34', 'Used', 2001, 'Fixed', NULL, 'used', 21, 'pending', NULL, NULL, 'reciever', 'Ampara', '12345', '899', '789', 'reciever', 'reciever', NULL),
(149, 'Madoldoowa', '978-3-16-1484100', 'Martin Wickramasignhe', NULL, '0.00', 'Science-Fiction', '250', '978-3-16-148410-0\r\n978-3-16-148410-0\r\n978-3-16-148410-0\r\n978-3-16-148410-0\r\n978-3-16-148410-0\r\n978-3-16-148410-0\r\n978-3-16-148410-0', NULL, NULL, 'Madoldoowa-1714301738-imgFront.jpg', 'Madoldoowa-1714301738-imgBack.jpg', 'Madoldoowa-1714301738-imgInside.png', '2024-04-28 10:07:16', 'Used', 1502, '', 'Hathpana', 'exchanged', 21, 'pending', NULL, NULL, 'reciever', 'Ampara', '78921', NULL, NULL, NULL, NULL, NULL),
(150, 'Adventures of Sindbad the Sailor', '978-81-7758-221-5', 'D K Swan', '385.00', '0.00', 'Adventure', '25', '&#34;Sindbad the Sailor&#34; is a collection of Middle Eastern folk tales from the Islamic Golden Age. The stories follow the adventures of Sindbad, a sailor who travels to distant lands and encounters magical creatures, natural disasters, and various challenges. Each story typically ends with Sindbad overcoming adversity through wit, courage, or luck. The tales are known for their vivid descriptions of exotic locations and fantastical events, making them popular in both Eastern and Western literature.', NULL, NULL, 'Adventures of Sindbad the Sailor-1714324153-imgFront.jpeg', 'Adventures of Sindbad the Sailor-1714324153-imgBack.jpeg', 'Adventures of Sindbad the Sailor-1714324153-imgInside.jpeg', '2024-04-28 17:09:12', 'Used', 2013, 'Fixed', NULL, 'used', 40, 'pending', NULL, NULL, 'Piliyandala', 'Colombo', '10300', 'Geeradha', '12345678', 'Piliyandala', 'BOC', NULL),
(151, 'The Secret Garden', '978-81-317-1058-6', 'Frances Hodgson Burnett', '640.00', '0.00', 'Mystery', '25', '&#34;The Secret Garden&#34; is a classic children&#39;s novel by Frances Hodgson Burnett. It tells the story of Mary Lennox, a young girl who is sent to live with her uncle in Yorkshire, England, after being orphaned by a cholera outbreak in India. Lonely and spoiled, Mary discovers a hidden, neglected garden on her uncle&#39;s estate, which she decides to restore with the help of her new friend, Dickon, and her sickly cousin, Colin. As the garden blooms, so do the children, as they find healing, friendship, and a renewed sense of hope and joy. The novel explores themes of the healing power of nature, the magic of childhood, and the transformative power of friendship and love.', NULL, NULL, 'The Secret Garden-1714324634-imgFront.jpeg', 'The Secret Garden-1714324634-imgBack.jpeg', 'The Secret Garden-1714324634-imgInside.jpeg', '2024-04-28 17:17:13', 'Used', 2013, 'Fixed', NULL, 'used', 40, 'approval', NULL, NULL, 'Piliyandala', 'Colombo', '10300', 'Geeradha', '12345678', 'Piliyandala', 'BOC', NULL),
(152, 'Alice in Wonderland', '978-81-7758-659-6', 'Lewis Carroll', '435.00', '0.00', 'Fantacy', '25', '&#34;Alice&#39;s Adventures in Wonderland&#34; is a whimsical and imaginative tale written by Lewis Carroll. It follows the adventures of a young girl named Alice who falls down a rabbit hole into a fantastical world populated by peculiar and anthropomorphic creatures. In this strange world, she encounters the White Rabbit, the Mad Hatter, the Cheshire Cat, and the Queen of Hearts, among others. As Alice navigates this surreal landscape, she encounters bizarre situations and nonsensical logic, all while trying to make sense of her surroundings and find her way home. The story is celebrated for its imaginative storytelling, wordplay, and memorable characters, making it a beloved classic of children&#39;s literature.', NULL, NULL, 'Alice in Wonderland-1714324891-imgFront.jpeg', 'Alice in Wonderland-1714324891-imgBack.jpeg', 'Alice in Wonderland-1714324891-imgInside.jpeg', '2024-04-28 17:21:29', 'Used', 2009, 'Fixed', NULL, 'used', 40, 'approval', NULL, NULL, 'Piliyandala', 'Colombo', '10300', 'Geeradha', '12345678', 'Piliyandala', 'BOC', NULL),
(157, 'Oliver Twist', '978-81-7758-667-1', 'Charles Dickens', NULL, '0.00', 'Adventure', '25', '&#34;Oliver Twist&#34; is a novel by Charles Dickens, first published in 1837. It tells the story of a young orphan boy named Oliver Twist who endures a harsh life in a workhouse before running away to London. There, he falls in with a group of young pickpockets led by the elderly Fagin. Oliver&#39;s innocence and kind nature contrast with the criminal activities of Fagin&#39;s gang, leading to a series of adventures and misadventures as Oliver navigates the dangers of the city&#39;s underworld. Along the way, he encounters a variety of colorful characters, both good and bad, and ultimately discovers his true identity and finds a place where he belongs. The novel is known for its vivid portrayal of Victorian London, its exploration of social issues such as poverty and injustice, and its memorable characters, including the villainous Bill Sikes and the kind-hearted Nancy.', NULL, NULL, 'Oliver Twist-1714327352-imgFront.jpeg', 'Oliver Twist-1714327352-imgBack.jpeg', 'Oliver Twist-1714327352-imgInside.jpeg', '2024-04-28 17:54:29', 'Used', 1837, '', 'Peter and The Wolf', 'exchanged', 40, 'pending', NULL, NULL, 'Piliyandala', 'Colombo', '10300', NULL, NULL, NULL, NULL, NULL),
(158, 'The Prince and The Pauper', '978-955-665-252-9', 'Mark Twain', NULL, '0.00', 'Adventure', '50', '&#34;The Prince and the Pauper&#34; is a novel by Mark Twain, first published in 1881. It tells the story of two boys who are identical in appearance but come from very different backgrounds. Tom Canty is a poor beggar boy living in London, while Prince Edward, known as Prince of Wales, is the heir to the throne of England. By a twist of fate, the two boys meet and decide to exchange places for a short time. The prince experiences the harsh realities of life in poverty, while Tom enjoys the luxuries of life in the palace. As they struggle to adapt to their new lives, they uncover a plot to overthrow the king and must work together to save the kingdom. The novel explores themes of identity, social class, and the nature of power, and is known for its engaging plot and colorful depiction of Tudor England.', NULL, NULL, 'The Prince and The Pauper-1714327258-imgFront.jpeg', 'The Prince and The Pauper-1714327258-imgBack.jpeg', 'The Prince and The Pauper-1714327258-imgInside.jpeg', '2024-04-28 18:00:57', 'Used', 1881, '', 'The Magic Porridge Pot', 'exchanged', 40, 'pending', NULL, NULL, 'Piliyandala', 'Colombo', '10300', NULL, NULL, NULL, NULL, NULL),
(159, 'Pollyana', '978-955-652-250-2', 'Elenor H Porter', NULL, '0.00', 'Fantacy', '50', '&#34;Pollyanna&#34; is a novel by Eleanor H. Porter, first published in 1913. It tells the story of a young orphan girl named Pollyanna who goes to live with her wealthy but stern Aunt Polly in a small New England town. Despite facing many challenges and hardships, Pollyanna maintains an optimistic outlook on life, inspired by the &#34;Glad Game&#34; taught to her by her father. The game involves finding something to be glad about in every situation, no matter how difficult. Pollyanna&#39;s cheerful and positive attitude has a profound effect on the people around her, transforming the lives of her aunt, the townspeople, and even the cynical Dr. Chilton. The novel explores themes of optimism, gratitude, and the power of positive thinking, and has become a classic of children&#39;s literature.', NULL, NULL, 'Pollyana-1714327602-imgFront.jpeg', 'Pollyana-1714327602-imgBack.jpeg', 'Pollyana-1714327602-imgInside.jpeg', '2024-04-28 18:06:41', 'Used', 1913, '', 'The Three Billy Goats Gruff', 'exchanged', 40, 'pending', NULL, NULL, 'Piliyandala', 'Colombo', '10300', NULL, NULL, NULL, NULL, NULL),
(160, 'Diya Manthi Kollaya', '978-955-655-301-7', 'Krishantha Thilakarathna', '120.00', '0.00', 'Adventure', '50', '&#34;Diyamanthi Kollaya&#34; follows the thrilling journey of protagonist Maya as she sets out to recover the legendary Diyamanthi Diamond, stolen from her family&#39;s possession by a cunning thief. Fueled by a desire to reclaim her heritage and restore honor to her family name, Maya embarks on a perilous adventure across exotic locales and encounters a cast of colorful characters, each with their own motives and secrets. As Maya delves deeper into the mystery of the diamond&#39;s theft, she uncovers hidden truths about her family&#39;s past and must confront her own fears and doubts. With twists and turns at every corner, &#34;Diyamanthi Kollaya&#34; is a gripping tale of courage, redemption, and the power of determination in the face of adversity.', NULL, NULL, 'Diya Manthi Kollaya-1714328113-imgFront.jpg', 'Diya Manthi Kollaya-1714328113-imgBack.jpg', 'Diya Manthi Kollaya-1714328113-imgInside.jpg', '2024-04-28 18:15:12', 'Used', 2007, 'Fixed', NULL, 'used', 41, 'approval', NULL, NULL, 'Kesbewa', 'Colombo', '10300', 'Sahansa Vihangi', '87654321', 'Kesbewa', 'Peoples&#39; Bank', NULL),
(162, 'Siw Rahas Salakuna', '955-95930-6-4', 'Chandana Mendis', '780.00', '0.00', 'Mystery', '150', '&#34;The Sign of Four&#34; is a classic detective novel by Sir Arthur Conan Doyle, featuring the brilliant Sherlock Holmes and his loyal companion Dr. John Watson. In this gripping tale, Holmes and Watson are hired by Miss Mary Morstan to investigate the mysterious disappearance of her father and the perplexing arrival of anonymous pearls and a cryptic note. As they delve into the case, they uncover a complex web of intrigue involving stolen treasure, betrayal, and revenge. Set against the backdrop of Victorian London, &#34;The Sign of Four&#34; is a riveting narrative that showcases Holmes&#39;s deductive genius and Watson&#39;s unwavering loyalty, making it a timeless masterpiece of the mystery genre.', 1, NULL, 'Siw Rahas Salakuna-1714328987-imgFront.jpg', 'Siw Rahas Salakuna-1714328987-imgBack.jpg', 'Siw Rahas Salakuna-1714328987-imgInside.jpg', '2024-04-28 18:29:46', 'Used', 2003, 'Fixed', NULL, 'used', 41, 'approval', NULL, NULL, 'Kesbewa', 'Colombo', '10300', 'Sahansa Vihangi', '87654321', 'Kesbewa', 'Peoples&#39; Bank', NULL),
(163, 'I wonder why Triceratops had Horns', '0-7534-0760-4', 'Rod Theodorou', '500.00', '0.00', 'Science-Fiction', '30', '&#34;I Wonder Why Triceratops Had Horns&#34; is an engaging children&#39;s book that takes young readers on an exciting journey through the prehistoric world of dinosaurs. Through vivid illustrations and easy-to-understand language, the book explores the fascinating features of the Triceratops, focusing on its distinctive horns. Readers will learn about the possible purposes of these horns, from defense against predators to courtship displays and even regulating body temperature. With fun facts and interactive elements, &#34;I Wonder Why Triceratops Had Horns&#34; sparks curiosity and imagination, making it an entertaining and educational read for dinosaur enthusiasts of all ages.', 1, NULL, 'I wonder why Triceratops had Horns-1714329268-imgFront.jpg', 'I wonder why Triceratops had Horns-1714329268-imgBack.jpg', 'I wonder why Triceratops had Horns-1714329268-imgInside.jpg', '2024-04-28 18:34:26', 'Used', 2002, 'Fixed', NULL, 'used', 41, 'approval', NULL, NULL, 'Kesbewa', 'Colombo', '10300', 'Sahansa Vihangi', '87654321', 'Kesbewa', 'Peoples&#39; Bank', NULL),
(164, 'Tashi and the Baba Yaga', '978-81-309-1327-8', 'Anna Fienberg', NULL, '0.00', 'Adventure', '30', '&#34;Tashi and Baba Yaga&#34; is a thrilling children&#39;s book where young hero Tashi confronts the legendary witch Baba Yaga to save his village. With courage and wit, Tashi navigates through magical challenges, showcasing the power of bravery and friendship in an enchanting Slavic-inspired world.', NULL, NULL, 'Tashi and the Baba Yaga-1714329536-imgFront.jpg', 'Tashi and the Baba Yaga-1714329536-imgBack.jpg', 'Tashi and the Baba Yaga-1714329536-imgInside.jpg', '2024-04-28 18:38:55', 'Used', 1998, '', 'Wuthering Heights', 'exchanged', 41, 'approval', NULL, NULL, 'Kesbewa', 'Colombo', '10300', NULL, NULL, NULL, NULL, NULL),
(165, 'Bheeshanayak', '978-955-1262-13-6', 'Chandana Mendis', NULL, '0.00', 'Thriller', '150', '&#34;Bheeshanayak&#34; is a chilling mystery novel set in the quaint English town of Surrey. When a series of strange occurrences plague the local community, suspicions fall upon the enigmatic host of a grand estate. As secrets unravel and tensions rise, a group of curious townsfolk band together to uncover the truth behind the mysterious host and the sinister events unfolding in their midst. Filled with suspense, intrigue, and unexpected twists, &#34;Bheeshanayak&#34; keeps readers on the edge of their seats until the very end.', NULL, NULL, 'Bheeshanayak-1714329811-imgFront.jpg', 'Bheeshanayak-1714329811-imgBack.jpg', 'Bheeshanayak-1714329811-imgInside.jpg', '2024-04-28 18:43:30', 'Used', 2010, '', 'Vendor of sweets', 'exchanged', 41, 'pending', NULL, NULL, 'Kesbewa', 'Colombo', '10300', NULL, NULL, NULL, NULL, NULL),
(166, 'Peter and the wolf', '978-1-8422-936-9', 'Richard Hook', NULL, '0.00', 'Fantacy', '25', '&#34;Peter and the Wolf&#34; is a timeless children&#39;s story that combines narration with orchestral music. Set in a Russian village, it follows young Peter as he sets out to capture a wolf that threatens his town. With each character represented by a different musical instrument, the story unfolds through Sergei Prokofiev&#39;s enchanting score. As Peter bravely faces the wolf, children are introduced to various instruments and musical themes, creating a magical and educational experience that has delighted audiences for generations.', NULL, NULL, 'Peter and the wolf-1714330052-imgFront.jpg', 'Peter and the wolf-1714330052-imgBack.jpg', 'Peter and the wolf-1714330052-imgInside.jpg', '2024-04-28 18:47:31', 'Used', 2013, '', 'Oliver Twist', 'exchanged', 41, 'pending', NULL, NULL, 'Kesbewa', 'Colombo', '10300', NULL, NULL, NULL, NULL, NULL),
(167, 'Emma', '978-93-80792-01-9', 'Jane Austen', '180.00', '0.00', 'Romance', '10', '&#34;Emma&#34; is a novel by Jane Austen, first published in 1815. It follows the story of Emma Woodhouse, a young and wealthy woman who prides herself on her matchmaking abilities. Despite her good intentions, Emma&#39;s attempts at matchmaking often lead to misunderstandings and complications, particularly in the lives of her friends and family. As the novel progresses, Emma must confront her own misconceptions and learn to see the world from others&#39; perspectives. The novel explores themes of love, class, and personal growth, and is celebrated for its witty satire and keen observation of human nature. &#34;Emma&#34; is considered one of Austen&#39;s greatest works and a classic of English literature.', 1, NULL, 'Emma-1714330869-imgFront.jpeg', 'Emma-1714330869-imgBack.jpeg', 'Emma-1714330869-imgInside.jpeg', '2024-04-28 19:01:08', 'Used', 2015, 'Negotiable', NULL, 'used', 42, 'approval', NULL, NULL, 'Piliyandala', 'Ampara', '10400', 'Yuhasna', '246810', 'Moratuwa', 'BOC', NULL),
(168, 'The Magic  Porridge', '0-7214-1971-2', 'David Pace', '300.00', '0.00', 'Fantacy', '25', '&#34;The Magic Porridge Pot&#34; is a delightful children&#39;s book that tells the story of a young girl who discovers a magical cooking pot that never stops producing porridge. Initially a blessing, the pot soon becomes a challenge as the porridge threatens to overflow and inundate the entire town. With humor and ingenuity, the girl navigates the chaos caused by the never-ending porridge, learning valuable lessons about responsibility and the consequences of magic. Filled with whimsical illustrations and engaging storytelling, &#34;The Magic Porridge Pot&#34; is a timeless tale that captures the imagination of young readers.', 1, NULL, 'The Magic  Porridge-1714331430-imgFront.jpg', 'The Magic  Porridge-1714331430-imgBack.jpg', 'The Magic  Porridge-1714331430-imgInside.jpg', '2024-04-28 19:10:29', 'Used', 2013, 'Fixed', NULL, 'used', 43, 'approval', NULL, NULL, 'Talgaspe', 'Galle', '80470', 'Hansika Dewmini', '675823344', 'Galle', 'Commercial Bank', NULL),
(169, 'The Three Billy Goats Gruff', '0-7214-1951-8', 'Graham Percy', '100.00', '0.00', 'Fantacy', '10', '&#34;The Three Billy Goats Gruff&#34; is a Norwegian fairy tale about three billy goats who want to cross a bridge to graze in a meadow on the other side. However, the bridge is guarded by a mean and hungry troll who threatens to eat them. The smallest billy goat is the first to cross the bridge and, using cleverness, tricks the troll into letting him pass. The second billy goat also outsmarts the troll. Finally, the biggest billy goat challenges the troll, who is so scared of the large goat that he lets him pass as well. The story teaches the value of wit and bravery, and is a popular tale for children around the world.', 1, NULL, 'The Three Billy Goats Gruff-1714331582-imgFront.jpeg', 'The Three Billy Goats Gruff-1714331582-imgBack.jpeg', 'The Three Billy Goats Gruff-1714331582-imgInside.jpeg', '2024-04-28 19:13:01', 'Used', 2013, 'Fixed', NULL, 'used', 42, 'pending', NULL, NULL, 'Piliyandala', 'Ampara', '10400', 'Yuhasna', '246810', 'Moratuwa', 'BOC', NULL),
(170, 'The Enormous Turnip', '0-7214-1949-6', 'Stephen Holmes', '300.00', '0.00', 'Fantacy', '25', '&#34;The Enormous Turnip&#34; is a charming children&#39;s story that revolves around a humble vegetable and the collaborative efforts of a diverse group of characters. When an elderly man plants a turnip seed that grows into an enormous size, he finds himself unable to pull it from the ground alone. With the help of various farm animals, including a dog, a cat, and a mouse, they attempt to uproot the colossal turnip. Through teamwork and determination, they ultimately succeed, teaching readers valuable lessons about cooperation, perseverance, and the rewards of working together. Filled with whimsical illustrations and heartwarming moments, &#34;The Enormous Turnip&#34; is a beloved classic that celebrates the power of unity and community.', NULL, NULL, 'The Enormous Turnip-1714331680-imgFront.jpg', 'The Enormous Turnip-1714331680-imgBack.jpg', 'The Enormous Turnip-1714331680-imgInside.jpg', '2024-04-28 19:14:38', 'Used', 2015, 'Negotiable', NULL, 'used', 43, 'pending', NULL, NULL, 'Talgaspe', 'Galle', '80470', 'Hansika Dewmini', '675823344', 'Galle', 'Commercial Bank', NULL),
(171, 'Amba Yaluwo', '978-955-4682-00-9', 'T B Ilangarathna', '460.00', '0.00', 'Adventure', '50', '&#34;Amba Yaluwo&#34; is a poignant novel that delves into the complexities of human relationships, societal norms, and personal identity in Sri Lankan culture. Set against the backdrop of a changing nation, the story follows the lives of several interconnected characters as they navigate love, loss, and self-discovery. Through richly woven narratives and vivid characterizations, the author explores themes of family dynamics, tradition versus modernity, and the search for belonging. With its evocative prose and insightful portrayal of Sri Lankan society, &#34;Amba Yaluwo&#34; offers readers a compelling journey into the heart of human experience.', NULL, NULL, 'Amba Yaluwo-1714331878-imgFront.jpg', 'Amba Yaluwo-1714331878-imgBack.jpg', 'Amba Yaluwo-1714331878-imgInside.jpg', '2024-04-28 19:17:57', 'Used', 1957, 'Fixed', NULL, 'used', 43, 'approval', NULL, NULL, 'Talgaspe', 'Galle', '80470', 'Hansika Dewmini', '675823344', 'Galle', 'Commercial Bank', NULL),
(172, 'Robin Hood', '0-582-5287-0', 'D K Swan', NULL, '0.00', 'Adventure', '30', '&#34;Robin Hood&#34; is a timeless tale of adventure and heroism set in medieval England. The story follows the legendary outlaw Robin Hood and his band of Merry Men as they rob from the rich to give to the poor, while defying the corrupt Sheriff of Nottingham and his allies. With his exceptional archery skills, cunning tactics, and sense of justice, Robin Hood becomes a symbol of resistance against oppression and inequality. Through daring escapades in Sherwood Forest and daring rescues of those in need, Robin Hood embodies the ideals of honor, loyalty, and altruism, making him a beloved folk hero for generations.', NULL, NULL, 'Robin Hood-1714332076-imgFront.jpg', 'Robin Hood-1714332076-imgBack.jpg', 'Robin Hood-1714332076-imgInside.jpg', '2024-04-28 19:21:14', 'Used', 1989, '', 'Wuthering Heights', 'exchanged', 43, 'pending', NULL, NULL, 'Talgaspe', 'Galle', '80470', NULL, NULL, NULL, NULL, NULL),
(173, 'Wijayaba Kollaya', '955-20-2343-2', 'W.A.Silva', '475.00', '0.00', 'History', '50', '&#34;Wijayaba Kollaya&#34; is a historical novel by author W.A.Silva, published in 1997. The novel is set in medieval Sri Lanka during the reign of King Parakramabahu VI (1412-1467) and follows the story of Prince Sapumal, the son of a concubine, who rises to power and becomes a prominent figure in the kingdom. The title &#34;Wijayaba Kollaya&#34; translates to &#34;The Revolt of Vijayabahu,&#34; referring to Prince Sapumal&#39;s eventual rise to power and his conflict with King Parakramabahu VI. The novel explores themes of power, politics, betrayal, and loyalty, and is renowned for its vivid portrayal of historical events and characters.', NULL, NULL, 'Wijayaba Kollaya-1714332243-imgFront.jpeg', 'Wijayaba Kollaya-1714332243-imgBack.jpeg', 'Wijayaba Kollaya-1714332243-imgInside.jpeg', '2024-04-28 19:24:02', 'Used', 1938, 'Fixed', NULL, 'used', 42, 'approval', NULL, NULL, 'Piliyandala', 'Ampara', '10400', 'Yuhasna', '246810', 'Moratuwa', 'BOC', NULL),
(174, 'Wuthering Heights', '978-0-141-32669-6', 'Emily Bronte', NULL, '0.00', 'Mystery', '200', '&#34;Wuthering Heights&#34; is a captivating novel that explores themes of love, revenge, and the destructive power of obsession. Set against the desolate Yorkshire moors, the story revolves around the tempestuous relationship between Heathcliff, a brooding orphan, and Catherine Earnshaw, the spirited daughter of the house. Their intense bond transcends societal conventions but is marred by cruelty, jealousy, and manipulation. As their tumultuous love story unfolds, it affects the lives of those around them, including the innocent bystanders caught in the crossfire of their passionate feud. Brimming with gothic atmosphere and psychological depth, &#34;Wuthering Heights&#34; is a haunting masterpiece that continues to enthrall readers with its raw emotion and unforgettable characters.', NULL, NULL, 'Wuthering Heights-1714332273-imgFront.jpg', 'Wuthering Heights-1714332273-imgBack.jpg', 'Wuthering Heights-1714332273-imgInside.jpg', '2024-04-28 19:24:31', 'Used', 1990, '', 'Oliver Twist', 'exchanged', 43, 'pending', NULL, NULL, 'Talgaspe', 'Galle', '80470', NULL, NULL, NULL, NULL, NULL),
(175, 'Dari the third wife', '955-573-071-1', 'Sita Kulatunga', NULL, '0.00', 'Romance', '40', '&#34;Dari, The Third Wife&#34; is a poignant novel set in 19th-century Vietnam, which follows the journey of a young girl named Dari as she enters into an arranged marriage with a wealthy landowner. As the third wife in a polygamous household, Dari navigates the complex dynamics between the wives, each vying for their husband&#39;s affection and striving for their own autonomy within a patriarchal society. Amidst the backdrop of tradition and societal expectations, Dari grapples with her desires for independence and self-discovery. Through vivid prose and richly drawn characters, the novel explores themes of love, betrayal, and the resilience of the human spirit in the face of adversity. &#34;Dari, The Third Wife&#34; is a compelling tale that sheds light on the experiences of women in a rapidly changing world.', NULL, NULL, 'Dari the third wife-1714332517-imgFront.jpg', 'Dari the third wife-1714332517-imgBack.jpg', 'Dari the third wife-1714332517-imgInside.jpg', '2024-04-28 19:28:36', 'Used', 1988, '', 'The secret Garden', 'exchanged', 43, 'approval', NULL, NULL, 'Talgaspe', 'Galle', '80470', NULL, NULL, NULL, NULL, NULL),
(176, 'Bihisunu Nimnaya', '955-95930-8-0', 'Chandana Mendis', NULL, '0.00', 'Mystery', '50', '&#34;The Valley of Fear&#34; is a detective novel by Sir Arthur Conan Doyle, first published in 1915. It is the fourth and final novel featuring Sherlock Holmes. The story is divided into two parts: the first takes place in London, where Holmes and Dr. Watson investigate a mysterious murder connected to a secret society, and the second part is a flashback to events in America that lead up to the murder. The novel is known for its intricate plot, clever deductions by Holmes, and its depiction of the criminal underworld. It is considered one of Conan Doyle&#39;s finest works and a classic of detective fiction.', NULL, NULL, 'Bihisunu Nimnaya-1714332882-imgFront.jpeg', 'Bihisunu Nimnaya-1714332882-imgBack.jpeg', 'Bihisunu Nimnaya-1714332882-imgInside.jpeg', '2024-04-28 19:34:41', 'Used', 1999, '', 'Harry Potter', 'exchanged', 42, 'approval', NULL, NULL, 'Piliyandala', 'Ampara', '10400', NULL, NULL, NULL, NULL, NULL),
(177, 'Pollyanna', '955-652-250-3', 'Kathyana Amarasingha', '680.00', '0.00', 'Drama', '150', '&#34;Pollyanna&#34; is a heartwarming tale that follows the optimistic and ever-cheerful orphan, Pollyanna, as she brings joy and positivity to the lives of those around her. Despite facing numerous challenges and setbacks, Pollyanna&#39;s unwavering belief in the &#34;Glad Game&#34; — finding something to be glad about in every situation — inspires everyone she meets. Through her infectious optimism, she transforms the attitudes of the people in her small town, teaching them the power of gratitude and kindness. With its timeless message of hope and resilience, &#34;Pollyanna&#34; continues to captivate readers of all ages with its uplifting spirit and enduring charm.', 1, NULL, 'Pollyanna-1714333411-imgFront.jpg', 'Pollyanna-1714333411-imgBack.jpg', 'Pollyanna-1714333411-imgInside.jpg', '2024-04-28 19:43:30', 'Used', 2003, 'Fixed', NULL, 'used', 44, 'approval', NULL, NULL, 'Gampaha', 'Gampaha', '11870', 'Yasindu Ramith', '987983692', 'Gampaha', 'Peoples&#39; Bank', NULL),
(178, 'Adventures of Sindbad the salior', '978-81-775-8221-5', 'D K Swan', '385.00', '0.00', 'Adventure', '25', '&#34;Sinbad&#34; is a classic tale from the collection of Middle Eastern folklore known as &#34;One Thousand and One Nights.&#34; It chronicles the adventures of Sinbad the Sailor, a brave and resourceful mariner who embarks on voyages filled with encounters with fantastical creatures, treacherous seas, and exotic lands. From battling fierce monsters to outwitting cunning adversaries, Sinbad&#39;s exploits showcase his courage, cunning, and indomitable spirit. Through his journeys, Sinbad learns valuable lessons about perseverance, integrity, and the importance of friendship. With its rich tapestry of storytelling and captivating adventures, the legend of Sinbad continues to enchant audiences around the world.', 1, NULL, 'Adventures of Sindbad the salior-1714333602-imgFront.jpg', 'Adventures of Sindbad the salior-1714333602-imgBack.jpg', 'Adventures of Sindbad the salior-1714333602-imgInside.jpg', '2024-04-28 19:46:41', 'Used', 2013, 'Fixed', NULL, 'used', 44, 'approval', NULL, NULL, 'Gampaha', 'Gampaha', '11870', 'Yasindu Ramith', '987983692', 'Gampaha', 'Peoples&#39; Bank', NULL),
(179, 'Wuthering Heights', '978-0-141-32669-6', 'Emily Bronte', NULL, '0.00', 'Romance', '200', '&#34;Wuthering Heights&#34; is a novel by Emily Brontë, published in 1847 under the pseudonym Ellis Bell. It is a passionate and tragic tale that follows the lives of Heathcliff and Catherine Earnshaw on the Yorkshire moors. The story is narrated by Mr. Lockwood, a tenant at Thrushcross Grange, who learns about the history of the mysterious Heathcliff and his obsessive love for Catherine. The novel explores themes of love, revenge, social class, and the destructive power of unfulfilled passion. &#34;Wuthering Heights&#34; is celebrated for its dark and intense narrative, complex characters, and evocative depiction of the Yorkshire landscape.', NULL, NULL, 'Wuthering Heights-1714333704-imgFront.jpeg', 'Wuthering Heights-1714333704-imgBack.jpeg', 'Wuthering Heights-1714333704-imgInside.jpeg', '2024-04-28 19:48:23', 'Used', 1847, '', 'Robin Hood', 'exchanged', 42, 'approval', NULL, NULL, 'Piliyandala', 'Ampara', '10400', NULL, NULL, NULL, NULL, NULL),
(180, 'Oliver Twist', '978-81-7758-667-1', 'Charles Dickens', '412.00', '0.00', 'Science-Fiction', '25', '&#34;Oliver Twist&#34; is a classic novel by Charles Dickens that follows the story of a young orphan named Oliver as he navigates the harsh realities of life in 19th-century London. From his humble beginnings in a workhouse to his adventures with a gang of juvenile pickpockets led by the notorious Fagin, Oliver encounters a colorful cast of characters, both virtuous and villainous. Through his journey, Oliver grapples with poverty, injustice, and the search for identity and belonging. Dickens&#39; vivid portrayal of Victorian society highlights the plight of the poor and the moral decay of urban life, while Oliver&#39;s innocence and resilience offer a beacon of hope amidst the darkness. &#34;Oliver Twist&#34; remains a timeless masterpiece that continues to captivate readers with its compelling narrative and timeless themes.', NULL, NULL, 'Oliver Twist-1714333818-imgFront.jpg', 'Oliver Twist-1714333818-imgBack.jpg', 'Oliver Twist-1714333818-imgInside.jpg', '2024-04-28 19:50:17', 'Used', 1838, 'Negotiable', NULL, 'used', 44, 'approval', NULL, NULL, 'Gampaha', 'Gampaha', '11870', 'Yasindu Ramith', '987983692', 'Gampaha', 'Peoples&#39; Bank', NULL),
(181, 'Aba Yaluwo', '978-955-4682-00-9', 'T.B.Ilangarathna', NULL, '0.00', 'Adventure', '25', '&#34;Aba Yaluwo&#34; is a Sinhalese novel by T.B.Ilangarathna, first published in 1947. The novel portrays the life of a young boy named Nimal and his family living in a remote village in colonial Sri Lanka. It explores the struggles, traditions, and beliefs of the village people, focusing on themes such as poverty, superstition, and the clash between traditional and modern values. The novel is renowned for its vivid depiction of rural life in Sri Lanka and its social commentary on the impact of colonialism and modernization on traditional societies.', NULL, NULL, 'Aba Yaluwo-1714334002-imgFront.jpeg', 'Aba Yaluwo-1714334002-imgBack.jpeg', 'Aba Yaluwo-1714334002-imgInside.jpeg', '2024-04-28 19:53:21', 'Used', 1947, '', 'The Secret Garden', 'exchanged', 42, 'approval', NULL, NULL, 'Piliyandala', 'Ampara', '10400', NULL, NULL, NULL, NULL, NULL),
(182, 'Robin Hood', '0-582-52287-0', 'D K Swan', NULL, '0.00', 'Adventure', '25', '&#34;Robin Hood&#34; is a timeless tale of adventure and heroism set in medieval England. The story follows the legendary outlaw Robin Hood and his band of Merry Men as they rob from the rich to give to the poor, while defying the corrupt Sheriff of Nottingham and his allies. With his exceptional archery skills, cunning tactics, and sense of justice, Robin Hood becomes a symbol of resistance against oppression and inequality. Through daring escapades in Sherwood Forest and daring rescues of those in need, Robin Hood embodies the ideals of honor, loyalty, and altruism, making him a beloved folk hero for generations.', NULL, NULL, 'Robin Hood-1714334014-imgFront.jpg', 'Robin Hood-1714334014-imgBack.jpg', 'Robin Hood-1714334014-imgInside.jpg', '2024-04-28 19:53:32', 'Used', 1989, '', '&#34;The Night Circus&#34; by Erin Morgenstern', 'exchanged', 44, 'approval', NULL, NULL, 'Gampaha', 'Gampaha', '11870', NULL, NULL, NULL, NULL, NULL),
(183, 'Dari the third wife', '978-955-573-071-7', 'Sita Kulatunga', NULL, '0.00', 'Science-Fiction', '50', '&#34;Dari, The Third Wife&#34; is a poignant novel set in 19th-century Vietnam, which follows the journey of a young girl named Dari as she enters into an arranged marriage with a wealthy landowner. As the third wife in a polygamous household, Dari navigates the complex dynamics between the wives, each vying for their husband&#39;s affection and striving for their own autonomy within a patriarchal society. Amidst the backdrop of tradition and societal expectations, Dari grapples with her desires for independence and self-discovery. Through vivid prose and richly drawn characters, the novel explores themes of love, betrayal, and the resilience of the human spirit in the face of adversity. &#34;Dari, The Third Wife&#34; is a compelling tale that sheds light on the experiences of women in a rapidly changing world.', NULL, NULL, 'Dari the third wife-1714334171-imgFront.jpg', 'Dari the third wife-1714334171-imgBack.jpg', 'Dari the third wife-1714334171-imgInside.jpg', '2024-04-28 19:56:10', 'Used', 1988, '', '&#34;The Goldfinch&#34; by Donna Tartt', 'exchanged', 44, 'pending', NULL, NULL, 'Gampaha', 'Gampaha', '11870', NULL, NULL, NULL, NULL, NULL),
(184, 'The Enormous Turnip', '0-7214-1949-6', 'Stephen Holmes', NULL, '0.00', 'Fantacy', '25', '&#34;The Enormous Turnip&#34; is a charming children&#39;s story that revolves around a humble vegetable and the collaborative efforts of a diverse group of characters. When an elderly man plants a turnip seed that grows into an enormous size, he finds himself unable to pull it from the ground alone. With the help of various farm animals, including a dog, a cat, and a mouse, they attempt to uproot the colossal turnip. Through teamwork and determination, they ultimately succeed, teaching readers valuable lessons about cooperation, perseverance, and the rewards of working together. Filled with whimsical illustrations and heartwarming moments, &#34;The Enormous Turnip&#34; is a beloved classic that celebrates the power of unity and community.', NULL, NULL, 'The Enormous Turnip-1714334313-imgFront.jpg', 'The Enormous Turnip-1714334313-imgBack.jpg', 'The Enormous Turnip-1714334313-imgInside.jpg', '2024-04-28 19:58:31', 'Used', 2013, '', '&#34;Circe&#34; by Madeline Miller', 'exchanged', 44, 'approval', NULL, NULL, 'Gampaha', 'Gampaha', '11870', NULL, NULL, NULL, NULL, NULL),
(185, 'First Prize For The Worst Witch', '9780241607985', 'ERIN WATT', '1950.00', '5.00', 'Fantacy', '800', '&#34;I am a hopeless case - everything I do always does go wrong in the end.&#34;  Mildred Hubble may be the worst witch at Miss Cackle&#39;s Academy for Witches, but she&#39;s the best friend you&#39;ll ever have.', 12, 38, 'First Prize For The Worst Witch38-img1.jpg', 'First Prize For The Worst Witch38-img2.jpg', NULL, '2024-04-29 04:40:12', '', 0, '', NULL, 'new', NULL, 'approval', 'Kaumadi Dedigamuwa', '38/2, &#39;Jayanthi&#39;', 'Gonapola', '', '12410', 'P.D.Kaumadi', '20004305', 'Gonapola', 'BOC', NULL);
INSERT INTO `books` (`book_id`, `book_name`, `ISBN_no`, `author`, `price`, `discounts`, `category`, `weight`, `descript`, `quantity`, `publisher_id`, `img1`, `img2`, `img3`, `created_at`, `condition`, `published_year`, `price_type`, `booksIWant`, `type`, `customer_id`, `status`, `postal_name`, `street_name`, `town`, `district`, `postal_code`, `account_name`, `account_no`, `branch_name`, `bank_name`, `NoOfPages`) VALUES
(186, 'The Worst Witch And The Wishing Star', '9780241607978', 'MURPHY JILL', '1950.00', '5.00', 'Fantacy', '800', 'In the first story from Miss Cackle’s Academy for Witches in 6 years Mildred Hubble is about to learn to be careful what you wish for...  Mildred, notoriously the worst witch at Miss Cackle&#39;s Academy for Witches, makes a wish on a shooting star - and to her great surprise it comes true! But it also spells trouble.', 12, 38, 'The Worst Witch And The Wishing Star38-img1.jpg', 'The Worst Witch And The Wishing Star38-img2.jpeg', NULL, '2024-04-29 04:48:01', '', 0, '', NULL, 'new', NULL, 'approval', 'Kaumadi Dedigamuwa', '38/2, &#39;Jayanthi&#39;', 'Gonapola', '', '12410', 'P.D.Kaumadi', '20004305', 'Gonapola', 'BOC', NULL),
(187, 'test1', '12345', 'name', '1000.00', '20.00', 'History', '150', 'good', 100, 28, 'test128-img1.png', 'test128-img2.png', NULL, '2024-04-30 06:43:39', '', 0, '', NULL, 'new', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10),
(188, 'test2', '123456', 'martin wickramasinha', '1000.00', '10.00', 'History', '100', 'good', 20, 28, 'test228-img1.png', 'test228-img2.png', NULL, '2024-04-30 06:50:16', '', 0, '', NULL, 'new', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `category`, `description`, `category_img`) VALUES
(1, 'Science-Fiction', 'Books that are not based on real events or people.', 'Science-Fiction-1713608909-img.png'),
(2, 'History', 'Features books that delve into past events, providing insight into the development of societies, cultures, and significant historical figures.', 'History-1713609259-img.png'),
(3, 'Mystery', 'Books that involve solving a crime or uncovering secrets.', 'Mystery-1713609367-img.png'),
(4, 'Romance', 'Romance novels center around the theme of love and emotional relationships. They explore the complexities of romantic connections, often featuring characters overcoming obstacles to find love or navigate the challenges of maintaining relationships. Romance novels can range from contemporary to historical settings, and they emphasize the emotional journey of the characters.', 'Romance-1713609475-img.png'),
(5, 'Adventure', 'Adventure novels revolve around exciting journeys, quests, or explorations. These stories often feature protagonists facing adversity, overcoming obstacles, and discovering new territories.', 'Adventure-1713609586-img.png'),
(6, 'Fantacy', 'Fantasy novels transport readers to magical realms filled with mythical creatures, magical powers, and epic adventures.', 'Fantacy-1713609709-img.png'),
(7, 'Thriller', 'Thriller novels focus on suspenseful and intriguing narratives, typically involving a central mystery or crime.', 'Thriller-1713609836-img.png'),
(9, 'Drama', '&#34;Drama&#34; typically encompasses literature that explores intense human conflict, emotional tension, and interpersonal relationships within a narrative framework.', 'Drama-1713604621-img.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `current_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `book_id`, `customer_id`, `quantity`, `current_time`) VALUES
(55, 116, 24, 2, '2024-02-18 11:29:19'),
(139, 120, 29, 1, '2024-04-26 03:58:15'),
(140, 120, 29, 1, '2024-04-26 04:01:25'),
(141, 120, 29, 1, '2024-04-26 04:16:13'),
(142, 123, 21, 1, '2024-04-26 06:28:58'),
(143, 136, 39, 1, '2024-04-28 11:29:28'),
(152, 137, 21, 1, '2024-04-29 21:09:25'),
(153, 135, 21, 1, '2024-04-30 11:57:31'),
(154, 120, 21, 1, '2024-05-02 09:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

CREATE TABLE `charity` (
  `charity_id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `reg_no` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approval','restrict','reject') NOT NULL DEFAULT 'pending',
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `charity`
--

INSERT INTO `charity` (`charity_id`, `profile_img`, `name`, `org_name`, `reg_no`, `email`, `contact_no`, `pass`, `user_id`, `created_at`, `status`, `restriction_date`) VALUES
(12, '', 'charity', 'girls welfare society', '2021/cs/003', 'charity@gmail.com', '0786767678', '1234567', 145, '2023-11-28 10:37:06', 'approval', NULL),
(17, '', 'm.r.ranasinghe', 'China welfare society', 'we23423424', 'charity4@gmail.com', '0476767675', '$2y$10$Bjgy.zk5Xeu2LRIn2PSD0eOlsWHu2FmB5QH51fWX9OS.bjAUcJjTa', 169, '2024-04-14 14:07:11', 'approval', NULL),
(18, '', 'D.M.Perera', 'sanasuma welfare society', '43234534r', 'sanasuma@gmail.com', '0786767675', '$2y$10$kGbnQZiJ6boXn9F/Q8rwNuOlrkg1xVes1Fmi0okJzLq7VE4xmNsRC', 170, '2024-04-26 16:03:30', 'pending', NULL),
(19, '', 'K.Mohomad', 'Sihina welfare society', '2021/cfd/3432', 'moho2345@gmail.com', '0786767675', '$2y$10$QG0zT1g7o3gHtosLFuZkYerdU251oqQqq3hA6brMqdP.popOo4.aS', 171, '2024-04-26 16:05:56', 'pending', NULL);

--
-- Triggers `charity`
--
DELIMITER $$
CREATE TRIGGER `after_insert_charity` AFTER INSERT ON `charity` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_charityn` AFTER INSERT ON `charity` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_charity` AFTER UPDATE ON `charity` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_charityn` AFTER UPDATE ON `charity` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `charity_event`
--

CREATE TABLE `charity_event` (
  `charity_event_id` int(11) NOT NULL,
  `event_name` varchar(300) NOT NULL,
  `location` varchar(300) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `Deadline_date` date NOT NULL,
  `book_category` varchar(400) NOT NULL,
  `poster` varchar(300) DEFAULT NULL,
  `contact_no` int(11) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `charity_event`
--

INSERT INTO `charity_event` (`charity_event_id`, `event_name`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `Deadline_date`, `book_category`, `poster`, `contact_no`, `description`, `status`) VALUES
(9, 'Literary Fest 2024', 'colombo hindu college', '2022-09-09', '2024-09-09', '10:00:00', '09:00:00', '2024-05-08', 'non-fiction, biography', 'event01.jpg', 76, 'Swing by the coffee shop for our literary giveaway...', 0),
(13, 'readspot#24', 'Central Public Library', '2024-06-05', '2024-06-15', '08:00:00', '14:00:00', '2024-05-02', 'non-fiction, science', 'CharityPress_ThemeMascot.jpg', 76, 'Join us for a day filled with literary delights as we celebrate the joy of reading and sharing books. Whether you\'re a book lover, an avid reader, or just curious about the world of literature, this event is for you!', 0),
(14, 'Bookworm Bash', 'Local Park', '2024-07-10', '2024-07-20', '09:00:00', '12:00:00', '2024-05-16', 'non-fiction, other', 'event11.jpg', 76, 'Attend our storybook swap meet and exchange your old favorites for new adventures! Donate a book and discover literary treasures from fellow book lovers.', 0),
(15, 'Read & Recycle Rally', 'Coffee Shop', '2024-08-24', '2024-08-30', '08:00:00', '04:00:00', '2024-05-06', 'biography, science', 'event12.jpg', 76, 'Swing by the coffee shop for our literary giveaway gathering! Donate a book and enjoy a complimentary coffee as a token of our appreciation.', 0),
(16, 'Storybook Swap Meet', 'Community Center', '2024-08-02', '2024-08-10', '04:00:00', '07:00:00', '2024-05-31', 'fiction, non-fiction, biography', 'event13.jpg', 76, 'Attend our storybook swap meet and exchange your old favorites for new adventures! Donate a book and discover literary treasures from fellow book lovers.', 0),
(17, 'Pages of Hope: Book Donation Drive', 'Sri Lanka Foundation Institute, 100 Independence Avenue, Colombo 7, Sri Lanka', '2024-08-06', '2024-02-06', '10:00:00', '04:00:00', '2024-06-05', 'science', 'event14.jpg', 76, 'Join us for a heartwarming initiative to spread the joy of reading and education across Sri Lanka. \"Pages of Hope\" is a book donation drive aimed at collecting books to support underprivileged communities, schools, and libraries throughout the country.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `parent_comment` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `parent_comment`, `name`, `comment`, `timestamp`, `book_id`) VALUES
(1, 0, 'pathumi', 'jii', '2023-12-10 02:35:28', NULL),
(2, 1, 'hii', 'kohomd', '2023-12-10 02:40:42', NULL),
(3, 0, 'pathumi', 'good', '2023-12-10 02:44:48', NULL),
(4, 0, 'dinuki thisaranai', 'correct', '2023-12-10 02:45:12', NULL),
(5, 0, 'Mahamada Kalapuwage Pathumee Ahinsa', 'jii', '2023-12-10 02:56:18', NULL),
(6, 5, 'hii', 'gona', '2023-12-10 02:56:38', NULL),
(7, 0, 'customer new', 'hellooo', '2023-12-10 03:02:28', NULL),
(8, 0, 'customer new', 'comment', '2023-12-10 05:30:04', NULL),
(9, 0, 'customer new', 'hii', '2023-12-10 06:30:42', NULL),
(10, 9, 'customer new', '42t3rg', '2023-12-14 09:42:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(32) NOT NULL,
  `contact_number` varchar(32) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `other` varchar(255) DEFAULT NULL,
  `err_img` varchar(255) DEFAULT NULL,
  `descript` text NOT NULL,
  `moderatorAdmin_comment` text DEFAULT NULL,
  `update_time_on_comment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `resolved_or_not` tinyint(1) NOT NULL DEFAULT 0,
  `sent_to_superadmin` tinyint(1) NOT NULL DEFAULT 0,
  `superadmin_comment` varchar(200) DEFAULT NULL,
  `resolvedBy_superadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `customer_id`, `first_name`, `last_name`, `email`, `contact_number`, `reason`, `other`, `err_img`, `descript`, `moderatorAdmin_comment`, `update_time_on_comment`, `resolved_or_not`, `sent_to_superadmin`, `superadmin_comment`, `resolvedBy_superadmin`) VALUES
(1, 21, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'Other', '', NULL, 'Why my account was rejected ,my email is generate@gmail.com', '', '2024-04-25 05:30:45', 1, 1, NULL, 0),
(2, 21, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'Comments', '', NULL, 'There are any unneccessary commnets in my content.please remove them,content_id:20', NULL, '0000-00-00 00:00:00', 1, 1, NULL, 0),
(3, 24, 'Kaumadi', 'Pahalage', 'kaumadi2k2@gmail.com', '0774769958', 'Events', '', NULL, 'I am writing to report an issue that occurred during the charity event organized by your platform on March 15, 2024. During the event, there was a significant delay in the start time, which resulted in confusion among attendees. Additionally, the catering service provided was subpar, with several guests complaining about the quality of the food.', 'please note that we do not handle events personally. If you have any inquiries or concerns regarding a specific event, we recommend contacting the relevant event organizer directly. They will be better equipped to assist you with any questions you may have.', '0000-00-00 00:00:00', 1, 1, NULL, 0),
(4, 29, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'Comments', '', '', 'There are hatefull messages send this rusara45@gmail.com owner for me,please take a look at this', NULL, '0000-00-00 00:00:00', 0, 1, NULL, 0),
(5, 29, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'Other', '', 'Reason 01-1713207259-imgComplaint.jpg', 'This comments is hatefull comments,please remove it', NULL, '0000-00-00 00:00:00', 0, 1, 'I restricted that account for 7days', 0),
(6, 24, 'kaumadi', 'Pahalage', 'kaumadi2k@gmail.com', '0774769958', 'Comments', '', NULL, 'I recently viewed a comment on one of the articles titled &#34;The Importance of Sleep&#34; posted on your platform. The comment by the username &#34;SleepHater23&#34; contained derogatory language and offensive remarks towards the author and other readers. Such comments create a hostile environment and undermine the integrity of your platform. I urge you to take immediate action to remove the offensive comment and ensure that appropriate measures are in place to prevent similar incidents in the future.', 'We have investigated the comment in question and have taken immediate action to remove it from the article. Additionally, we are implementing stricter moderation measures to prevent similar incidents from occurring in the future.\r\n\r\nPlease accept our sincere apologies for any discomfort or offense caused by the inappropriate comment. We appreciate your assistance in helping us maintain a positive community environment.', '2024-04-19 08:49:46', 1, 0, NULL, 0),
(7, 29, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'other', '', '', 'I recently viewed a comment on one of the articles titled &#34;The Importance of Sleep&#34; posted on your platform. The comment by the username &#34;SleepHater23&#34; contained derogatory language and offensive remarks towards the author and other readers. Such comments create a hostile environment and undermine the integrity of your platform. I urge you to take immediate action to remove the offensive comment and ensure that appropriate measures are in place to prevent similar incidents in the future.', NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `doc` varchar(100) DEFAULT NULL,
  `time` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('pending','approval','reject') NOT NULL DEFAULT 'pending',
  `reject_reason` varchar(200) DEFAULT NULL,
  `pointsAdd` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `customer_id`, `topic`, `text`, `img`, `doc`, `time`, `status`, `reject_reason`, `pointsAdd`) VALUES
(5, 21, 'Ahambakaraka', '“A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me. “A man never sees another in his truest form, and we try to interpret the other based on what we see and assume, and these interpretations are largely wrong” The above is one of my favorite lines from this book, and reading this was a new experience for me.', 'Ahambakaraka-1714200010img.jpg', 'Ahambakaraka-1714200010pdf.pdf', '2024-02-24 02:37:57', 'pending', 'not provide the content pdf', 0),
(6, 21, 'The Road Not Taken&#34; by Robert Frost', 'Two roads diverged in a yellow wood, And sorry I could not travel both And be one traveler, long I stood And looked down one as far as I could To where it bent in the undergrowth; Then took the other, as just as fair, And having perhaps the better claim, Because it was grassy and wanted wear; Though as for that the passing there Had worn them really about the same, And both that morning equally lay In leaves no step had trodden black. Oh, I kept the first for another day! Yet knowing how way leads on to way, I doubted if I should ever come back. I shall be telling this with a sigh Somewhere ages and ages hence: Two roads diverged in a wood, and I— I took the one less traveled by, And that has made all the difference.', 'The Road Not Taken&#34; by Robert Frost-1708742382img.jpg', '', '2024-03-22 02:39:43', 'approval', 'Image is not clear and no any pdf provided', 0),
(8, 21, 'Ahambakaraka (අහම්බකාරක)', 'The Road Not Taken', 'Ahambakaraka (අහම්බකාරක)-1714281180img.jpg', 'Ahambakaraka (අහම්බකාරක)-1714281180pdf.pdf', '2024-04-27 06:28:27', 'pending', NULL, 0),
(9, 21, 'Ahambakaraka (අහම්බකාරක)', 'Content', 'Ahambakaraka (අහම්බකාරක)-1714281214img.png', 'Ahambakaraka (අහම්බකාරක)-1714281214pdf.pdf', '2024-04-28 04:55:26', 'pending', NULL, 0),
(10, 21, 'Bookish Gift Guide', 'Create a gift guide featuring unique and thoughtful gifts for book lovers. Include items such as book subscription boxes, literary-themed accessories, cozy reading nook essentials, and bookish merchandise.', 'Bookish Gift Guide-1714376228img.jpeg', 'Bookish Gift Guide-1714376228pdf.pdf', '2024-04-29 07:37:09', 'pending', NULL, 0),
(12, 43, 'Book Review - &#34;The Alchemist&#34; by Paulo Coelho', 'A detailed review of the classic novel &#34;The Alchemist,&#34; exploring its themes of destiny, personal legend, and the journey of self-discovery.', 'Book Review The Alchemist&by Paulo Coelho-1714382150img.jpeg', 'Book Review The Alchemist&by Paulo Coelho-1714382150pdf.pdf', '2024-04-29 09:15:50', 'approval', NULL, 0),
(13, 42, 'Book Excerpt - &#34;The Great Gatsby&#34; by F. Scott Fitzgerald', 'Read an excerpt from the classic novel &#34;The Great Gatsby,&#34; showcasing Fitzgerald&#39;s elegant prose and vivid imagery.', 'Book Excerpt - &#34;The Great Gatsby&#34; by F. Scott Fitzgerald-1714382585img.jpeg', 'Book Excerpt - &#34;The Great Gatsby&#34; by F. Scott Fitzgerald-1714382585pdf.pdf', '2024-04-29 09:23:05', 'pending', NULL, 0),
(14, 43, 'Author Interview - J.K. Rowling', 'An exclusive interview with renowned author J.K. Rowling, discussing her writing process, inspirations, and upcoming projects.', 'Author Interview - J.K. Rowling-1714382614img.jpeg', 'Author Interview - J.K. Rowling-1714382614pdf.pdf', '2024-04-29 09:23:35', 'approval', NULL, 0),
(15, 43, 'Top 10 Must-Read Books of 2025', 'Discover the hottest books of the year with our list of the top 10 must-read books for 2025, spanning various genres and styles', 'Top 10 Must-Read Books of 2025-1714382888img.jpeg', 'Top 10 Must-Read Books of 2025-1714382888pdf.pdf', '2024-04-29 09:28:09', 'approval', NULL, 0),
(16, 42, 'Book Spotlight - &#34;Educated&#34; by Tara Westover', 'Learn about the compelling memoir &#34;Educated&#34; by Tara Westover, which chronicles her journey from a survivalist family to earning a PhD from Cambridge University.', 'Book Spotlight - &#34;Educated&#34; by Tara Westover-1714383103img.jpeg', 'Book Spotlight - &#34;Educated&#34; by Tara Westover-1714383103pdf.pdf', '2024-04-29 09:31:43', 'pending', NULL, 0),
(17, 42, '&#34;The Night Circus&#34; by Erin Morgenstern', 'Discover the enchanting world of &#34;The Night Circus&#34; and why this novel is a must-read for fans of magical realism and fantasy.', '&#34;The Night Circus&#34; by Erin Morgenstern-1714383364img.jpeg', '&#34;The Night Circus&#34; by Erin Morgenstern-1714383364pdf.pdf', '2024-04-29 09:36:04', 'pending', NULL, 0),
(18, 40, 'Literary Analysis - &#34;Pride and Prejudice&#34; by Jane Austen', 'Dive into the world of Jane Austen&#39;s &#34;Pride and Prejudice&#34; with a detailed literary analysis, examining its themes, characters, and social commentary.', 'Literary Analysis - &#34;Pride and Prejudice&#34; by Jane Austen-1714383398img.jpeg', 'Literary Analysis - &#34;Pride and Prejudice&#34; by Jane Austen-1714383398pdf.pdf', '2024-04-29 09:36:38', 'pending', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `content_review`
--

CREATE TABLE `content_review` (
  `review_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `help` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_review`
--

INSERT INTO `content_review` (`review_id`, `content_id`, `customer_id`, `review`, `rate`, `time`, `help`) VALUES
(1, 1, 21, 'good', 3, '2024-02-24 01:38:27.089763', 5),
(2, 1, 21, 'This poem beautifully captures the essence of life&#39;s choices and the uncertainty that accompanies them. The metaphor of the two roads diverging in a yellow wood resonates deeply, reminding us of the pivotal moments when we must make decisions that shape our destiny. Frost&#39;s masterful use of language evokes a sense of nostalgia and contemplation, prompting readers to reflect on their own journeys and the roads they&#39;ve chosen to take. &#39;The Road Not Taken&#39; is not just a poem; it&#39;s a timeless meditation on the complexities of human existence.', 5, '2024-02-24 01:46:30.963583', 0),
(3, 1, 21, 'This poem beautifully captures the essence of decision-making and the uncertainty that accompanies choosing one path over another. Frost&#39;s imagery of the two roads diverging in a yellow wood evokes a sense of contemplation and introspection.', 4, '2024-02-24 01:52:30.963476', 0),
(4, 4, 21, 'good', 3, '2024-02-24 02:56:57.826525', 0),
(6, 4, 21, 'thank you for this valuable article', 5, '2024-02-25 15:10:02.602142', 0),
(7, 4, 21, 'good', 2, '2024-02-25 15:11:12.091951', 0),
(9, 5, 21, 'good', 3, '2024-04-20 06:00:43.371895', 0),
(10, 5, 21, 'good content', 4, '2024-04-20 08:58:46.011692', 1),
(11, 5, 21, 'i love this article', 4, '2024-04-20 09:41:04.576806', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approval','restrict','reject') DEFAULT 'pending',
  `postal_name` varchar(255) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `town` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `redeem_points` int(11) NOT NULL DEFAULT 0,
  `content_point` int(11) NOT NULL,
  `challnege_point` int(11) NOT NULL,
  `challenge_point_date` timestamp NULL DEFAULT NULL,
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `profile_img`, `name`, `first_name`, `last_name`, `email`, `pass`, `contact_number`, `user_id`, `created_at`, `status`, `postal_name`, `street_name`, `town`, `district`, `postal_code`, `account_name`, `account_no`, `branch_name`, `bank_name`, `redeem_points`, `content_point`, `challnege_point`, `challenge_point_date`, `restriction_date`) VALUES
(21, 'Pathumi-1714060458-newImage.png', 'Pathumi Ahinsa', 'Pathumi', 'Ahinsa', 'pathuahinsa2001@gmail.com', '$2y$10$QK5gfmu2B8WJHb1Nrq926OOmYfFDgsmHwDRdwLz28Gx7quQMnAAuG', '+94712345678', 137, '2023-12-08 05:29:44', 'approval', 'reciever', 'Central', 'reciever', 'Ampara', 78990, '899', '789', 'reciever', 'reciever', 105, 240, 325, '2024-04-24 05:30:38', NULL),
(24, 'Kaumadi Pahalage-1712810802-newImage.png', 'Kaumadi Pahalage', 'Kaumadi', 'Pahalage', 'kaumadi2k2@gmail.com', '$2y$10$c1fJIg0hR3nlNPHWr7FnIu.Z6WqYxNH/9yE/q0vSjXBFiSjHCWSau', NULL, 153, '2024-02-17 05:07:42', 'approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 1250, 295, '2024-04-24 05:31:31', NULL),
(29, 'Ramath-1713846312-newImage.jpeg', 'Ramath Perera', 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '$2y$10$8vw51uiEHJsQBsng659iaOfvrsrfPgsKJyjH23wm8qUNiT40kAXe2', '0716933522', 162, '2024-02-24 13:45:26', 'approval', '163, Priyankara Mawatha, Paraththa, Keselwaththa', 'Western', 'Panadura', 'Kalutara', 12550, 'Ramath Perera', '21474836470000', 'Panadura Town', 'People&#39;s Bank', 10, 275, 600, '2024-04-24 05:31:04', NULL),
(32, NULL, 'pramith perera', 'pramith', 'perera', 'bap81735@gmail.com', '$2y$10$XeeMwsbKCbfu1WXFNrUTyONXTj9TqV2zvNjxG6ifiRfNp/ot9o52S', NULL, 165, '2024-02-26 03:04:58', 'approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 0, 0, NULL, NULL),
(36, NULL, 'k.hansani lakshani', 'k.hansani', 'lakshani', '2021cs003@stu.ucsc.cmb.ac.lk', '$2y$10$05Mzrf2c3dUePaBX42mHhu3sF/ziXsGgEKwF5kuub6NlIUdHdVPgG', NULL, 177, '2024-04-27 00:38:17', 'approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL),
(39, NULL, 'Thisari kaumadi', 'Thisari', 'kaumadi', 'kaumadi2k@gmail.com', '$2y$10$2KGeDEnwKvDpGHjHvdRa1ewAsbpq9rvwTcY3GeBzbS0bY5cbRM7kK', NULL, 181, '2024-04-28 11:27:06', 'approval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL),
(40, 'Geeradha-1714417655-newImage.jpeg', 'Geeradha Sulakshi', 'Geeradha', 'Sulakshi', 'geesulakshi@gmail.com', '$2y$10$8jbS19rXVcQdP/SniON/HOBOlMCs5QhGT4cIlkCksi0puWE2UyfJ2', '', 182, '2024-04-28 16:42:53', 'approval', '20,lake Rd,Piliyandala', 'Western', 'Piliyandala', 'Colombo', 10300, 'Geeradha', '12345678', 'Piliyandala', 'BOC', 0, 0, 0, NULL, NULL),
(41, NULL, 'Sahansa Vihangi', 'Sahansa', 'Vihangi', 'geeganegoda@gmail.com', '$2y$10$95t3Oy5D6xCKkvD3bPDCSOxfcGLjO93sysI52qKnhklwrhs2vsxyC', '', 183, '2024-04-28 17:59:57', 'approval', '', 'Western', 'Kesbewa', 'Colombo', 10300, 'Sahansa Vihangi', '87654321', 'Kesbewa', 'Peoples&#39; Bank', 0, 0, 0, NULL, NULL),
(42, NULL, 'Yuhasna Thesini', 'Yuhasna', 'Thesini', 'ganegodasulakshi@gmail.com', '$2y$10$LQWeFYVZKYaF/as3YdisserUyYBaj/bJRreNq9p88fi.ERYVR0Oem', '', 184, '2024-04-28 18:13:54', 'approval', 'Mrs.Thesini ,&#34;B&#34;, Moratuwa RD , Mampe West, Piliyandala', 'Central', 'Piliyandala', 'Ampara', 10400, 'Yuhasna', '246810', 'Moratuwa', 'BOC', 0, 0, 0, NULL, NULL),
(43, 'Hansika-1714418679-newImage.jpg', 'Hansika Dewmini', 'Hansika', 'Dewmini', 'priyanikalansooriya@gmail.com', '$2y$10$FSEuDmDssU4hYrx3e23OQOgrKtGU5wHfefhbMnQjv9sNWuEzlYL/K', '', 185, '2024-04-28 18:53:29', 'approval', '', 'Southern', 'Talgaspe', 'Galle', 80470, 'Hansika Dewmini', '675823344', 'Galle', 'Commercial Bank', 0, 0, 0, NULL, NULL),
(44, NULL, 'Yasindu Ramith', 'Yasindu', 'Ramith', 'gpyasinduramith@gmail.com', '$2y$10$dfLBnN0y93gNXHeHNRLsBOA/GrctUDBC8BdqaRcmNkNKwj6yvUUG2', '', 186, '2024-04-28 19:32:20', 'approval', '', 'Western', 'Gampaha', 'Gampaha', 11870, 'Yasindu Ramith', '987983692', 'Gampaha', 'Peoples&#39; Bank', 0, 0, 0, NULL, NULL);

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `after_insert_customern` AFTER INSERT ON `customers` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_customers` AFTER INSERT ON `customers` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_customer` AFTER UPDATE ON `customers` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_customern` AFTER UPDATE ON `customers` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_redeem_points` BEFORE UPDATE ON `customers` FOR EACH ROW BEGIN
    IF NEW.redeem_points < 0 THEN
        SET NEW.redeem_points = 0;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_user_name_after_customer_change` AFTER UPDATE ON `customers` FOR EACH ROW BEGIN
    IF OLD.first_name != NEW.first_name THEN
        UPDATE users
        SET name = CONCAT(NEW.first_name, ' ', (SELECT last_name FROM customers WHERE user_id = NEW.user_id))
        WHERE user_id = NEW.user_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `priceperkilo` decimal(10,2) DEFAULT NULL,
  `priceperadditional` decimal(10,2) DEFAULT NULL,
  `status` enum('approval','reject','restrict') NOT NULL DEFAULT 'approval',
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `profile_img`, `user_id`, `name`, `email`, `pass`, `priceperkilo`, `priceperadditional`, `status`, `restriction_date`) VALUES
(12, '', 143, 'delivery person', 'delivery@gmail.com', '$2y$10$AhaaJN.PPGwApW3TLHVX6e25mxzM6x8n5phdDbtcO55yFAtVhF7AS', '350.00', '70.00', '', NULL);

--
-- Triggers `delivery`
--
DELIMITER $$
CREATE TRIGGER `after_insert_delivery` AFTER INSERT ON `delivery` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_deliveryn` AFTER INSERT ON `delivery` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_delivery` AFTER UPDATE ON `delivery` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_deliveryn` AFTER UPDATE ON `delivery` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_reviews`
--

CREATE TABLE `delivery_reviews` (
  `review_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_reviews`
--

INSERT INTO `delivery_reviews` (`review_id`, `order_id`, `customer_id`, `review`, `date`, `rating`) VALUES
(34, 236, 21, 'good delivery', '2024-04-26 00:26:58', NULL),
(43, 240, 21, 'speed delivery service', '2024-04-26 00:37:38', 4),
(44, 241, 29, 'i have recieved it within only two days,thank you', '2024-04-26 00:50:40', 5),
(45, 237, 24, 'speed delivery service', '2024-04-26 06:35:07', 4),
(46, 244, 21, 'good delivery', '2024-04-30 06:30:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `donate_books`
--

CREATE TABLE `donate_books` (
  `donate_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `charity_event_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(32) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `book_types` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Pending','Accepted','Rejected') NOT NULL DEFAULT 'Pending',
  `mark_as_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donate_books`
--

INSERT INTO `donate_books` (`donate_id`, `customer_id`, `charity_event_id`, `first_name`, `last_name`, `email`, `contact_number`, `book_types`, `quantity`, `description`, `status`, `mark_as_read`) VALUES
(1, 21, 10, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book01, book02', 25, 'charity_event_idcharity_event_idcharity_event_id', 'Accepted', 1),
(2, 21, 10, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book03', 12, 'Donatedetails Donatedetails', 'Pending', 0),
(3, 21, 10, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', '', 0, '.register a button', 'Pending', 0),
(4, 21, 10, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book01', 10, '.register a button', 'Pending', 0),
(5, 21, 14, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', '', 0, 'aabb', 'Pending', 0),
(6, 21, 14, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', '', 0, 'charity_event_id', 'Pending', 0),
(7, 21, 14, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book1, book2', 35, '1234', 'Pending', 0),
(8, 21, 9, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', '', 0, '1234', 'Pending', 0),
(9, 21, 9, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', '', 0, '1234', 'Pending', 0),
(10, 21, 9, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', '', 0, 'book', 'Pending', 0),
(11, 21, 13, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book_non-fiction, book__science', 0, '1234', 'Pending', 0),
(12, 21, 9, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book_non-fiction, book__biography', 0, 'aaabbbccc', 'Pending', 0),
(13, 21, 9, 'Ramath', 'Perera', 'ramath.perera08@gmail.com', '0716933522', 'book_non-fiction', 0, '1278', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('Customer','Charity Organization','Publisher') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `moderator_comment` text DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `poster` varchar(100) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL,
  `img4` varchar(100) NOT NULL,
  `img5` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `user_type`, `title`, `description`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `status`, `moderator_comment`, `category_name`, `poster`, `img1`, `img2`, `img3`, `img4`, `img5`, `created_at`) VALUES
(1, 94, 'Publisher', 'Authors talk', 'authors talk with famous authors in Sri lanka', 'BMICH', '2024-01-25', '2024-01-26', '00:00:00', '00:00:00', 'Approved', NULL, 'Author Talks', 'Authors talk94-img1.jpg', 'Authors talk94-img1.jpg', 'Authors talk94-img1.jpg', 'Authors talk94-img1.jpg', 'Authors talk94-img1.jpg', 'Authors talk94-img1.jpg', '2024-01-17 02:04:01'),
(3, 137, 'Customer', 'Event', 'Event', 'Moratuwa', '2024-04-24', '2024-02-20', '05:02:00', '17:01:00', 'Approved', NULL, 'Book Signing', '', '', '', '', '', '', '2024-02-18 10:32:51'),
(6, 153, 'Customer', 'Event 100', '{ day: 15, month: 1, year: 2024 },', 'Panadura', '2024-02-14', '2024-02-28', '05:02:00', '17:01:00', 'Pending', NULL, 'authorTalks', 'Event 100-1708920966-imgMain.jpg', 'Event 100-1708920966-1stImg.jpg', 'Event 100-1708920966-2ndImg.png', 'Event 100-1708920966-3rdImg.jpg', 'Event 100-1708920966-4thImg.png', 'Event 100-1708920966-5thImg.png', '2024-03-25 04:16:08'),
(7, 153, 'Customer', 'Event 150', '{ day: 15, month: 1, year: 2024 },', 'Panadura', '2024-02-14', '2024-02-28', '05:02:00', '17:01:00', 'Pending', NULL, 'bookFair', 'Event 150-1708921207-imgMain.png', 'Event 150-1708921207-1stImg.png', 'Event 150-1708921207-2ndImg.png', 'Event 150-1708921207-3rdImg.png', 'Event 150-1708921207-4thImg.png', 'Event 150-1708921207-5thImg.png', '2024-03-26 04:20:09'),
(8, 162, 'Customer', 'Colombo International Book Fair', 'The Colombo International Book Fair is an annual trade fair for books usually held in mid-September at the Bandaranaike Memorial International Conference Hall in Colombo, Sri Lanka. Organized by the Sri Lankan Book Publishers’ Association, it is the largest book exhibition and fair in the country.\r\n\r\n22nd edition of Colombo International Book Fair began on September 22 and lasted till October 01. Organizers have arranged special COVID19 safety measures. CIBF is the Sri Lanka&#39;s largest book exhibition and fair.', 'BMICH Colombo', '2023-09-22', '2023-10-01', '09:00:00', '21:00:00', 'Approved', NULL, 'Literary Festival', 'Colombo International Book Fair-1713685845-imgMain.jpg', 'Colombo International Book Fair-1713685845-1stImg.jpg', 'Colombo International Book Fair-1713685845-2ndImg.jpg', 'Colombo International Book Fair-1713685845-3rdImg.png', 'Colombo International Book Fair-1713685845-4thImg.jpg', 'Colombo International Book Fair-1713685845-5thImg.jpg', '2024-04-21 07:50:47'),
(37, 162, 'Customer', 'Event 1010', 'readspot.cbusia0uaymm.ap-southeast-2.rds.amazonaws.com', 'Panadura', '2024-04-22', '2024-04-22', '13:00:00', '18:00:00', 'Pending', NULL, 'Literary Festival', 'Event 1010-1713771048-imgMain.jpg', 'Event 1010-1713771048-1stImg.jpg', 'Event 1010-1713771048-2ndImg.jpg', 'Event 1010-1713771048-3rdImg.png', 'Event 1010-1713771048-4thImg.jpg', 'Event 1010-1713771048-5thImg.jpg', '2024-04-22 07:30:48'),
(38, 162, 'Customer', 'Event 10101010', 'intval($challengePoints)', 'Panadura', '2024-04-22', '2024-04-22', '13:44:00', '13:44:00', 'Pending', NULL, 'Book Launch', 'Event 10101010-1713773694-imgMain.jpg', 'Event 10101010-1713773694-1stImg.jpg', 'Event 10101010-1713773694-2ndImg.jpg', 'Event 10101010-1713773694-3rdImg.png', 'Event 10101010-1713773694-4thImg.jpg', 'Event 10101010-1713773694-5thImg.jpg', '2024-04-22 08:14:54'),
(39, 162, 'Customer', 'Event 10101010', 'z-index: 110;', 'BMICH Colombo', '2024-04-22', '2024-04-22', '13:50:00', '13:50:00', 'Pending', NULL, 'Book Launch', 'Event 10101010-1713774068-imgMain.jpg', 'Event 10101010-1713774068-1stImg.jpg', 'Event 10101010-1713774068-2ndImg.jpg', 'Event 10101010-1713774068-3rdImg.png', 'Event 10101010-1713774068-4thImg.jpg', 'Event 10101010-1713774068-5thImg.jpg', '2024-04-22 08:21:07'),
(40, 94, 'Publisher', 'book fair', 'book fair', 'BMICH', '2024-05-10', '2024-05-11', '00:00:00', '00:00:00', 'Pending', NULL, 'Book Launch', 'book fair94-img4.jpg', '', '', '', 'book fair94-img5.png', 'book fair94-img6.png', '2024-04-23 10:15:53'),
(41, 94, 'Publisher', 'book launch', 'book launch', 'nelum pokuna', '2024-04-30', '2024-05-30', '00:00:00', '00:00:00', 'Pending', NULL, 'Book Launch', 'book launch94-img1.jpg', '', '', '', '', '', '2024-04-23 10:26:09'),
(42, 94, 'Publisher', 'authors talk', 'talk with Mr.masibula', 'university of kelaniya', '2024-04-29', '2024-04-29', '00:00:00', '00:00:00', 'Pending', NULL, 'Author Talks', 'authors talk94-img1.jpg', '', '', '', '', '', '2024-04-23 10:30:38'),
(43, 162, 'Customer', 'Event 10101010', '$_SESSION[&#39;showModal1&#39;] = true;', 'Panadura', '2024-04-24', '2024-04-24', '09:31:00', '09:32:00', 'Pending', NULL, 'Book Launch', 'Event 10101010-1713931363-imgMain.jpg', 'Event 10101010-1713931363-1stImg.jpg', 'Event 10101010-1713931363-2ndImg.jpg', 'Event 10101010-1713931363-3rdImg.png', 'Event 10101010-1713931363-4thImg.jpg', 'Event 10101010-1713931363-5thImg.jpg', '2024-04-24 04:02:44'),
(44, 162, 'Customer', 'Event 10101010', '$_SESSION[&#39;showModal1&#39;] = true;', 'Panadura', '2024-04-24', '2024-04-24', '09:33:00', '09:33:00', 'Pending', NULL, 'Book Launch', 'Event 10101010-1713931458-imgMain.jpg', 'Event 10101010-1713931458-1stImg.jpg', 'Event 10101010-1713931458-2ndImg.jpg', 'Event 10101010-1713931458-3rdImg.png', 'Event 10101010-1713931458-4thImg.jpg', 'Event 10101010-1713931458-5thImg.jpg', '2024-04-24 04:04:19'),
(45, 137, 'Customer', 'Event 10101010', 'public function addEvent(){\r\n        if(!isLoggedInPublisher()){\r\n            redirect(&#39;landing/login&#39;);\r\n        }\r\n        \r\n        if($_SERVER[&#39;REQUEST_METHOD&#39;]==&#39;POST&#39;){\r\n            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);\r\n\r\n            if(isset($_SESSION[&#39;user_id&#39;])){\r\n                $user_id = $_SESSION[&#39;user_id&#39;];\r\n                $publisherDetails = $this->publisherModel->findPublisherById($user_id);\r\n                $eventCategoryDetails = $this->adminModel->getEventCategories();\r\n            }\r\n\r\n            $data=[\r\n                &#39;publisherName&#39; => $publisherDetails[0]->name,\r\n                &#39;user_type&#39;=> &#39;Publisher&#39;,\r\n                &#39;user_id&#39;=>trim($user_id),\r\n                &#39;title&#39;=>trim($_POST[&#39;title&#39;]),\r\n                &#39;description&#39;=>trim($_POST[&#39;description&#39;]),\r\n                &#39;location&#39;=>trim($_POST[&#39;location&#39;]),\r\n                &#39;start_date&#39;=>trim($_POST[&#39;start_date&#39;]),\r\n                &#39;end_date&#39;=>trim($_POST[&#39;end_date&#39;]),\r\n                &#39;category&#39;=>trim($_POST[&#39;category&#39;]),\r\n                &#39;poster&#39;=>&#39;&#39;,\r\n                &#39;title_err&#39;=>&#39;&#39;,\r\n                &#39;description_err&#39;=>&#39;&#39;,\r\n                &#39;location_err&#39;=>&#39;&#39;,\r\n                &#39;start_date_err&#39;=>&#39;&#39;,\r\n                &#39;end_date_err&#39;=>&#39;&#39;,\r\n                &#39;category_err&#39;=>&#39;&#39;\r\n            ];\r\n\r\n            if(empty($data[&#39;title&#39;])){\r\n                $data[&#39;title_err&#39;] = &#39;Please enter event title&#39;;\r\n            }\r\n            if(empty($data[&#39;description&#39;])){\r\n                $data[&#39;description_err&#39;] = &#39;Please enter event description&#39;;\r\n            }\r\n            if(empty($data[&#39;location&#39;])){\r\n                $data[&#39;location_err&#39;] = &#39;Please enter event location&#39;;\r\n            }\r\n            if(empty($data[&#39;start_date&#39;])){\r\n                $data[&#39;start_date_err&#39;] = &#39;Please enter event date&#39;;\r\n            }\r\n            if(empty($data[&#39;end_date&#39;])){\r\n                $data[&#39;end_date_err&#39;] = &#39;Please enter event end date&#39;;\r\n            }\r\n            if(empty($data[&#39;category&#39;])){\r\n                $data[&#39;category_err&#39;] = &#39;Please select event category&#39;;\r\n            }\r\n\r\n            if(empty($data[&#39;title_err&#39;]) && empty($data[&#39;description_err&#39;]) && empty($data[&#39;location_err&#39;]) && empty($data[&#39;start_date_err&#39;]) && empty($data[&#39;end_date_err&#39;]) && empty($data[&#39;category_err&#39;])){\r\n                if (isset($_FILES[&#39;poster&#39;][&#39;name&#39;]) AND !empty($_FILES[&#39;poster&#39;][&#39;name&#39;])) {\r\n            \r\n            \r\n                    $img_name = $_FILES[&#39;poster&#39;][&#39;name&#39;];\r\n                    $tmp_name = $_FILES[&#39;poster&#39;][&#39;tmp_name&#39;];\r\n                    $error = $_FILES[&#39;poster&#39;][&#39;error&#39;];\r\n                    \r\n                    if($error === 0){\r\n                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);\r\n                    $img_ex_to_lc = strtolower($img_ex);\r\n        \r\n                    $allowed_exs = array(&#39;jpg&#39;, &#39;jpeg&#39;, &#39;png&#39;);\r\n                    if(in_array($img_ex_to_lc, $allowed_exs)){\r\n                        $new_img_name = $data[&#39;title&#39;].$data[&#39;user_id&#39;] .&#39;-img1.&#39;. $img_ex_to_lc;\r\n                        $img_upload_path = &#34;../public/assets/images/landing/addevents/&#34;.$new_img_name;\r\n                        move_uploaded_file($tmp_name, $img_upload_path);\r\n\r\n                        $data[&#39;poster&#39;]=$new_img_name;\r\n                    }\r\n                    }\r\n                }\r\n\r\n                if($this->publisherModel->addEvent($data)){\r\n                    // flash(&#39;add_success&#39;,&#39;You are added the event successfully&#39;);\r\n                    $_SESSION[&#39;showModal&#39;] = true;\r\n                    redirect(&#39;publisher/events&#39;);\r\n                }else{\r\n                    die(&#39;Something went wrong&#39;);\r\n                }\r\n            }else{\r\n                $this->view(&#39;publisher/addEvent&#39;,$data);\r\n            }\r\n        }\r\n        \r\n        else{\r\n            if(isset($_SESSION[&#39;user_id&#39;])){\r\n                $user_id = $_SESSION[&#39;user_id&#39;];\r\n                $eventCategoryDetails = $this->adminModel->getEventCategories();\r\n                $publisherDetails = $this->publisherModel->findPublisherById($user_id);\r\n            }\r\n            $data=[\r\n                &#39;publisherDetails&#39; => $publisherDetails,\r\n                &#39;publisher_id&#39; => $publisherDetails[0]->publisher_id,\r\n                &#39;publisherName&#39; => $publisherDetails[0]->name,\r\n                &#39;eventCategoryDetails&#39;=>$eventCategoryDetails,\r\n                &#39;user_type&#39;=> &#39;Publisher&#39;,\r\n                &#39;title&#39;=>&#39;&#39;,\r\n                &#39;description&#39;=>&#39;&#39;,\r\n                &#39;location&#39;=>&#39;&#39;,\r\n                &#39;start_date&#39;=>&#39;&#39;,\r\n                &#39;end_date&#39;=>&#39;&#39;,\r\n                &#39;category&#39;=>&#39;&#39;,\r\n\r\n                &#39;title_err&#39;=>&#39;&#39;,\r\n                &#39;description_err&#39;=>&#39;&#39;,\r\n                &#39;location_err&#39;=>&#39;&#39;,\r\n                &#39;start_date_err&#39;=>&#39;&#39;,\r\n                &#39;end_date_err&#39;=>&#39;&#39;,\r\n                &#39;category_err&#39;=>&#39;&#39;\r\n\r\n            ];\r\n            $this->view(&#39;publisher/addEvent&#39;,$data);\r\n        }\r\n        \r\n    }', 'Panadura', '2024-04-24', '2024-04-24', '09:49:00', '21:49:00', 'Pending', NULL, 'Book Launch', 'Event 10101010-1713932386-imgMain.jpg', 'Event 10101010-1713932386-1stImg.jpg', 'Event 10101010-1713932386-2ndImg.jpg', 'Event 10101010-1713932386-3rdImg.png', 'Event 10101010-1713932386-4thImg.jpg', 'Event 10101010-1713932386-5thImg.jpg', '2024-04-24 04:19:47'),
(46, 137, 'Customer', 'Event 10101010', 'public function addEvent()', 'Panadura', '2024-04-28', '2024-05-01', '21:50:00', '21:50:00', 'Pending', NULL, 'Book Launch', '', '', '', '', '', '', '2024-04-24 04:21:27'),
(48, 94, 'Publisher', '123456789', '1236544', 'Panadura', '2024-04-24', '2024-04-24', '00:00:00', '00:00:00', 'Pending', NULL, 'Literary Festival', '12345678994-img1.jpg', '', '', '', '', '', '2024-04-24 04:35:36'),
(49, 94, 'Publisher', '123456789', '1236544', 'Panadura', '2024-04-24', '2024-04-24', '00:00:00', '00:00:00', 'Pending', NULL, 'Literary Festival', '12345678994-img1.jpg', '', '', '', '', '', '2024-04-24 04:37:32'),
(50, 94, 'Publisher', '123456789', '1236544', 'BMICH Colombo', '2024-04-24', '2024-04-27', '00:00:00', '00:00:00', 'Pending', NULL, 'Book Launch', '12345678994-img1.jpg', '', '', '', '', '', '2024-04-24 07:04:19'),
(52, 94, 'Publisher', '1234567896', '1236544', 'Panadura', '2024-04-24', '2024-04-24', '00:00:00', '00:00:00', 'Pending', NULL, 'Book Launch', '123456789694-img1.jpg', '', '', '', '', '', '2024-04-24 07:17:05'),
(53, 94, 'Publisher', '123456789', '1236544', 'Panadura', '2024-04-24', '2024-04-24', '00:00:00', '00:00:00', 'Pending', NULL, 'Book Launch', '12345678994-img1.jpg', '', '', '', '', '', '2024-04-24 07:18:46'),
(54, 94, 'Publisher', '123456789', '1236544', 'Panadura', '2024-04-24', '2024-04-24', '00:00:00', '00:00:00', 'Pending', NULL, 'Literary Festival', '12345678994-img1.jpg', '', '', '', '', '', '2024-04-24 07:21:33'),
(57, 94, 'Publisher', 'book store open', 'book store open i colombo', 'colombo 7', '2024-05-03', '2024-05-03', '10:27:00', '00:27:00', 'Pending', NULL, 'Book Launch', 'book store open94-img4.jpg', '', '', '', 'book store open94-img5.jpg', 'book store open94-img6.png', '2024-04-26 04:59:23'),
(58, 137, 'Customer', 'Event 250', 'validateForm', 'Panadura', '2024-04-24', '2024-04-11', '11:07:00', '11:07:00', 'Approved', NULL, 'Author Talks', '', '', '', '', '', '', '2024-04-28 05:38:01'),
(59, 137, 'Customer', 'Event 250', 'validateForm', 'Panadura', '2024-04-22', '2024-04-30', '13:10:00', '23:10:00', 'Approved', NULL, 'Author Talks', '', '', '', '', '', '', '2024-04-28 05:44:19'),
(60, 137, 'Customer', 'Event 10101010', 'equal to orequal to or', 'Panadura', '2024-04-30', '2024-04-30', '11:16:00', '23:17:00', 'Pending', NULL, 'Book Launch', 'Event 10101010-1714303775-imgMain.png', 'Event 10101010-1714303775-1stImg.png', 'Event 10101010-1714303775-2ndImg.png', 'Event 10101010-1714303775-3rdImg.png', 'Event 10101010-1714303775-4thImg.png', 'Event 10101010-1714303775-5thImg.png', '2024-04-28 05:48:21'),
(61, 137, 'Customer', 'Event 01', 'min=&#34;', 'Panadura', '2024-04-28', '2024-04-22', '11:46:00', '11:42:00', 'Pending', NULL, 'Book Launch', 'Event 01-1714285032-imgMain.jpg', 'Event 01-1714285032-1stImg.jpg', 'Event 01-1714285032-2ndImg.png', 'Event 01-1714285032-3rdImg.png', 'Event 01-1714285032-4thImg.png', 'Event 01-1714285032-5thImg.jpg', '2024-04-28 06:17:14'),
(62, 137, 'Customer', 'Event 01', 'min=&#34;', 'Panadura', '2024-04-28', '2024-04-13', '11:49:00', '11:49:00', 'Pending', NULL, 'Book Launch', 'Event 01-1714285191-imgMain.png', 'Event 01-1714285191-1stImg.png', 'Event 01-1714285191-2ndImg.png', 'Event 01-1714285191-3rdImg.png', 'Event 01-1714285191-4thImg.png', 'Event 01-1714285191-5thImg.png', '2024-04-28 06:19:53'),
(63, 137, 'Customer', 'Event 250', 'validateForm', 'BMICH Colombo', '2024-04-29', '2024-04-30', '11:57:00', '23:09:00', 'Pending', NULL, 'Book Launch', 'Event 250-1714285719-imgMain.png', 'Event 250-1714285719-1stImg.png', 'Event 250-1714285719-2ndImg.jpg', 'Event 250-1714285719-3rdImg.jpg', 'Event 250-1714285719-4thImg.jpg', 'Event 250-1714285719-5thImg.png', '2024-04-28 06:28:41'),
(64, 137, 'Customer', 'Event 1010', 'Start date must be equal to or after today.', 'Panadura', '2024-04-28', '2024-04-28', '00:27:00', '00:27:00', 'Pending', NULL, 'Book Launch', '', '', '', '', '', '', '2024-04-28 06:58:56'),
(65, 94, 'Publisher', 'Literary Evening. Exploring Sri Lankan Poetry', 'Join us for an enchanting evening celebrating the rich tapestry of Sri Lankan poetry. Hosted by Rohitha publishers, this event will feature renowned poets from across Sri Lanka, sharing their works and insights into the diverse cultural landscape of the island nation', 'Lotus Hall, Colombo City Hotel, 123 Galle Road, Colombo, Sri Lanka', '2024-04-28', '2024-05-15', '18:00:00', '17:00:00', 'Pending', NULL, 'Literary Festival', 'Literary Evening. Exploring Sri Lankan Poetry94-img4.png', '', '', '', 'Literary Evening. Exploring Sri Lankan Poetry94-img5.jpeg', 'Literary Evening. Exploring Sri Lankan Poetry94-img6.jpeg', '2024-04-28 10:48:07'),
(66, 186, 'Customer', 'Book Launch Extravaganza', 'Join us for the launch of the latest books by bestselling authors. There will be a book signing and a chance to meet the authors.', 'BMICH', '2024-05-06', '2024-05-10', '08:00:00', '15:00:00', 'Approved', NULL, 'Book Launch', 'Book Launch Extravaganza01.jpg', 'Book Launch Extravaganza02.jpg', 'Book Launch Extravaganza03.jpg', 'Book Launch Extravaganza04.jpg', 'Book Launch Extravaganza05.jpg', 'Book Launch Extravaganza06.jpg', '2024-04-29 05:15:17'),
(67, 186, 'Customer', 'Insightful Author Talk', 'Join us for an insightful talk by renowned author Kathyana Amarasinghe on their latest book. The author will discuss their inspiration, writing process, and more.', 'BMICH', '2024-05-24', '2024-04-24', '08:00:00', '13:00:00', 'Approved', NULL, 'Author Talks', 'Insightful Author Talk01.jpg', 'Insightful Author Talk02.jpg', 'Insightful Author Talk03.jpg', 'Insightful Author Talk04.jpg', 'Insightful Author Talk05.jpg', 'Insightful Author Talk06.jpg', '2024-04-29 05:23:35'),
(68, 186, 'Customer', 'Literary Luminaries Festival', 'Join us for a celebration of literature at our annual Literary Festival. The event will feature book readings, panel discussions, book signings, and more. Don&#39;t miss this opportunity to immerse yourself in the world of books and authors.', 'BMICH', '2024-05-16', '2024-05-18', '08:00:00', '01:00:00', 'Approved', NULL, 'Literary Festival', 'Literary Luminaries Festival01.jpg', 'Literary Luminaries Festival02.jpg', 'Literary Luminaries Festival03.jpg', 'Literary Luminaries Festival04.jpg', 'Literary Luminaries Festival05.jpg', 'Literary Luminaries Festival06.jpg', '2024-04-29 06:03:19'),
(69, 183, 'Customer', 'Autographs & Authors', 'Meet your favorite authors and get your books signed at our exclusive book signing event! Join us for a day filled with literary excitement, meet-and-greets, and special editions available for purchase.', 'Colombo City Library', '2024-06-15', '2024-06-15', '10:00:00', '16:00:00', 'Pending', NULL, 'Book Signing', '', '', '', '', '', '', '2024-04-29 06:14:34'),
(70, 182, 'Customer', 'Book Fair Extravaganza', 'Join us for a weekend of literary delight at our Book Fair Extravaganza. Browse through a wide selection of books, attend author signings, and participate in book-related activities.', 'BMICH', '2024-09-20', '2024-09-22', '10:00:00', '18:00:00', 'Approved', NULL, 'Literary Festival', 'Book Fair Extravaganza01.jpg', 'Book Fair Extravaganza02.jpg', 'Book Fair Extravaganza03.jpg', 'Book Fair Extravaganza04.jpg', 'Book Fair Extravaganza05.jpg', 'Book Fair Extravaganza06.jpg', '2024-04-29 06:20:51'),
(71, 183, 'Customer', 'Author Spotlight Series', 'Join us every Saturday for our Author Spotlight Series, where local authors will present their latest works and engage in discussions with the audience.', 'Colombo City Library', '2024-05-17', '2024-05-19', '10:00:00', '20:00:00', 'Pending', NULL, 'Literary Festival', '', '', '', '', '', '', '2024-04-29 06:25:36'),
(72, 182, 'Customer', 'Poetry Slam Night', 'Join us for an evening of poetic expression at our Poetry Slam Night. Poets of all levels are welcome to share their work in a supportive environment.', 'BMICH', '2024-05-18', '2024-05-19', '10:00:00', '23:00:00', 'Pending', NULL, 'Literary Festival', '', '', '', '', '', '', '2024-04-29 06:29:11'),
(73, 182, 'Customer', 'Literary Quiz Night', 'Test your literary knowledge at our fun and interactive Literary Quiz Night. Form a team or join one on the spot for a chance to win prizes', 'BMICH', '2024-05-17', '2024-05-17', '21:00:00', '23:00:00', 'Approved', NULL, 'Literary Festival', 'Literary Quiz Night01.jpg', 'Literary Quiz Night02.jpg', 'Literary Quiz Night03.jpg', 'Literary Quiz Night04.jpg', 'Literary Quiz Night05.jpg', 'Literary Quiz Night06.jpg', '2024-04-29 06:35:47'),
(74, 183, 'Customer', 'Storytelling Workshop for Kids', 'Spark your child&#39;s imagination at our Storytelling Workshop. Professional storytellers will engage children with captivating tales and interactive activities.', 'Colombo City Library', '2024-05-10', '2024-05-12', '10:00:00', '17:00:00', 'Approved', NULL, 'Literary Festival', 'Storytelling Workshop for Kids01.jpg', 'Storytelling Workshop for Kids02.jpg', 'Storytelling Workshop for Kids03.jpg', 'Storytelling Workshop for Kids04.jpg', 'Storytelling Workshop for Kids05.jpg', 'Storytelling Workshop for Kids06.jpg', '2024-04-29 06:41:32'),
(75, 184, 'Customer', 'Literary Open Mic Night', 'Showcase your literary talents at our Open Mic Night. Poets, storytellers, and writers are invited to share their work with a supportive audience.', 'BMICH', '2024-05-30', '2024-05-30', '18:00:00', '23:00:00', 'Approved', NULL, 'Literary Festival', 'Literary Open Mic Night01.jpg', 'Literary Open Mic Night02.jpg', 'Literary Open Mic Night03.jpg', 'Literary Open Mic Night04.jpg', 'Literary Open Mic Night05.jpg', 'Literary Open Mic Night06.jpg', '2024-04-29 06:45:13'),
(76, 185, 'Customer', 'Literary Scavenger Hunt', 'Embark on a literary adventure with our Scavenger Hunt. Follow clues related to books and authors to discover hidden treasures in the bookstore.', 'Colombo City Library', '2024-05-31', '2024-05-31', '09:00:00', '19:00:00', 'Approved', NULL, 'Literary Festival', 'Literary Scavenger Hunt01.jpg', 'Literary Scavenger Hunt02.jpg', 'Literary Scavenger Hunt03.jpg', 'Literary Scavenger Hunt04.jpg', 'Literary Scavenger Hunt05.jpg', 'Literary Scavenger Hunt06.jpg', '2024-04-29 06:53:30'),
(77, 184, 'Customer', 'Bookbinding Workshop', 'Learn the art of bookbinding at our hands-on workshop. Create your own personalized notebook using traditional bookbinding techniques.', 'BMICH', '2024-05-18', '2024-05-18', '08:00:00', '20:00:00', 'Pending', NULL, 'Book Launch', '', '', '', '', '', '', '2024-04-29 06:58:30'),
(78, 153, 'Customer', 'Kaumadi Event 01', 'Kaumadi', 'Colombo', '2024-04-30', '2024-05-02', '13:18:00', '13:18:00', 'Pending', NULL, 'Book Launch', 'Kaumadi Event 01-1714376978-imgMain.jpg', 'Kaumadi Event 01-1714376978-1stImg.jpg', 'Kaumadi Event 01-1714376978-2ndImg.jpg', 'Kaumadi Event 01-1714376978-3rdImg.jpg', 'Kaumadi Event 01-1714376978-4thImg.jpg', 'Kaumadi Event 01-1714376978-5thImg.jpg', '2024-04-29 07:50:26'),
(79, 184, 'Customer', 'A Journey Through Time', 'Celebrate the launch of &#34;A Journey Through Time,&#34; a captivating memoir by local authors. Meet the authors, hear readings from the book, and enjoy light refreshments.', 'Colombo Main Library', '2024-05-24', '2024-05-24', '17:30:00', '20:30:00', 'Pending', NULL, 'Book Launch', 'A Journey Through Time-1714377471-imgMain.jpg', '', '', '', '', '', '2024-04-29 07:57:51'),
(80, 185, 'Customer', 'The Art of Fiction', 'Meet the bestselling author as he signs copies of his latest book, &#34;The Art of Fiction.&#34; Purchase a copy and have it personally signed by the author.', 'BMICH', '2024-05-02', '2024-05-02', '08:30:00', '11:30:00', 'Pending', NULL, 'Book Signing', 'The Art of Fiction-1714377727-imgMain.jpg', '', '', '', '', '', '2024-04-29 08:02:07'),
(81, 185, 'Customer', 'The Last Adventure', 'Meet acclaimed authors and get your copy of &#34;The Last Adventure&#34; signed. Engage in conversation with the authors and fellow book lovers.', 'Colombo City Library', '2024-05-14', '2024-05-14', '17:00:00', '20:00:00', 'Pending', NULL, 'Author Talks', 'The Last Adventure-1714378228-imgMain.jpg', '', '', '', '', '', '2024-04-29 08:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id`, `event`, `description`) VALUES
(1, 'Book Launch', 'Events related to the launch of a new book.'),
(2, 'Author Talks', 'Events where authors discuss their books, writing process, and more.'),
(3, 'Literary Festival', 'Large-scale festivals celebrating literature and books.'),
(4, 'Book Signing', 'Events where authors sign copies of their books and interact with readers.');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `fav_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`fav_id`, `item_id`, `customer_id`, `topic`, `category`) VALUES
(7, 4, 21, 'ELEPHANT WALK BY ROBERT STANDISH', 'Content'),
(12, 7, 29, 'How to write book review', 'Content'),
(23, 126, 29, 'ikigai', 'Used Book'),
(25, 128, 29, 'ABCD EFGH IJKL MNOP QRST', 'Exchange Book'),
(32, 136, 36, 'Twisted Lies', 'New Book'),
(34, 6, 21, 'The Road Not Taken&#34; by Robert Frost', 'Content'),
(35, 185, 21, 'First Prize For The Worst Witch', 'New Book');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `attempt_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`user_id`, `quiz_id`, `score`, `attempt_date`) VALUES
(137, 1, 18, '2024-02-24 13:24:27'),
(137, 2, 8, '2024-04-23 07:00:37'),
(137, 3, 6, '2024-04-26 14:22:17'),
(153, 1, 12, '2024-04-07 13:49:24'),
(153, 2, 6, '2024-04-28 10:06:38'),
(153, 9, 4, '2024-04-29 21:30:51'),
(162, 1, 10, '2024-02-24 13:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(46, 130, 92, 'we\'ve noticed an increase in pending content submissions. Can you please prioritize reviewing them?'),
(48, 153, 137, 'hi,i want to buy ikigya book'),
(49, 153, 137, 'why did not reply yet'),
(56, 92, 130, 'i look into it'),
(57, 130, 84, 'can u give me your complaints list please?'),
(60, 130, 84, 'hi'),
(61, 137, 94, 'how are you'),
(62, 153, 181, 'Hi, Like to buy your book.Can u reduce the book price'),
(63, 153, 137, 'hloo!'),
(64, 186, 137, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read') DEFAULT 'unread',
  `topic` varchar(500) NOT NULL,
  `sender_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `parent_id`, `sender_id`, `user_id`, `message`, `timestamp`, `status`, `topic`, `sender_name`) VALUES
(71, 0, NULL, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 00:05:18', 'unread', 'New Order Details', 'system administration'),
(72, 0, NULL, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 48170544988330516', '2024-01-17 00:05:18', 'unread', 'New Order Details', 'system administration'),
(73, 0, NULL, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 00:08:18', 'unread', 'New Order Details', 'system administration'),
(74, 0, NULL, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 48170544991855384', '2024-01-17 00:08:18', 'read', 'New Order Details', 'system administration'),
(75, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 00:11:29', 'read', 'New Order Details', 'system administration'),
(76, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 48170545009891726', '2024-01-17 00:11:29', 'unread', 'New Order Details', 'system administration'),
(77, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 00:13:55', 'unread', 'New Order Details', 'system administration'),
(78, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 0', '2024-01-17 00:13:55', 'unread', 'New Order Details', 'system administration'),
(79, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 00:16:13', 'unread', 'New Order Details', 'system administration'),
(80, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 49170545043589433', '2024-01-17 00:16:13', 'read', 'New Order Details', 'system administration'),
(90, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 11:16:30', 'unread', 'New Order Details', 'system administration'),
(91, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 0', '2024-01-17 11:16:30', 'unread', 'New Order Details', 'system administration'),
(92, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-17 13:46:53', 'unread', 'New Order Details', 'system administration'),
(93, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number 0', '2024-01-17 13:46:53', 'unread', 'New Order Details', 'system administration'),
(94, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-23 14:40:04', 'unread', 'New Order Details', 'system administration'),
(95, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-01-23 14:40:04', 'unread', 'New Order Details', 'system administration'),
(100, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-28 03:41:07', 'unread', 'New Order Details', 'system administration'),
(101, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-01-28 03:41:07', 'unread', 'New Order Details', 'system administration'),
(102, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-01-30 10:32:21', 'unread', 'New Order Details', 'system administration'),
(103, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-01-30 10:32:21', 'unread', 'New Order Details', 'system administration'),
(109, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-02-06 14:45:28', 'read', 'New Order Details', 'system administration'),
(110, 0, 130, 137, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-02-07 04:12:11', 'unread', 'New Order Details', 'system administration'),
(111, 0, 130, 94, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-02-07 04:12:11', 'read', 'New Order Details', 'system administration'),
(112, NULL, 143, 137, 'picked up  your order from the pick up location  successfully', '2024-02-18 15:56:11', 'unread', 'Delivery Status', 'delivery person'),
(113, NULL, 143, 94, 'Picked up   your order from  your location  successfully', '2024-02-18 15:56:11', 'unread', 'Delivery Status', 'delivery person'),
(114, NULL, 143, 137, 'Delivered  your order from the pick up location to your location successfully', '2024-02-18 15:57:03', 'unread', 'Delivery Status', 'delivery person'),
(115, NULL, 143, 94, 'Delivered  your order from the your location to your customer\'s  location successfully', '2024-02-18 15:57:03', 'unread', 'Delivery Status', 'delivery person'),
(116, NULL, 143, 137, 'Delivered  your order from the pick up location to your location successfully', '2024-02-18 16:04:36', 'unread', 'Delivery Status', 'delivery person'),
(117, NULL, 143, 94, 'Delivered  your order from the your location to your customer\'s  location successfully', '2024-02-18 16:04:36', 'read', 'Delivery Status', 'delivery person'),
(118, NULL, 130, 94, 'We are pleased to inform you that the payment for the books you supplied has been successfully processed. These books have been delivered to their respective buyers, marking the completion of another successful transaction:\r\n\r\n        Order ID: .193\r\n        Book ID: .123\r\n        Total Payment: .1368.00\r\n        \r\n        We appreciate your valuable contribution to our platform and the quality literature you provide. Your continued partnership is integral to our success.\r\n        \r\n        Thank you for your dedication and support. ', '2024-04-16 14:26:06', 'read', 'Payment Confirmation: Books Delivered to Buyers', 'System_Administration'),
(119, NULL, 130, 94, 'We are pleased to inform you that the payment for the books you supplied has been successfully processed. These books have been delivered to their respective buyers, marking the completion of another successful transaction: ', '2024-04-16 14:47:35', 'read', 'Payment Confirmation: Books Delivered to Buyers', 'System_Administration'),
(120, NULL, 130, 94, 'We are pleased to inform you that the payment for the books you supplied has been successfully processed. These books have been delivered to their respective buyers, marking the completion of another successful transaction: ', '2024-04-16 14:55:07', 'read', 'Payment Confirmation: Books Delivered to Buyers', 'System_Administration'),
(121, NULL, 130, 94, 'We are pleased to inform you that the payment for the books you supplied has been successfully processed. These books have been delivered to their respective buyers, marking the completion of another successful transaction: ', '2024-04-16 14:55:21', 'read', 'Payment Confirmation: Books Delivered to Buyers', 'System_Administration'),
(122, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-23 00:43:02', 'unread', 'New Order Details', 'system administration'),
(123, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 00:43:03', 'unread', 'New Order Details', 'system administration'),
(124, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 00:43:03', 'unread', 'New Order Details', 'system administration'),
(125, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-23 09:57:31', 'unread', 'New Order Details', 'system administration'),
(126, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 09:57:31', 'unread', 'New Order Details', 'system administration'),
(127, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 09:57:32', 'unread', 'New Order Details', 'system administration'),
(128, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-23 10:03:28', 'unread', 'New Order Details', 'system administration'),
(129, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 10:03:29', 'unread', 'New Order Details', 'system administration'),
(130, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 10:03:29', 'unread', 'New Order Details', 'system administration'),
(131, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-23 11:38:07', 'unread', 'New Order Details', 'system administration'),
(132, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 11:38:07', 'unread', 'New Order Details', 'system administration'),
(133, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 11:38:07', 'unread', 'New Order Details', 'system administration'),
(134, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-23 11:40:17', 'unread', 'New Order Details', 'system administration'),
(135, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 11:40:17', 'unread', 'New Order Details', 'system administration'),
(136, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-23 11:40:17', 'unread', 'New Order Details', 'system administration'),
(137, NULL, 143, 137, 'We are excited to inform you that your order has been successfully picked up from the designated location. Our team is now on the move to ensure swift delivery to your doorstep. Rest assured, your package is en route and will soon be in your hands. Thank you for choosing us!', '2024-04-24 10:38:38', 'unread', 'Delivery Status', 'delivery person'),
(138, NULL, 143, 94, 'We are pleased to notify you that the order (order_id:. 235.)  has been successfully picked up from your location.  Our delivery team has ensured a smooth pickup process and everything is on track for the next stage.\n\n            Thank you for promptly preparing the order and making it ready for pickup. Your cooperation is invaluable in ensuring timely deliveries to our customers.\n            \n            Warm regards,Readspot Team', '2024-04-24 10:38:38', 'read', 'Delivery Status', 'delivery person'),
(139, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-25 05:21:46', 'unread', 'New Order Details', 'system administration'),
(140, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-25 05:21:46', 'unread', 'New Order Details', 'system administration'),
(141, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-26 00:49:56', 'unread', 'New Order Details', 'system administration'),
(142, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-26 00:49:57', 'unread', 'New Order Details', 'system administration'),
(143, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-28 11:37:37', 'unread', 'New Order Details', 'system administration'),
(144, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-28 11:37:37', 'unread', 'New Order Details', 'system administration'),
(145, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-29 19:55:53', 'unread', 'New Order Details', 'system administration'),
(146, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-29 19:55:53', 'unread', 'New Order Details', 'system administration'),
(147, NULL, 130, NULL, 'Congratulations! Your order has been processing now. Order will be received at home as soon as possible.', '2024-04-30 06:29:45', 'unread', 'New Order Details', 'system administration'),
(148, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-30 06:29:45', 'unread', 'New Order Details', 'system administration'),
(149, NULL, 130, NULL, 'Congratulations! You have a new order. Login to the site and visit your order status by this tracking number ', '2024-04-30 06:29:45', 'unread', 'New Order Details', 'system administration');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `moderator_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` enum('approval','reject','restrict') NOT NULL DEFAULT 'approval',
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`moderator_id`, `user_id`, `profile_img`, `name`, `email`, `pass`, `status`, `restriction_date`) VALUES
(1, 92, '', 'moderator', 'moderator@gmail.com', '1234567', 'approval', NULL);

--
-- Triggers `moderator`
--
DELIMITER $$
CREATE TRIGGER `after_insert_moderator` AFTER INSERT ON `moderator` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_moderatorn` AFTER INSERT ON `moderator` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_moderator` AFTER UPDATE ON `moderator` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_moderatorn` AFTER UPDATE ON `moderator` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `tracking_no` bigint(20) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) DEFAULT NULL,
  `total_weight` int(11) DEFAULT NULL,
  `total_delivery` int(11) DEFAULT NULL,
  `payment_type` enum('OnlineDeposit','cardPayment','COD') DEFAULT NULL,
  `recipt` varchar(100) DEFAULT NULL,
  `c_postal_name` varchar(200) DEFAULT NULL,
  `c_street_name` varchar(200) DEFAULT NULL,
  `c_town` varchar(200) DEFAULT NULL,
  `c_district` varchar(200) DEFAULT NULL,
  `c_postal_code` varchar(200) DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `tracking_no`, `customer_id`, `order_date`, `total_price`, `total_weight`, `total_delivery`, `payment_type`, `recipt`, `c_postal_name`, `c_street_name`, `c_town`, `c_district`, `c_postal_code`, `contact_no`) VALUES
(235, 235171386659560190, 21, '2024-04-23 10:03:15', '2920.00', 400, 350, 'COD', NULL, 'reciever', 'reciever', 'reciever', 'Ampara', '7899', '0766644721'),
(236, 236171387227491225, 21, '2024-04-23 11:37:54', '2645.00', 420, 350, 'COD', NULL, 'reciever', 'reciever', 'reciever', 'Ampara', '7899', '0786767675'),
(237, 237171387240630336, 21, '2024-04-23 11:39:25', '4699.76', 780, 350, 'cardPayment', NULL, 'reciever', 'reciever', 'reciever', 'Ampara', '7899', '0476767675'),
(239, 239171402249466945, 29, '2024-04-25 05:20:34', '777.50', 220, 350, 'cardPayment', NULL, '163, Priyankara Mawatha, Paraththa, Keselwaththa', 'Western', 'Panadura', 'Kalutara', '12550', '0772888098'),
(240, 240171402410248027, 21, '2024-04-25 05:48:22', '1430.00', 170, 350, 'OnlineDeposit', '6629eea6505c6-48.jpg', 'reciever', 'reciever', 'reciever', 'Ampara', '7899', '0786767675'),
(241, 241171409258833140, 29, '2024-04-26 00:49:48', '1850.00', 200, 350, 'COD', NULL, '163, Priyankara Mawatha, Paraththa, Keselwaththa', 'Western', 'Panadura', 'Kalutara', '12550', '0786767876'),
(242, 242171430420020348, 39, '2024-04-28 11:36:05', '1320.00', 200, 350, 'cardPayment', NULL, 'pathumi', '38/2, &#39;Jayanthi&#39;', 'Gonapola', 'Ampara', '12410', '0768881305'),
(243, 243171442049423956, 24, '2024-04-29 19:54:29', '1950.00', 200, 350, 'cardPayment', NULL, 'Kaumadi Dedigamuwa', 'Gonapola', 'Horana', 'Ampara', '12410', '+94774769958'),
(244, 244171445857560757, 21, '2024-04-30 06:29:05', '2889.76', 430, 350, 'cardPayment', NULL, 'reciever', 'Central', 'reciever', 'Ampara', '78990', '+94712345678'),
(245, 245171462327763540, 21, '2024-05-02 04:14:37', '1320.00', 200, 350, 'OnlineDeposit', '6633132d402a9-65dd45b622eb9-deposit-receipt-b39a92e2e1c31126f8b163aaaa9fad89.png', 'reciever', 'Central', 'reciever', 'Ampara', '78990', '+94712345678');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` enum('pending','processing','shipping','delivered','returned','cancel') NOT NULL DEFAULT 'pending',
  `reasonOfCancel` varchar(100) DEFAULT NULL,
  `sent_payment` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `book_id`, `quantity`, `status`, `reasonOfCancel`, `sent_payment`) VALUES
(235, 135, 1, 'pending', '', 0),
(235, 136, 1, 'cancel', 'I do not need this order anymore', 0),
(236, 119, 1, 'cancel', 'I do not need this order anymore', 0),
(236, 123, 1, 'cancel', 'I do not need this order anymore', 0),
(237, 117, 1, 'delivered', NULL, 0),
(237, 118, 1, 'shipping', NULL, 0),
(238, 136, 1, 'pending', NULL, 0),
(239, 120, 1, 'processing', NULL, 0),
(240, 116, 1, 'delivered', NULL, 0),
(241, 135, 1, 'shipping', NULL, 0),
(242, 136, 1, 'cancel', 'The seller raised the price of the order', 0),
(243, 135, 1, 'processing', NULL, 0),
(244, 117, 1, 'delivered', NULL, 0),
(244, 135, 1, 'delivered', NULL, 0),
(245, 136, 1, 'pending', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `book_id`, `payment`, `paid_date`, `user_id`, `quantity`) VALUES
(1, 193, 123, '1368.00', '2024-04-16 13:15:51', 94, 1),
(2, 194, 123, '1368.00', '2024-04-16 13:23:24', 94, 1),
(3, 195, 123, '1368.00', '2024-04-16 13:26:17', 94, 1),
(4, 195, 123, '1368.00', '2024-04-16 13:26:22', 94, 1);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `reg_no` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `postal_name` varchar(255) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approval','restrict','reject') NOT NULL DEFAULT 'pending',
  `profile_img` varchar(255) DEFAULT NULL,
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `name`, `company_name`, `reg_no`, `email`, `contact_no`, `pass`, `postal_name`, `street_name`, `town`, `district`, `postal_code`, `account_name`, `account_no`, `branch_name`, `bank_name`, `user_id`, `created_at`, `status`, `profile_img`, `restriction_date`) VALUES
(28, 'Pathumi Ahinsa', 'MD gunasena', '21000945', 'publisher@gmail.com', '+94774769958', '$2y$10$ZhvPfOTssx3fgJFR2jkNAO.1aWsgB0FzagFGblZM.j2PO7VcJiLe.', 'Rohitha book shop', 'Flower Road', 'Colombo 7', 'Colombo', '12410', 'pathumi', '62000897', 'tangalle', 'peoples', 94, '2023-11-22 02:10:28', 'approval', '94Pathumi Ahinsa-profile_img.jpg', NULL),
(38, 'Kaumadi', 'Rohitha Publications', '15230', 'ramath.perera2021@gmail.com', '+94774769958', '$2y$10$H6kSrHtGEicIjtRC0iGdeeekwMzxgnwf2tC1cCpK2OlSquAYdELEm', 'Kaumadi Dedigamuwa', '38/2, &#39;Jayanthi&#39;', 'Gonapola', 'Kalutara', '12410', 'P.D.Kaumadi', '20004305', 'Gonapola', 'BOC', 180, '2024-04-28 05:41:29', 'approval', '180Kaumadi-profile_img.jpeg', NULL),
(39, 'dinuki thisaranai', 'sarasavi2', '24235346', 'publisher3@gmail.com', '+94346933522', '$2y$10$12SyjHnbwdyv1OBRr/nqA.BfrgK6adOT4gN4emZ.pyE0dG2/7ZqeW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, '2024-04-30 06:26:38', 'pending', NULL, NULL);

--
-- Triggers `publishers`
--
DELIMITER $$
CREATE TRIGGER `after_insert_customer` AFTER INSERT ON `publishers` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_publishern` AFTER INSERT ON `publishers` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_publishers` AFTER UPDATE ON `publishers` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_publishersn` AFTER UPDATE ON `publishers` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher_stores`
--

CREATE TABLE `publisher_stores` (
  `store_id` int(11) NOT NULL,
  `postal_name` varchar(100) NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `publisher_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publisher_stores`
--

INSERT INTO `publisher_stores` (`store_id`, `postal_name`, `street_name`, `town`, `district`, `postal_code`, `publisher_Id`) VALUES
(2, 'pathumi', 'godellaweela', 'tangalle', 'Matara', '82200', 28),
(3, 'pathumiiii', 'godellaweela', 'tangalle', 'Matale', '82200', 28),
(12, 'Ampara branch', 'No34/A', 'Ampara', 'Ampara', '56678', 28),
(13, 'pathumi', 'hvu', 'kn k', 'Kandy', 'ෆ්ක්ව්ඝ්බ්ජ්න්', 28);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `number_of_questions` int(11) NOT NULL,
  `time_limit` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NULL DEFAULT (`date` + interval 1 week),
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `title`, `number_of_questions`, `time_limit`, `description`, `date`, `end_date`, `img`) VALUES
(2, 'Literary Masterpieces Quiz', 5, 5, 'Test your knowledge of classic literature with our Literary Masterpieces Quiz!', '2024-02-25 14:05:08', '2024-05-15 14:05:08', 'challenge_img.jpg'),
(3, 'Romance Book Quiz: Test Your Love Story Knowledge', 5, 5, 'Welcome to the Romance Book Quiz! Test your knowledge of popular romance novels with these questions.', '2024-04-22 12:26:35', '2024-04-29 12:26:35', 'challenge1713788750-img.jpg'),
(11, 'Literary Legends Quiz', 5, 5, 'Dive into the world of literature and test your knowledge of literary legends with our &#34;Literary Legends Quiz&#34;! This quiz celebrates the iconic authors and timeless works that have left an indelible mark on the literary landscape.', '2024-04-30 01:48:07', '2024-05-07 01:48:07', 'challenge1714441638-img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `correctAnswer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`quiz_id`, `question_id`, `question`, `option1`, `option2`, `option3`, `correctAnswer`) VALUES
(1, 1, 'What is the name of Harry Potter&#39;s pet owl?', ' Hedwig', ' Scabbers', 'Crookshanks', 'opt1'),
(1, 2, 'Which Hogwarts house does Harry belong to?', ' Slytherin', 'Gryffindor', 'Hufflepuff', 'opt2'),
(1, 3, 'Who is the author of the Harry Potter series?', 'J.R.R. Tolkien', 'J.K. Rowling', ' C.S. Lewis', 'opt2'),
(1, 4, 'What is the name of the Hogwarts gamekeeper?', 'Hagrid', ' Snape', 'McGonagall', 'opt1'),
(1, 5, 'What is the name of Voldemort&#39;s snake?', 'Nagini', ' Norbert', 'Aragog', 'opt1'),
(2, 1, 'What is the title of J.K. Rowling&#39;s first Harry Potter book?', 'Harry Potter and the Sorcerer&#39;s Stone ', ' Harry Potter and the Goblet of Fire', 'Harry Potter and the Prisoner of Azkaban', 'opt1'),
(2, 2, 'In which classic novel would you find the characters Elizabeth Bennet and Mr. Darcy?', 'Jane Eyre', 'Wuthering Heights', 'Pride and Prejudice', 'opt3'),
(2, 3, 'Who is the author of &#34;To Kill a Mockingbird&#34;?', 'J.R.R. Tolkien', 'Harper Lee', 'J.D. Salinger', 'opt2'),
(2, 4, 'Who wrote &#34;The Great Gatsby&#34;?', 'F. Scott Fitzgerald', 'Ernest Hemingway', 'William Faulkner', 'opt1'),
(2, 5, 'What is the name of the character who lives in a cupboard under the stairs in the &#34;Harry Potter&#34; series?', 'Draco Malfoy', 'Hermione Granger', 'Harry Potter ', 'opt3'),
(3, 1, 'Who is the author of the famous romance novel &#34;Pride and Prejudice&#34;?', 'Jane Austen', ' Emily Brontë', ' Charlotte Brontë', 'opt1'),
(3, 2, 'In &#34;Romeo and Juliet&#34; by William Shakespeare, which family does Romeo belong to?', 'Capulet', 'Verona', ' Montague', 'opt3'),
(3, 3, 'Which novel features the love story of Heathcliff and Catherine Earnshaw?', 'Wuthering Heights by Emily Brontë', 'Jane Eyre by Charlotte Brontë', 'Tess of the d&#39;Urbervilles by Thomas Hardy', 'opt1'),
(3, 4, 'Who is the protagonist in Nicholas Sparks&#39; novel &#34;The Notebook&#34;?', 'Allie Hamilton', 'Noah Calhoun', 'Rachel McAdams', 'opt2'),
(3, 5, 'Which of the following books is NOT written by Nora Roberts?', 'The Wedding Date', 'Vision in White', 'he Witness', 'opt1'),
(11, 1, 'Who is the author of &#34;The Great Gatsby&#34;?', 'F. Scott Fitzgerald', ' Ernest Hemingway', ' John Steinbeck', 'opt1'),
(11, 2, 'Which novel features the character Atticus Finch and explores themes of racial injustice in the American South?', ' &#34;To Kill a Mockingbird&#34; by Harper Lee', ' &#34;The Catcher in the Rye&#34; by J.D. Salinger', '&#34;Of Mice and Men&#34; by John Steinbeck', 'opt1'),
(11, 3, 'Who wrote the epic fantasy series &#34;The Lord of the Rings&#34;?', 'J.R.R. Tolkien', 'C.S. Lewis', 'J.K. Rowling', 'opt1'),
(11, 4, 'In which novel would you find the characters Elizabeth Bennet and Mr. Darcy?', '&#34;Pride and Prejudice&#34; by Jane Austen', ' &#34;Jane Eyre&#34; by Charlotte Brontë', ' &#34;Wuthering Heights&#34; by Emily Brontë', 'opt1'),
(11, 5, 'Who is the author of the novel &#34;1984,&#34; which depicts a dystopian society under constant surveillance?', 'George Orwell', ' Aldous Huxley', 'Ray Bradbury', 'opt1');

-- --------------------------------------------------------

--
-- Table structure for table `removed_list`
--

CREATE TABLE `removed_list` (
  `remove_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `removed_date` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('restored','removed') NOT NULL DEFAULT 'removed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `removed_list`
--

INSERT INTO `removed_list` (`remove_id`, `user_id`, `name`, `email`, `removed_date`, `status`) VALUES
(2, 92, 'moderator', 'moderator@gmail.com', '2024-04-19 11:28:37', 'restored'),
(3, 142, 'admin new', 'admin2@gmail.com', '2024-04-19 12:32:30', 'restored'),
(4, 142, 'admin new', 'admin2@gmail.com', '2024-04-19 17:09:24', 'restored'),
(5, 142, 'admin new', 'admin3@gmail.com', '2024-04-22 13:14:34', 'restored');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `time` timestamp(6) NULL DEFAULT current_timestamp(6),
  `help` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `book_id`, `customer_id`, `review`, `rate`, `time`, `help`) VALUES
(10, 125, 21, 'Heartwarming and romantic! This book is a delightful escape into the world of love and relationships. The chemistry between the characters is palpable, and the emotional journey will leave you swooning. Perfect for a cozy night in!', 5, '2024-02-23 07:37:51.902045', 0),
(17, 115, 21, 'It really is a wonderful book about the old traditions, culture in Sri Lanka and mostly about the different natures of people we meet in everyday life', 4, '2024-02-23 22:17:39.650647', 0),
(19, 119, 28, 'This book is good novel', 3, '2024-02-24 08:27:21.875771', 0),
(23, 123, 21, 'I had an excellent experience ordering books from Readspot. The website was user-friendly, and I found the titles I was looking for quickly.', 3, '2024-02-26 12:40:01.994943', 0),
(24, 123, 21, 'I recently ordered a set of classic literature books from this store, and I couldn&#39;t be happier with my purchase.', 1, '2024-02-26 12:40:39.644943', 0),
(25, 123, 21, 'Each book was carefully packaged and arrived in pristine condition. This store exceeded my expectations, and I will definitely be a returning customer. Thank you for the excellent service!', 5, '2024-02-26 12:41:39.930318', 0),
(37, 116, 24, 'Lovely novel', 4, '2024-04-29 11:29:01.325724', 0),
(38, 186, 43, 'One of my favourite books.', 4, '2024-04-29 19:40:30.215033', 0),
(39, 114, 24, 'I read this book when I was in grade 6 ,this is the first Russian novel that I have read, and amazing', 5, '2024-04-29 20:40:06.250189', 0),
(40, 120, 21, '', 4, '2024-05-02 04:14:05.045561', 0);

-- --------------------------------------------------------

--
-- Table structure for table `saveevent`
--

CREATE TABLE `saveevent` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saveevent`
--

INSERT INTO `saveevent` (`event_id`, `user_id`, `title`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(8, 137, 'Colombo International Book Fair', '2023-09-22', '2023-10-01', '09:00:00', '21:00:00'),
(37, 137, 'Event 1010', '2024-04-22', '2024-04-22', '13:00:00', '18:00:00'),
(1, 153, 'Authors talk', '2024-01-25', '2024-01-26', '00:00:00', '00:00:00'),
(2, 153, 'Event 01', '2024-02-15', '2024-02-16', '10:30:00', '16:30:00'),
(2, 162, 'Event 01', '2024-02-15', '2024-02-16', '10:30:00', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `superadmin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`superadmin_id`, `user_id`, `profile_img`, `name`, `email`, `pass`) VALUES
(1, 84, '', 'Kamal Gunawardhana', 'superadmin@gmail.com', '1234567');

--
-- Triggers `superadmin`
--
DELIMITER $$
CREATE TRIGGER `after_insert_superadmin` AFTER INSERT ON `superadmin` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_superadminn` AFTER INSERT ON `superadmin` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_superadmin` AFTER UPDATE ON `superadmin` FOR EACH ROW BEGIN
    UPDATE users
    SET profile_img = NEW.profile_img
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_superadminn` AFTER UPDATE ON `superadmin` FOR EACH ROW BEGIN
    UPDATE users
    SET name = NEW.name
    WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_role` enum('customer','publisher','charity','admin','deliver','super_admin','moderator') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approval','restrict','reject') NOT NULL DEFAULT 'pending',
  `restriction_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `profile_img`, `email`, `pass`, `user_role`, `created_at`, `status`, `restriction_date`) VALUES
(84, 'Kamal Gunawardhana', '', 'superadmin@gmail.com', '1234567', 'super_admin', '2023-11-20 03:44:09', 'approval', NULL),
(92, 'moderator', '', 'moderator@gmail.com', '1234567', 'moderator', '2023-11-21 16:15:51', 'approval', NULL),
(94, 'Pathumi Ahinsa', '94Pathumi Ahinsa-profile_img.jpg', 'publisher@gmail.com', '$2y$10$ZhvPfOTssx3fgJFR2jkNAO.1aWsgB0FzagFGblZM.j2PO7VcJiLe.', 'publisher', '2023-11-22 02:10:28', 'approval', NULL),
(130, 'admin', '', 'admin@gmail.com', '1234567', 'admin', '2023-12-06 08:49:09', 'approval', NULL),
(137, 'Pathumi Ahinsa', 'Pathumi-1714060458-newImage.png', 'pathuahinsa2001@gmail.com', '$2y$10$QK5gfmu2B8WJHb1Nrq926OOmYfFDgsmHwDRdwLz28Gx7quQMnAAuG', 'customer', '2023-12-08 05:29:44', 'approval', NULL),
(142, 'admin new', '', 'admin3@gmail.com', '', 'admin', '2024-01-27 18:34:32', 'approval', '2024-04-22 13:20:18'),
(143, 'delivery person', '', 'delivery@gmail.com', '$2y$10$AhaaJN.PPGwApW3TLHVX6e25mxzM6x8n5phdDbtcO55yFAtVhF7AS', 'deliver', '2024-01-27 18:53:15', 'approval', NULL),
(145, 'charity', '', 'charity@gmail.com', '1234567', 'charity', '2024-02-06 15:12:32', 'approval', NULL),
(153, 'Kaumadi Pahalage', 'Kaumadi Pahalage-1712810802-newImage.png', 'kaumadi2k2@gmail.com', '$2y$10$c1fJIg0hR3nlNPHWr7FnIu.Z6WqYxNH/9yE/q0vSjXBFiSjHCWSau', 'customer', '2024-02-17 05:07:41', 'approval', NULL),
(162, 'Ramath Perera', 'Ramath-1713846312-newImage.jpeg', 'ramath.perera08@gmail.com', '$2y$10$8vw51uiEHJsQBsng659iaOfvrsrfPgsKJyjH23wm8qUNiT40kAXe2', 'customer', '2024-02-24 13:45:26', 'approval', NULL),
(165, 'pramith perera', NULL, 'bap81735@gmail.com', '$2y$10$XeeMwsbKCbfu1WXFNrUTyONXTj9TqV2zvNjxG6ifiRfNp/ot9o52S', 'customer', '2024-02-26 03:04:58', 'reject', NULL),
(169, 'm.r.ranasinghe', '', 'charity4@gmail.com', '$2y$10$Bjgy.zk5Xeu2LRIn2PSD0eOlsWHu2FmB5QH51fWX9OS.bjAUcJjTa', 'charity', '2024-04-14 14:07:11', 'approval', NULL),
(170, 'D.M.Perera', '', 'sanasuma@gmail.com', '$2y$10$kGbnQZiJ6boXn9F/Q8rwNuOlrkg1xVes1Fmi0okJzLq7VE4xmNsRC', 'charity', '2024-04-26 16:03:30', 'pending', NULL),
(171, 'K.Mohomad', '', 'moho2345@gmail.com', '$2y$10$QG0zT1g7o3gHtosLFuZkYerdU251oqQqq3hA6brMqdP.popOo4.aS', 'charity', '2024-04-26 16:05:56', 'pending', NULL),
(177, 'k.hansani lakshani', NULL, '2021cs003@stu.ucsc.cmb.ac.lk', '$2y$10$05Mzrf2c3dUePaBX42mHhu3sF/ziXsGgEKwF5kuub6NlIUdHdVPgG', 'customer', '2024-04-27 00:38:16', 'approval', NULL),
(180, 'Kaumadi', '180Kaumadi-profile_img.jpeg', 'ramath.perera2021@gmail.com', '1234567', 'publisher', '2024-04-28 05:41:28', 'approval', NULL),
(181, 'Thisari kaumadi', NULL, 'kaumadi2k@gmail.com', '$2y$10$2KGeDEnwKvDpGHjHvdRa1ewAsbpq9rvwTcY3GeBzbS0bY5cbRM7kK', 'customer', '2024-04-28 11:27:05', 'approval', NULL),
(182, 'Geeradha Sulakshi', 'Geeradha-1714417655-newImage.jpeg', 'geesulakshi@gmail.com', '$2y$10$8jbS19rXVcQdP/SniON/HOBOlMCs5QhGT4cIlkCksi0puWE2UyfJ2', 'customer', '2024-04-28 16:42:53', 'approval', NULL),
(183, 'Sahansa Vihangi', NULL, 'geeganegoda@gmail.com', '$2y$10$95t3Oy5D6xCKkvD3bPDCSOxfcGLjO93sysI52qKnhklwrhs2vsxyC', 'customer', '2024-04-28 17:59:57', 'approval', NULL),
(184, 'Yuhasna Thesini', NULL, 'ganegodasulakshi@gmail.com', '$2y$10$LQWeFYVZKYaF/as3YdisserUyYBaj/bJRreNq9p88fi.ERYVR0Oem', 'customer', '2024-04-28 18:13:54', 'approval', NULL),
(185, 'Hansika Dewmini', 'Hansika-1714418679-newImage.jpg', 'priyanikalansooriya@gmail.com', '1234567', 'customer', '2024-04-28 18:53:29', 'approval', NULL),
(186, 'Yasindu Ramith', NULL, 'gpyasinduramith@gmail.com', '$2y$10$dfLBnN0y93gNXHeHNRLsBOA/GrctUDBC8BdqaRcmNkNKwj6yvUUG2', 'customer', '2024-04-28 19:32:20', 'approval', NULL),
(187, 'dinuki thisaranai', NULL, 'publisher3@gmail.com', '$2y$10$12SyjHnbwdyv1OBRr/nqA.BfrgK6adOT4gN4emZ.pyE0dG2/7ZqeW', 'publisher', '2024-04-30 06:26:38', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `login_time`, `logout_time`) VALUES
(1, 84, '2024-04-21 05:34:17', '2024-04-21 05:34:41'),
(2, 84, '2024-04-21 10:42:26', '2024-04-22 02:35:17'),
(3, 137, '2024-04-21 11:56:53', '2024-04-21 12:20:56'),
(4, 94, '2024-04-21 12:21:12', '2024-04-21 12:33:57'),
(5, 92, '2024-04-21 12:34:16', '2024-04-21 13:29:07'),
(6, 84, '2024-04-21 13:30:09', '2024-04-22 02:35:17'),
(7, 162, '2024-04-21 16:22:47', '2024-04-21 21:21:11'),
(8, 137, '2024-04-21 21:21:29', '2024-04-22 07:25:22'),
(9, 94, '2024-04-22 02:26:40', '2024-04-22 02:27:59'),
(10, 137, '2024-04-22 02:28:15', '2024-04-22 07:25:22'),
(11, 94, '2024-04-22 02:35:39', '2024-04-22 08:39:28'),
(12, 162, '2024-04-22 05:50:30', '2024-04-22 06:07:44'),
(13, 137, '2024-04-22 06:08:58', '2024-04-22 07:25:22'),
(14, 162, '2024-04-22 07:54:24', '2024-04-23 06:36:11'),
(15, 84, '2024-04-22 08:39:50', '2024-04-22 15:45:03'),
(16, 84, '2024-04-22 16:14:59', '2024-04-22 16:16:46'),
(17, 84, '2024-04-22 16:17:18', '2024-04-24 07:57:30'),
(18, 137, '2024-04-22 16:17:27', '2024-04-23 02:44:59'),
(19, 94, '2024-04-23 02:45:18', '2024-04-23 03:44:14'),
(20, 130, '2024-04-23 03:48:49', '2024-04-24 07:28:35'),
(21, 137, '2024-04-23 06:36:34', '2024-04-23 08:41:28'),
(22, 137, '2024-04-23 07:04:56', '2024-04-23 08:41:28'),
(23, 145, '2024-04-23 08:45:10', '2024-04-24 06:26:45'),
(24, 137, '2024-04-23 09:13:52', '2024-04-23 09:26:36'),
(25, 137, '2024-04-23 09:13:55', '2024-04-23 09:26:36'),
(26, 94, '2024-04-23 09:26:56', '2024-04-23 12:41:45'),
(27, 94, '2024-04-23 11:40:01', '2024-04-23 12:41:45'),
(28, 137, '2024-04-23 11:55:48', '2024-04-23 13:44:08'),
(29, 143, '2024-04-23 12:42:20', '2024-04-23 13:00:50'),
(30, 137, '2024-04-23 13:32:00', '2024-04-23 13:44:08'),
(31, 145, '2024-04-23 14:49:38', '2024-04-24 06:26:45'),
(32, 145, '2024-04-23 15:04:52', '2024-04-24 06:26:45'),
(33, 145, '2024-04-23 15:56:26', '2024-04-24 06:26:45'),
(34, 94, '2024-04-23 17:28:47', '2024-04-24 01:06:47'),
(35, 145, '2024-04-23 19:09:36', '2024-04-24 06:26:45'),
(36, 94, '2024-04-24 05:39:17', '2024-04-24 06:00:57'),
(37, 94, '2024-04-24 06:00:47', '2024-04-24 06:00:57'),
(38, 162, '2024-04-24 06:01:11', '2024-04-24 06:06:34'),
(39, 94, '2024-04-24 06:06:51', '2024-04-24 06:12:18'),
(40, 94, '2024-04-24 06:14:33', '2024-04-24 06:16:19'),
(41, 94, '2024-04-24 06:17:53', '2024-04-24 07:17:42'),
(42, 137, '2024-04-24 06:18:00', '2024-04-24 06:47:44'),
(43, 145, '2024-04-24 06:23:46', '2024-04-24 06:26:45'),
(44, 145, '2024-04-24 06:24:26', '2024-04-24 06:26:45'),
(45, 145, '2024-04-24 06:27:36', '2024-04-26 07:10:00'),
(46, 137, '2024-04-24 06:45:25', '2024-04-24 06:47:44'),
(47, 137, '2024-04-24 06:45:27', '2024-04-24 06:47:44'),
(48, 137, '2024-04-24 06:46:08', '2024-04-24 06:47:44'),
(49, 137, '2024-04-24 06:48:50', '2024-04-24 06:49:04'),
(50, 137, '2024-04-24 06:50:18', '2024-04-24 07:03:50'),
(51, 94, '2024-04-24 07:04:17', '2024-04-24 07:17:42'),
(52, 94, '2024-04-24 07:09:52', '2024-04-24 07:17:42'),
(53, 130, '2024-04-24 07:18:04', '2024-04-24 07:28:35'),
(54, 92, '2024-04-24 07:28:52', '2024-04-24 07:35:39'),
(55, 145, '2024-04-24 07:36:02', '2024-04-26 07:10:00'),
(56, 84, '2024-04-24 07:43:51', '2024-04-24 07:57:30'),
(57, 143, '2024-04-24 07:57:51', '2024-04-25 07:49:30'),
(58, 153, '2024-04-24 09:12:30', '2024-04-24 10:23:07'),
(59, 137, '2024-04-24 09:22:37', '2024-04-24 11:39:48'),
(60, 153, '2024-04-24 10:16:20', '2024-04-24 10:23:07'),
(61, 130, '2024-04-24 10:20:45', '2024-04-24 10:21:25'),
(62, 153, '2024-04-24 10:22:26', '2024-04-24 10:23:07'),
(63, 162, '2024-04-24 10:23:51', '2024-04-24 10:33:49'),
(64, 137, '2024-04-24 10:26:45', '2024-04-24 11:39:48'),
(65, 92, '2024-04-24 10:34:16', '2024-04-26 06:38:00'),
(66, 145, '2024-04-24 10:44:38', '2024-04-26 07:10:00'),
(67, 137, '2024-04-24 11:06:38', '2024-04-24 11:39:48'),
(68, 137, '2024-04-24 12:31:57', '2024-04-24 15:48:06'),
(69, 143, '2024-04-24 12:34:36', '2024-04-25 07:49:30'),
(70, 145, '2024-04-24 15:02:41', '2024-04-26 07:10:00'),
(71, 137, '2024-04-24 15:48:19', '2024-04-24 15:50:48'),
(72, 137, '2024-04-24 16:14:27', '2024-04-24 16:40:42'),
(73, 137, '2024-04-24 16:41:17', '2024-04-24 19:17:45'),
(74, 145, '2024-04-24 19:00:55', '2024-04-26 07:10:00'),
(75, 84, '2024-04-24 19:18:31', '2024-04-25 05:51:33'),
(76, 145, '2024-04-24 20:26:57', '2024-04-26 07:10:00'),
(77, 137, '2024-04-24 22:21:13', '2024-04-25 08:58:57'),
(78, 145, '2024-04-25 04:58:39', '2024-04-26 07:10:00'),
(79, 162, '2024-04-25 05:48:27', '2024-04-25 05:57:49'),
(80, 137, '2024-04-25 05:51:54', '2024-04-25 08:58:57'),
(81, 162, '2024-04-25 06:04:53', '2024-04-25 06:45:56'),
(82, 162, '2024-04-25 06:20:56', '2024-04-25 06:45:56'),
(83, 162, '2024-04-25 06:46:21', '2024-04-25 07:04:12'),
(84, 162, '2024-04-25 07:09:01', '2024-04-25 07:23:39'),
(85, 130, '2024-04-25 07:24:10', '2024-04-25 07:34:52'),
(86, 162, '2024-04-25 07:35:13', '2024-04-25 07:57:59'),
(87, 130, '2024-04-25 07:49:45', '2024-04-26 05:58:54'),
(88, 162, '2024-04-25 07:58:34', '2024-04-25 08:59:24'),
(89, 137, '2024-04-25 09:03:43', '2024-04-25 15:55:29'),
(90, 162, '2024-04-25 09:18:26', '2024-04-25 18:22:52'),
(91, 145, '2024-04-25 17:10:03', '2024-04-26 07:10:00'),
(92, 137, '2024-04-25 17:53:04', '2024-04-26 02:41:23'),
(93, 162, '2024-04-26 02:46:45', '2024-04-26 02:50:53'),
(94, 94, '2024-04-26 02:52:01', '2024-04-26 04:05:10'),
(95, 94, '2024-04-26 04:26:12', '2024-04-26 08:33:55'),
(96, 162, '2024-04-26 05:41:52', '2024-04-26 08:42:45'),
(97, 130, '2024-04-26 05:57:09', '2024-04-26 05:58:54'),
(98, 130, '2024-04-26 05:58:16', '2024-04-26 05:58:54'),
(99, 84, '2024-04-26 05:59:12', '2024-04-26 06:04:58'),
(100, 92, '2024-04-26 06:10:25', '2024-04-26 06:38:00'),
(101, 153, '2024-04-26 06:38:33', '2024-04-26 06:41:02'),
(102, 92, '2024-04-26 06:48:14', '2024-04-26 06:59:13'),
(103, 153, '2024-04-26 06:59:34', '2024-04-26 07:13:20'),
(104, 137, '2024-04-26 08:28:37', '2024-04-26 08:45:36'),
(105, 137, '2024-04-26 08:34:14', '2024-04-26 08:45:36'),
(106, 137, '2024-04-26 08:43:03', '2024-04-26 08:45:36'),
(107, 94, '2024-04-26 08:45:56', '2024-04-26 16:21:38'),
(108, 162, '2024-04-26 10:22:41', '2024-04-26 10:56:05'),
(109, 145, '2024-04-26 10:27:24', '2024-04-28 10:39:46'),
(110, 137, '2024-04-26 10:56:25', '2024-04-26 11:18:25'),
(111, 137, '2024-04-26 11:21:22', '2024-04-26 12:14:19'),
(112, 130, '2024-04-26 12:09:39', '2024-04-26 16:34:42'),
(113, 162, '2024-04-26 12:14:33', '2024-04-27 01:47:02'),
(114, 153, '2024-04-26 12:57:43', '2024-04-27 12:05:04'),
(115, 137, '2024-04-26 16:21:56', '2024-04-26 16:27:35'),
(116, 137, '2024-04-26 16:27:54', '2024-04-26 16:28:47'),
(117, 130, '2024-04-26 16:29:05', '2024-04-26 16:34:42'),
(118, 130, '2024-04-26 17:05:47', '2024-04-26 17:08:30'),
(119, 130, '2024-04-26 17:18:37', '2024-04-26 17:23:27'),
(120, 92, '2024-04-26 17:23:51', '2024-04-26 18:12:43'),
(121, 130, '2024-04-26 18:13:09', '2024-04-27 07:20:15'),
(122, 162, '2024-04-27 01:47:14', '2024-04-27 05:56:00'),
(123, 177, '2024-04-27 02:40:55', '2024-04-27 02:45:57'),
(124, 137, '2024-04-27 02:43:12', '2024-04-27 02:43:42'),
(125, 162, '2024-04-27 02:44:27', '2024-04-27 05:56:00'),
(126, 137, '2024-04-27 05:56:57', '2024-04-27 08:44:48'),
(127, 145, '2024-04-27 06:56:48', '2024-04-28 10:39:46'),
(128, 92, '2024-04-27 07:09:53', '2024-04-27 07:12:02'),
(129, 130, '2024-04-27 07:12:21', '2024-04-27 07:20:15'),
(130, 94, '2024-04-27 07:20:38', '2024-04-27 07:58:36'),
(131, 143, '2024-04-27 08:00:00', '2024-04-27 12:00:23'),
(132, 162, '2024-04-27 08:45:22', '2024-04-27 09:59:36'),
(133, 137, '2024-04-27 10:00:02', '2024-04-27 12:19:13'),
(134, 153, '2024-04-27 12:00:51', '2024-04-27 12:05:04'),
(135, 94, '2024-04-27 12:19:38', '2024-04-27 12:26:05'),
(136, 94, '2024-04-27 12:31:21', '2024-04-28 06:27:55'),
(137, 137, '2024-04-27 12:33:48', '2024-04-28 14:21:35'),
(138, 137, '2024-04-27 12:50:14', '2024-04-28 14:21:35'),
(139, 145, '2024-04-27 13:36:25', '2024-04-28 10:39:46'),
(140, 145, '2024-04-27 16:09:52', '2024-04-28 10:39:46'),
(141, 145, '2024-04-27 19:49:53', '2024-04-28 10:39:46'),
(142, 153, '2024-04-28 00:46:55', '2024-04-28 00:51:00'),
(143, 94, '2024-04-28 06:28:10', '2024-04-28 07:37:47'),
(144, 162, '2024-04-28 06:29:12', '2024-04-28 06:35:48'),
(145, 137, '2024-04-28 06:36:09', '2024-04-28 14:21:35'),
(146, 94, '2024-04-28 08:41:51', '2024-04-28 13:00:15'),
(147, 145, '2024-04-28 09:20:32', '2024-04-28 10:39:46'),
(148, 145, '2024-04-28 09:45:41', '2024-04-28 10:39:46'),
(149, 145, '2024-04-28 10:43:44', '2024-04-29 09:31:36'),
(150, 153, '2024-04-28 11:53:44', '2024-04-29 06:06:07'),
(151, 181, '2024-04-28 13:26:58', NULL),
(152, 137, '2024-04-28 14:07:25', '2024-04-28 14:21:35'),
(153, 137, '2024-04-28 14:21:47', '2024-04-28 14:22:03'),
(154, 137, '2024-04-28 14:22:31', '2024-04-29 14:30:41'),
(155, 145, '2024-04-28 14:32:48', '2024-04-29 09:31:36'),
(156, 137, '2024-04-28 14:34:15', '2024-04-29 14:30:41'),
(157, 145, '2024-04-28 16:21:39', '2024-04-29 09:31:36'),
(158, 145, '2024-04-28 16:24:21', '2024-04-29 09:31:36'),
(159, 182, '2024-04-28 18:43:20', '2024-04-28 20:10:04'),
(160, 162, '2024-04-28 19:12:53', '2024-04-28 19:22:58'),
(161, 183, '2024-04-28 20:02:15', '2024-04-28 20:48:07'),
(162, 184, '2024-04-28 20:15:06', '2024-04-29 06:05:28'),
(163, 185, '2024-04-28 20:59:49', '2024-04-28 21:29:38'),
(164, 186, '2024-04-28 21:32:54', '2024-04-29 08:04:15'),
(165, 153, '2024-04-29 05:42:39', '2024-04-29 06:06:07'),
(166, 182, '2024-04-29 05:51:08', '2024-04-29 05:56:27'),
(167, 184, '2024-04-29 05:58:22', '2024-04-29 06:05:28'),
(168, 185, '2024-04-29 06:00:27', '2024-04-29 06:08:32'),
(169, 130, '2024-04-29 06:07:09', '2024-04-29 06:21:42'),
(170, 186, '2024-04-29 06:08:07', '2024-04-29 08:04:15'),
(171, 183, '2024-04-29 06:09:43', '2024-04-29 08:42:31'),
(172, 180, '2024-04-29 06:23:39', '2024-04-29 07:06:45'),
(173, 153, '2024-04-29 06:48:47', '2024-04-29 07:05:18'),
(174, 153, '2024-04-29 07:05:44', '2024-04-29 07:11:35'),
(175, 130, '2024-04-29 07:07:50', '2024-04-29 13:17:47'),
(176, 92, '2024-04-29 07:11:59', '2024-04-29 07:21:29'),
(177, 153, '2024-04-29 07:21:54', '2024-04-29 08:32:47'),
(178, 182, '2024-04-29 08:08:48', '2024-04-29 08:36:33'),
(179, 145, '2024-04-29 08:33:11', '2024-04-29 09:31:36'),
(180, 153, '2024-04-29 08:33:56', '2024-04-29 09:00:46'),
(181, 184, '2024-04-29 08:37:35', NULL),
(182, 185, '2024-04-29 08:47:02', '2024-04-29 11:28:18'),
(183, 153, '2024-04-29 09:01:18', '2024-04-29 13:13:13'),
(184, 137, '2024-04-29 09:31:51', '2024-04-29 14:30:41'),
(185, 182, '2024-04-29 11:29:40', '2024-04-29 21:10:45'),
(186, 153, '2024-04-29 13:14:28', '2024-04-29 13:24:59'),
(187, 130, '2024-04-29 13:18:13', NULL),
(188, 153, '2024-04-29 13:27:00', '2024-04-29 21:04:11'),
(189, 145, '2024-04-29 14:30:58', '2024-04-29 20:45:17'),
(190, 145, '2024-04-29 18:08:34', '2024-04-29 20:45:17'),
(191, 153, '2024-04-29 20:45:50', '2024-04-29 21:04:11'),
(192, 94, '2024-04-29 21:06:27', '2024-04-29 21:28:47'),
(193, 182, '2024-04-29 21:06:38', '2024-04-29 21:10:45'),
(194, 137, '2024-04-29 21:12:36', '2024-04-29 23:15:07'),
(195, 153, '2024-04-29 21:20:43', '2024-04-29 21:22:26'),
(196, 185, '2024-04-29 21:22:47', '2024-04-29 21:58:11'),
(197, 153, '2024-04-29 21:25:17', '2024-04-29 21:36:56'),
(198, 94, '2024-04-29 21:29:35', '2024-04-29 21:32:49'),
(199, 153, '2024-04-29 21:33:43', '2024-04-29 21:36:56'),
(200, 153, '2024-04-29 21:51:52', '2024-04-29 22:54:22'),
(201, 153, '2024-04-29 21:53:21', '2024-04-29 22:54:22'),
(202, 92, '2024-04-29 21:58:28', '2024-04-29 22:17:44'),
(203, 92, '2024-04-29 22:17:56', '2024-04-29 22:43:52'),
(204, 92, '2024-04-29 22:44:06', '2024-04-29 23:08:25'),
(205, 92, '2024-04-29 22:54:59', '2024-04-29 23:08:25'),
(206, 137, '2024-04-29 23:08:53', '2024-04-29 23:15:07'),
(207, 92, '2024-04-30 03:43:19', NULL),
(208, 153, '2024-04-30 03:43:53', '2024-04-30 03:59:48'),
(209, 153, '2024-04-30 04:00:08', NULL),
(210, 145, '2024-04-30 05:03:00', '2024-04-30 08:24:52'),
(211, 137, '2024-04-30 08:27:08', '2024-04-30 08:31:31'),
(212, 94, '2024-04-30 08:31:39', '2024-05-02 06:13:29'),
(213, 137, '2024-05-02 06:13:39', NULL),
(214, 137, '2024-05-07 05:47:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `fk_books_customer_id` (`customer_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cart_customer` (`customer_id`),
  ADD KEY `fk_cart_book` (`book_id`);

--
-- Indexes for table `charity`
--
ALTER TABLE `charity`
  ADD PRIMARY KEY (`charity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `charity_event`
--
ALTER TABLE `charity_event`
  ADD PRIMARY KEY (`charity_event_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comments_book_id` (`book_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `content_review`
--
ALTER TABLE `content_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `delivery_reviews`
--
ALTER TABLE `delivery_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `donate_books`
--
ALTER TABLE `donate_books`
  ADD PRIMARY KEY (`donate_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`user_id`,`quiz_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `message` (`incoming_msg_id`),
  ADD KEY `message2` (`outgoing_msg_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `messages1` (`sender_id`),
  ADD KEY `messages_ibfk_3` (`user_id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderator_id`),
  ADD KEY `moderator_ibfk_1` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `tracking_no` (`tracking_no`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`book_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `publisher_stores`
--
ALTER TABLE `publisher_stores`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `fk_publisher_stores_publisher_id` (`publisher_Id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`quiz_id`,`question_id`);

--
-- Indexes for table `removed_list`
--
ALTER TABLE `removed_list`
  ADD PRIMARY KEY (`remove_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `saveevent`
--
ALTER TABLE `saveevent`
  ADD PRIMARY KEY (`user_id`,`event_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`superadmin_id`),
  ADD KEY `superadmin_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `charity`
--
ALTER TABLE `charity`
  MODIFY `charity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `charity_event`
--
ALTER TABLE `charity_event`
  MODIFY `charity_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `content_review`
--
ALTER TABLE `content_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `delivery_reviews`
--
ALTER TABLE `delivery_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `donate_books`
--
ALTER TABLE `donate_books`
  MODIFY `donate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `publisher_stores`
--
ALTER TABLE `publisher_stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `removed_list`
--
ALTER TABLE `removed_list`
  MODIFY `remove_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `superadmin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_books_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `charity`
--
ALTER TABLE `charity`
  ADD CONSTRAINT `charity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message` FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `moderator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE SET NULL;

--
-- Constraints for table `publishers`
--
ALTER TABLE `publishers`
  ADD CONSTRAINT `publishers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `publisher_stores`
--
ALTER TABLE `publisher_stores`
  ADD CONSTRAINT `fk_publisher_stores_publisher_id` FOREIGN KEY (`publisher_Id`) REFERENCES `publishers` (`publisher_id`);

--
-- Constraints for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD CONSTRAINT `superadmin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_admin` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:36:58' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE admins SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_charity` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:37:38' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE charity SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_cus` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:36:43' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE customers SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_del` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:38:21' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE delivery SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_mod` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:37:22' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE moderator SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_pub` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:36:27' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE publishers SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `approve_restricted_users` ON SCHEDULE EVERY 1 DAY STARTS '2024-04-20 10:36:06' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE users SET status = 'approval' 
    WHERE status = 'restrict' AND DATEDIFF(NOW(), restriction_date) >= 7;
END$$

CREATE DEFINER=`readspot`@`%` EVENT `clear_points_date_event` ON SCHEDULE EVERY 1 WEEK STARTS '2024-04-23 09:31:52' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE customers
  SET challenge_point_date = NULL
  WHERE challenge_point_date < DATE_SUB(NOW(), INTERVAL 1 WEEK)$$

CREATE DEFINER=`readspot`@`%` EVENT `reject_content` ON SCHEDULE EVERY 1 MONTH STARTS '2024-04-11 06:16:58' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE content SET status = 'rejected' WHERE status = 'approval' AND created_at <= NOW() - INTERVAL 1 MONTH$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
