<?php

require '../../vendor/autoload.php';
use Utils\EntryValidator as V;

// start session
// TODO CSRF
if (empty($_SESSION)) {
    session_start();
}

/**
 * 405 Method Not Allowed unless POST method
 */
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        break;
    default:
        header('Allow: POST');
        http_response_code(405);
        return;
}

/**
 * return 400 Bad Request unless validation succeed
 */
$errors = V::validate($_POST);
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(array(
        'errors' => $errors
    ));
    return;
}

$sql = 'INSERT INTO
            entry (name, school_name, grade, category_id, lecture_id, lecture_pref_day_one,
            lecture_pref_day_two, lecture_pref_day_three, lecture_pref_day_four,
            comment, lecture_comment, category_comment)
        VALUES
            (:name, :school_name, :grade, :category_id, :lecture_id, :lecture_pref_day_one,
            :lecture_pref_day_two, :lecture_pref_day_three, :lecture_pref_day_four,
            :comment, :lecture_comment, :category_comment)';
try {
    $pdo = Database::connect();
    $statement = $pdo->prepare($sql);
    $ok = $statement->execute(array(
        ':name' => $_POST['name'],
        ':school_name' => $_POST['school_name'],
        ':grade' => $_POST['grade'],
        ':category_id' => $_POST['category_id'],
        ':lecture_id' => $_POST['lecture_id'],
        ':lecture_pref_day_one' => $_POST['lecture_pref_day_one'],
        ':lecture_pref_day_two' => $_POST['lecture_pref_day_two'],
        ':lecture_pref_day_three' => $_POST['lecture_pref_day_three'],
        ':lecture_pref_day_four' => $_POST['lecture_pref_day_four'],
        ':comment' => $_POST['comment'],
        ':lecture_comment' => $_POST['lecture_comment'],
        ':category_comment' => $_POST['category_comment'],
    ));
    if (!$ok) {
        $error_info = $statement->errorInfo();
        var_dump($error_info);
        throw new Exception('pdo error info ');
    }
} catch(\Exception $e) {
    http_response_code(500);
}
