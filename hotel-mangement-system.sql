-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 04:18 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `available_room` (IN `date_in` VARCHAR(45), IN `date_out` VARCHAR(45))  BEGIN
DECLARE msg varchar(128);
IF(date_in<CURRENT_DATE) THEN
	set msg = 'Enter valid check in date.' ;
signal sqlstate '45001' set message_text = msg;
ELSEIF(date_out<=date_in) THEN
	set msg = 'Enter valid check out date.' ;
signal sqlstate '45001' set message_text = msg;
ELSE
SELECT room.room_no,room.floor_no,room_type.room_name,room_type.no_of_single_bed,room_type.no_of_double_bed,room_type.no_of_accomodate,room.features,room.amount FROM room,room_type where room.room_no IN (SELECT room_status.room_no FROM room_status  WHERE room_status.check_out IS NULL OR room_status.check_out<date_in ) AND room.room_code=room_type.room_code ;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cancel_booked_room` (IN `roomno` INT, IN `checkout` VARCHAR(45))  BEGIN
DECLARE msg varchar(128);
if(roomno NOT IN (SELECT room_booked.room_no FROM room_booked)) THEN
   set msg = 'Enter valid room no.'; 
   signal sqlstate '45011' set message_text = msg;
ELSEif(checkout NOT IN(SELECT room_booked.check_out FROM room_booked)) THEN
   set msg = 'Enter valid check out date.'; 	
   signal sqlstate '45011' set message_text = msg;
ELSE
DELETE FROM room_booked WHERE room_booked.room_no=roomno and room_booked.check_out=checkout;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `customer_previous_booking_info_with_payment_done` (IN `id` INT)  BEGIN
SELECT room_booked.room_no,room_booked.check_in,room_booked.check_out,room_booked.total_days,room.features ,room.amount,room.features from room,room_booked where room_booked.customer_id IN (SELECT customer_id from booking WHERE booking.payment_status=1 and booking.customer_id=id) and room.room_no=room_booked.room_no and room_booked.payment_status=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_room_from_admin` (IN `roomno` INT)  BEGIN
DECLARE msg varchar(128);
IF(roomno ="") THEN
	set msg = 'Room no. can not be empty.' ;
signal sqlstate '45001' set message_text = msg;
ELSEIF(roomno NOT IN (SELECT room.room_no FROM room)) THEN
	set msg = 'Room does not exist.' ;
signal sqlstate '45001' set message_text = msg;
ELSE
DELETE FROM room WHERE room.room_no=roomno;
END IF;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_booked_room_info_to_admin_for_payment_status_0` ()  BEGIN
SELECT room_booked.room_no,room_booked.check_in,room_booked.check_out,room_booked.customer_id
 FROM room_booked WHERE room_booked.check_out>CURRENT_DATE AND room_booked.payment_status=0;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_booked_room_info_to_admin_for_payment_status_1` ()  BEGIN
SELECT room_booked.room_no,room_booked.check_in,room_booked.check_out,room_booked.customer_id
 FROM room_booked WHERE room_booked.check_out>CURRENT_DATE AND room_booked.payment_status=1;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showing_customer_details_to_admin` (IN `id` INT)  BEGIN
DECLARE msg varchar(128);
IF(id ="") THEN
	set msg = 'Enter valid customer ID.' ;
signal sqlstate '45001' set message_text = msg;
ELSEIF(id NOT IN (SELECT customer.customer_id FROM customer)) THEN
	set msg = 'Enter valid customer ID.' ;
signal sqlstate '45001' set message_text = msg;
ELSE
SELECT customer.customer_id,customer.first_name,customer.last_name,customer.gender,customer.email,customer.contact_no,customer.nationality,customer.username FROM customer where customer.customer_id=id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_all_employee_to_admin` ()  BEGIN
SELECT employee.employee_id,employee.first_name,employee.last_name,employee.gender,employee.department,employee.contact_no,employee.salary FROM employee;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_attendence_of_employee` (IN `date` VARCHAR(45))  BEGIN
DECLARE msg varchar(128);
IF(date NOT IN (SELECT employee_attendence.date FROM employee_attendence)) THEN
	set msg = 'Enter valid date' ;
signal sqlstate '45001' set message_text = msg;
ELSE
SELECT employee_attendence.employee_id,employee.first_name,employee.last_name,employee.department FROM employee_attendence,employee WHERE employee_attendence.date=date AND employee.employee_id=employee_attendence.employee_id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_customer_info` (IN `f_name` VARCHAR(45), IN `l_name` VARCHAR(45), IN `g` VARCHAR(45), IN `em` VARCHAR(45), IN `contact` INT, IN `nationality` VARCHAR(45), IN `user` VARCHAR(45))  BEGIN
UPDATE customer SET customer.first_name=f_name,customer.last_name=l_name,customer.gender=g,customer.email=em,customer.contact_no=contact,customer.nationality=nationality WHERE customer.username=user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_room_info_by_admin` (IN `roomno` INT, IN `floorno` INT, IN `roomname` VARCHAR(45), IN `features` VARCHAR(45), IN `price` INT)  BEGIN
DECLARE msg varchar(128);
IF(roomno NOT IN (SELECT room.room_no FROM room)) THEN
	set msg = 'Enter valid room no.' ;
signal sqlstate '45001' set message_text = msg;
elseIF(roomname NOT IN (SELECT room_type.room_name FROM room_type)) THEN
	set msg = 'Enter valid room name.' ;
signal sqlstate '45001' set message_text = msg;
elseIF(floorno="") THEN
	set msg = 'Floor no can not be null.' ;
signal sqlstate '45001' set message_text = msg;
elseIF(price="") THEN
	set msg = 'Price can not be null.' ;
signal sqlstate '45001' set message_text = msg;
ELSE
UPDATE room SET room.floor_no=floorno,room.features=features,room.amount=price,room.room_code=(SELECT room_type.room_code FROM room_type WHERE room_type.room_name=roomname) WHERE room.room_no=roomno;
END IF;
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
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `no_of_room` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_id`, `no_of_room`, `amount`, `payment_status`) VALUES
(51, 60, 1, 20000, 1),
(52, 61, 2, 42000, 1),
(53, 59, 2, 55000, 1),
(54, 58, 1, 30000, 1);

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
(58, 'nirav', 'patel', 'male', 'harsh.p5@ahduni.edu.in', 2147483647, 'indian', 'nirav'),
(59, 'harsh', 'patel', 'male', 'harshpatel.hp908@gmail.com', 2147483647, 'non_indian', 'harsh'),
(60, 'Raj', 'Patel', 'male', 'raj@gmail.com', 2147483647, 'non_indian', 'raj'),
(61, 'Tirth', 'Kanani', 'male', 'tirth.k@gmail.com', 2147483647, 'indian', 'tirth');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `chk_all_customer_info_is_non_empty` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
if(new.first_name="") THEN
   set msg = 'Error: First name can not be null.'; 
   signal sqlstate '45003' set message_text = msg;
end if;
IF(new.last_name ="") THEN
set msg = 'Error: Last name can not be null.'; 
   signal sqlstate '45004' set message_text = msg;  
end if;
IF(new.contact_no ="") THEN
set msg = 'Error: Contact no can not be null.'; 
   signal sqlstate '45005' set message_text = msg;  
end if;
IF(SELECT length(new.contact_no)<>10) THEN
set msg = 'Error: Please enter valid contact no.'; 
   signal sqlstate '45005' set message_text = msg;  
end if;
IF(new.email ="") THEN
set msg = 'Error: email can not be null.'; 
   signal sqlstate '45007' set message_text = msg;  
end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `chk_all_customer_info_is_non_empty_before_update` BEFORE UPDATE ON `customer` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
if(new.first_name="") THEN
   set msg = 'Error: First name can not be null.'; 
   signal sqlstate '45003' set message_text = msg;
end if;
IF(new.last_name ="") THEN
set msg = 'Error: Last name can not be null.'; 
   signal sqlstate '45004' set message_text = msg;  
end if;
IF(new.contact_no ="") THEN
set msg = 'Error: Contact no can not be null.'; 
   signal sqlstate '45005' set message_text = msg;  
end if;
IF(SELECT length(new.contact_no)<>10) THEN
set msg = 'Error: Please enter valid contact no.'; 
   signal sqlstate '45005' set message_text = msg;  
end if;
IF(new.email ="") THEN
set msg = 'Error: email can not be null.'; 
   signal sqlstate '45007' set message_text = msg;  
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `department` varchar(45) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `gender`, `department`, `contact_no`, `salary`) VALUES
(4, 'Ramesh', 'Patel', 'male', 'Cleaning', 2147483647, 15000),
(5, 'Suresh', 'Modi', 'male', 'Waiter', 2147483647, 20000),
(6, 'Priya', 'Patel', 'female', 'cleaning', 2147483647, 15000),
(7, 'Param', 'Patel', 'male', 'Waiter', 2147483647, 20000),
(8, 'Krunal', 'Patel', 'male', 'Manager', 2147483647, 30000);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `chk_employee_details` BEFORE INSERT ON `employee` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
IF(new.first_name="" ) THEN
	set msg = 'First name can not be null.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.last_name="" ) THEN
	set msg = 'Last name can not be null.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.contact_no="" ) THEN
	set msg = 'conatact no. can not be null.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(length(new.contact_no)<>10) THEN
	set msg = 'Enter valid contact no.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.department="" ) THEN
	set msg = 'Department can not be null.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.salary="" ) THEN
	set msg = 'Salary can not be null.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendence`
--

CREATE TABLE `employee_attendence` (
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_attendence`
--

INSERT INTO `employee_attendence` (`employee_id`, `date`) VALUES
(5, '2021-04-11'),
(6, '2021-04-11'),
(7, '2021-04-11'),
(8, '2021-04-11');

--
-- Triggers `employee_attendence`
--
DELIMITER $$
CREATE TRIGGER `chk_employee_id` BEFORE INSERT ON `employee_attendence` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
IF(new.employee_id NOT IN (SELECT employee.employee_id FROM employee)) THEN
	set msg = 'Enter valid employee id.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.employee_id IN (SELECT employee_attendence.employee_id FROM employee_attendence WHERE employee_attendence.date=CURRENT_DATE)) THEN
	set msg = 'Attendence alreday done for the day.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_into_revenue_from_emp` AFTER INSERT ON `employee_attendence` FOR EACH ROW BEGIN
INSERT INTO revenue(revenue.revenue_type,revenue.expense_name,revenue.employee_id,revenue.amount) VALUES('expense','salary',new.employee_id,(SELECT (employee.salary/30) FROM employee WHERE employee.employee_id=new.employee_id));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `date` date NOT NULL DEFAULT current_timestamp(),
  `revenue_type` varchar(45) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `expense_name` varchar(45) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `revenue`
--

INSERT INTO `revenue` (`date`, `revenue_type`, `transaction_id`, `expense_name`, `employee_id`, `amount`) VALUES
('2021-04-11', 'income', 48, NULL, NULL, 20000),
('2021-04-11', 'income', 49, NULL, NULL, 42000),
('2021-04-11', 'income', 50, NULL, NULL, 55000),
('2021-04-11', 'expense', NULL, 'salary', 5, 667),
('2021-04-11', 'expense', NULL, 'salary', 6, 500),
('2021-04-11', 'expense', NULL, 'salary', 7, 667),
('2021-04-11', 'expense', NULL, 'salary', 8, 1000),
('2021-04-11', 'income', 51, NULL, NULL, 30000),
('2021-04-11', 'expense', NULL, 'water bill', NULL, 2000),
('2021-04-11', 'expense', NULL, 'water bill', NULL, 2000),
('2021-04-11', 'expense', NULL, 'Electricity bill', NULL, 10000);

--
-- Triggers `revenue`
--
DELIMITER $$
CREATE TRIGGER `chk_expense` BEFORE INSERT ON `revenue` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
IF(new.expense_name="") THEN
	set msg = 'Enter valid expense name.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.amount="") THEN
	set msg = 'Amount can not be null.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
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
(101, 1, 111, NULL, 10000),
(102, 1, 111, NULL, 10000),
(103, 1, 111, 'extra bathroom', 12000),
(104, 1, 111, NULL, 10000),
(105, 1, 111, 'extra bathroom', 12000),
(201, 2, 222, 'extra bathroom', 15000),
(202, 2, 222, 'extra bathroom with gallary', 17000),
(203, 2, 222, 'extra  two bathroom', 20000),
(204, 2, 222, 'extra bathroom', 15000),
(205, 2, 222, 'extra bathroom with gallary', 17000),
(301, 3, 333, 'extra bathroom', 22000),
(302, 3, 333, 'extra bathroom with pool', 25000),
(303, 3, 333, 'extra bathroom', 20000),
(304, 3, 333, 'extra bathroom with pool', 22000);

--
-- Triggers `room`
--
DELIMITER $$
CREATE TRIGGER `add_room_details_to_room_status` AFTER INSERT ON `room` FOR EACH ROW BEGIN
INSERT INTO room_status VALUES (new.room_no,"");
End
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `chk_room_details_by_admin` BEFORE INSERT ON `room` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
IF(new.room_no IN (SELECT room.room_no FROM room)) THEN
	set msg = 'Room no already exist.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.room_no ="") THEN
	set msg = 'Room no can not be empty.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.floor_no="") THEN
	set msg = 'Floor no can not be empty.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
IF(new.amount="") THEN
	set msg = 'Price can not be empty.' ;
signal sqlstate '45001' set message_text = msg;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_room_from_room_status` BEFORE DELETE ON `room` FOR EACH ROW BEGIN
DELETE FROM room_status where old.room_no=room_status.room_no;
END
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
-- Dumping data for table `room_booked`
--

INSERT INTO `room_booked` (`customer_id`, `check_in`, `check_out`, `total_days`, `room_no`, `payment_status`) VALUES
(60, '2021-04-11', '2021-04-13', 2, 101, 1),
(58, '2021-04-11', '2021-04-14', 3, 104, 1),
(59, '2021-04-11', '2021-04-13', 2, 204, 1),
(61, '2021-04-11', '2021-04-12', 1, 301, 1),
(61, '2021-04-12', '2021-04-14', 2, 102, 1),
(59, '2021-04-12', '2021-04-13', 1, 302, 1);

--
-- Triggers `room_booked`
--
DELIMITER $$
CREATE TRIGGER `check_room_no` BEFORE INSERT ON `room_booked` FOR EACH ROW BEGIN
DECLARE msg varchar(128);
IF(new.room_no IN (SELECT room_status.room_no from room_status where room_status.check_out>new.check_in AND room_status.room_no=new.room_no)) THEN
   set msg = 'Room already booked for this check in date'; 
   signal sqlstate '45001' set message_text = msg; 
end if;
IF(new.room_no NOT IN (SELECT room.room_no FROM room)) THEN
   set msg = 'Enter valid room no.'; 
   signal sqlstate '45001' set message_text = msg; 
end if;
IF(new.check_in<CURRENT_DATE) THEN
	set msg = 'Enter valid check in date.' ;
signal sqlstate '45001' set message_text = msg;
end if;
IF(new.check_out<=new.check_in) THEN
	set msg = 'Enter valid check out date.' ;
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
(101, '2021-04-13'),
(102, '2021-04-14'),
(103, '0000-00-00'),
(104, '2021-04-14'),
(105, '0000-00-00'),
(201, '0000-00-00'),
(202, '0000-00-00'),
(203, '0000-00-00'),
(204, '2021-04-13'),
(205, '0000-00-00'),
(301, '2021-04-12'),
(302, '2021-04-13'),
(303, '0000-00-00'),
(304, '0000-00-00');

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
  `total_amount` int(11) NOT NULL,
  `payment_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `booking_id`, `payment_type`, `total_amount`, `payment_date`) VALUES
(48, 51, 'DEBIT_CARD', 20000, '2021-04-11'),
(49, 52, 'CREID_CARD', 42000, '2021-04-11'),
(50, 53, 'NET_BANKING', 55000, '2021-04-11'),
(51, 54, 'UPI', 30000, '2021-04-11');

--
-- Triggers `transaction`
--
DELIMITER $$
CREATE TRIGGER `insert_into_revenue` AFTER INSERT ON `transaction` FOR EACH ROW BEGIN
INSERT INTO revenue(revenue.revenue_type,revenue.transaction_id,revenue.amount) VALUES('income',new.transaction_id,new.total_amount);
END
$$
DELIMITER ;
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
(12, 'harsh', '$2y$10$n9HfupQGPfoqO98KST98z.ivFc3hXFlQOgJ8s5GairNsYf1pPR5J.', '2021-04-09'),
(13, 'nirav', '$2y$10$CHRnraW4ozk.F5hTz.NXf.OY7rG6qdeN8lG1QkekRgIb8ocWrl/WG', '2021-04-09'),
(14, 'raj', '$2y$10$yM9JQB2J1Vm24OAAvYa0lO/sz4iZCaSAJw9UmxMV4BwUTFOvDTCvK', '2021-04-11'),
(15, 'tirth', '$2y$10$X9foavhGhXOL.SMFCG5UDuD6.2bMhRVfEejxmerhiiQihupOes9Mi', '2021-04-11'),
(16, 'ankit', '$2y$10$f06syfU7YKr4E2TmgkOxxOrGG4.zHKN7/tA7zx2e5TPYWZz3glu6a', '2021-04-11');

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_attendence`
--
ALTER TABLE `employee_attendence`
  ADD PRIMARY KEY (`employee_id`,`date`);

--
-- Indexes for table `revenue`
--
ALTER TABLE `revenue`
  ADD KEY `fk_employ_id` (`employee_id`),
  ADD KEY `fk_tran_id` (`transaction_id`);

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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Constraints for table `employee_attendence`
--
ALTER TABLE `employee_attendence`
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `revenue`
--
ALTER TABLE `revenue`
  ADD CONSTRAINT `fk_employ_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `fk_tran_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`);

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
  ADD CONSTRAINT `fk_room_no` FOREIGN KEY (`room_no`) REFERENCES `room` (`room_no`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_bookingid` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
