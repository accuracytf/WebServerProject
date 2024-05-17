<?php
function generateCsrfToken() {
    return bin2hex(random_bytes(32));
}

function validateCsrfToken($token) {
    return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

class Sanitizer {
    /**
     * Sanitize a string input.
     *
     * @param string $input
     * @return string
     */
    public static function sanitizeString($input) {
        return htmlspecialchars(stripslashes(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize an integer input.
     *
     * @param int $input
     * @return int
     */
    public static function sanitizeInt($input) {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Sanitize an email input.
     *
     * @param string $input
     * @return string
     */
    public static function sanitizeEmail($input) {
        return filter_var($input, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Sanitize a URL input.
     *
     * @param string $input
     * @return string
     */
    public static function sanitizeUrl($input) {
        return filter_var($input, FILTER_SANITIZE_URL);
    }

    // Add more sanitization methods as needed
}
?>