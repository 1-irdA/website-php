<?php

namespace App\Table;

use DateTime;
use PDO;

class LogsTable extends Table
{
    public static function writeLogs(PDO $pdo, DateTime $dt, string $action)
    {
        $stmt = $pdo->prepare("INSERT INTO logs VALUES (?,?)");
        $stmt->execute([$dt->format('Y-m-d H:i:s'), $action]);
    }
}