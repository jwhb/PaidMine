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
INSERT INTO `log_pp_raw` VALUES ('1', '--------------------------------------------------------------------------------\n[11/02/2013 12:15 AM] - https://www.sandbox.paypal.com/cgi-bin/webscr (curl)\n--------------------------------------------------------------------------------\nHTTP/1.1 200 OK\r\nDate: Fri, 01 Nov 2013 23:15:36 GMT\r\nServer: Apache\r\nX-Frame-Options: SAMEORIGIN\r\nSet-Cookie: c9MWDuvPtT9GIMyPc3jwol1VSlO=OwY76X8tTa6AzI0hKGFL5ZFSoj4nVLX3r1P2XObbormMiyR2lALWx0XZ2BEAzcQDG5ocN7TeOM9MujWD5tVk1xcUAe8RigfJmn7SCHzY41pr8mTS8LFrcv9GG4omgPLfZZxNLnzf7E2vKXcK4d1qAW-DlHtpbw9oPNkfIiF5qpTsGUj4kaHvArkMlf1nbYYU8IEYirg_UL6FPbxYnYnQVAOKPMMTkbQEHes2CbuF7XxjJPdcXoFyRsHbLoKUgnT8zauWEFOZsCJNvoiFnAWQ360N8bvrYL56cKtbwVSE4U0fn3bKCSd4NpQoNZcjvm2FmlyKCbShJvDCUfN8VNZVKLWoXszn4XhvsNoa8WbA-y50srbU31xA9SnrNKWPk6wHi-u8lsBdBPuyAEFQDq-As7m27RmD_dj2w1gy7nwyayy-EpyZc2lHfttk3Ey; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: cookie_check=yes; expires=Mon, 30-Oct-2023 23:15:37 GMT; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: navcmd=_notify-validate; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: navlns=0.0; expires=Sun, 01-Nov-2015 23:15:37 GMT; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: Apache=10.72.109.11.1383347736772051; path=/; expires=Sun, 25-Oct-43 23:15:36 GMT\r\nX-Cnection: close\r\nSet-Cookie: X-PP-SILOVER=name%3DSANDBOX3.WEB.1%26silo_version%3D880%26app%3Dslingshot%26TIME%3D406221906; domain=.paypal.com; path=/; Secure; HttpOnly\r\nSet-Cookie: X-PP-SILOVER=; Expires=Thu, 01 Jan 1970 00:00:01 GMT\r\nSet-Cookie: Apache=10.72.128.11.1383347736764345; path=/; expires=Sun, 25-Oct-43 23:15:36 GMT\r\nVary: Accept-Encoding\r\nStrict-Transport-Security: max-age=14400\r\nTransfer-Encoding: chunked\r\nContent-Type: text/html; charset=UTF-8\r\n\r\nINVALID\n--------------------------------------------------------------------------------\npayment_type             bba\n\n\n', '0', '2013-11-02 00:15:29');

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
