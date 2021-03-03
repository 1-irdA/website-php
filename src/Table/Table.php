<?php

namespace App\Table;

use PDO;
use Exception;

abstract class Table
{

    protected $pdo;

    /**
     * __construct
     *
     * @param  PDO $pdo instance of PDO
     * @return void
     */
    public function __construct(PDO $pdo)
    {
        if ($this->table === null) {
            throw new Exception('La classe n\'a pas de propriété table');
        }
        $this->pdo = $pdo;
    }

    /**
     * Find a post with an id
     *
     * @param  int $id post id
     * @return Object or exception if not found
     */
    public function find(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} where id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $stmt->fetch();
        if ($result === false) {
            throw new Exception("Le post #$id n'est pas dans la table {$this->table}");
        }
        return $result;
    }

    /**
     * Check if a value exist in table
     *
     * @param  string $field field to search
     * @param  mixed $value associated field value
     * @return bool
     */
    public function exists(string $field, $value, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if ($except !== null) {
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    /**
     * Delete post with id = id
     *
     * @param  int $id id of post to delete
     * @return void
     */
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $deleted = $stmt->execute([$id]);

        if ($deleted === false) {
            throw new Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
    }

    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}"; //ORDER BY id DESC
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}
