<?php

namespace App\Helpers;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use App\Models\Setting;

class MailerHelper
{
    public static function sendContactNotification($data)
    {
        $dsn = "smtp://" . urlencode($_ENV['MAIL_USERNAME'] ?? '') . ":" . urlencode($_ENV['MAIL_PASSWORD'] ?? '')
            . "@" . ($_ENV['MAIL_HOST'] ?? 'localhost') . ":" . ($_ENV['MAIL_PORT'] ?? '25');

        // Disable TLS if it's mailtrap or local testing (or better, configure it properly later)
        if (strpos($_ENV['MAIL_HOST'] ?? '', 'mailtrap') !== false) {
            // Basic mailtrap DSN
            $dsn = "smtp://" . urlencode($_ENV['MAIL_USERNAME'] ?? '') . ":" . urlencode($_ENV['MAIL_PASSWORD'] ?? '')
                . "@" . ($_ENV['MAIL_HOST'] ?? 'localhost') . ":" . ($_ENV['MAIL_PORT'] ?? '2525');
        }

        try {
            $transport = Transport::fromDsn($dsn);
            $mailer = new Mailer($transport);

            // Fetch to email address from settings or .env, fallback to MAIL_FROM_ADDRESS
            $toEmail = Setting::get('contact_email') ?: ($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com');
            $appName = $_ENV['APP_NAME'] ?? 'Portfolio';

            $email = (new Email())
                ->from($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com')
                ->to($toEmail)
                ->subject('Nouveau message de contact : ' . $appName)
                ->text(
                    "Vous avez reçu un nouveau message de contact sur votre portfolio.\n\n" .
                    "Nom : " . $data['name'] . "\n" .
                    "Email : " . $data['email'] . "\n" .
                    "Message :\n" . $data['message']
                );

            $mailer->send($email);
            return true;
        } catch (\Exception $e) {
            error_log("Mail Error: " . $e->getMessage());
            return false;
        }
    }
}
