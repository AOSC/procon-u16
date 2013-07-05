<?php

require '../../vendor/autoload.php';
use Utils\EntryValidator as V;
use Models\Entry;
use Utils\Log;
use Utils\Mailer;

$log = Log::getLogger();

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

    $log->error('400 BadRequest');
    $json = json_encode($_POST, JSON_PRETTY_PRINT);
    $log->error($json);
    Mailer::send('smagch@gmail.com', "Bad Request $json");
    exit();
}

try {
    $entry = new Entry();
    $ok = $entry->create($_POST);
    http_response_code(200);
    echo '受付を完了しました';
    $log->info('Accept new entry');
    $log->info(json_encode($_POST));
    $csv_filename = $entry->writeCSV();
    Mailer::send(array('smagch@gmail.com', 'info@procon-asahikawa.org'),
        '新たなエントリーを受け付けました', $csv_filename);
} catch(\Exception $ex) {
    http_response_code(500);
    $log->emergency('500 Internal Server Error');
    $msg = $ex->getMessage();
    $log->emergency($msg);
    Mailer::send('smagch@gmail.com', "Internal Server Error $msg");
}
