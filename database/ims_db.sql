/*
MySQL Data Transfer
Source Host: localhost
Source Database: ims_db
Target Host: localhost
Target Database: ims_db
Date: 7/12/2025 11:13:21 PM
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
-- Table structure for tbl_supply
-- ----------------------------
DROP TABLE IF EXISTS `tbl_supply`;
CREATE TABLE `tbl_supply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  `contact_person` int(11) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
INSERT INTO `tbl_user` VALUES ('1', 'admin', '$2y$10$qp8/XGUs9X5uC..EWTI5vurdZ1kU/GIQgW/p.dB8UWI3FNCMyG2bu', 'Admin');
