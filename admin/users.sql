/*
 Navicat MySQL Data Transfer

 Source Server         : MAMP
 Source Server Type    : MySQL
 Source Server Version : 50534
 Source Host           : 127.0.0.1
 Source Database       : softacad

 Target Server Type    : MySQL
 Target Server Version : 50534
 File Encoding         : utf-8

 Date: 06/04/2014 09:02:20 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99'), ('2', 'test', '202cb962ac59075b964b07152d234b70'), ('3', 'asd', '7815696ecbf1c96e6894b779456d330e');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
