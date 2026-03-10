<?php

namespace App\Helpers;

use App\Models\Analytics;
use App\Config\Database;
use PDO;

class RateLimiter
{
    /**
     * Check if a request should be limited based on event type and IP.
     * 
     * @param string $eventType e.g., 'contact_form', 'login_attempt'
     * @param int $maxAttempts e.g., 5
     * @param int $decaySeconds e.g., 3600 (1 hour)
     * @return bool True if limited, false otherwise
     */
    public static function isLimited($eventType, $maxAttempts = 5, $decaySeconds = 3600)
    {
        $ip = self::getAnonymizedIp();
        $db = Database::getConnection();

        $stmt = $db->prepare("
            SELECT COUNT(*) 
            FROM analytics 
            WHERE event_type = ? 
            AND ip_address = ? 
            AND created_at >= ?
        ");

        $since = date('Y-m-d H:i:s', time() - $decaySeconds);
        $stmt->execute([$eventType, $ip, $since]);
        $count = $stmt->fetchColumn();

        return $count >= $maxAttempts;
    }

    private static function getAnonymizedIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        // Anonymize IPv4
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            $parts[3] = '0';
            return implode('.', $parts);
        }

        // Anonymize IPv6
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $packed = inet_pton($ip);
            if ($packed !== false && strlen($packed) === 16) {
                $mask = str_repeat("\xFF", 8) . str_repeat("\x00", 8);
                return inet_ntop($packed & $mask);
            }
        }

        return $ip;
    }
}
