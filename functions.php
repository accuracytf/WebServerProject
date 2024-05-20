<?php
//csrf token saker
function generateCsrfToken() {
    return bin2hex(random_bytes(32));
}

function validateCsrfToken($token) {
    return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

//sanitizer class
class Sanitizer {
    /**
     * Sanitera en string input.
     *
     * @param string $input
     * @return string
     */
    public static function sanitizeString($input) {
        return htmlspecialchars(stripslashes(trim($input)), ENT_QUOTES, 'UTF-8');
    }
}
?>

