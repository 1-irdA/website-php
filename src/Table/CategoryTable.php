<?php

namespace App\Table;

use App\Model\Category;
use PDO;
use Exception;

class CategoryTable extends Table
{

    protected $table = 'category';
    protected $class = Category::class;

    public function create(Category $item): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} 
            SET name = :name, slug = :slug");

        $created = $stmt->execute([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
        ]);


        if ($created === false) {
            throw new Exception("Impossible de créer le post dans la table {$this->table}");
        }
        $item->setID($this->pdo->lastInsertId());
    }

    /**
     * update
     * @param Post
     * @return void
     */
    public function update(Category $item): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table} 
            SET name = :name, slug = :slug
            WHERE id = :id");

        $updated = $stmt->execute([
            'id' => $item->getID(),
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
        ]);

        if ($updated === false) {
            throw new Exception("Impossible de modifier l'enregistrement $item->getID() dans la table {$this->table}");
        }
    }
    

}
