<?php

use App\Auth;
use App\Connection;
use App\HTML\Form;
use App\Model\User;
use App\Table\UserTable;

$title = 'Se connecter';

$user = new User();
$errors = [];

if (!empty($_POST)) {
    // fill field
    $user->setUsername($_POST['username']);
    $errors['password'] = 'Identifiant ou mot de passe incorrect';

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $table = new UserTable(Connection::getPDO());
        try {
            $u = $table->findByUsername($_POST['username']);

            if (password_verify($_POST['password'], $u->getPassword()) === true) {
                session_start();
                $_SESSION['auth'] = $u->getID();

                header('Location: ' . $router->url('admin'));
                exit();
            }
        } catch (Exception $e) {
            $errors['password'] = 'Identifiant ou mot de passe incorrect';
        }
    }
}

$form = new Form($user, $errors);
?>

<?php
if (Auth::isConnected()) {
    header('Location: ' . $router->url('admin'));
}
?>

<?php if (isset($_GET['forbidden'])) : ?>
    <div class="alert alert-danger">
        Vous devez vous connecter pour accéder à cette page
    </div>
<?php endif; ?>

<h1 class="mb-4 font-weight-normal text-center">Se connecter</h1>

<form action="" method="POST">
    <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-10 offset-sm-1 col-xs-8 offset-xs-2 text-center">
        <i class="fas fa-lock fa-3x mb-4"></i>
        <?= $form->input('username', 'Nom d\'utilisateur'); ?>
        <?= $form->input('password', 'Mot de passe'); ?>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>
</form>