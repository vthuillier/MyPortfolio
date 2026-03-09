<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Analytics
{
    public static function logEvent($type, $path = null)
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        if ($ip) {
            // Anonymize IPv4 (e.g. 192.168.1.1 -> 192.168.1.0)
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $parts = explode('.', $ip);
                $parts[3] = '0';
                $ip = implode('.', $parts);
            }
            // Anonymize IPv6 (masking last 64 bits)
            elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $packed = inet_pton($ip);
                if ($packed !== false && strlen($packed) === 16) {
                    $mask = str_repeat("\xFF", 8) . str_repeat("\x00", 8);
                    $ip = inet_ntop($packed & $mask);
                }
            }
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO analytics (event_type, page_path, ip_address, user_agent) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $type,
            $path,
            $ip,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    }

    public static function getVisitStats($days = 30)
    {
        $db = Database::getConnection();
        $driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);

        $dateFunc = "DATE(created_at)";
        if ($driver === 'pgsql') {
            $dateFunc = "created_at::date";
        }

        $stmt = $db->prepare("
            SELECT $dateFunc as date, COUNT(*) as count 
            FROM analytics 
            WHERE event_type = 'page_view' 
            AND created_at >= ?
            GROUP BY $dateFunc
            ORDER BY $dateFunc ASC
        ");

        $startDate = date('Y-m-d', strtotime("-$days days"));
        $stmt->execute([$startDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getDownloadStats($days = 30)
    {
        $db = Database::getConnection();
        $driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);

        $dateFunc = "DATE(created_at)";
        if ($driver === 'pgsql') {
            $dateFunc = "created_at::date";
        }

        $stmt = $db->prepare("
            SELECT $dateFunc as date, COUNT(*) as count 
            FROM analytics 
            WHERE event_type = 'cv_download' 
            AND created_at >= ?
            GROUP BY $dateFunc
            ORDER BY $dateFunc ASC
        ");

        $startDate = date('Y-m-d', strtotime("-$days days"));
        $stmt->execute([$startDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTotalVisits()
    {
        $db = Database::getConnection();
        return $db->query("SELECT COUNT(*) FROM analytics WHERE event_type = 'page_view'")->fetchColumn();
    }

    public static function getTotalDownloads()
    {
        $db = Database::getConnection();
        return $db->query("SELECT COUNT(*) FROM analytics WHERE event_type = 'cv_download'")->fetchColumn();
    }
}
