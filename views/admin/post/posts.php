<?php

use App\Connection;
use App\Table\PostTable;
use App\Auth;

Auth::check();

$title = 'Gestion des articles';
$logo = $title;

$link = $router->url('admin_posts');

$pdo = Connection::getPDO();
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

?>

<?php if (isset($_GET['delete'])) : ?>
    <div class="alert alert-success">
        Post supprimé
    </div>
<?php endif; ?>

<?php if (isset($_GET['created']) && $_GET['created'] === '1'): ?>
    <div class="alert alert-success">
        Post enregistré
    </div>
<?php endif; ?>

<h1 class="font-weight-normal">Tous les articles</h1>


<table class="table table-dark">
    <thead>
        <th>#</th>
        <th>Titre</th>
        <th>
            <a href="<?= $router->url('admin_post_new') ?>" class="btn btn-info">Ajouter <i class="fas fa-plus"></i></a>
        </th>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td>#<?= $post->getID() ?></td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>" class="text-white">
                        <?= htmlentities($post->getName()) ?>
                    </a>
                </td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>" class="btn btn-primary">
                        Modifier <i class="fas fa-pen"></i>
                    </a>
                </td>
                <td>
                    <form action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiment supprimer ce post ?')" style="display:inline">
                        <button type="submit" class="btn btn-danger">Supprimer <i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr> <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link); ?>
</div>