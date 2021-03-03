<?php

use App\Connection;
use App\Model\Post;
use App\PaginatedQuery;

$id = (int) $params['id'];
$slug = $params['slug'];
$name = $params['name'];

?>

<h1 class="card-title"><?= htmlentities($name) ?>
    <img src="../resources/64px/<?= $name ?>.png">
</h1>

<?php

/*
$paginatedQuery = new PaginatedQuery(
    "SELECT p.* 
    FROM post p 
    JOIN category c ON c.name = p.category
    WHERE p.category = '{$name}'
    ORDER BY created_at DESC",
    // count
    "SELECT COUNT(p.id) 
    FROM post p 
    JOIN category c ON c.name = p.category
    WHERE p.category = '{$name}'"
);

$posts = $paginatedQuery->getItems(Post::class);
*/
$pdo = Connection::getPDO();
$stmt = $pdo->prepare('SELECT * FROM post WHERE category = :category');
$stmt->execute([':category' => $name]);
$posts = $stmt->fetchAll(PDO::FETCH_CLASS, Post::class);
$link = $router->url('categorie');

?>

<div class="row">
    <?php foreach ($posts as $post) : ?>
        <!-- 3 articles by lines -->
        <div class="col-md-4">
            <?php require 'cardPostCat.php' ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- <div class="d-flex justify-content-between my-4">
    <?php 
    // $paginatedQuery->previousLink($link) 
    // $paginatedQuery->nextLink($link) 
    ?>
</div> -->