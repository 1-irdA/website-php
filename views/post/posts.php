<?php

use App\Model\Post;
use App\PaginatedQuery;

$title = 'Les articles';

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM post ORDER BY created_at DESC",
    "SELECT COUNT(id) FROM post"
);

$posts = $paginatedQuery->getItems(Post::class); 
$link = $router->url('posts');

?>
<h1 class="weight-normal">Tous les articles</h1>

<div class="row">
    <?php foreach ($posts as $post) : ?>
        <!-- 3 articles by lines -->
        <div class="col-md-4">
            <?php require 'card.php' ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link); ?>
</div>