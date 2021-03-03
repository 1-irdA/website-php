<?php

namespace App\Table;

use App\PaginatedQuery;
use App\Model\Post;
use Exception;

class PostTable extends Table
{

    protected $table = "post";
    protected $class = Post::class;

    /**
     * Return posts from SQL request response and pagination
     *
     * @return array with posts and pagination
     */
    public function findPaginated(): array
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM {$this->table}",
            $this->pdo
        );
        $posts = $paginatedQuery->getItems($this->class);
        return [$posts, $paginatedQuery];
    }

    public function create($post): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} 
            SET name = :name, slug = :slug, category = :category, image = :image, link = :link, content = :content, created_at = :created");

        $created = $stmt->execute([
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'category' => $post->getCategory(),
            'image' => $post->getImage(),
            'link' => $post->getLink(),
            'content' => $post->getContent(),
            'created' => $post->getCreatedAt()->format('Y-m-d')
        ]);


        if ($created === false) {
            throw new Exception("Impossible de créer le post dans la table {$this->table}");
        }
        $post->setID($this->pdo->lastInsertId());
    }

    /**
     * update
     * @param Post
     * @return void
     */
    public function update(Post $post): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE {$this->table} 
            SET name = :name, slug = :slug, category = :category, image = :image, link = :link, content = :content, created_at = :created
            WHERE id = :id");

        $updated = $stmt->execute([
            'id' => $post->getID(),
            'name' => $post->getName(),
            'slug' => $post->getSlug(),
            'category' => $post->getCategory(),
            'image' => $post->getImage(),
            'link' => $post->getLink(),
            'content' => $post->getContent(),
            'created' => $post->getCreatedAt()->format('Y-m-d')
        ]);


        if ($updated === false) {
            throw new Exception("Impossible de modifier l'enregistrement $post->getID() dans la table {$this->table}");
        }
    }
}
