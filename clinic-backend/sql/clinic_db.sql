-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 11:32 PM
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
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `checkup_id`, `total_amount`, `payment_status`) VALUES
(0, 1, 52.00, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `billing_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `checkup_id`, `total_amount`, `billing_date`) VALUES
(1, 1, 40.00, '2025-07-17 14:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `checkups`
--

CREATE TABLE `checkups` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `history` text DEFAULT NULL,
  `report_path` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `checkup_date` date DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkups`
--

INSERT INTO `checkups` (`id`, `patient_id`, `symptoms`, `history`, `report_path`, `date`, `diagnosis`, `checkup_date`, `doctor_name`) VALUES
(1, 1, 'Fever, cough, body ache', 'Allergic to penicillin\r\n\r\n', '', '2025-07-16 19:30:00', NULL, NULL, NULL),
(2, 1, 'sample', 'sample', '', '2025-07-16 01:07:00', NULL, NULL, NULL),
(4, 1, 'sample4', 'sample4', '', '2025-07-11 11:26:00', NULL, NULL, NULL),
(5, 6, 'sample 6', 'sddd', '', '2025-07-10 13:41:00', NULL, NULL, NULL),
(6, 4, 'sample 5', '-', 'uploads/1752871576_sample doc.txt', '2025-07-04 13:46:00', NULL, NULL, NULL),
(7, 11, 'sample7', '-', 'uploads/1752871670_sample doc.txt', '2025-07-29 13:47:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `price`, `stock`, `medicine_id`, `quantity`, `created_at`) VALUES
(1, '	Amoxicillin', 40.00, 50, 0, 0, '2025-07-18 12:42:35'),
(2, 'Dolo', 75.00, 75, 0, 0, '2025-07-18 12:42:35'),
(3, 'Paracetamol', 100.00, 100, 0, 0, '2025-07-18 12:42:35'),
(4, 'Crosin', 55.00, 60, 0, 0, '2025-07-18 12:42:35'),
(5, 'Zerodol-P', 50.00, 50, 0, 100, '2025-07-18 12:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `Age`, `Gender`, `phone`) VALUES
(1, 'John Doe	', 0, '', '	9876543210'),
(2, 'Megan Cooper', 49, 'Female', '9547416762'),
(3, 'Steven Daniels', 28, 'Male', '9426278550'),
(4, 'Courtney Thompson', 48, 'Female', '9174493319'),
(5, 'Brandon Howard', 43, 'Male', '9785041999'),
(6, 'Vanessa Watson', 22, 'Female', '9857110508'),
(7, 'Christopher Brown', 63, 'Male', '9811257711'),
(8, 'Laura King', 29, 'Female', '9027927010'),
(9, 'Jeffrey White', 33, 'Male', '9728595155'),
(10, 'Abigail Edwards', 61, 'Female', '9975996815'),
(11, 'David Smith', 71, 'Male', '9286408430');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table products
--

CREATE TABLE products (
  id int(11) NOT NULL,
  name varchar(100) DEFAULT NULL,
  quantity int(11) DEFAULT NULL,
  price decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table products
--

INSERT INTO products (id, name, quantity, price) VALUES
(2, 'pc', 10, 300000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table products
--
ALTER TABLE products
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table products
--
ALTER TABLE products
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) DEFAULT NULL,
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(100) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `checkup_id`, `medicine_id`, `medicine_name`, `dosage`, `duration`, `quantity`) VALUES
(1, 1, 1, NULL, NULL, NULL, 1),
(2, 2, 1, NULL, NULL, NULL, 1),
(3, 1, 2, NULL, NULL, NULL, 3),
(4, 1, 2, NULL, NULL, NULL, 2),
(5, 1, 1, NULL, NULL, NULL, 1),
(6, 1, 1, NULL, NULL, NULL, 1),
(7, 1, 1, NULL, NULL, NULL, 2),
(8, 1, 1, NULL, NULL, NULL, 1),
(9, 1, 0, 'dolo', '500mg', '5days', 1),
(10, 11, 0, 'dolo', '500mg', '5days', 1),
(11, 1, 1, NULL, NULL, NULL, 1),
(12, 7, 1, NULL, NULL, NULL, 2),
(13, 2, 2, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkups`
--
ALTER TABLE `checkups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkups`
--
ALTER TABLE `checkups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


-- Adding foreign key constraints for data integrity

ALTER TABLE checkups
  ADD CONSTRAINT fk_checkups_patient
  FOREIGN KEY (patient_id) REFERENCES patients(id);

ALTER TABLE prescriptions
  ADD CONSTRAINT fk_prescriptions_checkup
  FOREIGN KEY (checkup_id) REFERENCES checkups(id);

ALTER TABLE prescriptions
  ADD CONSTRAINT fk_prescriptions_medicine
  FOREIGN KEY (medicine_id) REFERENCES medicines(id);

ALTER TABLE billing
  ADD CONSTRAINT fk_billing_checkup
  FOREIGN KEY (checkup_id) REFERENCES checkups(id);

ALTER TABLE bills
  ADD CONSTRAINT fk_bills_checkup
  FOREIGN KEY (checkup_id) REFERENCES checkups(id);

ALTER TABLE reports
  ADD CONSTRAINT fk_reports_checkup
  FOREIGN KEY (checkup_id) REFERENCES checkups(id);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- Change forced at Mon Jul 21 10:42:17 IST 2025
