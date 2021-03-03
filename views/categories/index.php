<?php

$title = 'Categories';

use App\Model\Category;
use App\PaginatedQuery;

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM category",
    "SELECT COUNT(id) FROM category"
);

$categories = $paginatedQuery->getItems(Category::class); 
$link = $router->url('categories');

?>
<h1 class="font-weight-normal">Catégories</h1>

<div class="row">
    <?php foreach ($categories as $category) : ?>
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