<!-- categories card -->
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 text-center mb-2">
                <a href="<?= $router->url('categorie', ['id' => $category->getID(), 'slug' => $category->getSlug(), 'name' => $category->getName()]) ?>" class="btn btn-link">
                    <img src="resources/128px/<?= ucfirst($category->getName()) ?>.png">
                </a>
            </div>
            <div class="col-sm-6 text-center">
                <h5 class="card-title"><?= ucfirst($category->getName()) ?></h5>
                <a href="<?= $router->url('categorie', ['id' => $category->getID(), 'slug' => $category->getSlug(), 'name' => $category->getName()]) ?>" class="btn btn-primary">Voir &raquo;</a>
            </div>
        </div>
    </div>
</div>