<?php

namespace App\Helpers;

class SpamChecker
{
    /**
     * Analyze submission data to determine if it is spam.
     *
     * @param array $postData The raw $_POST data
     * @param string $message The message content
     * @return bool True if spam is detected, false otherwise
     */
    public static function isSpam(array $postData, string $message): bool
    {
        // 1. Honeypot check: Bots typically fill all fields.
        if (!empty($postData['website'])) {
            return true;
        }

        $message = trim($message);
        if (empty($message)) {
            return false;
        }

        // 2. Cyrillic check: If the site is in French/English, block messages containing Cyrillic characters
        // as they are a very common source of bot spam.
        if (preg_match('/[\p{Cyrillic}]/u', $message)) {
            return true;
        }

        // 3. Analyze words and structure
        // Split by whitespace
        $words = preg_split('/\s+/', $message);
        if ($words === false || count($words) === 0) {
            return false;
        }

        $totalWords = count($words);
        $totalLength = 0;

        foreach ($words as $word) {
            // Strip common punctuation from start/end of the word
            $cleanWord = preg_replace('/^[^\p{L}]+|[^\p{L}]+$/u', '', $word);
            $len = mb_strlen($cleanWord);

            if ($len === 0) {
                continue;
            }

            // Skip URLs or emails
            if (filter_var($word, FILTER_VALIDATE_EMAIL) || 
                preg_match('/^https?:\/\//i', $word) || 
                preg_match('/www\./i', $word)) {
                continue;
            }

            $totalLength += $len;

            // A. Extremely long words (e.g. > 24 characters) are blocked immediately
            if ($len > 24) {
                return true;
            }

            // B. Words longer than 15 characters are heavily scrutinized
            if ($len > 15) {
                // If it contains 4 or more consecutive consonants (very rare for genuine long words)
                if (preg_match('/[bcdfghjklmnpqrstvwxz]{4,}/i', $cleanWord)) {
                    return true;
                }
                // If it has low vowel ratio (< 25%)
                $vowelsCount = preg_match_all('/[aeiouyéèàùâêîôûëïüæœ]/ui', $cleanWord);
                if ($vowelsCount !== false) {
                    $ratio = $vowelsCount / $len;
                    if ($ratio < 0.25) {
                        return true;
                    }
                }
            }

            // C. General gibberish: any word with 5+ consecutive consonants
            if (preg_match('/[bcdfghjklmnpqrstvwxz]{5,}/i', $cleanWord)) {
                return true;
            }

            // D. Words of 8+ characters with extremely low vowel ratio (< 15%)
            if ($len >= 8) {
                $vowelsCount = preg_match_all('/[aeiouyéèàùâêîôûëïüæœ]/ui', $cleanWord);
                if ($vowelsCount !== false) {
                    $ratio = $vowelsCount / $len;
                    if ($ratio < 0.15) {
                        return true;
                    }
                }
            }
        }

        // E. Average word length check: if the message has multiple words, check the average length.
        // Genuine messages have an average word length of 4-6 characters.
        if ($totalWords >= 3) {
            $avgLength = $totalLength / $totalWords;
            if ($avgLength > 12) {
                return true;
            }
        }

        return false;
    }
}
