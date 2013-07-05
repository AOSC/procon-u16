<?php

require '../../vendor/autoload.php';
use Utils\EntryValidator as V;
use Models\Entry;

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
        exit();
}

/**
 * return 400 Bad Request unless validation succeed
 */
$errors = V::validate($_POST);
if (!empty($errors)) {
    http_response_code(400);
    echo 'Bad Request';
    echo '<ul>';
    foreach($errors as $msg) {
        echo '<li>' . $msg . '</li>';
    }
    echo '</ul>';
    echo '<pre>';
    echo json_encode($_POST, JSON_PRETTY_PRINT);
    echo '</pre>';
    exit();
}

try {
    $entry = new Entry();
    $ok = $entry->create($_POST);
    http_response_code(200);
    echo '受付を完了しました';
} catch(\Exception $e) {
    http_response_code(500);
}
