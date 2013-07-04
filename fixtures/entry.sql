
--
-- MySQL Schema for programming contest entry in 2013
-- MySQL version should be 5.6
--
--
CREATE TABLE `entry` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `grade` tinyint(1) unsigned NOT NULL,
  `category` set('kyogi','sakuhin','jugyo') NOT NULL,
  `q_kyogi_macro` enum('yes','no', '') DEFAULT '',
  `q_kyogi_exp` enum('yes','no', '') DEFAULT '',
  `lecture_pref_day_one` tinyint(1) unsigned NOT NULL,
  `lecture_pref_day_two` tinyint(1) unsigned NOT NULL,
  `lecture_pref_day_three` tinyint(1) unsigned NOT NULL,
  `lecture_pref_day_four` tinyint(1) unsigned NOT NULL,
  `comment` text NOT NULL,
  `comment_kyogi` text NOT NULL,
  `comment_sakuhin` text NOT NULL,
  `comment_jugyo` text NOT NULL,
  `comment_lecture` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
