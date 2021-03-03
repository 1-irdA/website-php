<?php

namespace App\Table;

use App\Model\User;
use PDO;
use Exception;

class UserTable
{

    private $pdo;

    private $table = "user";

    private $class = User::class;

    /**
     * __construct
     *
     * @param  PDO $pdo instance of PDO
     * @return void
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByUsername(string $username) 
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} where username = :username");
        $stmt->execute(['username' => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();
        if ($result === false) {
            throw new Exception("L'utilisateur n'est pas dans la table {$this->table}");
        }
        return $result;
    }
    
}
