<?php
use Utils\EntryValidator as V;

/* entry form schema

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
*/
class EntryValidatorTest extends PHPUnit_Framework_TestCase
{

    public function testValidateWithValidData()
    {
        $valid_data = array(
            'name' => '島口知也',
            'school_name' => '旭川市東陽中学校',
            'grade' => 1,
            'category' => array('kyogi', 'sakuhin'),
            'comment' => '',
            'comment_lecture' => '',
            'comment_kyogi' => '',
            'comment_sakuhin' => '',
            'comment_jugyo' => '',
            'email' => 'smagch@gmail.com',
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
            'category' => array('invalid'),
            'comment' => null,
            'comment_lecture' => null,
            'comment_kyogi' => null,
            'comment_sakuhin' => null,
            'comment_jugyo' => null,
            'email' => 'hogefoo.com',
        );

        $result = V::validate($invalid_data);
        $this->assertCount(10, $result);
    }
}
