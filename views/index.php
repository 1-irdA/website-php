<?php

use App\Connection;
use App\Model\Post;

$pdo = Connection::getPDO();

$stmt = $pdo->query('SELECT * FROM post 
                    WHERE id = 
                    (SELECT MAX(id) 
                    FROM post)');
$stmt->setFetchMode(PDO::FETCH_CLASS, Post::class);
$post = $stmt->fetch();
?>

<h1 class="display-3 text-center">Bienvenue sur mon site</h1>

<p class="text-center font-italic mb-4">
    Ce site contient des projets en informatique que j'ai réalisé durant mon temps libre ou mes études.<br />
    Consulter la page <a href="<?= $router->url('profil') ?>" class="link">profil</a> pour en apprendre plus sur moi.
</p>

<?php if ($post) : ?>
    <div class="card">
        <div class="card-body text-center">
            <h3>Dernier article ajouté</h3>
            <hr />
            <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-link">
                <img src="<?= $post->getImage() ?>" style="width: 8rem;" class="card-img-top mb-4" alt="Image for last article">
            </a>
            <h5><?= $post->getName() ?></h5>
            <p class="text-muted"><?= $post->getCreatedAt()->format('d/m/Y') ?></p>
            <p><a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir &raquo;</a></p>
            <h5>Catégorie</h5>
            <img src="resources/64px/<?= $post->getCategory() ?>.png">
        </div>
    </div>
<?php endif; ?>