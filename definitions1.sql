DROP TABLE IF EXISTS `breakfast`;
DROP TABLE IF EXISTS `starch_breakfast`;
DROP TABLE IF EXISTS `starch`;
DROP TABLE IF EXISTS `cereal`;
DROP TABLE IF EXISTS `fruit`;
DROP TABLE IF EXISTS `drink`;
DROP TABLE IF EXISTS `diet`;
DROP TABLE IF EXISTS `day`;
DROP TABLE IF EXISTS `main_breakfast`;
DROP TABLE IF EXISTS `main_course`;

CREATE TABLE `diet` (
	`diet_id` INT(11) AUTO_INCREMENT NOT NULL,
	`diet_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`diet_name`),
	PRIMARY KEY (`diet_id`)
) ENGINE=InnoDB;

CREATE TABLE `day` (
	`day_id` INT(11) AUTO_INCREMENT NOT NULL,
	`day_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`day_name`),
	PRIMARY KEY (`day_id`)
) ENGINE=InnoDB;

CREATE TABLE `main_breakfast` (
	`main_id` INT(11) AUTO_INCREMENT NOT NULL,
	`main_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`main_name`),
	PRIMARY KEY (`main_id`)
)ENGINE=InnoDB;

CREATE TABLE `main_course` (
	`main_id` INT(11) AUTO_INCREMENT NOT NULL,
	`main_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`main_name`),
	PRIMARY KEY (`main_id`)
)ENGINE=InnoDB;

CREATE TABLE `starch_breakfast` (
	`starch_id` INT(11) AUTO_INCREMENT NOT NULL,
	`starch_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`starch_name`),
	PRIMARY KEY (`starch_id`)
) ENGINE=InnoDB;

CREATE TABLE `starch` (
	`starch_id` INT(11) AUTO_INCREMENT NOT NULL,
	`starch_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`starch_name`),
	PRIMARY KEY (`starch_id`)
) ENGINE=InnoDB;

CREATE TABLE `vegetable` (
	`vegetable_id` INT(11) AUTO_INCREMENT NOT NULL,
	`vegetable_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`vegetable_name`),
	PRIMARY KEY (`vegetable_id`)
) ENGINE=InnoDB;

CREATE TABLE `cereal` (
	`cereal_id` INT(11) AUTO_INCREMENT NOT NULL,
	`cereal_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`cereal_name`),
	PRIMARY KEY (`cereal_id`)
) ENGINE=InnoDB;

CREATE TABLE `fruit` (
	`fruit_id` INT(11) AUTO_INCREMENT NOT NULL,
	`fruit_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`fruit_name`),
	PRIMARY KEY (`fruit_id`)
) ENGINE=InnoDB;

CREATE TABLE `drink` (
	`drink_id` INT(11) AUTO_INCREMENT NOT NULL,
	`drink_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`drink_name`),
	PRIMARY KEY (`drink_id`)
) ENGINE=InnoDB;

CREATE TABLE `dessert` (
	`dessert_id` INT(11) AUTO_INCREMENT NOT NULL,
	`dessert_name` VARCHAR(255) NOT NULL,
	UNIQUE KEY (`dessert_name`),
	PRIMARY KEY (`dessert_id`)
) ENGINE=InnoDB;

CREATE TABLE `breakfast` (
	`breakfast_id` INT(11) AUTO_INCREMENT NOT NULL,
	`diet_id` INT(11) NOT NULL,
	`day_id` INT(11) NOT NULL,
	`main_id` INT(11) NOT NULL,
	`starch_id` INT(11) NOT NULL,
	`cereal_id` INT(11) NOT NULL,
	`fruit_id` INT(11) NOT NULL,
	`drink_1` INT(11) NOT NULL,
	`drink_2` INT(11) NOT NULL,
	FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`) ON DELETE CASCADE,
	FOREIGN KEY (`day_id`) REFERENCES `day` (`day_id`) ON DELETE CASCADE,
	FOREIGN KEY (`main_id`) REFERENCES `main_breakfast` (`main_id`) ON DELETE CASCADE,
	FOREIGN KEY (`starch_id`) REFERENCES `starch_breakfast` (`starch_id`) ON DELETE CASCADE,
	FOREIGN KEY (`cereal_id`) REFERENCES `cereal` (`cereal_id`) ON DELETE CASCADE,
	FOREIGN KEY (`fruit_id`) REFERENCES `fruit` (`fruit_id`) ON DELETE CASCADE,
	FOREIGN KEY (`drink_1`) REFERENCES `drink` (`drink_id`) ON DELETE CASCADE,
	FOREIGN KEY (`drink_2`) REFERENCES `drink` (`drink_id`) ON DELETE CASCADE,
	PRIMARY KEY (`breakfast_id`)
) ENGINE=InnoDB;

CREATE TABLE `lunch` (
	`lunch_id` INT(11) AUTO_INCREMENT NOT NULL,
	`diet_id` INT(11) NOT NULL,
	`day_id` INT(11) NOT NULL,
	`main_id` INT(11) NOT NULL,
	`starch_id` INT(11) NOT NULL,
	`vegetable_id` INT(11) NOT NULL,
	`fruit_id` INT(11) NOT NULL,
	`drink_id` INT(11) NOT NULL,	
	FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`) ON DELETE CASCADE,
	FOREIGN KEY (`day_id`) REFERENCES `day` (`day_id`) ON DELETE CASCADE,
	FOREIGN KEY (`main_id`) REFERENCES `main_course` (`main_id`) ON DELETE CASCADE,
	FOREIGN KEY (`starch_id`) REFERENCES `starch` (`starch_id`) ON DELETE CASCADE,
	FOREIGN KEY (`fruit_id`) REFERENCES `fruit` (`fruit_id`) ON DELETE CASCADE,
	FOREIGN KEY (`vegetable_id`) REFERENCES `vegetable` (`vegetable_id`) ON DELETE CASCADE,
	FOREIGN KEY (`drink_id`) REFERENCES `drink` (`drink_id`) ON DELETE CASCADE,
	PRIMARY KEY (`lunch_id`)
) ENGINE=InnoDB;

CREATE TABLE `dinner` (
	`dinner_id` INT(11) AUTO_INCREMENT NOT NULL,
	`diet_id` INT(11) NOT NULL,
	`day_id` INT(11) NOT NULL,
	`main_id` INT(11) NOT NULL,
	`starch_id` INT(11) NOT NULL,
	`vegetable_id` INT(11) NOT NULL,
	`dessert_id` INT(11) NOT NULL,
	`drink_1` INT(11) NOT NULL,
	`drink_2` INT(11) NOT NULL,		
	FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`) ON DELETE CASCADE,
	FOREIGN KEY (`day_id`) REFERENCES `day` (`day_id`) ON DELETE CASCADE,
	FOREIGN KEY (`main_id`) REFERENCES `main_course` (`main_id`) ON DELETE CASCADE,
	FOREIGN KEY (`starch_id`) REFERENCES `starch` (`starch_id`) ON DELETE CASCADE,
	FOREIGN KEY (`vegetable_id`) REFERENCES `vegetable` (`vegetable_id`) ON DELETE CASCADE,
	FOREIGN KEY (`dessert_id`) REFERENCES `dessert` (`dessert_id`) ON DELETE CASCADE,
	FOREIGN KEY (`drink_1`) REFERENCES `drink` (`drink_id`) ON DELETE CASCADE,
	FOREIGN KEY (`drink_2`) REFERENCES `drink` (`drink_id`) ON DELETE CASCADE,
	PRIMARY KEY (`dinner_id`)
) ENGINE=InnoDB;

CREATE TABLE `patient` (
	`patient_id` INT(11) AUTO_INCREMENT NOT NULL,
	`first_name` VARCHAR(255) NOT NULL,
	`last_name` VARCHAR(255) NOT NULL,
	`room_number` INT(11) NOT NULL,
	`DOB` DATE NOT NULL,
	`diet_id` INT(11) NOT NULL,
	FOREIGN KEY (`diet_id`) REFERENCES `diet` (`diet_id`) ON DELETE CASCADE,
	UNIQUE KEY (`room_number`),
	PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB;

INSERT INTO `day` (`day_name`) VALUES
('Monday'),
('Tuesday'),
('Wednesday'),
('Thursday'),
('Friday');

INSERT INTO `diet` (`diet_name`) VALUES
('NPO'),
('Regular'),
('Diabetic'),
('Cardiac'),
('Pediatric');

INSERT INTO `main_breakfast` (`main_id`, `main_name`) VALUES
(1, 'N/A'),
(2, 'Ham and Cheese Omelete'),
(3, 'Cheese Omelete'),
(4, 'Scrambled Eggs'),
(5, 'Low Cholesterol Scrambled Eggs'),
(6, 'Denver Scramble with Toast'),
(7, 'Low Cholesterol Denver Scramble with Toast'),
(8, 'Breakfast Burrito'),
(9, '1/2 Breakfast Burrito');

INSERT INTO `starch_breakfast` (`starch_id`, `starch_name`) VALUES
(1, 'N/A'),
(2, 'Shredded Hashbrowns'),
(3, 'French Toast'),
(4, '1/2 French Toast'),
(5, '2 Pancakes'),
(6, '1 Pancake'),
(7, 'Diced Potatoes'),
(8, 'Tater Tots');

INSERT INTO `cereal` (`cereal_id`, `cereal_name`) VALUES
(1, 'N/A'),
(2, 'Corn Flakes'),
(3, 'Cream of Wheat'),
(4, 'Oatmeal'),
(5, 'Cheerios'),
(6, 'Raisin Bran');

INSERT INTO `fruit` (`fruit_id`, `fruit_name`) VALUES
(1, 'N/A'),
(2, 'Banana'),
(3, 'Half Banana'),
(4, 'Fresh Fruit'),
(5, 'Strawberries'),
(6, 'Grapes'),
(7, 'Apple Slices'),
(8, 'Watermelon'),
(9, 'Peaches'),
(10, 'Orange Slices');

INSERT INTO `drink` (`drink_id`, `drink_name`) VALUES
(1, 'N/A'),
(2, 'Coffee'),
(3, 'Decaf Coffee'),
(4, '2% Milk'),
(5, 'Skim milk'),
(6, 'Orange Juice'),
(7, 'Apple Juice'),
(8, 'Grape Juice'),
(9, 'Iced Tea'),
(10, 'Fruit Punch');

INSERT INTO `main_course` (`main_id`, `main_name`) VALUES
(1, 'N/A'),
(2, 'Hamburger'),
(3, 'Turkey Burger'),
(4, 'BBQ Chicken'),
(5, 'Grilled Chicken'),
(6, 'Roasted Turnkey'),
(7, 'Beef Fajitas'),
(8, 'Caesar Chicken Salad'),
(9, 'Baked Salmon'),
(10, 'Cheese Quesadilla'),
(11, 'Cheese Lasagna'),
(12, 'Chicken Vegetable Stir Fry'),
(13, 'Roasted Pork'),
(14, 'Meatloaf'),
(15, 'Cheese Pizza');

INSERT INTO `starch` (`starch_id`, `starch_name`) VALUES
(1, 'N/A'),
(2, 'Potato Chips'),
(3, 'Baked Potato Chips'),
(4, 'Mashed Potatoes'),
(5, 'Mashed Potatoes with Gravy'),
(6, 'Spanish Rice'),
(7, 'Brown Rice'),
(8, 'Rice Pilaf');

INSERT INTO `vegetable` (`vegetable_id`, `vegetable_name`) VALUES
(1, 'N/A'),
(2, 'Broccoli'),
(3, 'Asparagus'),
(4, 'Green Beans'),
(5, 'Fiesta vegetables'),
(6, 'Spinach'),
(7, 'Mixed Vegetable'),
(8, 'Carrots');


INSERT INTO `dessert` (`dessert_id`, `dessert_name`) VALUES
(1, 'N/A'),
(2, 'Vanilla Ice Cream'),
(3, 'Sherbet'),
(4, 'Sugar Free Gelatin'),
(5, 'Chocolate Chip Cookies'),
(6, 'Sugar Free Cookies'),
(7, 'Chocolate Cake'),
(8, 'Angel Food Cake'),
(9, 'Gelatin'),
(10, 'Vanilla Pudding'),
(11, 'Sugar Free Vanilla Pudding');

INSERT INTO `breakfast` 
(`diet_id`, `day_id`, `main_id`, `starch_id`, `cereal_id`, `fruit_id`, `drink_1`, `drink_2`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1), (2, 1, 4, 3, 3, 4, 2, 6), (3, 1, 4, 4, 3, 4, 2, 1), (4, 1, 5, 3, 3, 4, 3, 6), (5, 1, 4, 4, 3, 4, 4, 6), 
(1, 2, 1, 1, 1, 1, 1, 1), (2, 2, 2, 2, 2, 2, 2, 4), (3, 2, 2, 2, 2, 3, 2, 4), (4, 2, 3, 2, 2, 2, 3, 5), (5, 2, 2, 2, 2, 3, 6, 4), 
(1, 3, 1, 1, 1, 1, 1, 1), (2, 3, 4, 5, 4, 5, 2, 7), (3, 3, 4, 6, 4, 5, 2, 1), (4, 3, 5, 5, 4, 5, 3, 7), (5, 3, 4, 6, 4, 5, 4, 7), 
(1, 4, 1, 1, 1, 1, 1, 1), (2, 4, 6, 7, 5, 6, 2, 4), (3, 4, 6, 7, 1, 6, 2, 1), (4, 4, 7, 7, 5, 6, 3, 5), (5, 4, 4, 7, 5, 6, 6, 4), 
(1, 5, 1, 1, 1, 1, 1, 1), (2, 5, 8, 8, 6, 7, 2, 4), (3, 5, 8, 1, 2, 7, 2, 4), (4, 5, 4, 2, 6, 7, 3, 5), (5, 5, 9, 8, 6, 7, 8, 4);

INSERT INTO `lunch`
(`diet_id`, `day_id`, `main_id`, `starch_id`, `vegetable_id`, `fruit_id`, `drink_id`) VALUES
(1, 1, 1, 1, 1, 1, 1), (2, 1, 2, 2, 2, 8, 9), (3, 1, 2, 1, 2, 8, 9), (4, 1, 3, 3, 2, 8, 9), (5, 1, 2, 2, 2, 8, 4),
(1, 2, 1, 1, 1, 1, 1), (2, 2, 4, 4, 3, 9, 9), (3, 2, 4, 4, 3, 9, 9), (4, 2, 4, 4, 3, 9, 9), (5, 2, 4, 4, 3, 9, 4),
(1, 3, 1, 1, 1, 1, 1), (2, 3, 6, 5, 4, 10, 9), (3, 3, 6, 5, 4, 10, 9), (4, 3, 6, 5, 4, 10, 9), (5, 3, 6, 5, 4, 10, 4),
(1, 4, 1, 1, 1, 1, 1), (2, 4, 7, 6, 5, 4, 9), (3, 4, 7, 6, 5, 4, 9), (4, 4, 7, 6, 5, 4, 9), (5, 4, 7, 6, 5, 4, 4),
(1, 5, 1, 1, 1, 1, 1), (2, 5, 8, 1, 1, 5, 9), (3, 5, 8, 1, 1, 5, 9), (4, 5, 8, 1, 1, 5, 9), (5, 5, 2, 2, 2, 5, 4);

INSERT INTO `dinner`
(`diet_id`, `day_id`, `main_id`, `starch_id`, `vegetable_id`, `dessert_id`, `drink_1`, `drink_2`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1), (2, 1, 9, 7, 6, 2, 4, 2), (3, 1, 9, 7, 6, 4, 4, 2), (4, 1, 9, 7, 6, 3, 5, 3), (5, 1, 10, 1, 6, 2, 4, 10),
(1, 2, 1, 1, 1, 1, 1, 1), (2, 2, 11, 1, 4, 5, 4, 2), (3, 2, 5, 7, 4, 6, 4, 2), (4, 2, 11, 1, 4, 6, 5, 3), (5, 2, 11, 1, 4, 5, 4, 8),
(1, 3, 1, 1, 1, 1, 1, 1), (2, 3, 12, 7, 1, 7, 4, 2), (3, 3, 12, 7, 1, 8, 4, 2), (4, 3, 12, 7, 1, 8, 5, 3), (5, 3, 12, 7, 1, 7, 4, 6),
(1, 4, 1, 1, 1, 1, 1, 1), (2, 4, 13, 8, 8, 10, 4, 2), (3, 4, 13, 8, 8, 11, 4, 2), (4, 4, 13, 8, 8, 10, 5, 3), (5, 4, 15, 1, 8, 10, 4, 10),
(1, 5, 1, 1, 1, 1, 1, 1), (2, 5, 14, 4, 7, 9, 4, 2), (3, 5, 14, 4, 7, 4, 4, 2), (4, 5, 14, 4, 7, 9, 5, 3), (5, 5, 14, 4, 7, 9, 4, 8);

INSERT INTO `patient`
(`first_name`, `last_name`, `room_number`, `DOB`, `diet_id`) VALUES
('Stacey', 'Shields', 101, '1956-11-23', 2),
('Benito', 'Brindley', 103, '1952-01-24', 2),
('Roger', 'Lalonde', 105, '1954-09-13', 1),
('Gregg', 'Zeng', 107, '1956-10-25', 3),
('Cletus', 'Maynez', 202, '1934-10-25', 2),
('Josiah', 'Gracie', 204, '1946-03-15', 4),
('Emory', 'Curtsinger', 206, '1983-03-12', 1),
('Jermaine', 'Loew', 208, '1991-01-02', 2),
('Wesley', 'Slye', 210, '1952-09-29', 4),
('Dong', 'Kunz', 303, '1943-08-28', 2),
('Deidra', 'Sheehan', 304, '1959-07-29', 3),
('Allena', 'Lanphear', 306, '1986-04-07', 3),
('Krystyna', 'Plattner', 308, '1984-06-05', 2),
('Shasta', 'Leach', 401, '1967-12-26', 1),
('Ciara', 'Ellett', 405, '1941-03-03', 2),
('Kyla', 'Malta', 407, '1998-07-10', 2),
('Debby', 'Maloy', 409, '1983-07-21', 2),
('Anette', 'Sobota', 502, '2010-11-10', 5),
('Elda', 'Whittlesey', 506, '2008-01-10', 5),
('Queenie', 'Aucoin', 510, '2012-06-01', 5);
