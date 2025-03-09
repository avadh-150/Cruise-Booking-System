-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 01:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`, `answer`, `created_at`, `is_read`) VALUES
(4, 'ava joy', 'wovos30942@intady.com', '09085647123', 'fs sjf skjsjneskjsjskjndwndnawkldwmdiowjfoefjefeifrvnviubrjendiuenkjesn', '', '2025-01-18 14:07:04', 1),
(7, 'white paguses', 'wotor30234@arensus.com', '09085647123', 'skjbnskfmjsnsm jn,f jne,fn,nfjsn skn  ,n,fnk,snkjsndnd f e', '', '2025-01-22 08:41:27', 0),
(8, 'ava joy', 'direya4166@halbov.com', '09085647123', 'hello sir i have some query for your gym to join your club plz reply  ', '', '2025-01-22 09:57:49', 0),
(9, 'white paguses', 'whitehack880@gmail.coom', '884866151398', ' mcs djasdhabdhdbawhdbawhjdbwhjdfbhj', '', '2025-01-22 10:00:41', 0),
(10, 'KKK123', 'retik86981@shouxs.com', '985632174', 'hi my interested to booking the ticket of your cruise service but here facing the some issues to booking the ticket of it', '', '2025-02-15 11:23:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gym_blogs`
--

CREATE TABLE `gym_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_blogs`
--

INSERT INTO `gym_blogs` (`id`, `title`, `content`, `image_path`, `created_at`) VALUES
(13, 'Carnival Luminosa', 'Two Cruise Ships Cancel Sailings Due to Category 2 Cyclone, to Remain at Sea\r\nEven if gyms are closed, or you\'d just rather work out at home, an hour gives you plenty of time for a well-rounded routine with a proper warm-up and cool down. You could do a full body workout, target specific areas or work on your cardiovascular endurance. Plus, having 60 minutes lets you build the intensity over the course of your workout session.\r\n\r\nWhether you\'re prepping for a triathlon or an obstacle race, regular one hour exercise sessions at the gym are an excellent step in the right direction. Longer sessions are perfect for honing specific techniques to get you over the finish line, letting you work on foot strike, breathing patterns, pedal rhythm or pull-ups, for example.\r\n\r\nBut for maximum return on your time investment, having a solid workout plan in place is key. Pre-planning lets you move around the gym with purpose, without wasting precious time wondering what to do next. \r\n\r\nIn this article we\'ll be covering: \r\n\r\nWhat are the benefits of a one hour workout?\r\nHow many calories can you burn in one hour at the gym? \r\nHow many one hour workouts should I do per week?\r\nIs one hour at the gym enough to get fit? \r\nIs a 60 minute workout better than a HIIT session for cardio?\r\nCan I do an hour gym workout everyday?\r\nWhat if I don\'t have time for a one hour workout?\r\n1 hour full body workout plan\r\n1 hour HIIT workout plan\r\n1 hour cardio workout plan\r\n1 hour strength workout plan\r\n1 hour kettlebell workout plan\r\nOur 1 hour workout ideas below make a great starting point. But to get the most out of every minute, download the PureGym app. Totally free of charge even for non-members, the app lets you tailor your plan to both your goals and current level of fitness, from absolute beginners looking to build muscle, to athletes needing more variation.\r\n\r\nWhat are the benefits of a one hour workout?\r\nWhether squeezed into your lunch break or tacked onto your commute, one hour workouts can have huge benefits on your physical and mental wellbeing. Regular sessions that include both aerobic and resistance elements will put you well on your way to achieving (and even exceeding) the minimum amount of activity needed for good health.\r\n\r\nOfficial recommendations from Public Health England state that adults should accumulate at least 150 minutes of moderate-intensity activity (like brisk walking or cycling) per week or 75 minutes of vigorous-intensity activity (such as running). In addition, the PHE suggests we do resistance training on two days per week, to develop and maintain strength in all the major muscle groups.\r\n\r\nAccording to the government\'s own report, achieving this amount of exercise is associated with better mental health and cardiovascular fitness, can contribute to a healthy weight status and can also have a protective effect on chronic conditions including coronary heart disease, obesity and type 2 diabetes.\r\n\r\nSixty minute sessions also allow time for a short stretching routine, helping you work on the third (and often overlooked) pillar of health after muscular strength and cardiovascular fitness: flexibility. From sprinters to bodybuilders, joint mobility is vital to athletic performance as it reduces the risk of injury and soreness. But it\'s also important when it comes to maintaining posture and balance as we age, something that can significantly increase our quality of life\r\n\r\n                                        “Our Fleet Operations Center continues to keep a close eye on Tropical Cyclone Alfred. Given its current track, the storm is expected to directly impact the Brisbane area in the coming days and the port is now closed as it prepares. Once the storm passes, officials must conduct a post-storm assessment before we can be cleared to safely return to port. We are anticipating that this process will take some time to complete, the earliest being Saturday, 8 March. Regrettably, we have no alternative but to cancel your voyage.”\r\n\r\nWhile plans are still up in the air, the Carnival vessel is currently scheduled to depart from Brisbane on a 4-day sailing on March 9, if no other alterations are made.\r\n\r\nOn April 3, 2025, Carnival Luminosa will set off on a 28-day sailing from Brisbane to Seattle, from which port the ship will offer 7-day Alaskan cruises for the season before coming back to Australia.', '1741453639_Carnival-Luminosa-in-Brisbane.jpg', '2025-03-04 12:16:09'),
(14, 'Cruise Ships Being Rerouted as Tropical Cyclone Inches Closer to Brisbane', 'Cruise ships along the Southeastern Queensland coast of Australia are being forced to alter their itineraries as Tropical Cyclone Alfred, a Category 2 system, intensifies and approaches the Port of Brisbane, traveling at 9 miles per hour (14 kilometers per hour).\r\nCunard’s Queen Anne and the Norwegian Sun have both skipped their scheduled visits to Brisbane, as the Norwegian Cruise Line ship headed straight to Cairns instead, while Queen Anne sailed toward Airlie Beach in North Queensland, where she will arrive on Tuesday.\r\n\r\nQueen Anne will then call on Yorkeys Knob on March 6, and the adjusted schedule will allow the Cunard ship to arrive in Darwin a day early on March 10.  This will help make sure the ship is back on schedule to continue her 112-day world cruise that is set to arrive in Germany on April 29, 2025.\r\n\r\nAs Alfred intensified into a Category 2 cyclone, the Port of Brisbane was closed, and commercial shipping was directed to evacuate. The Bureau of Meteorology warned of high tides and potentially hazardous swells in the area.', '1741454608_Brisbane-cruise-port-Australia.jpg', '2025-03-08 17:23:28'),
(15, 'All Three Ports Being Canceled”: Carnival Passengers on Unplanned Cruise to Nowhere', 'Passengers on a four-day sailing aboard Carnival Glory expected a short getaway from Port Canaveral, with at least two ports of call. The captain attempted to add a third stop in Freeport, but due to weather conditions, this also failed, leaving the voyage a cruise with zero destinations beyond the ship itself.\r\nA “cruise to nowhere” used to be a popular short vacation option, especially for those wanting a taste of cruising without giving up an entire week. But changes in U.S. maritime law and stricter enforcement of crew visa regulations have made it nearly impossible for cruise ships to offer them from U.S. ports today.\r\n\r\nCarnival Glory appears to be an exception, as this cruise to nowhere was due to weather conditions.\r\n\r\nA user on Reddit wrote about the ordeal in a post with this message:\r\n\r\n “I’m currently on a 4 day cruise on the Carnival Glory. We were supposed to stop in Nassau and Princess Cays, but both ports were cancelled due to rough seas. Today was supposed to be a sea day, but the captain has coordinated an attempted stop in Freeport. He did kind of hint at unfavorable sea conditions in his announcement yesterday, so I will be surprised if we actually stop in Freeport.”\r\n\r\nInstead of being upset though, the poster said that most were still positive about the experience.\r\n\r\n“Cruisers seem to be in good spirits, despite missing both ports, and though the length and itinerary would suggest it’s a “booze cruise”, everyone I’ve seen has been very well behaved,” the post read.\r\n\r\nBut not everyone seems to be thrilled with this “portless” cruise.  Apparently, the guest services line has been getting longer and longer as some passengers are upset with the course of events.\r\n\r\nAnother comment came from a passenger on board the ship as well that stated:\r\n\r\n“Currently on board with you. All three ports being canceled seems to have EVERYONE fuming on our side of the boat. Neighbors and people walking around me angry and heading to guest services to demand refunds. Pretty sure carnival doesn’t care, but personally I would appreciate a future cruise credit or something.”\r\n\r\nThere were only two ports of call on this itinerary, but the captain attempted to add a third stop in Freeport since the others had to be cancelled.  But once again, weather ', '1741454922_Carnival-Glory.jpg', '2025-03-08 17:28:42'),
(16, 'Cruise Couple Finds Luggage Held by Fellow Passenger After Weeks of AirPod Tracking', 'Losing luggage while traveling is a major headache. On cruise ships, you expect a few hiccups—maybe a bag ends up in the wrong cabin or gets sidelined due to a lost tag. But usually, passengers get their stuff back pretty quickly.\r\nHowever, for Jason and Tammy Marritt from Oklahoma, their lost luggage story went on for weeks. News reports say they didn’t get their bags back until after their Carnival Magic cruise was over.  So, the entire voyage was spent buying what they needed and making do with what they had.\r\n\r\nAnd this cruise was a celebration for the couple’s 26th wedding anniversary.\r\n\r\nFortunately, they were able to track their luggage using Apple AirPods, keeping tabs on it for all those weeks, which was probably more of a tease than a reassurance.\r\n\r\nI say that because for almost a month the couple kept contacting Carnival Cruise Line to inform them of their luggage status and location.\r\n\r\n“We kept showing them, ‘Hey, we’re tracking it. Hey, it’s here.’ You know, ‘Can you go to deck zero?’ No, it’s not going to be there. You know, we’ve searched all the floors, every room’s been checked. There’s nothing,” Merritt stated.\r\n\r\nBut now there’s good news and bad news.  The good news is that the Merritt’s have been reunited with their luggage.  The bad news?  39 items are reportedly missing. \r\n\r\n“There’s about 39 items missing, and she took the majority of his clothes. She took all of his shoes, belts, and his entire toiletry bag. So electronic toothbrushes, razors, medications, she took it all,” Tammy Merritt said.\r\n\r\nEven the key to their Ford Bronco was missing from the bag, in addition to the name tag itself missing from the outside of the bag.  This same name tag had the couple’s names, address, and phone number on it.\r\n\r\nHere is a recent news video on this story before the couple’s luggage was retrieved:', '1741455044_Lost-luggage-on-cruise.jpg', '2025-03-08 17:30:44'),
(17, 'Cruisers Ask from Their Cabin Stewards Most', '1. Ice\r\nThis was by far the most requested item.  With responses like “ice every day” or “ice in the bucket at night” regular cruisers made clear that keeping their beverages cold while enjoying some time on their balcony was a high priority.  Almost 25% of all replies mentioned asking for ice from the cabin steward.  Some even suggested having ice-makers in the tiny fridges in the room so they could have their own full-time supply.\r\n\r\n2. Extra Towels\r\nTowels were the second most requested item.  Whether it’s extra towels for use in the cabin bathroom or on the pool deck, passengers like to be prepared.  Some liked to have double the towels and then have them washed after two days instead of every day.\r\n\r\n3. Extra Pillows\r\nCruisers like to be comfy, and sometimes the included pillows in a cruise cabin just don’t cut it.  Some cruise lines can offer different types of pillows as well if the pillows on your bed don’t fit your firmness preference.   Most of the cruise travelers that made this request wanted at least two more pillows in the cabin.  While you can bring your own pillow from home, that’s just an extra thing to try to cram into an already overloaded suitcase or duffle bag.\r\n\r\nRead more: 7 Lesser-known items a cruise passenger can request from a steward\r\n\r\n4. Extra Hangers\r\nAnother “extra” on the list, a few more hangers were often requested, especially on longer cruises.   One of the best parts of cruising is that you can unpack once and see several destinations on a vacation.  But no one wants to run out of hangers while unpacking and putting clothes in the closet.  Also, because cruise cabins don’t have ironing boards and irons, hanging up your clothing can help keep the wrinkles out.  I will often just spray some water on my clothes and let gravity do its thing.\r\n\r\n5. Their Name\r\nBy far my favorite answer in the comments, asking a cabin steward for their name or how to pronounce their name is a great way to show them you care.  In fact, the many replies that mentioned asking for their steward’s name or introducing themselves showed me just how awesome our cruise community at Cruise Fever really is.   I recommend every cruiser learn their attendant’s name (and how to pronounce it properly) and remember to use it throughout the cruise.  It not only shows you care, but it makes it easier to remember them when it’s time to fill out the post-cruise survey.\r\n\r\nRelated: Cruise cabin check: 11 things to do before you empty your suitcase\r\n\r\n6. Bathrobes\r\nSome of the more premium cruise lines will already have bathrobes in the cabin, but even mainstream lines will often offer additional bathrobes upon request.  According to Carnival’s website, “bathrobes will be provided during turndown service on the first evening of the cruise, upon request through your Stateroom Attendant.”  Dozens of cruisers in our comments mentioned asking for bathrobes, and it was the sixth most requested item.\r\n\r\n7. Mattress Topper\r\nMany first-time cruisers or newbies to this style of vacationing don’t even realize you can request a mattress topper from a cabin steward.  But for those who need a little extra cushion on that cruise cabin bed, mattress toppers are available.  There are only so many on each cruise though, so you should make this request as soon as you can if it’s really something you need to sleep soundly.', '1741455241_Cabin-doors-on-a-cruise-ship.jpg', '2025-03-08 17:34:01'),
(18, 'What You Should Do on the Last Day of Your Cruise', 'There’s an entire fun-filled vacation ahead of you and it feels like it’s going to last forever.  But sadly, that feeling gradually fades as the week progresses and the days tick by.\r\n\r\nBefore you know it, it’s now the last day of the cruise and your vacation is almost over.  It’s as sad and depressing as that first day was exciting.\r\n\r\nWhether your cruise’s final day is a relaxing day at sea or a visit to a cruise line private island, there are a few extra things that you’ll need to take care of in preparation for the following morning’s debarkation.\r\n\r\n1. Debarking Information\r\nThe room steward should leave debarkation instructions in your room the evening before.  If you haven’t already taken a look at it, read the instructions in the morning so that you won’t be surprised at the last minute by any details.\r\nEven if you are frequent cruiser with the line, it’s still a good idea to take a look at the instructions as cruise lines periodically update their procedures to help make the entire process go more smoothly.', '1741455313_Harmonyofseas-37.jpg', '2025-03-08 17:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `port_list`
--

CREATE TABLE `port_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `port_list`
--

INSERT INTO `port_list` (`id`, `name`, `location`, `date_created`) VALUES
(1, 'Sample Port 101', 'Location 1', '2021-08-28 10:34:53'),
(2, 'Sample Port 102', 'Location 2', '2021-08-28 10:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `captain_name` varchar(100) NOT NULL,
  `manager` varchar(100) NOT NULL,
  `members` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `boat_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `captain_name`, `manager`, `members`, `image`, `boat_id`, `create_at`) VALUES
(1, 'Jiyak Farry', 'Kim Seyuon', '5000', '1741520675_agent-4.jpg', 1, '2025-03-09 08:59:31'),
(4, 'urava kimal', 'jeun kim', '8000', '1741520828_agent-3.jpg', 3, '2025-03-09 09:11:27'),
(7, 'Nyaka Josh', 'Kimsa him', '3580', '1741520837_agent-2.jpg', 4, '2025-03-09 09:13:27'),
(9, 'Sejon kim', 'Jack son', '5012', '1741520847_agent-1.jpg', 5, '2025-03-09 09:15:36'),
(10, 'Alcaraz, Ramon', 'kim son jon', '4500', '1741521626_images (1).jpg', 6, '2025-03-09 09:16:46'),
(11, 'ranik lili', 'ronik feth', '6241', '1741523728_istockphoto-547156272-612x612.jpg', 7, '2025-03-09 09:16:46'),
(12, 'Omica jeel', 'lichava wov', '8400', '1741521647_download (2).jpg', 8, '2025-03-09 09:21:50'),
(13, 'jonson cav.', 'jeshika none', '5200', '1741523710_download (4).jpg', 11, '2025-03-09 09:21:50'),
(14, 'luesh keni', 'joshipher', '2000', '1741521772_images (5).jpg', 10, '2025-03-09 09:22:11'),
(15, 'omavale jansi', 'kamrek joson', '5200', '1741521784_images (3).jpg', 9, '2025-03-09 09:22:11'),
(16, 'liyonad josh', 'jack fen', '1900', '1741521795_images (4).jpg', 12, '2025-03-09 09:24:49'),
(17, 'seyoung seen', 'liyang seem', '5000', '1741521834_images (7).jpg', 14, '2025-03-09 09:31:07'),
(18, 'Adams  William', '5400', 'Kevin Charge', '1741521592_images (2).jpg', 2, '2025-03-09 11:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL,
  `otp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UserType`, `otp`) VALUES
(2, 'Admin', 'admin', 8956565656, 'tokaga2194@kaiav.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2024-08-31 18:30:00', 1, 846568),
(3, 'Anuj kumar', 'akr305', 1234567890, 'ak@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-09-10 18:30:00', 0, 0),
(7, 'Meenu Kumari', 'meenu123', 7894561236, 'meenu@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-09-25 05:57:24', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblboat`
--

CREATE TABLE `tblboat` (
  `ID` int(5) NOT NULL,
  `BoatName` varchar(250) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Size` varchar(100) DEFAULT NULL,
  `Capacity` varchar(100) DEFAULT NULL,
  `Source` varchar(250) DEFAULT NULL,
  `Destination` varchar(250) DEFAULT NULL,
  `Route` varchar(250) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `Description` mediumtext DEFAULT NULL,
  `AddedBy` int(5) DEFAULT NULL,
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL,
  `executive` int(50) DEFAULT NULL,
  `business` int(50) DEFAULT NULL,
  `room_cabin` int(50) DEFAULT NULL,
  `sleeper` int(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblboat`
--

INSERT INTO `tblboat` (`ID`, `BoatName`, `Image`, `Size`, `Capacity`, `Source`, `Destination`, `Route`, `Price`, `arrival_time`, `departure_time`, `Description`, `AddedBy`, `image1`, `image2`, `image3`, `executive`, `business`, `room_cabin`, `sleeper`, `CreationDate`) VALUES
(1, 'Zealandnar Cruise', 'd4907b9f65b954610ab783a4d3c6daa31740808609.jpg', 'Medium', '800', 'Sydney, Australia ', 'New Zealand', 'Sydney → Fiordland National Park → Dunedin → Wellington → Auckland → Sydney', 8000, '2025-03-18 01:00:00', '2025-03-20 01:00:00', 'A scenic cruise across the Tasman Sea, featuring breathtaking fjords, wildlife, and cultural experiences in New Zealand. It includes stops at cities known for their rich Maori heritage and stunning landscapes.', 2, 'image1_53ba6a0858685304c71be8259c0a86471740814491.jpg', 'image2_ef91d5d70430e4036745dd352e7f1ab91740814491.jpg', 'image3_3656e9fa6565ff45d42075361ecebfb31740814491.jpg', 2000, 4500, 5600, 1000, '2024-09-25 06:31:44'),
(2, 'Caribbean Cruises', '87aef1d76079b03ca48a59280539bced1740807097.jpg', 'Large', '1000', 'Miami', 'USA ', 'Bahamas, Jamaica, Cozumel (Mexico), Puerto Rico', 1000, '2025-03-06 02:00:00', '2025-03-07 05:00:00', 'One of the highlights of MSC Virtuosa’s onboard entertainment will be the two brand new Cirque du Soleil at Sea shows, created exclusively for MSC Cruises’ guests\r\nWith about 10 sq. m. of public space per guest, poolside space on MSC Virtuosa is some of the most plentiful to be found at sea\r\nThe large and spacious amusement park provides a large arena where the guests can play sports and games\r\n5 outdoor bars with breathtaking view and 16 indoor bars, each offering a unique experience\r\nMSC Virtuosa\'s namesake comes from the word virtuoso, meaning someone highly skilled in any field of activity, and so MSC Virtuosa was named to pay homage to the skill and expertise of the MSC Cruises architects and shipyard partners at Les Chantiers de l\'Atlantique who designed and built this innovative class of ships. This new cruise ship is one of the two largest in MSC Cruises\' fleet, along with her sister ship MSC Grandiosa, boasting an impressive array of guest features all coming together in perfect harmony to deliver the ultimate cruise vacation experience.', 2, 'image1_7c89d94a054010c6c6fe11f88b1603b01740814180.jpg', 'image2_4529b2d8f5d0eda4bf0d546907ad763c1740814180.jpg', 'image3_d10c948226fc857bc311dc9cff34e0ac1740814180.jpg', 3500, 5500, 8000, 2000, '2024-09-25 06:34:28'),
(3, 'East Cruise', 'c638ae216a0429d25559e8309d67241d1740808724.jpg', 'Large', '2000', 'Dubai, UAE', 'Middle East ', 'Dubai → Muscat (Oman) → Abu Dhabi → Doha (Qatar) → Dubai', 2500, '2025-03-23 02:00:00', '2025-03-23 09:00:00', 'This luxurious cruise offers a mix of modern and traditional Arabian experiences, from exploring souks and desert safaris to enjoying skyscrapers and luxury shopping in Dubai and Abu Dhabi.', 2, 'image1_b7f3022c758ab20efd064367a7c4c6f51740814582.jpg', 'image2_da8d417c073a1150b513cc69a26d32101740814582.jpg', 'image3_25c84eacdceef20bdde04be3cd4f53d91740814582.jpg', 2500, 4000, 7000, 1000, '2024-09-25 06:35:33'),
(4, 'Asia Cruise', '5ff2f0a17c5ba5d0fd61ba3f7bb91e151740808455.jpg', 'Large', '2000', 'Singapore ', 'Southeast ', 'Singapore → Phuket (Thailand) → Langkawi (Malaysia) → Bali (Indonesia) → Singapore', 1100, '2025-03-20 12:30:00', '2025-03-21 03:20:00', 'This cruise is ideal for exploring tropical islands, exotic beaches, and vibrant cultures. It includes activities like water sports, temple visits, and street food experiences.', 2, 'image1_ca25b5b8c3a68fabee5a0155fa5263b01740814548.jpg', 'image2_fb60fc6984824b7e1e9dd513d979da2e1740814548.jpg', 'image3_84d1f1bb73e46769fa710775ae19b1c61740814548.jpg', 4000, 8000, 10000, 3000, '2024-09-25 06:36:33'),
(5, 'Mediterranean Cruises', '5554d55619dbc91d07ed43ee9cb90e6a1740808129.jpg', 'Large', '1-20', 'Barcelona', 'Spain ', ' Rome, Italy → Santorini, Greece', 1200, '2025-03-11 12:00:00', '2025-03-12 03:00:00', 'Extraordinary features that offer the perfect experience at sea in every season\r\nExquisite, authentic dining options in 12 distinct venues\r\nOne of the most intricate and exciting water parks at sea, with three twisting slides\r\nParty with friends, enjoy a nightcap or simply dance into the small hours at the stylish onboard nightclub\r\nOffering 6 different shows, even on a 7-night cruise, featuring innovative world-class and standing-ovation productions', 2, 'image1_d61685e3dbc597eeda90209f75e74d6a1740814353.jpg', 'image2_981cbb5159840a4c44acb1d2cb89d3ed1740814353.jpg', 'image3_abdbd039954d3be800d34401ab3d1cb81740814353.jpg', 2800, 3000, 6000, 900, '2024-09-26 04:55:19'),
(6, 'Alaska Cruise', '0cc589562a8ea503b3c7b9eb1de255181740808940.jpg', 'Large', '5000', 'USA', 'Canada', 'Seattle → Ketchikan → Juneau → Glacier Bay → Victoria (Canada) → Seattle', 2000, '2025-03-11 12:30:00', '2025-03-13 02:00:00', 'Perfect for nature lovers, this cruise explores Alaska’s icy landscapes, glaciers, and wildlife like whales and bears. It offers activities like dog sledding and scenic train rides.', 2, 'image1_7ccb43e2b8c5775bd7b2040261ebdd701740814395.jpg', 'image2_6b88337889a230eac46c80bd91a425401740814395.jpg', 'image3_a6d0274100ac14e5e34dd898466d642a1740814395.jpg', 2600, 6000, 10000, 1800, '2024-09-26 05:34:22'),
(7, 'Caribbean Islands', '8a166641e85e673924e336ec992886601740808258.jpg', 'Large', '3000', 'Fort Lauderdale', 'USA ', 'St. Thomas, St. Maarten, Grand Cayman', 1500, '2025-03-13 05:00:00', '2025-03-14 09:12:00', 'MSC Meraviglia is packed with extraordinary features for the perfect experience at sea in any season. Enjoy outstanding dining options and out-of-this-world entertainment with new panoramic areas, an innovative ocean-view lounge, a two-deck inside promenade with an LED dome and a spectacular amusement area connected to an outdoor water park. Also, MSC Meraviglia is one of the four ships that sail to Ocean Cay MSC Marine Reserve, MSC’s exclusive Bahamian destination. Enjoy exclusive shows performed in innovative venues like the Carousel Lounge and the multi-purpose karaoke bar, comedy club, TV studio & bar. Younger guests will love amusement park and sports center. The whole family can have hours of fun in one of the most exciting water parks at sea.\r\n', 2, 'image1_2bc261b5547f3052fdc46226a55eea7a1740814463.jpg', 'image2_188115b5c354819ff77e801cdf8c873d1740814463.jpg', 'image3_7bf4c9a27ef28f34a3ac0d3d2a943fa71740814463.jpg', 3000, 7500, 9000, 2000, '2024-09-26 05:35:12'),
(8, 'Greek Isles Cruise', '6c8c5b11e6df40d84296d50b273747981740809122.jpg', 'Large', '2000', 'Venice, Italy ', 'Adriatic & Greek Isles', 'Venice → Dubrovnik (Croatia) → Santorini (Greece) → Mykonos → Corfu → Venice', 5000, '2025-03-12 05:00:00', '2025-02-13 12:00:00', 'A romantic and historical cruise featuring medieval towns, stunning Greek islands, and the famous canals of Venice. Ideal for history lovers and beachgoers.', 2, 'image1_14ecb3bdbb091921f56d14c71fd290f71740814431.jpg', 'image2_476688a4732396929bd1324faf9293be1740814431.jpg', 'image3_ba94b1fabeba61ced8b0c7888116a4681740814431.jpg', 5000, 10000, 15000, 2000, '2024-09-26 06:30:06'),
(9, 'Southampton Cruise', '622b8772986ddefc5da84e256f7e50fa1740809266.jpg', 'Large', '4000', 'London, UK', 'Northern Europe & Scandinavia', 'Southampton → Bruges (Belgium) → Copenhagen (Denmark) → Oslo (Norway) → Stockholm (Sweden) → Southampton', 4000, '2025-03-11 06:30:00', '2025-03-12 12:45:00', 'This cruise explores the rich history and culture of Northern Europe, featuring medieval cities, royal palaces, and scenic fjords. Highlights include the Viking heritage in Oslo and the beautiful canals of Copenhagen.\r\n\r\n', 2, 'image1_911105bef0b913af22021f58961ebec01740814213.jpg', 'image2_8220b23dafe294afc340f62b4bb422541740814213.jpg', 'image3_b756268e19ad5804ba91e5fd5aa9e1d81740814213.jpg', 2000, 3000, 5000, 700, '2024-09-27 05:41:33'),
(10, 'Mexican Riviera Cruise', 'c38f0da3828a3d3d0b127ca5d3e2c5bf1740809428.jpg', 'Medium', '1-4', 'Los Angeles, USA', 'Mexican Riviera', 'Los Angeles → Cabo San Lucas → Puerto Vallarta → Mazatlán → Los Angeles', 3000, '2025-03-26 12:00:00', '2025-03-27 01:20:00', 'A warm and tropical cruise along the Pacific coastline of Mexico, featuring stunning beaches, marine wildlife, and vibrant local culture. It’s popular for whale watching, snorkeling, and nightlife.\r\n\r\n', 2, 'image1_a99d5ccdbb090c022ce60c28b2a3e9801740814612.jpg', 'image2_fa05a206d61f31a4df2d6f835487f8d11740814612.jpg', 'image3_f5df409cc4db50939ee1ba8178e3a53b1740814612.jpg', 1100, 2200, 3200, 800, '2024-10-01 05:05:43'),
(11, 'Luxuries cruise', 'bce36420801217447162ef98cb7094871740809558.jpg', 'Large', '3000', 'Tokyo, Japan ', 'Asia Pacific', 'Tokyo → Busan (South Korea) → Shanghai (China) → Hong Kong → Manila (Philippines) → Tokyo', 3500, '2025-03-18 05:35:00', '2025-03-19 15:36:00', 'A mix of modern metropolises and cultural heritage sites, this cruise allows travelers to experience Japan’s futuristic cities, China’s ancient temples, and South Korea’s coastal beauty.\r\n\r\n', 2, 'image1_73a5627a24b566ec45b3b9221a348f431740814523.jpg', 'image2_26ec8e3fac256bd9db850653b6b815481740814523.jpg', 'image3_38b878367528ec3f0d37604e36dd387c1740814523.jpg', 1000, 2050, 3500, 750, '2025-01-18 16:06:01'),
(12, 'Coastal Cruise', '4ee863d88c1d68ad5c4a5bb97c2910521740810785.jpg', 'Large', '2400', 'Cape Town, South Africa', 'African Coastal ', 'Cape Town → Durban → Madagascar → Seychelles → Mauritius → Cape Town', 2400, '2025-04-01 12:59:00', '2025-04-02 13:52:00', 'A tropical and wildlife-rich cruise along Africa’s coastline, offering stunning island getaways, safaris, and oceanic biodiversity. It’s ideal for adventure seekers and beach lovers.', 2, 'image1_57ef83c96f4a0600965a22cb9777f3e51740814641.jpg', 'image2_678b750caa16f7225effb08de53ce1e21740814641.jpg', 'image3_5123b251fe44855666b052d99d61bfe51740814641.jpg', 1200, 2100, 3000, 700, '2025-03-01 06:31:10'),
(14, 'South American Explorer Cruise', 'd253aacd783120a4dd0be5e8bf75970d.jpg', 'Large', '5000', 'Rio de Janeiro, Brazi', 'South American Explorer', ': Rio de Janeiro → Buenos Aires (Argentina) → Montevideo (Uruguay) → Patagonia → Santiago (Chile)', 3499, '2025-03-05 03:20:00', '2025-03-06 07:36:00', 'This cruise highlights South America’s best landscapes, including the vibrant cities of Brazil and Argentina, stunning waterfalls, and the icy beauty of Patagonia.', 2, '2e41da6e8c56716f5037a10c3137a9cc.jpg', 'image2_b5106c32276da19079a47dcf73cf10f11740813561.jpg', '9c4e0a6d2271e580a1def1b5c2fd1224.jpg', 900, 2500, 4400, 650, '2025-03-01 06:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `tblboat_history`
--

CREATE TABLE `tblboat_history` (
  `ID` int(5) NOT NULL,
  `BoatName` varchar(250) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Size` varchar(100) DEFAULT NULL,
  `Capacity` varchar(100) DEFAULT NULL,
  `Source` varchar(250) DEFAULT NULL,
  `Destination` varchar(250) DEFAULT NULL,
  `Route` varchar(250) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `Description` mediumtext DEFAULT NULL,
  `AddedBy` int(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblboat_images`
--

CREATE TABLE `tblboat_images` (
  `id` int(11) NOT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `boat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblboat_images`
--

INSERT INTO `tblboat_images` (`id`, `Image`, `boat_id`) VALUES
(1, 'd41d8cd98f00b204e9800998ecf8427e1740810670', 12),
(2, 'd41d8cd98f00b204e9800998ecf8427e1740810670', 12),
(3, 'd41d8cd98f00b204e9800998ecf8427e1740810670', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookings`
--

CREATE TABLE `tblbookings` (
  `ID` int(5) NOT NULL,
  `BoatID` int(10) DEFAULT NULL,
  `BookingNumber` bigint(12) DEFAULT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `EmailId` varchar(250) DEFAULT NULL,
  `adhar_card` varchar(50) NOT NULL,
  `PhoneNumber` bigint(12) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `BookingDateFrom` varchar(250) DEFAULT NULL,
  `BookingDateTo` varchar(250) DEFAULT NULL,
  `BookingTime` varchar(100) DEFAULT NULL,
  `NumnerofPeople` int(5) DEFAULT NULL,
  `Notes` mediumtext DEFAULT NULL,
  `cancel_status` int(11) NOT NULL DEFAULT 0,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` varchar(250) DEFAULT NULL,
  `BookingStatus` varchar(250) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`ID`, `BoatID`, `BookingNumber`, `FullName`, `EmailId`, `adhar_card`, `PhoneNumber`, `price`, `class`, `gender`, `user_id`, `BookingDateFrom`, `BookingDateTo`, `BookingTime`, `NumnerofPeople`, `Notes`, `cancel_status`, `postingDate`, `AdminRemark`, `BookingStatus`, `UpdationDate`, `created_at`) VALUES
(4, 6, 5811679355, 'John ', 'sutax102@gmail.com', '0', 4566541230, '', '', '', NULL, '2024-11-08', '2024-11-09', '10:30', 4, 'NA', 0, '2024-10-14 15:11:02', 'Booking Appoved', 'Accepted', '2025-02-27 12:23:54', '2025-02-15 07:10:03'),
(21, 1, 2750784342, 'white paguses', 'sutax102@gmail.com', '985632147000', 9874563210, '1800', 'executive', 'male', NULL, NULL, NULL, NULL, 2, '', 0, '2025-02-15 14:06:25', NULL, 'Accepted', '2025-02-27 12:23:58', '2025-02-15 14:06:25'),
(23, 2, 3129569692, 'jayi joshi', 'sutax102@gmail.com', '987456321147', 9874125630, '1800', 'executive', 'female', 5, NULL, NULL, NULL, 2, '', 0, '2025-02-27 08:55:49', NULL, 'Accepted', '2025-02-27 12:24:04', '2025-02-27 08:55:49'),
(24, 7, 6007054073, 'Kavel  Kanani Mukeshbhai', 'rovace1808@calmpros.com', '987456321000', 9737264670, '7000', 'sleeper', 'male', 2, NULL, NULL, NULL, 2, '', 0, '2025-03-01 11:15:07', NULL, 'Accepted', '2025-03-01 11:18:06', '2025-03-01 11:15:07'),
(25, 2, 8840510796, 'Het joshy k.', 'hat@gmail.com', '985632014789', 7894563210, '4500', 'executive', 'male', 2, NULL, NULL, NULL, 1, '', 0, '2025-03-01 11:21:51', NULL, 'Accepted', '2025-03-01 11:51:43', '2025-03-01 11:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `id` int(11) NOT NULL,
  `booking_id` bigint(12) DEFAULT NULL,
  `txn_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `login_email` varchar(50) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`id`, `booking_id`, `txn_id`, `email`, `amount`, `payment_status`, `login_email`, `payment_date`) VALUES
(15, 1319339120, 'txn_3QjjJVPx6HkKfodW0KG0IUxb', 'abc@gmail.com', 1200.00, 'Yes', 'ram@gmail.com', '2025-01-21 15:24:25'),
(16, 2147483647, 'txn_3Qsm1sPx6HkKfodW0KmHjDFS', 'avadh@gmail.com', 1800.00, 'Yes', 'wovos30942@intady.com', '2025-02-15 14:07:36'),
(17, 1102195146, 'txn_3QsmcLPx6HkKfodW2LuTp7qJ', 'wotor30234@arensus.com', 2700.00, 'Yes', 'wovos30942@intady.com', '2025-02-15 14:45:17'),
(21, 8840510796, 'txn_3Qxoa8Px6HkKfodW2amD8QFt', 'hat@gmail.com', 4500.00, 'Yes', 'wovos30942@intady.com', '2025-03-01 11:51:43'),
(22, 3608679795, 'txn_3Qxod9Px6HkKfodW2201gTW8', 'mofivo9318@halbov.com', 3500.00, 'Yes', 'wovos30942@intady.com', '2025-03-01 11:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblreviews`
--

CREATE TABLE `tblreviews` (
  `review_id` int(11) NOT NULL,
  `boat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `rating` int(1) NOT NULL,
  `review_text` text NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreviews`
--

INSERT INTO `tblreviews` (`review_id`, `boat_id`, `user_id`, `username`, `rating`, `review_text`, `review_date`, `status`) VALUES
(9, 3, 5, 'kkk123', 2, 'Enjoyed the itinerary, 3 days in port was fantastic! Never had to wait for service. Got a great deal on the spa services!\r\n', '2025-02-27 10:21:32', 'pending'),
(10, 1, 5, 'kkk123', 3, 'Stayed in a Haven room. Excellent butler Isarah (sp?) Dining rooms super.', '2025-02-27 10:22:37', 'pending'),
(11, 2, 5, 'kkk123', 2, 'With the exception of two negative experiences- the cruise was great. The length of time needed for the LA immigration check was improperly communicated. They did not adequately tell passengers that they would not be permitted to reboard the ship until after noon. Total of 4.5 hrs wasted in a terminal building. We also arranged bus transfers to SF airport. We were in line for over 2 hrs waiting for buses to take us to the airport. As a general comment: Amount of time spent in ports was relatively short.', '2025-02-27 10:22:58', 'pending'),
(12, 2, 2, 'Ram123', 4, 'With the exception of two negative experiences- the cruise was great. The length of time needed for the LA immigration check was improperly communicated. They did not adequately tell passengers that they would not be permitted to reboard the ship until after noon. Total of 4.5 hrs wasted in a terminal building. We also arranged bus transfers to SF airport. We were in line for over 2 hrs waiting for buses to take us to the airport. As a general comment: Amount of time spent in ports was relatively short.', '2025-02-27 10:23:06', 'pending'),
(13, 4, 2, 'Ram123', 5, 'The food was delicious but I had trouble having no halal meat for Muslims\r\n\r\n', '2025-02-27 10:24:14', 'pending'),
(14, 5, 2, 'Ram123', 4, 'Staffs did not know information to simple questions. They were rude. Absolute the worst cruise we have ever been to. Never again.\r\n\r\n', '2025-02-27 10:24:35', 'pending'),
(15, 2, 2, 'Ram123', 3, 'Cruise services offer a luxurious and hassle-free way to explore multiple destinations while enjoying world-class amenities. From gourmet dining and entertainment to spa treatments and adventure activities, cruises cater to diverse interests. The all-inclusive nature ensures convenience, with accommodation, food, and entertainment seamlessly integrated. Whether it\'s a family vacation, romantic getaway, or solo adventure, cruises provide a unique blend of relaxation and exploration. The well-trained staff, breathtaking ocean views, and immersive shore excursions enhance the overall experience. While prices vary, the value for money is excellent. Overall, cruises are an exceptional way to travel in style and comfort.', '2025-03-01 11:26:32', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `txn_id` varchar(50) DEFAULT NULL,
  `ticket_number` varchar(50) NOT NULL,
  `login_email` varchar(50) NOT NULL,
  `passenger_name` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `boat_id` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `number_of_passengers` int(11) NOT NULL,
  `cancel_status` int(11) NOT NULL DEFAULT 0,
  `issue_date` datetime NOT NULL DEFAULT current_timestamp(),
  `booking_id` bigint(12) DEFAULT NULL,
  `Notes` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `txn_id`, `ticket_number`, `login_email`, `passenger_name`, `price`, `boat_id`, `email`, `class`, `number_of_passengers`, `cancel_status`, `issue_date`, `booking_id`, `Notes`) VALUES
(14, 'txn_3QjjJVPx6HkKfodW0KG0IUxb', '3189003882', 'ram@gmail.com', 'ava joy', '1200', 1, 'abc@gmail.com', 'business', 1, 0, '2025-01-21 20:54:25', 1319339120, ''),
(20, 'txn_3Qxoa8Px6HkKfodW2amD8QFt', '2894267355', 'wovos30942@intady.com', 'Het joshy k.', '4500', 2, 'hat@gmail.com', 'executive', 1, 0, '2025-03-01 17:21:43', 8840510796, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `otp` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `phone`, `city`, `otp`, `created_at`) VALUES
(1, 'het123', 'het@gmail.com', '202cb962ac59075b964b07152d234b70', '1739609807_2.jpg', '1236547890', 'Rajkot,Gujarat', 0, '2025-02-15 08:28:55'),
(2, 'Ram123', 'bowadav568@payposs.com', '202cb962ac59075b964b07152d234b70', '1739526257_person_2.jpg', '9085647123', 'surat', 732728, '2025-02-15 08:28:55'),
(3, 'het', 'avadh@gmail.com', '202cb962ac59075b964b07152d234b70', '1739609951_1.jpg', '8523697410', 'Ahmbdabad', 0, '2025-02-15 08:28:55'),
(5, 'kkk123', 'tokaga2194@kaiav.com', '7ef605fc8dba5425d6965fbd4c8fbe1f', '1739607174_3.jpg', '9874563210', 'surat', 0, '2025-02-15 08:28:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_blogs`
--
ALTER TABLE `gym_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `port_list`
--
ALTER TABLE `port_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblboat`
--
ALTER TABLE `tblboat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblboat_images`
--
ALTER TABLE `tblboat_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `bid` (`BoatID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreviews`
--
ALTER TABLE `tblreviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gym_blogs`
--
ALTER TABLE `gym_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `port_list`
--
ALTER TABLE `port_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblboat`
--
ALTER TABLE `tblboat`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblboat_images`
--
ALTER TABLE `tblboat_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblbookings`
--
ALTER TABLE `tblbookings`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblreviews`
--
ALTER TABLE `tblreviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD CONSTRAINT `bid` FOREIGN KEY (`BoatID`) REFERENCES `tblboat` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
