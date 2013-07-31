<?php
namespace Utils;
use Respect\Validation\Validator as v;

/*
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
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/

class EntryValidator
{
    /**
     * validate entity model
     *
     * 本当は、Validationは１度に行い、エラーメッセージは自動的に吐いて欲しいのですが、
     * Respect\Validationのv0.4.4の現状ではもんだがまだ解決されていません
     * 詳しくは、以下のリンクのチケットをみて下さい
     * https://github.com/Respect/Validation/issues/86
     *
     *   e.g. v::arr()->key('username', v::string())
     *                ->key('email',    v::email())
     *                ->assert($model);
     *
     * @param  array   entity model to validate
     * @return array   list of error messages
     */
    public static function validate(array $model)
    {
        $errors = array();
        mb_language("japanese");
        mb_internal_encoding("UTF-8");

        // at least 1 letter
        if (! v::arr()->key('name', v::string()->length(1, null))->validate($model)) {
            $errors[] = '名前は必須です';
        } elseif (mb_strlen($model['name']) > 100) {
            $errors[] = '名前は100文字以下でお願いします';
        }

        if (! v::arr()->key('school_name', v::string()->length(1, null))->validate($model)) {
            $errors[] = '学校名は必須です';
        } elseif (mb_strlen($model['school_name']) > 100) {
            $errors[] = '名前は100文字以下でお願いします';
        }

        if (! v::arr()->key('email', v::email())->validate($model)) {
          $errors[] = 'メールアドレスは必須です';
        }

        $one_to_three = v::int()->between(1, 3, true);

        if (! v::arr()->key('grade', $one_to_three)->validate($model)) {
            $errors[] = '学年は、1、2、3のどれかでなければいけません';
        }

        if (! v::arr()->key('category', v::arr())->validate($model)) {
            $errors[] = '参加部門が不正な値です';
            $errors[] = '参加部門は、競技・作品・授業のいずれか１つ以上選択する必要があります';
        } elseif (empty($model['category'])) {
            $errors[] = '参加部門は、競技・作品・授業のいずれか１つ以上選択する必要があります';
        } else {
            $diff = array_diff($model['category'], array('kyogi', 'sakuhin', 'jugyo'));
            if (! empty($diff)) {
                $errors[] = implode(', ', $diff) . 'は不正なIDです';
            }
        }

        if (! v::arr()->key('lecture_pref_day_one', $one_to_three)->validate($model)) {
            $errors[] = '参加希望日１が無効な値です';
        }

        if (! v::arr()->key('lecture_pref_day_two', $one_to_three)->validate($model)) {
            $errors[] = '参加希望日２が無効な値です';
        }

        if (! v::arr()->key('lecture_pref_day_three', $one_to_three)->validate($model)) {
            $errors[] = '参加希望日３が無効な値です';
        }

        if (! v::arr()->key('lecture_pref_day_four', $one_to_three)->validate($model)) {
            $errors[] = '参加希望日４が無効な値です';
        }

        // max byte size of "text" is 64k
        if (! v::arr()->key('comment', v::string())->validate($model)) {
            $errors[] = 'コメントが文字ではありません';
        } elseif (mb_strlen($model['comment']) > 64000) {
            $errors[] = 'コメントが多すぎです';
        }

        if (! v::arr()->key('comment_lecture', v::string())->validate($model)) {
            $errors[] = '講習会についての希望が文字ではありません';
        } elseif (mb_strlen($model['comment_lecture'] > 64000)) {
            $errors[] = '講習会についての希望コメントが多すぎです';
        }

        if (! v::arr()->key('comment_kyogi', v::string())->validate($model)) {
            $errors[] = '競技の質問が文字ではありません';
        } elseif (mb_strlen($model['comment_kyogi']) > 64000) {
            $errors[] = '競技の質問のコメントが多すぎです';
        }

        if (! v::arr()->key('comment_sakuhin', v::string())->validate($model)) {
            $errors[] = '作品についてのコメントが文字ではありません';
        } elseif (mb_strlen($model['comment_sakuhin']) > 64000) {
            $errors[] = '作品についてののコメントが多すぎです';
        }

        if (! v::arr()->key('comment_jugyo', v::string())->validate($model)) {
            $errors[] = 'マイコンカーについてのコメントが文字ではありません';
        } elseif (mb_strlen($model['comment_jugyo']) > 64000) {
            $errors[] = 'マイコンカーについてのコメントが多すぎです';
        }

        return $errors;
    }
}



