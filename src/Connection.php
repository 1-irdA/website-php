<?php

namespace App;

use PDO;

class Connection
{  
    /**
     * Return a pdo connection
     *
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        return new PDO('mysql:dbname=site;host=127.0.0.1', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}
