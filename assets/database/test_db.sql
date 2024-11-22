-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 04:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_username` varchar(10) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `admin_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'admin', 'admin123', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(10) NOT NULL,
  `applicant_username` varchar(10) NOT NULL,
  `applicant_password` varchar(200) NOT NULL,
  `applicant_first_name` varchar(50) NOT NULL,
  `applicant_last_name` varchar(50) NOT NULL,
  `applicant_email` varchar(100) NOT NULL,
  `applicant_profile_picture` text NOT NULL,
  `applicant_recycle_bin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `applicant_username`, `applicant_password`, `applicant_first_name`, `applicant_last_name`, `applicant_email`, `applicant_profile_picture`, `applicant_recycle_bin`) VALUES
(9, 'Sithira', '$2y$10$KW2qCR1SAd37UL9LhgFsR..nBpT9JCuRfSkpRK9ptBeV/WJH1ultO', 'Sithira', 'Lakvindu', 'sithira@gmail.com', 'APPLICANT_IMG-672724eb59b1d9.78623978.jpg', 0),
(10, 'isuru', '$2y$10$iWzT4hyfQJZIIUSWvfmV3.3/eIWNuk9UWCaOUb163BFR4SHI1dnra', 'Isuru', 'Sidath', 'isuru@gmail.com', 'APPLICANT_IMG-672729ea1e1d92.32204093.jpg', 0),
(11, 'Saman', '$2y$10$vFa.J1iRGt/5Ph3StKvP1OaqJ8G02vuFRsBNfCJiT45efk7xM.G/S', 'Saman', 'Kumara', 'samankumara@gmail.com', 'APPLICANT_IMG-6727bd08a1dd14.32976619.jpg', 0),
(12, 'Sandali', '$2y$10$Tbji6lWsFdkuUPp5qMWdWuV7dxsyWkXs3M3w3xi3yBt35vbn68e8.', 'Sandali', 'Sehasna', 'sehasna@gmail.com', 'APPLICANT_IMG-6727bddc137ff6.11634356.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(10) NOT NULL,
  `applicant_id` int(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `applicant_full_name` varchar(200) NOT NULL,
  `applicant_mobile_number` varchar(50) NOT NULL,
  `applicant_contact_email` varchar(100) NOT NULL,
  `applicant_cv` text NOT NULL,
  `applicant_cover_letter` text NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `application_recycle_bin` int(1) NOT NULL,
  `is_approved` int(1) NOT NULL DEFAULT 0,
  `approved_description` varchar(1000) NOT NULL,
  `approved_link` varchar(1000) NOT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT 0,
  `read_status_a` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `applicant_id`, `job_id`, `company_id`, `applicant_full_name`, `applicant_mobile_number`, `applicant_contact_email`, `applicant_cv`, `applicant_cover_letter`, `applied_date`, `application_recycle_bin`, `is_approved`, `approved_description`, `approved_link`, `read_status`, `read_status_a`) VALUES
(28, 10, 25, 29, 'Isuru Sidath', '0716589547', 'isuru@gmail.com', 'CV-6727337fa88ee1.78812843.pdf', 'COVER_LETTER-6727337fa8d803.80054880.pdf', '2024-11-19 15:01:08', 0, 1, 'Thank you for your interest in the Digital Marketer role at Unilever. After reviewing your CV, we are pleased to invite you to participate in an online interview.\n\n26 November 2024, 9:30am', 'https://meet.google.com/zxu-mryb-aee', 0, 1),
(29, 9, 25, 29, 'Sithira Lakvindu', '0771759842', 'sithira@gmail.com', 'CV-6727bc167bfa82.51846621.pdf', 'COVER_LETTER-6727bc167c2864.10279850.pdf', '2024-11-19 15:06:06', 0, 1, 'Thank you for your interest in the Digital Marketer role at Unilever. After reviewing your CV, we are pleased to invite you to participate in an online interview.\n\n10 December 2024, 11:00am', 'https://meet.google.com/zxu-mryb-aee', 0, 1),
(30, 9, 28, 35, 'Sithira Lakvindu', '0771759842', 'sithira@gmail.com', 'CV-6727bc2ebb3996.61093059.pdf', 'COVER_LETTER-6727bc2ebb6767.90747641.pdf', '2024-11-19 15:06:49', 0, 1, 'Thank you for your interest in the Senior Product Executive role at SLT-Mobitel (Pvt) Ltd. After reviewing your CV, we are pleased to invite you to participate in an online interview.\n\n01 December 2024, 10:30am', 'https://meet.google.com/zxu-mryb-aee', 1, 1),
(31, 9, 30, 34, 'Sithira Lakvindu', '0771759842', 'sithira@gmail.com', 'CV-6727bc48277721.63973130.pdf', 'COVER_LETTER-6727bc4827a3a7.12037442.pdf', '2024-11-19 08:36:40', 0, 2, '', '', 1, 0),
(32, 11, 33, 34, 'Saman Kumara', '0782749857', 'samankumara@gmail.com', 'CV-6727bd58829f11.17692495.pdf', 'COVER_LETTER-6727bd5882c303.58442648.pdf', '2024-11-19 08:18:39', 0, 0, '', '', 1, 0),
(33, 11, 32, 32, 'Saman Kumara', '0782749857', 'samankumara@gmail.com', 'CV-6727bd9ae75f30.99950154.pdf', 'COVER_LETTER-6727bd9ae78921.79869815.pdf', '2024-11-19 15:09:25', 0, 2, '', '', 1, 0),
(34, 12, 31, 32, 'Sandali Sehasna', '0718957456', 'sehasna@gmail.com', 'CV-6727be0ce56549.06708767.pdf', 'COVER_LETTER-6727be0ce59997.56107620.pdf', '2024-11-19 15:08:37', 0, 1, 'Thank you for your interest in the UI Engineer role at Calcey Technologies. After reviewing your CV, we are pleased to invite you to participate in an online interview.\n\n30 November 2024, 9:00am', 'https://meet.google.com/zxu-mryb-aee', 1, 1),
(48, 9, 33, 34, 'Sithira Lakvindu', '0123654896', 'sithira@gmail.com', 'CV-673c499cbf4c68.59112014.pdf', 'COVER_LETTER-673c499cbf91a2.72496204.pdf', '2024-11-19 08:44:17', 0, 1, 'Thank you for your interest in the Senior Banking Assistant role at DFCC Bank. After reviewing your CV, we are pleased to invite you to participate in an online interview.\n\n30 November 2024, 3:30pm.', 'https://meet.google.com/zxu-mryb-aee', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(10) NOT NULL,
  `company_username` varchar(10) NOT NULL,
  `company_password` varchar(200) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_website` varchar(100) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_description` longtext NOT NULL,
  `company_logo` text NOT NULL,
  `company_recycle_bin` int(1) NOT NULL,
  `is_approved` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_username`, `company_password`, `company_name`, `company_website`, `company_email`, `company_description`, `company_logo`, `company_recycle_bin`, `is_approved`) VALUES
(29, 'unilever', '$2y$10$TZyJNtnQPd.nylO2kAReleZyc/rPqAZJJaMdkWyhpwx32YPcodQC6', 'Unilever', 'www.unilever.com', 'unilever.career@unilever.com', 'Unilever plc is a British multinational consumer goods company with headquarters in London, England. Unilever products include food, condiments, ice cream, cleaning agents, beauty products, and personal care. Unilever is the largest producer of soap in the world and its products are available in around 190 countries.', 'COMPANY_IMG-672722f41b07e1.73333835.png', 0, 1),
(30, 'nawaloka', '$2y$10$xMdWY3WmHYpgv5mxWKRIW.s5m3Tjbd8d4woBDrcnu1p0PvTKFm1j.', 'Nawaloka (Pvt) Ltd', 'www.nawaloka.net', 'careers@nawaloka.net', 'Nawaloka Construction Company has undergone a long process on success in the local Construction Market with over 68 years rich and firsthand experience. Today the Company holds a predominant position in the Sri Lankan construction industry who has earned valued recognition in undertaking any challenging task in the field of CS2 category for High-rise Buildings , Highways and Heavy Construction.Nawaloka Construction Company is a wholly owned subsidiary of the Nawaloka Holdings. With the expertise of the company team of professionals, ample resources and stable market position, Nawaloka Construction Company ensure that the Company is exposed to the latest construction techniques, products and materials and is thus able to apply them in the most practical, efficient and profitable manner to give the client the best value for money.', 'COMPANY_IMG-672723d62c4079.36365262.png', 0, 1),
(31, 'hemas', '$2y$10$6KuIXb0tYrTQw5ibrIHJa.xlgPwxCXzkapwreYoxCUh.F2SiO4wxG', 'Hemas Holdings PLC', 'www.hemashealthcare.com', 'careers@healthcarephemas.com', 'Hemas Holdings PLC is a diversified corporate with focused interest in consumer, healthcare, and mobility. Hemas is a publicly listed company with over 5,400+ employees. In 1948, Hemas started with simple intent: to help families live healthfully.', 'COMPANY_IMG-6727243ce6ea45.95776790.png', 0, 1),
(32, 'calcey', '$2y$10$q7Aj2SnR4SpDwlWMqogtZ.1CKXeFB/eiUVPWddcwpreMe/z79aQq.', 'Calcey Technologies', 'www.calcey.com', 'careers@calcey.com', 'Calcey Technologies (Pvt) Ltd. is an innovation firm specializing in a comprehensive range of online services including Web, Mobile & Cloud Solutions, Multimedia Services, Software Quality Assurance and Knowledge Services for SMEs to large enterprise level companies worldwide. As a boutique professional services firm, Calcey helps our customers to launch fully convergent products to market by leveraging creative and highly experienced terms in Silicon Valley, California and Colombo, Sri Lanka.', 'COMPANY_IMG-6727905403b078.26596560.png', 0, 1),
(33, 'grandEng', '$2y$10$qGNlO2hGRI00A0S1Sh1TeuD.Agr0uvFlgfXGikJMitQiiQPZ5x0oq', 'Grand Engineering', 'www.grandengineering.Ik', 'grandengineering@gmail.com', 'The Grand Engineering business came to fruition from two industry professionals who identified an opportunity to enhance the design and construction experience to Developers, Builders and Owner Builders. Through over 30 years combined experience within the construction sector we have identified a critical need to ensure our clients are provided with an innovative solution within a committed time frame, ensuring that our team is working with you every step of the journey. We refer this as the “Grand Experience”.', 'COMPANY_IMG-672790d8187787.57270907.png', 0, 1),
(34, 'dfcc', '$2y$10$3Ig.FDYkk8bjcZYohlon3O0pMAXNhCpANp.nSYGH6UmEwIf.j2dAq', 'DFCC Bank', 'www.dfcc.com', 'careers@dfcc.com', 'DFCC Bank was set up in 1955 as Sri Lanka\'s a pioneer development finance institution on the recommendation of the World Bank and is one of the oldest development banks in Asia. In October 2015, DFCC Bank and its 99% owned subsidiary, DFCC Vardhana Bank amalgamated.', 'COMPANY_IMG-672791638904c6.73601880.png', 0, 1),
(35, 'slt', '$2y$10$iBVXhlXY05Afqu6Gr3vpnO1JutZSqffSGmC.zWGVQoLa5PcUJeNp2', 'SLT-Mobitel (Pvt) Ltd', 'www.sltmobitel.lk', 'career@mobitel.lk', 'SLT-MOBITEL is the national telecommunications services provider in Sri Lanka and one of the country\'s largest companies with an annual turnover in excess of Rs 40 billion.', 'COMPANY_IMG-672791c21fb014.37261826.png', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `salary` int(10) NOT NULL,
  `salary_type` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `vacancies` int(10) NOT NULL,
  `job_nature` varchar(50) NOT NULL,
  `requirement_skills` longtext NOT NULL,
  `education_and_experience` longtext NOT NULL,
  `deadline` varchar(50) NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jobs_recycle_bin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `company_id`, `category`, `job_role`, `salary`, `salary_type`, `location`, `description`, `vacancies`, `job_nature`, `requirement_skills`, `education_and_experience`, `deadline`, `posted_date`, `jobs_recycle_bin`) VALUES
(25, 29, 'Sales and Marketing', 'Digital Marketer', 4000, 'yearly', 'Western Province', 'It is a long established fact that a reader will beff distracted by vbthe creadable content of a page when looking at its layout. The pointf of using Lorem Ipsum is that it has ahf mcore or-lgess normal distribution of letters, as opposed to using, Content here content here making it look like readable.', 5, 'Full Time', 'System Software Development\r\nMobile Applicationin iOS/Android/Tizen or other platform\r\nResearch and code , libraries, APIs and frameworks\r\nStrong knowledge on software development life cycle\r\nStrong problem solving and debugging skills', '3 or more years of professional design experience\r\nDirect response email experience\r\nEcommerce website design experience\r\nFamiliarity with mobile and web apps preferred\r\nExperience using Invision a plus', '16 Dec 2024', '2024-11-07 06:38:30', 0),
(26, 31, 'Accounting and Auditing', 'JUNIOR EXECUTIVE FINANCE - COSTING', 2800, 'yearly', 'Western Province', 'The selected candidate will be responsible for timely costing of shipments, analysis of all clearing related transactions , accounts and checking of all related payment vouchers submitted for final payment. The role holder will also be responsible for handling all entries relating to the goods in transit.', 2, 'Full Time', 'Proficient in MS Office (Thorough knowledge in MS Excel will be an added advantage)\r\nStrong analytical, negotiation and communication skills\r\n', 'Full/part qualification in CIMA/ICASL/ACCA\r\nMinimum of 1 year experience in a similar role\r\nWorking knowledge of SAP is important', '10 Nov 2024', '2024-11-18 17:36:35', 1),
(27, 30, 'Construction', 'Project Manager', 2500, 'monthly', 'Southern Province', 'We are looking for experienced and qualified Project Manager. A project manager is responsible for the direction, coordination, implementation, executive, control and completion of the project while remaining aligned with the strategy, commitments and goals of the organization.', 1, 'Part Time', 'Minimum of 10 years\' post qualifying experience with at least 7 years in a similar capacity of building construction.\r\nBe able to achieve tasks within given time frames.\r\nExcellent managerial, organizing, planning, communication and interpersonal skills. ', 'B.Sc. (Eng.) with charted qualification.\r\n\r\nProject Management Professional (PMP): This certifies that you’re a capable project manager who is competent in waterfall and agile project management.\r\n\r\nAgile certifications: These are ideal for those project managers who want to work in agile environments as a scrum master, agile certified practitioner or agile value stream consultant.\r\n\r\nCertified Associate in Project Management (CAPM): This project management training program is the first step toward getting your PMP certification. It’s recognized by many employers for entry-level project manager positions.', '01 Dec 2024', '2024-11-03 08:03:55', 0),
(28, 35, 'Telecommunication', 'Senior Product Executive', 2000, 'monthly', 'Sabaragamuwa Province', 'We are looking for a senior product executive for our Broadband department.', 6, 'Full Time', 'Design, develop a. implement marketing plans through market research, competitor analysis, pricing, customer engagement business planning in order to achieve targets.\r\nFacilitate in Acquisition and Data revenue enhancement via installed ease management.\r\nSupport the Broadband business unit to develop, test a. launch new product features and functionality in partnership with other teams.\r\nAssist the customer life cycle management campaigns a. work closely with retention teams.\r\nEnhance digitalized service platforms to improve the productivity and experience.\r\nData analysis of product performance by using Big Data Platform a. support grow. of Broadband revenue and Subscriber base.\r\nMonitor campaigns and take appropriate action to achieve set objectives.\r\nDrive and develop material for multiple product or service launches including customer presentations and sales trainings.', 'Candidate should hold a Bachelors degree in Business Management/ Marketing from a recognized university/ institute.\r\nMinimum 2 years\' experience in Product or Bra. Management in a similar position in a reputed agency or organization.\r\nTelecommunication related experience is an added advantage.\r\nMust be well versed in English and Sinhala both in written a. verbal communication.\r\nShould possess excellent presentation a. analytical skills with a working knowledge of Microsoft packages.\r\nShould be able to work independently with minimum supervision a. maintain records methodically.\r\nBe highly organized, proactive, a. energetic with a rrositive attitude.\r\nBe a team player a. be able to interact with staff at all levels.\r\n', '01 Jan 2024', '2024-11-03 15:12:52', 0),
(29, 33, 'Architecture', 'Architecture', 1000, 'hourly', 'Central Province', 'We are hiring male or female architect.', 1, 'Remote', 'Analyze design issues and recommend corrective actions, and perform structural design analysis and calculations according to project.\r\nExcellent communication skills, both verbal and written. Good command of English and Sinhala.\r\nMust possess a commanding personality with an eye for accuracy.\r\nLiaise with clients and contractors to resolve construction and design related issues at site.\r\nComfort and enthusiasm for learning latest design skills and can do attitude.\r\nPerform design changes and improvements according to changing project demands, and use latest software (Tekla structures 2D & 3D detailing) and technologies to develop effective designs.', 'Bachelor\'s degree in Architecture (BSc / B. Arch).\r\nExperience in computer aided design AutoCAD / SketchUp / Refit 3D, and Lumion 30 rendering / Rendering 3D images.\r\nGood knowledge about local rules & regulations, specially housing projects and apartments (council approval process).\r\nExperience since qualification minimum 5 years in Architectural based environment. ', '05 Jan 2025', '2024-11-03 15:25:48', 0),
(30, 34, 'Sales and Marketing', 'Assistant Manager', 2000, 'monthly', 'Western Province', 'Assistant Manager – Employee Experience\r\n\r\nFunction: Human Resources\r\n\r\nWould you like to work in a place where you can bring your purpose to life through the work that you do? You can create a better business and better world by working on brands that are loved and improve the lives of millions while you learn from brilliant business leaders!\r\n\r\nWe have an opportunity for Assistant Manager - Employee Experience, see more information below.\r\n\r\nBut first, an important message.\r\n\r\nDiversity is one of our most relevant pillars in people management and our main objective is to develop an internal environment open to the multiplicity of world views, through inclusion without stereotypes. This allows us to value the best professionals, bringing together different profiles and operating styles, and to face with greater propriety the current and future challenges of the company.\r\n\r\nAt Unilever, more than 50% of leadership positions are held by women. And we want more diversity in our company. In this way, we consider all candidates for our vacancies, regardless of disability, race, color, religion, gender and gender identity, nationality, sexual orientation, ancestry, age, or any other diversity.', 2, 'Part Time', 'Candidate should have excellent stakeholder management skills with the ability to work with cross functional teams', 'Candidate should be a graduate or possess a relevant equivalent professional qualification.\r\n2-3 years of experience in human resources in a similar capacity.', '25 Dec 2024', '2024-11-03 15:28:32', 0),
(31, 32, 'UI/UX Design', 'UI Engineer', 3500, 'monthly', 'Western Province', 'Calcey Technologies is one of Sri Lanka’s leading software product engineering firms. For two decades, we have delivered bespoke digital products for startups, SMEs, and global corporations including PayPal, Stanford University, and the Wikimedia Foundation. Recognized by Great Place to Work as one of the best workplaces in the IT/ITeS sector, we take pride in nurturing a culture where passion thrives. Calcey’s Colombo office requires a UI Engineer.', 3, 'Part Time', 'Creative UI design ability and good knowledge of UX design best practices\r\nBeing knowledgeable and up-to-date on software development lifecycle \r\nTranslating mock-ups, designs, and wireframes into responsive web applications in HTML, CSS/SASS, and JavaScript\r\nExperience with Less/Sass CSS Pre-Processors\r\nExperience with Adobe Creative Cloud, Sketch, InVision, Zeplin and WordPress/PHP\r\nExperience in working with modern front-end frameworks (Angular, React etc.) is a plus\r\nWillingness to learn the latest technologies and UI/UX trends\r\n2 years hands on industry experience as a UI Engineer', 'Front-end web development (HTML, CSS, JS)\r\nCreative design of web pages, graphics and icons\r\nCreate wireframes and mockups for new functionality\r\nCreate high-fidelity designs and prototypes\r\nProvide input for estimates\r\nWebsite development and maintenance\r\nTake ownership of the UI development of an assigned project\r\nInterfacing with other internal and external technology stakeholders', '30 Nov 2024', '2024-11-03 18:22:40', 0),
(32, 32, 'Information Technology', 'Senior Software Engineers', 4000, 'monthly', 'Sabaragamuwa Province', 'Calcey Technologies is one of Sri Lanka’s leading software product engineering firms. For two decades, we have delivered bespoke digital products for startups, SMEs, and global corporations including PayPal, Stanford University, and the Wikimedia Foundation. Calcey’s Colombo offices require the services of Senior Software Engineers – Node.js.', 1, 'Full Time', 'Ability to understand, adapt, initiate, implement process, and operate in a changing and sometimes undefined environment\r\nAnalytical thinking and planning, communication, problem-solving, good judgment, and the ability to influence others positively is required\r\nAbility to effectively communicate even when the information is sensitive/difficult\r\nDemonstrate the ability to multitask, prioritize, and meet deadlines in a fast-paced environment\r\nEthical, Courageous, Transparent, Imaginative, Candid, and Responsible', 'High proficiency & hands-on experience in developing back-ends with Node.js. \r\nExtensive knowledge of JavaScript and TypeScript\r\nExperience with Express.js and Sequelize\r\nExperience building AWS Lambda functions with Node.js\r\nExperience working with Relational and NoSQL databases\r\nExperience with AWS S3, SNS, SQS\r\nKnowledge and experience in Architectural and Design Patterns\r\nThorough in Object-Oriented Design\r\nExperience building front-ends with React or Angular will be a plus\r\n3+ years  hands-on industry experience\r\nWillingness to learn different programming paradigms, languages and technologies is a requirement', '08 Jan 2025', '2024-11-03 15:32:02', 0),
(33, 34, 'Banking and Insurance', 'SENIOR BANKING ASSISTANT', 1500, 'hourly', 'Central Province', 'A competitive remuneration package and other fringe benefits as well as structured career advancement opportunities and extensive training are on offer for the chosen candidates. Any form of canvassing is discouraged. Correspondence will only be with the short-listed candidates.', 8, 'Full Time', 'handling the allocated portfolio of clients transferred from the respective business units.\r\nassisting in the reduction of non-performing levels of the bank.\r\nassisting in recoveries through repossession, arbitration or litigation.\r\nApplicants who possess lesser experience would be considered for recruitment at junior levels.\r\na fair knowledge on banking products and exposure to the legal framework will also be an added advantage.\r\nhave good analytical skills.\r\nhave good communication and negotiation skills.', 'have passed the GCE O/L with credit passes for English and Mathematics and 3 passes for the main subjects at GCE A/L (excluding General English).\r\npossess 6 – 8 years’ experience preferably in the banking or financial services.\r\nsector with at least 2 years’ experience in recoveries/credit management/facility restructuring.', '15 Nov 2024', '2024-11-03 15:34:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
