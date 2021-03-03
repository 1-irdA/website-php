<?php

use App\Connection;
use App\Table\CategoryTable;

$pdo = Connection::getPDO();
$allCat = (new CategoryTable($pdo))->all();
$images = $pdo->query("SELECT * FROM images")->fetchAll(PDO::FETCH_OBJ);
?>

<form action="" method="POST">
    <?= $form->input('name', 'Titre'); ?>
    <?= $form->input('slug', 'URL'); ?>

    <label for="categories" class="font-weight-bold">Catégorie</label>
    <select name="category" id="categories" class="custom-select">
        <?php foreach ($allCat as $cat) : ?>
            <option value="<?= $cat->getName() ?>"  <?php if ($cat->getName() === $post->getCategory()) echo 'selected'; ?>><?= $cat->getName() ?></option>
        <?php endforeach; ?>
    </select>
    <div class="mb-3"></div>

    <?= $form->textarea('content', 'Contenu') ?>

    <label for="images" class="font-weight-bold">Image</label>
    <select name="image" id="images" class="custom-select">
        <?php foreach ($images as $img) : ?>
            <option id="preview" value="<?=$img->url ?>" <?php if ($img->url === $post->getImage()) echo 'selected'; ?>><?= $img->name ?></option>
        <?php endforeach; ?>
    </select>
    <div class="mb-3"></div>

    <?= $form->input('link', 'Lien'); ?>
    <div class="mb-3"></div>

    <?= $form->input('created_at', 'Date de publication') ?>

    <button class="btn btn-primary">
        <?php if ($post->getID() !== null) : ?>
            Modifier
        <?php else : ?>
            Créer
        <?php endif; ?>
    </button>
</form>