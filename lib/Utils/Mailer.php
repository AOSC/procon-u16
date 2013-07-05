<?php
namespace Utils;

use Config;
use PHPMailer;

class Mailer
{
    /**
     * @param array|string   email address to send
     * @param string         email content to send
     * @param sting          attachment path if any
     * @param boolean        success or fail
     */
    public static function send($address, $body, $attachment_path = null)
    {
        $config = Config::getConfig();
        if ($config->debug) {
            return true;
        }

        mb_language("japanese");
        mb_internal_encoding("UTF-8");

        $mail = new PHPMailer();
        $mail->IsHTML(false);
        $mail->IsSMTP();
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug  = 0;
        $mail->CharSet = "iso-2022-jp";
        $mail->Encoding = "7bit";
        $mail->Host       = "smtp.lolipop.jp";
        $mail->Port       = 25;
        $mail->SMTPAuth   = true;
        $mail->Username   = $config->mailer_username;
        $mail->Password   = $config->mailer_password;
        $mail->SetFrom($config->mailer_username, '');
        if (is_array($address)) {
            foreach ($address as $val) {
                $mail->AddAddress($val, '');
            }
        } else {
            $mail->AddAddress($address, '');
        }

        $mail->Subject = 'U16 Asahikawa Programming Contest Email Nortification';
        $mail->Body    = mb_convert_encoding($body,"JIS","UTF-8");
        if (! empty($attachment_path)) {
            $mail->AddAttachment($attachment_path);
        }

        // TODO error logging here
        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}
