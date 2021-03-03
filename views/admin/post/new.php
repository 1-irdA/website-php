<?php

use App\Connection;
use App\Helpers\ObjectHelper;
use App\Table\PostTable;
use App\Validators\PostValidator;
use App\HTML\Form;
use App\Model\Post;
use App\Auth;
use App\Table\LogsTable;

Auth::check();

$title = 'Ajouter un article';

$post = new Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));
$errors = [];

if (!empty($_POST)) {

    $pdo = Connection::getPDO();
    $table = new PostTable($pdo);
    $v = new PostValidator($_POST, $table, $post->getID());

    ObjectHelper::hydrate($post, $_POST, ['name', 'slug', 'category', 'image', 'link', 'content', 'created_at']);

    if ($v->validate()) {
        $table->create($post);
        LogsTable::writeLogs($pdo, new DateTime('now', new DateTimeZone('Europe/Paris')), "AJOUT DE L'ARTICLE : {$post->getName()}");
        header('Location: ' . $router->url('admin_posts') . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($post, $errors);
?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        Erreur ! L'article n'a pas été ajouté
    </div>
<?php endif; ?>

<h1 class="font-weight-normal">Créer un article</h1>

<?php require '_form.php'; ?>
