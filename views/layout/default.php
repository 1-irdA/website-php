<!DOCTYPE html>
<html lang="fr">

<?php

use App\Auth;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $title ?? "Adrien Garrouste" ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="resources/logo.png" />
</head>

<body class="d-flex flex-column">
    <!-- navbar - window width - obscure - color : black-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href='/' class="navbar-brand"><?= $logo ?? 'AG' ?></a>
        <!-- responsive toggle button for navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#reponsiveNav" aria-controls="reponsiveNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="reponsiveNav">
            <!-- buttons to the left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->url('home') ?>">Accueil <i class="fas fa-home"></i><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->url('profil') ?>">Profil <i class="far fa-id-card"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->url('posts') ?>">Articles <i class="fas fa-newspaper"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->url('categories') ?>">Catégories <i class="fas fa-align-left"></i></a>
                </li>
                <?php if (Auth::isConnected()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->url('admin') ?>">Administrateur <i class="fas fa-user-lock"></i></a>
                    </li>
                <?php endif ?>
            </ul>
            <!-- connexion button to the right -->
            <ul class="navbar-nav">
                <?php if (Auth::isConnected() && !empty($_SESSION)) : ?>
                    <li class="nav-item">
                        <form action="<?= $router->url('logout') ?>" method="POST" style="display:inline">
                            <button type="submit" class="nav-link" style="background:transparent; border:none;">Se déconnecter <i class="fas fa-sign-out-alt"></i></button>
                        </form>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <form action="<?= $router->url('login') ?>" method="POST" style="display:inline">
                            <button type="submit" class="nav-link" style="background:transparent; border:none;">Se connecter <i class="fas fa-sign-out-alt"></i></button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <?= $content ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- font awesome icones  -->
    <script src="https://kit.fontawesome.com/1a3d67297c.js" crossorigin="anonymous"></script>
</body>

</html>