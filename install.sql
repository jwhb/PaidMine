SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'New Product',
  `description` text COLLATE utf8_unicode_ci,
  `command` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(6) COLLATE utf8_unicode_ci DEFAULT '2C4985',
  `price` float NOT NULL,
  `active` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='item data';

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('1', 'VIP', 'Very Important Player whatsoever', 'pex user {u} group set {g}', 'CC0066', '10', '1');
INSERT INTO `items` VALUES ('2', 'VIP+', 'Very Very Important Player', 'pex user {u} group set vipplus', '660033', '15', '1');
INSERT INTO `items` VALUES ('3', 'VIP++', 'Incredibly Important', 'pex user {u} group set vipplusplus', '660066', '25', '1');

-- ----------------------------
-- Table structure for `log_pp_raw`
-- ----------------------------
DROP TABLE IF EXISTS `log_pp_raw`;
CREATE TABLE `log_pp_raw` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text,
  `valid` tinyint(1) DEFAULT '0',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of log_pp_raw
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

-- ----------------------------
-- Records of users
-- ----------------------------
