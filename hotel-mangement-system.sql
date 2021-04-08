-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 07:35 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel-mangement-system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `available_room` (IN `date` VARCHAR(45))  BEGIN
SELECT room.room_no,room.floor_no,room_type.room_name,room_type.no_of_single_bed,room_type.no_of_double_bed,room_type.no_of_accomodate,room.features,room.amount FROM room,room_type where room.room_no IN (SELECT room_status.room_no FROM room_status  WHERE room_status.check_out IS NULL OR room_status.check_out<date ) AND room.room_code=room_type.room_code ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_previous_booking_info_with_payment_done` (IN `id` INT)  BEGIN
SELECT room_booked.room_no,room_booked.check_in,room_booked.check_out,room_booked.total_days,room.features ,room.amount,room.features from room,room_booked where room_booked.customer_id IN (SELECT customer_id from booking WHERE booking.payment_status=1 and booking.customer_id=id) and room.room_no=room_booked.room_no and room_booked.payment_status=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_room_from_admin` (IN `roomno` INT, IN `checkout` VARCHAR(45))  BEGIN
DELETE FROM room_booked WHERE room_booked.room_no=roomno and room_booked.check_out=checkout;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `display_customer_info_who_booked_room` (IN `id` INT)  BEGIN
SELECT customer.first_name,customer.last_name,customer.gender,customer.email,customer.contact_no,customer.nationality from customer WHERE customer.customer_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_customer_id_p` (IN `name` VARCHAR(45))  BEGIN
SELECT customer.customer_id from customer where username=name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_customer_info` (IN `id` INT)  BEGIN
SELECT customer.first_name,customer.last_name,customer.gender,customer.contact_no,customer.email FROM customer WHERE customer.customer_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `payment_info` (IN `id` INT)  BEGIN
SELECT room_booked.room_no,room_booked.check_in,room_booked.check_out,room_booked.total_days,room.features ,room.amount,room.features from room,room_booked where room_booked.customer_id IN (SELECT customer_id from booking WHERE booking.payment_status=0 and booking.customer_id=id) and room.room_no=room_booked.room_no and room_booked.payment_status=0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `room_info` (IN `code` INT)  BEGIN
DECLARE c_name VARCHAR(20);
DECLARE c_room_type CURSOR FOR SELECT room_code FROM room_type where room_code=CODE;
OPEN c_room_type;
FETCH c_room_type INTO c_name;
SELECT room_type.room_name, room.amount FROM room_type,room WHERE room_type.room_code=c_name and room.room_code=c_name;
CLOSE c_room_type;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_all_customer_details_to_admin` ()  BEGIN
SELECT customer.customer_id,customer.first_name,customer.last_name,customer.gender,customer.email,customer.contact_no,customer.nationality,customer.username FROM customer;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_all_room_info_to_admin` ()  BEGIN
SELECT room.room_no,room.floor_no,room_type.room_name,room_type.no_of_single_bed,room_type.no_of_double_bed,room_type.no_of_accomodate,room.features,room.amount FROM room,room_type WHERE room.room_code=room_type.room_code;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_booked_room_info_to_admin` ()  BEGIN
SELECT room_booked.room_no,room_booked.check_in,room_booked.check_out,room_booked.customer_id
 FROM room_booked WHERE room_booked.check_out>CURRENT_DATE;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_customer_details_to_admin` (IN `id` INT)  BEGIN
SELECT customer.customer_id,customer.first_name,customer.last_name,customer.gender,customer.email,customer.contact_no,customer.nationality,customer.username FROM customer where customer.customer_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_customer_info` (IN `f_name` VARCHAR(45), IN `l_name` VARCHAR(45), IN `g` VARCHAR(45), IN `em` VARCHAR(45), IN `contact` INT, IN `nationality` VARCHAR(45), IN `user` VARCHAR(45))  BEGIN
UPDATE customer SET customer.first_name=f_name,customer.last_name=l_name,customer.gender=g,customer.email=em,customer.contact_no=contact,customer.nationality=nationality WHERE customer.username=user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_room_info_by_admin` (IN `roomno` INT, IN `floorno` INT, IN `roomname` VARCHAR(45), IN `features` VARCHAR(45), IN `price` INT)  BEGIN
UPDATE room SET room.floor_no=floorno,room.features=features,room.amount=price,room.room_code=(SELECT room_type.room_code FROM room_type WHERE room_type.room_name=roomname) WHERE room.room_no=roomno;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_customer_id` (`name` VARCHAR(45)) RETURNS INT(11) BEGIN
DECLARE id int;
SELECT customer.customer_id from customer where username=name into id;
RETURN id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(1) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `no_of_room` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `gender`, `email`, `contact_no`, `nationality`, `username`) VALUES
(51, 'xx', 'xx', 'male', 'harsh.p5@ahduni.edu.in', 65465, 'indian', 'harsh'),
(52, 'nirav', 'patel', 'other', 'jkdskfj@gmail.com', 654654, 'non_indian', 'nirav');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `chk_customer` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
if(new.username in (SELECT username from customer)) THEN
   set msg = 'Error: source cannot be same as destination....'; 
   signal sqlstate '45001' set message_text = msg; 
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_no` int(11) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `room_code` int(11) NOT NULL,
  `features` varchar(45) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_no`, `floor_no`, `room_code`, `features`, `amount`) VALUES
(101, 2, 222, 'NULL', 20000),
(102, 1, 111, NULL, 10000),
(103, 1, 111, 'extra bathroom', 20000),
(104, 1, 111, 'NULL', 10000),
(201, 2, 222, 'extra bathroom', 15000),
(202, 2, 222, 'extra bathroom with gallary', 17000),
(203, 2, 222, 'extra bathroom', 20000),
(301, 3, 333, 'extra bathroom', 20000),
(302, 3, 333, 'extra bathroom with pool', 22000),
(303, 3, 222, 'NULL', 25000);

--
-- Triggers `room`
--
DELIMITER $$
CREATE TRIGGER `add_room_details_to_room_status` AFTER INSERT ON `room` FOR EACH ROW BEGIN
INSERT INTO room_status VALUES (new.room_no,NULL);
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room_booked`
--

CREATE TABLE `room_booked` (
  `customer_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `payment_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `room_booked`
--
DELIMITER $$
CREATE TRIGGER `check_room_no` BEFORE INSERT ON `room_booked` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
if(new.room_no IN (SELECT room_status.room_no from room_status where room_status.check_out>new.check_in AND room_status.room_no=new.room_no)) THEN
   set msg = 'Error: source cannot be same as destination....'; 
   signal sqlstate '45001' set message_text = msg; 
end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_checkout_room_status` AFTER DELETE ON `room_booked` FOR EACH ROW BEGIN 
UPDATE room_status SET room_status.check_out=(SELECT MAX(room_booked.check_out) from room_booked where room_booked.room_no=old.room_no) where room_status.room_no=old.room_no;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_booking_entry_after_deleting_room_booked` BEFORE DELETE ON `room_booked` FOR EACH ROW BEGIN
UPDATE booking SET booking.no_of_room=booking.no_of_room-1,booking.amount=booking.amount-(SELECT total_days FROM room_booked WHERE room_booked.room_no=old.room_no and room_booked.check_out=old.check_out)*(SELECT amount from room WHERE old.room_no=room.room_no) WHERE old.customer_id=booking.customer_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_booking_table` AFTER INSERT ON `room_booked` FOR EACH ROW BEGIN
IF(new.customer_id IN (SELECT booking.customer_id FROM booking where booking.payment_status=0)) THEN
UPDATE booking SET booking.no_of_room=booking.no_of_room+1,
booking.amount=booking.amount+(SELECT total_days FROM room_booked WHERE room_booked.room_no=new.room_no AND room_booked.check_out=new.check_out)*(SELECT room.amount from room WHERE room.room_no=new.room_no) WHERE new.customer_id=booking.customer_id;
ELSEIF(new.customer_id IN (SELECT booking.customer_id FROM booking where booking.payment_status=1)) THEN
INSERT INTO booking (customer_id,no_of_room,amount,payment_status) VALUES(new.customer_id,1,(SELECT total_days FROM room_booked WHERE room_booked.room_no=new.room_no AND room_booked.check_out=new.check_out)*(SELECT room.amount from room WHERE room.room_no=new.room_no),0);
ELSE
INSERT INTO booking (customer_id,no_of_room,amount,payment_status) VALUES(new.customer_id,1,(SELECT total_days FROM room_booked WHERE room_booked.room_no=new.room_no AND room_booked.check_out=new.check_out)*(SELECT room.amount from room WHERE room.room_no=new.room_no),0);
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_room_status` AFTER INSERT ON `room_booked` FOR EACH ROW BEGIN
update room_status set room_status.check_out=new.check_out WHERE new.room_no=room_status.room_no;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room_status`
--

CREATE TABLE `room_status` (
  `room_no` int(11) NOT NULL,
  `check_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_status`
--

INSERT INTO `room_status` (`room_no`, `check_out`) VALUES
(101, '0000-00-00'),
(102, '0000-00-00'),
(103, '0000-00-00'),
(104, '0000-00-00'),
(201, '0000-00-00'),
(202, '0000-00-00'),
(203, '0000-00-00'),
(301, '0000-00-00'),
(302, '0000-00-00'),
(303, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_code` int(11) NOT NULL,
  `room_name` varchar(45) NOT NULL,
  `no_of_single_bed` int(11) DEFAULT NULL,
  `no_of_double_bed` int(11) DEFAULT NULL,
  `no_of_accomodate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`room_code`, `room_name`, `no_of_single_bed`, `no_of_double_bed`, `no_of_accomodate`) VALUES
(111, 'Delux', 0, 1, 2),
(222, 'Super Delux', 1, 1, 3),
(333, 'Luxury', 2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `payment_type` varchar(45) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `update_payment_status_in_booking` BEFORE INSERT ON `transaction` FOR EACH ROW BEGIN
UPDATE booking set booking.payment_status=1 WHERE
booking.booking_id=new.booking_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_payment_status_in_room_booked` BEFORE INSERT ON `transaction` FOR EACH ROW BEGIN
UPDATE room_booked set room_booked.payment_status=1 WHERE
room_booked.customer_id IN(SELECT booking.customer_id from booking where booking.booking_id=new.booking_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(10, 'nirav', '$2y$10$OUhX426i1BfK5hojGpr3cOAwiQ1pLHCRC0VRU173jnJfG.zWwjFrO', '2021-04-06'),
(11, 'harsh', '$2y$10$aJvHSYypmvjvQvaAsxQhDe2XTrTKYZ/o74.Sn4jQTfHFW66m/ysxy', '2021-04-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_no`),
  ADD KEY `fk_room_code` (`room_code`);

--
-- Indexes for table `room_booked`
--
ALTER TABLE `room_booked`
  ADD PRIMARY KEY (`check_in`,`room_no`),
  ADD KEY `cust_fk` (`customer_id`),
  ADD KEY `room_no_fk` (`room_no`);

--
-- Indexes for table `room_status`
--
ALTER TABLE `room_status`
  ADD PRIMARY KEY (`room_no`,`check_out`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_code`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `fk_bookingid` (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_code` FOREIGN KEY (`room_code`) REFERENCES `room_type` (`room_code`);

--
-- Constraints for table `room_booked`
--
ALTER TABLE `room_booked`
  ADD CONSTRAINT `cust_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `room_no_fk` FOREIGN KEY (`room_no`) REFERENCES `room` (`room_no`);

--
-- Constraints for table `room_status`
--
ALTER TABLE `room_status`
  ADD CONSTRAINT `fk_room_no_2` FOREIGN KEY (`room_no`) REFERENCES `room` (`room_no`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_bookingid` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
