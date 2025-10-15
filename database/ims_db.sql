/*
MySQL Data Transfer
Source Host: localhost
Source Database: ims_db
Target Host: localhost
Target Database: ims_db
Date: 10/15/2025 1:16:38 PM
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
  `division_chief` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_item
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `description` text DEFAULT '',
  `unit` enum('pc','bottle','ream','box','pack','book') NOT NULL,
  `fund_cluster` enum('101-Regular','102-Split') NOT NULL,
  `initial_quantity` int(11) NOT NULL,
  `critical_level` int(11) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `received_by` varchar(255) DEFAULT NULL,
  `printed_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
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
  `fund_cluster` enum('101-Regular','102-Split') NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity_received` int(11) NOT NULL,
  `date_received` date NOT NULL,
  `remarks` text NOT NULL,
  `received_by` varchar(255) NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `po_received` date NOT NULL,
  PRIMARY KEY (`stock_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userlevel` enum('Admin','GSS Staff') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `tbl_division` VALUES ('1', 'Legal Division', 'Legal Unit', 'Atty. Lobayto Ilang-iay', 'Chief of Legal Division');
INSERT INTO `tbl_division` VALUES ('2', 'LTS Division', 'LTS', 'Engr. Presnelie Rogalvez', 'CARPO');
INSERT INTO `tbl_division` VALUES ('3', 'STOD', 'STOD', '', 'PCAO');
INSERT INTO `tbl_division` VALUES ('4', 'PBD', 'PBD', 'Carlita Lindley', 'Ow Ay See');
INSERT INTO `tbl_item` VALUES ('1', 'Ballpen', 'Blue', 'pc', '101-Regular', '20', '20', '2025-07-23');
INSERT INTO `tbl_item` VALUES ('2', 'Paper', 'Bond Paper', 'ream', '101-Regular', '0', '3', '2025-07-23');
INSERT INTO `tbl_item` VALUES ('3', 'Test', '123', 'pc', '102-Split', '1', '15', '2025-07-23');
INSERT INTO `tbl_item` VALUES ('4', 'Mohito', '17% alcohol', 'bottle', '101-Regular', '87', '0', '2025-10-04');
INSERT INTO `tbl_stock_entry` VALUES ('1', '1', '2', '101-Regular', '50', '20', '2025-07-23', 'Testing', 'admin', '', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('2', '1', '2', '101-Regular', '1', '1', '2025-07-23', '', 'admin', '', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('3', '1', '2', '101-Regular', '1', '1', '2025-07-23', '', 'admin', '', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('4', '2', '1', '101-Regular', '100', '50', '2025-07-23', '', 'admin', '', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('5', '1', '2', '101-Regular', '7', '200', '2025-07-23', 'Mayaman', 'admin', '', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('6', '4', '4', '101-Regular', '100', '5', '2025-10-04', '', 'admin', '', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('7', '4', '4', '101-Regular', '50', '20', '2025-10-04', '', 'admin', 'OP#1239239', '0000-00-00');
INSERT INTO `tbl_stock_entry` VALUES ('8', '4', '4', '101-Regular', '99', '12', '2025-10-04', '', 'admin', 'OP#1232322', '2025-10-04');
INSERT INTO `tbl_supplier` VALUES ('1', 'Madagascars', 'Arthur', '09213213213', '988878123', '2025-07-23');
INSERT INTO `tbl_supplier` VALUES ('2', 'Google', 'Mark', '09283273723', '823828323', '2025-07-23');
INSERT INTO `tbl_supplier` VALUES ('3', 'Android', 'Mark Zuckk', '09382138213', '213912309', '2025-08-30');
INSERT INTO `tbl_supplier` VALUES ('4', 'Ronie', 'Mallare', '09238238239', '012392193', '2025-10-04');
INSERT INTO `tbl_user` VALUES ('1', 'admin', '$2y$10$qp8/XGUs9X5uC..EWTI5vurdZ1kU/GIQgW/p.dB8UWI3FNCMyG2bu', 'Admin');
INSERT INTO `tbl_user` VALUES ('2', 'testing', '$2y$10$jMzOxvxyKklf9i1/i21QlOgu.I0LkD4MMt8pCKzk7NzBZOkttrUu.', 'Admin');
