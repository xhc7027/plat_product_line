<?php

class MailHelper
{

    /**
     * 定义帐户信息
     */
    public static $smtpAccounts = array(
        'sms' => array(
            'userName' => 'sms@hsb.com',
            'passWord' => 'dev@HSB#123',
        )
    );

    /**
     * 发送邮件
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public static function send($to, $subject = '', $body = '', $fromAccount = 'sms') {

        $mail = new Mailer();

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPDebug = 0; // enables SMTP debug information (for testing) 1 = errors and messages 2 = messages only
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->Host = "smtp.hsb.com"; // sets the SMTP server
        $mail->Port = 25; // set the SMTP port for the GMAIL server

        $accounts = self::$smtpAccounts;

        if (!in_array($fromAccount, array_keys($accounts))) {
            $fromAccount = 'sms';
        }

        $mail->Username = $accounts[$fromAccount]['userName']; // SMTP account username
        $mail->Password = $accounts[$fromAccount]['passWord']; // SMTP account password

        $mail->SetFrom($accounts[$fromAccount]['userName'], '回收宝');

        $mail->Subject = $subject;

        $mail->MsgHTML($body);

        if (is_array($to)) {
            foreach ($to as $item) {
                $mail->AddAddress($item);
            }
        } else {
            $mail->AddAddress($to);
        }

        if(!$mail->Send()) {
            Log::error("Mailer Error: " . $mail->ErrorInfo);
            return false;
        } else {
            Log::error("Mailer Success");
            return true;
        }
    }


    /**
     * 自定义发送邮件
     * @param $toUser
     * @param $fromUser
     * @param $fromPwd
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public static function sendEmail($toUser, $fromUser, $fromPwd, $subject = '', $body = '', $attachment = '') {

        $mail = new Mailer();

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPDebug = 0; // enables SMTP debug information (for testing) 1 = errors and messages 2 = messages only
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->Host = "smtp.hsb.com"; // sets the SMTP server
        $mail->Port = 25; // set the SMTP port for the GMAIL server
        $mail->Username = $fromUser; // SMTP account username
        $mail->Password = $fromPwd; // SMTP account password
        Log::error($fromUser);
        $mail->SetFrom($fromUser, '回收宝');

        $mail->Subject = $subject;

        if ($attachment) {
            $mail->AddAttachment($attachment, '会员资料自动备份_'.date('Ymd').'.zip'); // 添加附件
        } else {
            Log::error("Mailer without attachment");
            return false;
        }
        $mail->MsgHTML($body);

        if (is_array($toUser)) {
            foreach ($toUser as $item) {
                $mail->AddAddress($item);
            }
        } else {
            $mail->AddAddress($toUser);
        }

        if(!$mail->Send()) {
            Log::error("Mailer Error: " . $mail->ErrorInfo);
            return false;
        } else {
            Log::error("Mailer Success");
            return true;
        }
    }
}