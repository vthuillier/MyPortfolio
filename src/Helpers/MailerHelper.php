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
                ->replyTo($data['email'])
                ->subject('Nouveau message de contact : ' . $appName)
                ->text(
                    "Vous avez reçu un nouveau message de contact sur votre portfolio.\n\n" .
                    "Nom : " . $data['name'] . "\n" .
                    "Email : " . $data['email'] . "\n" .
                    "Message :\n" . $data['message']
                );

            $mailer->send($email);

            // Send recap to the user
            $nameSafe = htmlspecialchars($data['name']);
            $messageSafe = nl2br(htmlspecialchars($data['message']));
            $appNameSafe = htmlspecialchars($appName);
            $userNameSafe = htmlspecialchars(Setting::get('user_name') ?: 'Valentin Thuillier');

            $htmlBody = "
            <html>
            <body style='font-family: \"Courier New\", Courier, monospace; background-color: #0c0a09; color: #f5f5f4; margin: 0; padding: 40px 20px;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #171514; border: 1px solid rgba(250, 204, 21, 0.2); padding: 30px;'>
                    <div style='border-bottom: 2px solid #facc15; padding-bottom: 15px; margin-bottom: 30px;'>
                        <h2 style='color: #facc15; margin: 0; text-transform: uppercase; letter-spacing: 2px; font-size: 18px;'>SYSTEM ACKNOWLEDGEMENT</h2>
                        <span style='color: #78716c; font-size: 10px; text-transform: uppercase;'>{$appNameSafe}</span>
                    </div>
                    
                    <p style='color: #f5f5f4; font-size: 14px;'>Bonjour <strong>{$nameSafe}</strong>,</p>
                    
                    <p style='color: #a8a29e; font-size: 14px; line-height: 1.6;'>
                        Votre transmission a été reçue avec succès par nos serveurs. Voici une copie de votre payload :
                    </p>
                    
                    <div style='background-color: #000000; padding: 20px; border-left: 3px solid #facc15; margin: 30px 0; color: #d6d3d1; font-size: 13px; white-space: pre-wrap;'>{$messageSafe}</div>
                    
                    <p style='color: #a8a29e; font-size: 14px; line-height: 1.6;'>
                        Alerte déclenchée. Je reviendrai vers vous dans les plus brefs délais.
                    </p>
                    
                    <div style='margin-top: 40px; padding-top: 20px; border-top: 1px solid #333;'>
                        <p style='color: #78716c; font-size: 12px; font-weight: bold; text-transform: uppercase; margin: 0;'>
                            // {$userNameSafe}
                        </p>
                    </div>
                </div>
            </body>
            </html>
            ";

            $userEmail = (new Email())
                ->from($_ENV['MAIL_FROM_ADDRESS'] ?? 'hello@example.com')
                ->to($data['email'])
                ->subject('Confirmation de réception - ' . $appName)
                ->text(
                    "Bonjour " . $data['name'] . ",\n\n" .
                    "Votre transmission a bien été reçue. Voici un récapitulatif de votre payload :\n\n" .
                    "--------------------------------------------------\n" .
                    $data['message'] . "\n" .
                    "--------------------------------------------------\n\n" .
                    "Alerte déclenchée. Je reviendrai vers vous dans les plus brefs délais.\n\n" .
                    "// " . (Setting::get('user_name') ?: 'Valentin Thuillier')
                )
                ->html($htmlBody);

            $mailer->send($userEmail);

            return true;
        } catch (\Exception $e) {
            error_log("Mail Error: " . $e->getMessage());
            return false;
        }
    }
}
