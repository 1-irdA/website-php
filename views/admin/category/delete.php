<?php

use App\Connection;
use App\Table\{CategoryTable, LogsTable};
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$category = $table->find($params['id']);
$table->delete($params['id']);
LogsTable::writeLogs($pdo, new DateTime('now', new DateTimeZone('Europe/Paris')), "SUPPRESSION DE LA CATÉGORIE : {$category->getName()}");
header('Location: ' . $router->url('admin_categories') . '?delete=1');

?>