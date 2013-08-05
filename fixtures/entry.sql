
--
-- MySQL Schema for programming contest entry in 2013
-- MySQL version should be 5.6
--
-- DROP TABLE IF EXISTS `entry`;
--
CREATE TABLE `entry` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `grade` tinyint(1) unsigned NOT NULL,
  `category` set('kyogi','sakuhin','jugyo') NOT NULL,
  `q_kyogi_macro` enum('yes','no', '') DEFAULT '',
  `q_kyogi_exp` enum('yes','no', '') DEFAULT '',
  `comment` text NOT NULL,
  `comment_kyogi` text NOT NULL,
  `comment_sakuhin` text NOT NULL,
  `comment_jugyo` text NOT NULL,
  `comment_lecture` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
