<?php

use App\Connection;
use App\Helpers\ObjectHelper;
use App\Table\PostTable;
use App\Validators\PostValidator;
use App\HTML\Form;
use App\Auth;
use App\Table\LogsTable;

Auth::check();

$title = 'Modifier un article';

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
$post = $table->find($params['id']);
$success = false;
$errors = [];

if (!empty($_POST)) {

    $v = new PostValidator($_POST, $table, $post->getID());

    ObjectHelper::hydrate($post, $_POST, ['name', 'slug', 'category', 'image', 'link', 'content', 'created_at']);

    if ($v->validate()) {
        $table->update($post);
        $success = true;
        LogsTable::writeLogs($pdo, new DateTime('now', new DateTimeZone('Europe/Paris')), "MODIFICATION DE L'ARTICLE : {$post->getName()}");
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($post, $errors);
?>

<?php if ($success) : ?>
    <div class="alert alert-success">
        L'article a correctement été modifié
    </div>
<?php endif; ?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        Erreur ! L'article n'a pas été modifié
    </div>
<?php endif; ?>

<h1 class="display-4">Modifier l'article <?= htmlentities($post->getName()) ?></h1>

<?php require '_form.php' ?>