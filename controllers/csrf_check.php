<?php

class csrf_check{
    public function generate_csrf_token() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        // echo $_SESSION['csrf_token'];
        return $_SESSION['csrf_token'];
    }
    public function validate_csrf_token($token) {
        return isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'];
    }
}




?>
