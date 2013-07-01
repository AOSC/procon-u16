<?php
use Utils\EntryValidator as V;

/* entry form schema

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
*/
class EntryValidatorTest extends PHPUnit_Framework_TestCase
{

    public function testValidateWithValidData()
    {
        $valid_data = array(
            'name' => 'foo bar',
            'school_name' => '旭川市東陽中学校',
            'grade' => 1,
            'category_id' => 2,
            'lecture_id' => 3,
            'lecture_pref_day_one' => 1,
            'lecture_pref_day_two' => 2,
            'lecture_pref_day_three' => 2,
            'lecture_pref_day_four' => 3,
            'comment' => '',
            'lecture_comment' => '',
            'category_comment' => '',
        );

        $result = V::validate($valid_data);
        $this->assertEmpty($result);

    }

    public function testValidateWithInvalidData()
    {
        $invalid_data = array(
            'name' => '',
            'school_name' => '',
            'grade' => '',
            'category_id' => 10,
            'lecture_id' => 4,
            'lecture_pref_day_one' => 4,
            'lecture_pref_day_two' => 5,
            'lecture_pref_day_three' => 6,
            'lecture_pref_day_four' => 7,
            'comment' => null,
            'lecture_comment' => null,
            'category_comment' => null,
        );

        $result = V::validate($invalid_data);
        $this->assertCount(12, $result);
    }
}
