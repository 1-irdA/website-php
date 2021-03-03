<!-- articles for a specific category -->

<div class="card mb-3" style="width: 18rem;">
    <div class="card-body text-center">
        <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-link">
            <img src="<?= $post->getImage() ?>" class="card-img-top mb-4" alt="Image du projet">
        </a>
        <h5 class="card-title"><?= $post->getName() ?></h5>
        <p class="text-muted"><?= $post->getCreatedAt()->format('d/m/Y') ?></p>
        <p><a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir &raquo;</a></p>
    </div>
</div>