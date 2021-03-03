<?php

use App\Auth;
use App\PaginatedQuery;
use App\Model\Log;

Auth::check();

$title = 'Administration';
$logo = $title;

?>

<h1 class="display-4">Logs</h1>

<?php

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM logs ORDER BY date DESC",
    "SELECT COUNT(*) FROM logs"
);

$logs = $paginatedQuery->getItems(Log::class);
$link = $router->url('admin');

?>

<table class="table table-dark">
    <thead>
        <th scope="col">Date</th>
        <th scope="col">Heure</th>
        <th scope="col">Action</th>
    </thead>
    <tbody>
        <?php foreach ($logs as $log) : ?>
            <?php
            if (strpos($log->getAction(), 'SUPPRESSION') !== false) {
                $color = 'bg-danger';
                $icon = '<i class="fas fa-trash-alt"></i>';
            } else if (strpos($log->getAction(), 'MODIFICATION') !== false) {
                $color = 'bg-primary';
                $icon = '<i class="fas fa-pen"></i>';
            } else if (strpos($log->getAction(), 'AJOUT') !== false) {
                $color = 'bg-info';
                $icon = '<i class="fas fa-plus"></i>';
            }
            ?>
            <tr class="<?= $color ?>">
                <td><?= $log->getDate()->format('d/m/Y') ?></td>
                <td><?= $log->getDate()->format('H:i:s') ?></td>
                <td><?= $icon ?>&nbsp;&nbsp;&nbsp;<?= $log->getAction() ?></td>
            </tr> 
            <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link); ?>
</div>