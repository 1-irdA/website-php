<?php

use App\Connection;
use App\Model\Post;

$id = (int) $params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$stmt = $pdo->prepare('SELECT * FROM post WHERE id = :id');
$stmt->execute(['id' => $id]);
$stmt->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */
$post = $stmt->fetch();

if ($post == false) {
    throw new Exception('Aucun article ne correspond à cet ID');
}

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
?>

<h1 class="card-title"><?= htmlentities($post->getName()) ?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d/m/Y') ?></p>
<p><?= $post->getFormattedContent() ?></p>
<?php if ($post->getLink()) : ?>
    <p><a href="/projets/<?= $post->getLink() ?>" style="color: blue;">Voir <i class="fas fa-arrow-right"></i></a></p>
<?php endif; ?>