<?php

namespace App\Helpers;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use App\Models\Setting;

class MailerHelper
{
    private static function getMailer()
    {
        $dsn = "smtp://" . urlencode($_ENV['MAIL_USERNAME'] ?? '') . ":" . urlencode($_ENV['MAIL_PASSWORD'] ?? '')
            . "@" . ($_ENV['MAIL_HOST'] ?? 'localhost') . ":" . ($_ENV['MAIL_PORT'] ?? '25');

        if (strpos($_ENV['MAIL_HOST'] ?? '', 'mailtrap') !== false) {
            $dsn = "smtp://" . urlencode($_ENV['MAIL_USERNAME'] ?? '') . ":" . urlencode($_ENV['MAIL_PASSWORD'] ?? '')
                . "@" . ($_ENV['MAIL_HOST'] ?? 'localhost') . ":" . ($_ENV['MAIL_PORT'] ?? '2525');
        }

        return new Mailer(Transport::fromDsn($dsn));
    }

    public static function sendContactNotification($data)
    {
        try {
            $mailer = self::getMailer();
            $toEmail = Setting::get('contact_email') ?: ($_ENV['NOTIFY_EMAIL'] ?? ($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com'));
            $appName = $_ENV['APP_NAME'] ?? 'Portfolio';
            $userName = Setting::get('user_name') ?: 'Valentin Thuillier';

            // 1. Send Notification to Admin
            $adminHtmlBody = self::renderTemplate('admin_notification', [
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message']
            ]);

            $adminEmail = (new Email())
                ->from($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com')
                ->to($toEmail)
                ->replyTo($data['email'])
                ->subject('RE: [SYSTEM_ALERT] New message from ' . $data['name'])
                ->text("Nouveau message de contact.\n\nNom: {$data['name']}\nEmail: {$data['email']}\n\n{$data['message']}")
                ->html($adminHtmlBody);

            $mailer->send($adminEmail);

            // 2. Send Confirmation to User
            $userHtmlBody = self::renderTemplate('user_confirmation', [
                'name' => $data['name'],
                'message' => $data['message'],
                'appName' => $appName,
                'userName' => $userName
            ]);

            $userEmail = (new Email())
                ->from($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com')
                ->to($data['email'])
                ->subject('Confirmation de réception - ' . $appName)
                ->text("Bonjour {$data['name']},\n\nVotre message a bien été reçu.\n\n\"{$data['message']}\"\n\nJe reviens vers vous vite.\n\n// {$userName}")
                ->html($userHtmlBody);

            $mailer->send($userEmail);

            return true;
        } catch (\Exception $e) {
            error_log("Mail Error: " . $e->getMessage());
            return false;
        }
    }

    public static function sendDirectReply($to, $subject, $message, $originalMessage = null)
    {
        try {
            $mailer = self::getMailer();
            $appName = $_ENV['APP_NAME'] ?? 'Portfolio';
            $userName = Setting::get('user_name') ?: 'Valentin Thuillier';

            $htmlBody = self::renderTemplate('reply', [
                'message' => $message,
                'originalMessage' => $originalMessage,
                'userName' => $userName,
                'appName' => $appName
            ]);

            $email = (new Email())
                ->from($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com')
                ->to($to)
                ->subject($subject)
                ->text($message)
                ->html($htmlBody);

            $mailer->send($email);
            return true;
        } catch (\Exception $e) {
            error_log("Reply Mail Error: " . $e->getMessage());
            return false;
        }
    }

    private static function renderTemplate($template, $data = [])
    {
        extract($data);
        ob_start();
        $templatePath = __DIR__ . "/../Views/emails/{$template}.php";
        if (file_exists($templatePath)) {
            include $templatePath;
        }
        return ob_get_clean();
    }
}
