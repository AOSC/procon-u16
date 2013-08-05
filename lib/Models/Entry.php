<?php
namespace Models;
use Database;
use Config;

/*
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/

class Entry
{
    /**
     * @var pdo
     */
    private $pdo;

    /**
     * @var array
     */
    private $defaults = array(
        'q_kyogi_macro'   => '',
        'q_kyogi_exp'     => '',
        'comment'         => '',
        'comment_kyogi'   => '',
        'comment_sakuhin' => '',
        'comment_jugyo'   => '',
        'comment_lecture' => '',
    );

    /**
     * @var array
     */
    private $model;

    /**
     * Constructor
     * @param  pdo
     * @throws PDOException
     */
    public function __construct($pdo = null)
    {
        if ($pdo == null) {
            $this->pdo = Database::connect();
        }
    }

    /**
     * @param  array
     * @throws Exception
     */
    public function create($entry)
    {
        $sql = 'INSERT INTO
            entry (name, school_name, grade, category,
            q_kyogi_macro, q_kyogi_exp,
            comment, comment_kyogi, comment_sakuhin, comment_jugyo, comment_lecture, email)
        VALUES
            (:name, :school_name, :grade, :category,
            :q_kyogi_macro, :q_kyogi_exp,
            :comment, :comment_kyogi, :comment_sakuhin, :comment_jugyo, :comment_lecture, :email)';

        $statement = $this->pdo->prepare($sql);
        $model = array_merge($this->defaults, $entry, array(
            'category' => implode(',', $entry['category'])
        ));

        $ok = $statement->execute(array(
            ':name' => $model['name'],
            ':school_name' => $model['school_name'],
            ':grade' => $model['grade'],
            ':category' => $model['category'],
            ':q_kyogi_macro' => $model['q_kyogi_macro'],
            ':q_kyogi_exp' => $model['q_kyogi_exp'],
            ':comment' => $model['comment'],
            ':comment_lecture' => $model['comment_lecture'],
            ':comment_kyogi' => $model['comment_kyogi'],
            ':comment_sakuhin' => $model['comment_sakuhin'],
            ':comment_jugyo' => $model['comment_jugyo'],
            ':email' => $model['email'],
        ));

        $this->model = $model;

        if (!$ok) {
            $error_info = $statement->errorInfo();
            $error_str = json_encode($error_info);
            throw new Exception($error_str);
        }

        return true;
    }

    /**
     * @return array
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return boolean|string
     */
    public function writeCSV()
    {
        if (empty($this->model)) {
            return false;
        }
        $config = Config::getConfig();

        $date = date_create();
        $filename = $config->csv_path . date_format($date, 'Y-m-d-H-i') . '--' . uniqid() . '.csv';

        $list = array(
            array_keys($this->model),
            array_values($this->model),
        );

        $fp = fopen($filename, 'w');

        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
        return $filename;
    }
}
