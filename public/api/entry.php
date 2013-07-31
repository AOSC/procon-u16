<?php

require '../../vendor/autoload.php';
use Utils\EntryValidator as V;
use Models\Entry;
use Utils\Log;
use Utils\Mailer;

$log = Log::getLogger();

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
 * honeypot form field
 * "usename"は、フォームでは見えないようになっているテキストの入力項目です
 * スパムは、HTMLを解析して自動的にフォーム書き込むので、CSSを理解できない大体のスパムを弾けます
 */
if (!empty($_POST['username'])) {
    http_response_code(401);
    $log->info('honeypot captured "username"');
    exit();
}

/**
 * For details about CSRF read following documents
 * http://en.wikipedia.org/wiki/Cross-site_request_forgery
 * http://www.codinghorror.com/blog/2008/10/preventing-csrf-and-xsrf-attacks.html
 */
if (empty($_SESSION['fkey'])) {
    http_response_code(401);
    echo 'セキュリティーの観点から、ブラウザのクッキーをオンにしていただく必要があります。';
    exit();
}

if (empty($_POST['fkey']) || $_SESSION['fkey'] != $_POST['fkey']) {
    http_response_code(401);
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
    $json = json_encode($_POST);
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
