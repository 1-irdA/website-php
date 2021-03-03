<?php

use App\Connection;
use App\Table\{PostTable, LogsTable};
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
$table->delete($params['id']);
LogsTable::writeLogs($pdo, new DateTime('now', new DateTimeZone('Europe/Paris')), "SUPPRESSION DE L'ARTICLE : {$post->getName()}");
header('Location: ' . $router->url('admin_posts') . '?delete=1');
exit();
?>