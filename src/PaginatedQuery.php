<?php

namespace App;

use PDO;
use Exception;

class PaginatedQuery
{

    private $query;

    private $queryCount;

    private $pdo;

    private $perPage;

    private $count;

    private $items;

    /**
     * __construct
     *
     * @param  string $query SQL request to get all posts
     * @param  string $queryCount SQL request to get posts number 
     * @param  PDO $pdo connection to database
     * @param  int $perPage number of element per page
     * @return void
     */
    public function __construct(string $query, string $queryCount, ?PDO $pdo = null, int $perPage = 12)
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->pdo = $pdo ?: Connection::getPDO();
        $this->perPage = $perPage;
    }

    /**
     * getItems
     *
     * @param  string $classMapping fetch_class type of class
     * @return array with items of type class $classMapping
     */
    public function getItems(string $classMapping): array
    {
        if ($this->items === null) {
            $currentPage = $this->getCurrentPage();
            $pages = $this->getPages();
            if ($currentPage > $pages) {
                //throw new Exception('Numéro de page invalide'); 
                return [];
            }
            $offset = $this->perPage * ($currentPage - 1);
            $stmt = $this->pdo->query($this->query . " LIMIT {$this->perPage} OFFSET $offset");
            $this->items = $stmt->fetchAll(PDO::FETCH_CLASS, $classMapping);
        }
        return $this->items;
    }

    /**
     * Pagination for the previous link to the page
     *
     * @param  string $link to go to the previous page
     * @return string HTML link 
     */
    public function previousLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();

        if ($currentPage <= 1) return null;

        if ($currentPage > 2) $link .= '?page=' . ($currentPage - 1);

        return <<<HTML
            <a href="$link" class="btn btn-primary">&laquo; Page précédente</a>
        HTML;
    }

    /**
     * Pagination for the next link to the page
     *
     * @param  string $link to go to the next page
     * @return string HTML link 
     */
    public function nextLink(string $link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();

        if ($currentPage >= $pages) return null;

        $link .= '?page=' . ($currentPage + 1);

        return <<<HTML
            <a href="$link" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
        HTML;
    }

    /**
     * Return the current page
     *
     * @return int
     */
    private function getCurrentPage(): int
    {
        return URL::getPositiveInt('page', 1);
    }

    /**
     * Return number of pages 
     *
     * @return int number of pages
     */
    private function getPages(): int
    {
        if ($this->count === null) {
            $this->count = (int) $this->pdo->query($this->queryCount)->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->count / $this->perPage);
    }
}
