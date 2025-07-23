/*
MySQL Data Transfer
Source Host: localhost
Source Database: ims_db
Target Host: localhost
Target Database: ims_db
Date: 7/23/2025 5:07:40 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for tbl_division
-- ----------------------------
DROP TABLE IF EXISTS `tbl_division`;
CREATE TABLE `tbl_division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_item
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT '',
  `unit` enum('') NOT NULL,
  `stock_type` enum('') NOT NULL,
  `fund_cluster` enum('') NOT NULL,
  `initial_quantity` int(11) NOT NULL,
  `critical_level` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `status` enum('') NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_ris
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ris`;
CREATE TABLE `tbl_ris` (
  `ris_id` int(11) NOT NULL AUTO_INCREMENT,
  `ris_no` varchar(255) NOT NULL,
  `entity_name` varchar(255) DEFAULT NULL,
  `fund_cluster` enum('') NOT NULL,
  `division_id` int(11) NOT NULL,
  `responsibility_code` varchar(255) DEFAULT NULL,
  `requested_by` varchar(255) DEFAULT NULL,
  `printed_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `date_requested` date NOT NULL,
  `issued_by` varchar(255) DEFAULT NULL,
  `status` enum('') NOT NULL,
  PRIMARY KEY (`ris_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_ris_items
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ris_items`;
CREATE TABLE `tbl_ris_items` (
  `ris_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `ris_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_requested` int(11) NOT NULL,
  `quantity_issued` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  PRIMARY KEY (`ris_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_stock_entry
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stock_entry`;
CREATE TABLE `tbl_stock_entry` (
  `stock_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `fund_cluster` enum('') NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity_received` int(11) NOT NULL,
  `date_received` date NOT NULL,
  PRIMARY KEY (`stock_entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_stockcard
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stockcard`;
CREATE TABLE `tbl_stockcard` (
  `stockcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `stock_no` varchar(255) NOT NULL,
  `fund_cluster` enum('') NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` enum('') NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `receipt_qty` int(11) NOT NULL,
  `issued_qty` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `balance_qty` int(11) NOT NULL,
  `status` enum('') NOT NULL,
  PRIMARY KEY (`stockcard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tbl_supplier`;
CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `contact_person` varchar(11) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`supplier_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admin', '$2y$10$qp8/XGUs9X5uC..EWTI5vurdZ1kU/GIQgW/p.dB8UWI3FNCMyG2bu', 'Admin');
INSERT INTO `tbl_user` VALUES ('2', 'testing', '$2y$10$jMzOxvxyKklf9i1/i21QlOgu.I0LkD4MMt8pCKzk7NzBZOkttrUu.', 'Admin');
