<?php

namespace App;

use App\Security\ForbiddenException;

class Auth
{
    
    /**
     * Check if user is connected with admin account
     * 
     * @return void
     */
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['auth'])) {
            throw new ForbiddenException();
        }
    }

    public static function isConnected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['auth']);
    }
}
