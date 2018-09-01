-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: shareddb-g.hosting.stackcp.net
-- Generation Time: Jan 26, 2018 at 09:33 AM
-- Server version: 10.1.14-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vastukosh-32353f7f`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `idno` varchar(15) NOT NULL,
  `idpic` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `location`, `address`, `mobile`, `email`, `password`, `idno`, `idpic`, `status`) VALUES
(30, 'Siddhartha Dhar Choudhury', 'Chennai, Tamil Nadu, India', 'SRM Institute of Science and Technology', '8428258442', 'sdharchou@gmail.com', 'fbb66abf89cd4ab4d11f2be1d63e9c242d6d345d983285eff7ce4e8fe19c656d33687cb52a318f4bf1de8b06f4a0bb6c889885e781a98371e0c5081d5ed5e8f2', '123456789058', 'no.png', 1),
(33, 'Dhairya Jain', 'Chennai, Tamil Nadu, India', 'SRM Hostels', '9950538992', 'djdhairya.dj@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '232154789654', 'no.png', 1),
(34, 'Sudipta Dhar Choudhury', 'Kolkata', '58/123 Prince Anwarshah Road', '7005627589', 'rumkisen07@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '978998192764', 'no.png', 1),
(35, 'Reema Duttavarman', 'Varanasi', 'Flat no 501, Shanti Vimla Aprtt,  Rohit Nagar, Naria  Lanka', '9721452119', 'reemadroy@gmail.com', 'dca382239cad5d7bb2304c467588c39b82b9f6f5576587060b531b1a7cf63bcbf66f6289cb4d598affcab163c3ee6593f1d3c42c2dd703102473b00e09dc588a', '466912077067', 'no.png', 1),
(36, 'Bhavik Singhal', 'Gudiwara', 'SRM Hostels', '9100586790', 'Bhavik.ksvss@gmail.com', '7e49d2d6e8eefa16ff84d4179d17252ccb8e0534e250138ab94099dc157eef9f0a043ea24201bc10d711271402123535fe18e4f143c2fcb1a5b14aa49db2a0fa', '133803553116', 'no.png', 1),
(37, 'Pravir Kumar Sen', 'Kolkata', '58/123 Prince Anwarshah Road', '9830214771', 'pravirkumar.sen@gmail.com', 'd0f82056b5da467c1e1249ac06cc86f61fa027ad9edee94a2a6bab6a5b8e3bbc4cb661f024719cf59a886c1aaa38c2ec4b39d3397d4ca25d572462777ce16110', '142131337642', 'no.png', 0),
(38, 'Shaique Solanki', 'Bengaluru', 'MSRIT', '9739081379', 'solankishaque@gmail.com', 'efbc106a37c1d590ea01dec0beeb4ef806402ec02402948a9ff42c7b87f3ac8a711476e0e6aa40df2db27a5b51845b01a466027fdbe9968fd8ff1582ce491c66', '704039817558', 'no.png', 1),
(40, 'Varsha G. Naik', 'Mangalore', 'St. Aloysius College', '9481835954', 'varshanaik318@gmail.com', '5914d20dc18f2b9a6745f7cce051b885dbf8d337f48cc41239a568abd4869a67b9b3bf139f18b462280b41bf797c378789ac827e60a2e1979b61f416827cc768', '473158415265', 'no.png', 0),
(41, 'Samit Sen', 'Sydney', '6 Sarabh Street, Kellyville, NSW 2155', '+614399394', 'Samit.sen@jci.com', '819a110c4c4282afde20eba05b7445ed0699866f27497bdd7b7c67b9a99e5e77c0ae0c3a377b288b6cc8d3ed9eaa5bbc657233d801fede03a3d928cfdac50852', '175249233667', 'no.png', 1),
(42, 'Etishree Sahu', 'Bhubaneshwar', 'KIIT', '9861882922', 'etishreesahoo100@gmail.com', '7f234757b3a95fb34399585d70fa988d771cc95b92b7d77ec58259390ec1935acdcbe5e3136a3325406fd494eec7204b3abb165214fe3d4922a72b4a743b0a22', '972518674078', 'no.png', 1),
(43, 'Munmun Debnath', 'Tezpur', 'Jyotinagar, Mazgaon, Sonitput', '8131867911', 'munmundeb.98@gmail.com', 'b64f59857e4efeab69d54e4a8a443596184951f79cddc44b69a39023a2e6be08349f2555ce21e737dfe1e05adf0b62e1a053bfc5e5e033c7521c60f644e0ddce', '788853138933', 'no.png', 0),
(44, 'Sanjukta Sinharay', 'Kolkata', 'Jadavpur University', '8637597415', 'pinkisanjukta@gmail.com', 'e71d60a892eb452714da98a44961dc1ba700280ce73a79a41f8e2673e0c07932756cde22b4c90e6f74297110452e10acc8e2b6a1fd36fedbd1bb7c035c9e4e6a', '321568695067', 'no.png', 0),
(45, 'Mriganka Chaturvedi', 'Rawatbhata', 'Poornima College of Engineering', '9828811701', 'mrigankachaturvedi@gmail.com', '7929f38aca0b410fb824013ee41a47434722c1563a843f760ff3591d09f8e4219c684942a57fbbe44d267b68dcc8d74d02553a2da80f7607075d861f13b98f88', '380579040246', 'no.png', 0),
(46, 'Ashutosh Singh', 'Varanasi', 'Heritage Institue of Medical Sciences', '9129670697', 'ashutoshpsg@gmail.com', 'a072d5111db256d24fcaea0e46a3e75827187a8e668c0def238bfcec9267115db1a40c3467577bb623fa825fda7a47649401d17051f92da8b9790da319b7ce70', '291495080179', 'no.png', 1),
(47, 'Shruti Jain', 'Muzaffarnagar', 'IIT Bombay', '7525968587', 'shruticom.jain@gmail.com', '2ca24e7c519581c39ed23db916c510190ee83e3e19981da3a5578554b14b3d97ddef8ccc98c1dfcbbb78185c52c5c2d2a3c84ef34064c2f7b54bc858263f508a', '315289130285', 'no.png', 1),
(48, 'Janvee Menghrajani', 'Jaipur', 'Manipal University', '7073580251', 'jnvmgh@gmail.com', '895b87921661b7291bca7aca985dbb34bbd3123c57579b61fb6acc6ee1f290b108f478c2d869b64c72dff2ae44a674b5ea13621e9f19049503a40219d5ac3483', '666923983133', 'no.png', 1),
(49, 'Ananthu Nair', 'Surat', '108/A1, Sai Krupa Park, Opp. Sri Ram Marbles, Althan Road', '8939432238', 'ananthunair117@gmail.com', '9001fcba4cab46ee06db2f3dde47dd24d56f60ac28592d1d331a7e184ff0b40db0263aa001f3e5aef8fefe1faf7ce410f192c4ce5421075b2bbc1ac8ee6db28b', '718631474009', 'no.png', 1),
(50, 'Vaibhav Jain', 'Muzaffarnagar', 'S.D Polytechnic College', '9084640112', 'Jainvaibhav936@gmail.com', '363709c1bed1003ef69e586cbc9d7284f191673e339601d9009a3e193235fbcf2b7a14846c2839af418ab52e0a89d67cb7b08f9bc15f688a85b491b8ff09971f', '961992282123', 'no.png', 1),
(51, 'Soham Bhowmick', 'Vadodra', 'Don\'t', '9429916022', 'soham.bhowmick97@gmail.com', 'ca9212b9724e8c019894e7fecc1397002b9aa17510b4afd7a0b450c81f0ee8a0ecfd9d91858b1edf206344f0df86af5ff5c1703566ea5c37cd71ec396f53c3eb', '631820861694', 'no.png', 1),
(52, 'Shalin Shandilya', 'Muzaffarnagar', 'Lovely Professional University', '9634999994', 'Shalinshandilya@gmail.com', '9917780270d9770607a6a0d8468b7139cf8be0e2d84f2c2d5f531cb26c23315b3778be9b18b1d07f8a91792d9f82d1e3acc11066501868f5338fd589a5aed1f8', '882877813074', 'no.png', 1),
(53, 'Ateet Tiwari', 'Jaipur', 'MNIT', '9461711629', '16ucs050@lnmiit.ac.in', 'a76a47e28db4e326991b0f0903c939cfd72cfe4ba85f5af83ef1dc31f59645e23e0ed2c13cdfdb9c60f9b0bd779d879288ebcdbd1109e24a26fa570bffb60a7e', '523641864899', 'no.png', 1),
(54, 'Akash Verma', 'Muzaffarnagar', 'Amity University', '9557720052', 'akash.ver03@gmail.com', '5f41c55401b35b68a3b28749d8de3f22cb1211b716ac7d3fbbb61baf69c8180c72c7d97426fa386a1683f206071821279fdd7bdfb89d5f5b9a3033853b6db53c', '462141942577', 'no.png', 0),
(55, 'Nitish Jain', 'Hyderabad', 'Bloomberg', '9878877546', 'pogascry@gmail.com', '9764ab0f7d0cb67e7b69f7abebd6f275df21da6fd9c58b013811a11670941319ce6dbecfdd8411e64eb2c577937eb42826734257bde87c554495c2f349fc6154', '795082165902', 'no.png', 1),
(56, 'Harimangal Pandey', 'Delhi', 'Sec-62, Green Boulevard', '8130914724', 'Pandeyjss01@gmail.com', '970e7e6e3f6d186af49060382135e7f34d33627d273753742bb2e2a3ec1e3f88bdd57109d605c463b6b409e62b503d386f29b0d4b233c21cdb9c44c6d53f2c1a', '488098733623', 'no.png', 1),
(57, 'Sanjay Jain', 'Rawatbhata', 'Type IV 102/B Anupratap Colony', '9413358413', 'smdpjain@gmail.com', 'a7c43ea056b6e98c429605c64f899c859621e1603a39d4797407f042713a9a7eda01e1aaff480b73ab3ce9d33e0ae8ada2ac768177d999e47f8e0ec2e9bfcb57', '813208185442', 'no.png', 1),
(58, 'Rajsi Jain', 'Mumbai', 'K.J Somaiya Institute of Management Studies and Research', '9869640477', 'rajsijain41097@gmail.com', 'e367aa9b0dec0bb877ec1012dde749a5ac2c8a3045ef924e2289c9df2f2c3e79fb25dae8068e5fe5a124692885cb6836f82e1572dbcde0bfd6cbd00cdca4dda9', '521937384949', 'no.png', 1),
(59, 'Agnibha Biswas', 'Chennai', 'SRM Institute of Science and Technology', '9952919521', 'biswasagnibha97@gmail.com', 'bdcd282eb088250d2c329c751452d4bb05f74ed3afb4d94b9dccc6ca8adfb7d4a7cf7afeae1f505bc9c3d3823a817a3215a18f51b3066ecffd148017529ffd6b', '914400306099', 'no.png', 1),
(60, 'Aryan Chauhan', 'Bilaspur', 'PV 11 Railway Colony, Bilaspur', '7358084247', 'aryanqwerty123vc@gmail.com', '34f181570794f982dd2b80bf096e8dd062a9437c977f81b5c70a8dc6434a5c3c7fa1f64e5902795540da800625bb2231db5cb0613a8b4dd334e6ecc78f773502', '521671935666', 'no.png', 0),
(61, 'Madhavi Ojha ', 'Pasighat', 'Upper Banskota', '8258072950', 'Madhaviojha1@gmail.com', '669c68d7304502c43b7a6f831e3efc37dd7166205df8e3d07387155662dae0d7498f2ab7922aca31e02f2206a70bdd668853964e94757b48a34dbbff475ae71d', '861057975651', 'no.png', 0),
(62, 'Srilekha V', 'Chennai', 'SRM Institute of Science and Technology', '9502242806', 'srilekhav19@gmail.com', 'ebe98e02a8388bc122ac8337c9e01310326f40f20f29025883c1498ffc2cacf29229d20edd161b2339aefc28e0ea48989bbf25ff7c104d0b8d6c3759df3354cb', '162056701959', 'no.png', 1),
(64, 'Saurjya Bhattacharjee', 'Kolkata', '23/A Sahapur Colony, New Alipore Kolkata, West Bengal', '9874229833', 'Suarjya.bhattacharjee016@gmail.com', '59cbb4981d2f81f814e7016d967057800d571250a35bdd9b89ac2e3ee67a2a1fc851ac3cbe56f8554b5ec6c75565c1af565c66c041c5b91a29ed108dd80fbf56', '657416899729', 'no.png', 1),
(65, 'Shashank Pandey', 'Chennai', 'SRM university', '8299805309', 'pandeyshashank512@gmail.com', '9ea6ff4a26d99a7e98d8efa8e31f784392d3d1753b2c8b758b6b6dca683b00218d5491f327060980291cfa724a7b593946b27ad958990c6e866158a8a91941ae', '146226410894', 'no.png', 1),
(66, 'Rushil Gupta', 'Chennai', 'SRM University', '8127807034', 'rushil.rushil.gupta@gmail.com', 'fa733720400e5242ef561b992bfb86dce24da070c5c008eeb3a833ce29c16f5d14b360bd0690a96fdd773c19babdfbffbdd97fe7e324a4d34f07064d4a819521', '608670586585', 'no.png', 1),
(67, 'Amol Agrawal', 'Janjgir', 'Don\'t', '9999064658', 'amolagrawal98@gmail.com', '5085434c76cfd5687ea141f067922d9ba2e5690e712b0686678f2c61a90306edad1038c73d84b0bdc93159c2eedd508abc790c156b83b1255cb4b034da8bb09a', '668300958986', 'no.png', 1),
(68, 'Payal Jasoriya', 'Khairtal', 'All India Institute of Medical Sciences, Raipur', '9672747914', 'Jaspayal231198@gmail.com', '7000abd6474b4bca1bafca6183caf7d817a83c391fd9f054a16c95e7ec52be9c160e95c76f66d527d0535d008cd15b1fd5cc3db05e732109fe2badf33588fdd3', '165438254678', 'no.png', 0),
(69, 'Puneet Khandelwal', 'New Delhi', 'S S N Marg, Near Arya Samaj Mandir, Chattetpur Enclave Phase -2', '9810392172', 'Khandupuneet@gmail.com', 'c99c0fb2e94767bae1dc1b2ed3a2f2fddf263a5b634bc0f89430e1a9d7ed2d89b38ec251ca6b75b1b9e7dfa2905be94a4dd2bac439be785ec9cb2e2851166403', '317881920720', 'no.png', 0),
(70, 'Meenu Jasoriya', 'Kota', 'Mahaveer Nagar II, Kota', '9413358413', 'Jmeenu27@yahoo.co.in', '66b7ac55af53352584e353f4589e950a3bb987ca9f1020caa028208b37f411f936d5154530e98006bcab3c1bf214081304570bb7f3af9b1ff25e797c8cb0c475', '673257311918', 'no.png', 0),
(71, 'Dipika Singh', 'Bhiwadi', 'Thapar University', '7240294102', 'dpksingh101996@gmail.com', '54d906616571eef7a8d0000dcb5aa037cf6f34a610fbefbbd6823ab36e51041f144c2c4a026e5e97efc6636a0d4c49dfb12d0f60b69283239b7fd1f2e192bd2f', '515677176491', 'no.png', 0),
(72, 'Meenakshi Swaminathan', 'Mumbai', 'Modal Town, Near Chacha Nehru Park, Andheri W', '9920986135', 'meenaswami135@gmail.com', '121aa909d479ec333b64e0831b98aa067eb9daff0c14f507a3f58af699f29d3df4d791f7264762f9aafcad8a3b898c2d836290097ccff8ad8dc6d614d0412133', '370211660529', 'no.png', 1),
(73, 'Vijay Sherawat', 'Bengaluru', 'Smnvi Elite, 5th Cross Road, Near Four Point Super Market, Doddathogur', '9663368830', 'Vijayka007@gmail.com', '1028363d99ff555a6b72cb48bcf75fbc019fcb98ebd52bcfd07be0a82347f1046192b020630a35798fa1b1a644ff86bf51b3d411eb540afbf427c679e693e736', '650947502167', 'no.png', 1),
(74, 'Oyimang Apum', 'Pasighat', 'E-5 Tebo, GTC', '7641030580', '123oyimangapum@gmail.com', '586fbe536e256888783a3247bc4e0771bc8e137d3413b77b278c21c3d7b5fcb639428f67af609e316b6d862e935ecb9d6fc3796c9fe9faeb73c8881b684be39c', '309701831596', 'no.png', 1),
(75, 'Anup Sharma', 'Gurgaon', 'M Block, Jacaranda Marg DLF City, Phase II, Gurgaon', '9871597724', 'Alertanup@gmail.com', 'fb505a5ae1e03ec372d17594675ce1a4928ea9ec308a3727fdb38ce33c60a53c15a7948fbfb9be92ae978b986e106442961bceebb732057795c31f58e918982f', '568860861738', 'no.png', 1),
(76, 'Anjali Thakur', 'Noida', 'Elite Homz, Link Road, Near North Eye, Sector 77', '9868184921', 'anjalithakurnoida@gmail.com', '4983410f7172a8c6384b3f36a80263288941c7b206e3005fedf349587ac89cfd7b56d73bf5765a5965e08047f9129ba5d897324e311d7ff24b8b4d9ed347a4bf', '908607048554', 'no.png', 1),
(77, 'Bheem Choudhary', 'Delhi', '\r\nHardev nagar, jharoda', '9784265298', 'bheemsingh298@gmail.com', '3cc2ee107fa62cb5e7b2cb6eeb96864fa10289f92281295c92b1c23155d0c15f7a23c823fdec63e20eec3ddabce8f749e9fc47dcb8cc25ebb27510c87a6166fc', '478277418322', 'no.png', 1),
(78, 'Avneet Gupta', 'Bengaluru', 'Evergreen Street, Udayanagar Extension, Mahadevapura,', '9886041201', 'avneet@gmail.com', '657c8149bb099259661eb3e545ca5952aaa110dd88bfd6d417aa975837c1cf610c9189ae1d16c6ee86f955520189d6467ef945b0c067d2039a0bb6d91f60c204', '761230498164', 'no.png', 1),
(79, 'Soumen Dhar Choudhury', 'Pasighat', 'J N College Campus', '9862622085', 'soumendhar@gmail.com', 'f43d11b9e338dd9588efbb77228fee0d2ad406c3fa808e4fa5020884fe4df3e782b11205ced90f7080976ac1d3c74afc54da03613eb175e956f94108879e67c2', '580702547859', 'no.png', 1),
(80, 'Deepa Kar', 'Ghaziabad', 'IISER Pune', '9997027553', 'drdeepa.kar@gmail.com', '91685b680aa505ed3c0dd5dc45db3f923487abb806241eb7d613df4472b22640884b45961d0f564769f695b23a3740c35d431df246bdcf33ea9eb49f88f90bc7', '202080408503', 'no.png', 1),
(81, 'Shubham Jha', 'Alwar', 'Dhashmesh Residency, Kota', '7014005177', 'shubhamjha008@gmail.com', '04cef7db796b2b077c12be6bf38f5515dff27dae762eaa7d19dbd59a846c18006b250db3c93bf08081b9eee604830863998c78b4a7daa1333a079a446bdcf6c5', '728394296865', 'no.png', 0),
(82, 'Neha Bathra', 'Gandhinagar', 'NIFT Gandhinagar', '9662450185', 'Neha.bathra06@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '217694926130', 'no.png', 1),
(83, 'Jai Sharma', 'Alwar', 'IISER Bhopal', '7297943041', 'jaisharrma895@gmail.com', '9502df15dc6d0061ee79bc1499d93fd516eb1fb3ba877e6475bdcff9a1622470cdedb9ac5a93ff6334f42f453f8d76b1fb955d10e4f6f6ef7ae15745d726414e', '962038728125', 'no.png', 0),
(84, 'Harsh Jha', 'Kota', 'Dalmia Hostel, Kota', '8529776039', 'harshjhadm@gmail.com', '0e50f4ce9142e33141fe8dfcb55e4e5def5f12630c2f4e0dbcfe4ed49894ec5e3dd76215bd3f92f3035fe710f1bcc1f676e7d37114406d97983cc1fd8105914d', '257207677935', 'no.png', 1),
(85, 'Ashu Thangaraj', 'Bengaluru', '25th B Cross Road, Near Apollo Pharmacy, 2nd Sector', '9886054982', 'Ashu.than@gmail.com', '6cc9d78179860bac1f61ff5e8073d8663cd632ad08e23bc923ae884cd5780afd3db6b9ccd44ffebbfd83bf3f773da90380e8b094842de235590cc8bbca75a477', '556917374849', 'no.png', 0),
(86, 'Mili Das Mohapatra', 'New Delhi', 'D-26, Mehrauli Badarpur Road, Near Sai Mandir, Block-d', '9213527654', 'milidm@yahoo.com', 'a22a1b9f97f0c920a323194fd4cdd9d5504d20f415b35033f17c6ac355e7696e5b7e628b25b5df6d59c2b3fdf82bc3e3169b521d00df591d73cfe5a76303aab4', '762292410198', 'no.png', 1),
(87, 'Madhup Upadhyay', 'Bhopal', 'Bawadia Kalan, Bhopal', '9414218446', 'upadhyay.madhup@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '622386917699', 'no.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
