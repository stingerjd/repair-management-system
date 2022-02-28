<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
*  ==============================================================================
*  Author   : Usman Sher
*  Email    : usman@otsglobal.org
*  Web      : http://otsglobal.org
*  ==============================================================================
*/

require FCPATH.'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Wf_mail
{

    public function __construct() {

    }

    public function __get($var) {
        return get_instance()->$var;
    }

    public function send_mail($to, $subject, $body, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL, $bcc = NULL) {
        $Settings = $this->settings_model->getSettings();

        try {
            $mail = new PHPMailer;
            $mail->isSMTP();
            

            // $mail->SMTPDebug = 4;
            $mail->Host = $Settings->smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $Settings->smtp_user;
            $mail->Password = $Settings->smtp_pass;
            $mail->SMTPSecure = !empty($Settings->smtp_crypto) ? $Settings->smtp_crypto : false;
            $mail->Port = $Settings->smtp_port;

            if ($from && $from_name) {
                $mail->setFrom($from, $from_name);
                $mail->addReplyTo($from, $from_name);
            } elseif ($from) {
                $mail->setFrom($from, $Settings->title);
                $mail->addReplyTo($from, $Settings->title);
            } else {
                $mail->setFrom($Settings->invoice_mail, $Settings->title);
                $mail->addReplyTo($Settings->invoice_mail, $Settings->title);
            }

            if (is_array($to)) {
                foreach ($to as $email) {
                    $mail->addAddress($email);
                }
            }else{
                $mail->addAddress($to);
            }
            // $to = 'uskhan099@gmail.com';
            $mail->addAddress($to);
            if ($cc) { $mail->addCC($cc); }
            if ($bcc) { $mail->addBCC($bcc); }
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $body;
            if ($attachment) {
                if (is_array($attachment)) {
                    foreach ($attachment as $attach) {
                        $mail->addAttachment($attach);
                    }
                } else {
                    $mail->addAttachment($attachment);
                }
            }

            if (!$mail->send()) {
                throw new Exception($mail->ErrorInfo);
                return FALSE;
            }
            return TRUE;
        } catch (phpmailerException $e) {
            throw new Exception($e->errorMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
