/*
MySQL Data Transfer
Source Host: localhost
Source Database: ims_db
Target Host: localhost
Target Database: ims_db
Date: 7/13/2025 10:41:54 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for tbl_stocks
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stocks`;
CREATE TABLE `tbl_stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit_of_measure` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tbl_supplier`;
CREATE TABLE `tbl_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit_of_measure` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  `contact_person` varchar(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `tin` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userlevel` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `tbl_supplier` VALUES ('1', 'Tera Federation', 'Ballpen', 'Blue', 'pc', '150', '10', 'Regular', 'Puao', '1232132132', '123131231');
INSERT INTO `tbl_supplier` VALUES ('2', 'Pao Fed', 'Food', 'Corn', 'pc', '155', '12', 'Regular', 'Tea', '1232132132', '123456656');
INSERT INTO `tbl_supplier` VALUES ('3', 'Testing', 'TEst', '123', 'pc', '123', '123', 'Regular', '123', '09213336120', '123412412');
INSERT INTO `tbl_user` VALUES ('1', 'admin', '$2y$10$qp8/XGUs9X5uC..EWTI5vurdZ1kU/GIQgW/p.dB8UWI3FNCMyG2bu', 'Admin');
