<?php

use App\Connection;
use App\Helpers\ObjectHelper;
use App\Table\{CategoryTable, LogsTable};
use App\Validators\CategoryValidator;
use App\HTML\Form;
use App\Auth;

Auth::check();

$title = 'Modifier une categorie';

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];

if (!empty($_POST)) {

    $v = new CategoryValidator($_POST, $table, $item->getID());

    ObjectHelper::hydrate($item, $_POST, ['name', 'slug']);

    if ($v->validate()) {
        $table->update($item);
        LogsTable::writeLogs($pdo, new DateTime('now', new DateTimeZone('Europe/Paris')), "MODIFICATION DE LA CATÉGORIE : {$item->getName()}");
        $success = true;
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);
?>

<?php if ($success) : ?>
    <div class="alert alert-success">
        La catégorie a correctement été modifié
    </div>
<?php endif; ?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        Erreur ! La catégorie n'a pas été modifié
    </div>
<?php endif; ?>

<h1 class="display-4">Modifier la catégorie <?= htmlentities($item->getName()) ?></h1>

<?php require '_form.php' ?>