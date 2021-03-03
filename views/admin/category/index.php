<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Auth;

Auth::check();

$title = 'Gestion des catégories';
$logo = $title;

$link = $router->url('admin_categories');

$pdo = Connection::getPDO();
$items = (new CategoryTable($pdo))->all();

?>

<?php if (isset($_GET['delete'])) : ?>
    <div class="alert alert-success">
        Categorie supprimé
    </div>
<?php endif; ?>

<?php if (isset($_GET['created']) && $_GET['created'] === '1'): ?>
    <div class="alert alert-success">
        Categorie enregistré
    </div>
<?php endif; ?>

<h1 class="font-weight-normal">Toutes les catégories</h1>


<table class="table table-dark">
    <thead>
        <th>#</th>
        <th>Titre</th>
        <th>URL</th>
        <th>
            <a href="<?= $router->url('admin_category_new') ?>" class="btn btn-info">Ajouter <i class="fas fa-plus"></i></a>
        </th>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>#<?= $item->getID() ?></td>
                <td>
                    <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>" class="text-white">
                        <?= htmlentities($item->getName()) ?>
                    </a>
                </td>
                <td><?= $item->getSlug() ?></td>
                <td>
                    <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>" class="btn btn-primary">
                        Modifier <i class="fas fa-pen"></i>
                    </a>
                </td>
                <td>
                    <form action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiment supprimer cette catégorie ?')" style="display:inline">
                        <button type="submit" class="btn btn-danger">Supprimer <i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr> <?php endforeach; ?>
    </tbody>
</table>


