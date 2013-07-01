
--
-- MySQL Schema for programming contest entry in 2013
-- MySQL version should be 5.6
--
-- DROP TABLE IF EXISTS `entry`;
--
CREATE TABLE `entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `grade` tinyint unsigned NOT NULL,
  `category_id` tinyint unsigned NOT NULL,
  `lecture_id` tinyint unsigned NOT NULL,
  `lecture_pref_day_one` tinyint unsigned NOT NULL,
  `lecture_pref_day_two` tinyint unsigned NOT NULL,
  `lecture_pref_day_three` tinyint unsigned NOT NULL,
  `lecture_pref_day_four` tinyint unsigned NOT NULL,
  `comment` text NOT NULL,
  `lecture_comment` text NOT NULL,
  `category_comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
