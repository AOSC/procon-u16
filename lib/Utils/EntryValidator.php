<?php
namespace Utils;
use Respect\Validation\Validator as v;

class EntryValidator
{
    /**
     * validate model
     */
    public static function validate(array $model)
    {
        $errors = array();

        // at least 1 letter
        if (! v::arr()->key('name', v::string()->length(1, null))->validate($model)) {
            $errors[] = '名前は必須です';
        }

        if (! v::arr()->key('school_name', v::string()->length(1, null))->validate($model)) {
            $errors[] = '学校名は必須です';
        }

        $one_to_three = v::int()->between(1, 3, true);

        if (! v::arr()->key('grade', $one_to_three)->validate($model)) {
            $errors[] = '学年は、1、2、3のどれかでなければいけません';
        }

        if (! v::arr()->key('category_id', $one_to_three)->validate($model)) {
            $errors[] = '参加部門は必須です';
        }

        if (! v::arr()->key('lecture_id', $one_to_three)->validate($model)) {
            $errors[] = '参加部門は必須です';
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

        if (! v::arr()->key('lecture_comment', v::string())->validate($model)) {
            $errors[] = '講習会についての希望が文字ではありません';
        } elseif (mb_strlen($model['lecture_comment'] > 64000)) {
            $errors[] = '講習会についての希望コメントが多すぎです';
        }

        if (! v::arr()->key('category_comment', v::string())->validate($model)) {
            $errors[] = '質問が文字ではありません';
        } elseif (mb_strlen($model['lecture_comment']) > 64000) {
            $errors[] = '質問のコメントが多すぎです';
        }

        return $errors;
    }
}



