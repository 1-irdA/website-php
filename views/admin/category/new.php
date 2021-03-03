<?php

use App\Connection;
use App\Helpers\ObjectHelper;
use App\Table\{CategoryTable, LogsTable};
use App\Validators\CategoryValidator;
use App\HTML\Form;
use App\Model\Category;
use App\Auth;

Auth::check();

$title = 'Ajouter un article';

$item = new Category();
$errors = [];

if (!empty($_POST)) {

    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);
    $v = new CategoryValidator($_POST, $table, $item->getID());

    ObjectHelper::hydrate($item, $_POST, ['name', 'slug']);

    if ($v->validate()) {
        $table->create($item);
        LogsTable::writeLogs($pdo, new DateTime('now', new DateTimeZone('Europe/Paris')), "AJOUT DE LA CATÉGORIE : {$item->getName()}");
        header('Location: ' . $router->url('admin_categories') . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($item, $errors);
?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        Erreur ! La catégorie n'a pas été ajouté
    </div>
<?php endif; ?>

<h1 class="font-weight-normal">Créer une catégorie</h1>

<?php require '_form.php'; ?>
