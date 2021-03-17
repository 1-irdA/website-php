<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Connection;

$user1 = 'adri';
$mdp1 = 'password';
$mdp1_hash = password_hash($mdp1,PASSWORD_BCRYPT, ['cost' => 14]);

$pdo = Connection::getPDO();

$pdo->exec("INSERT INTO user SET username = '$user1', password = '$mdp1_hash'");