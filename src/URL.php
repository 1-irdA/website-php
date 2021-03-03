<?php

namespace App;

use Exception;

class URL
{
    
    /**
     * Return value of name param of default value
     *
     * @param  string $name name of key in $_GET
     * @param  int $default value to return
     * @return int value of param $name
     */
    public static function getInt(string $name, ?int $default = null): ?int
    {
        if (!isset($_GET[$name])) return $default;

        if ($_GET[$name] === '0') return 0;

        if (!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
            throw new Exception("Le paramètre $name dans l'url n'est pas un entier");
        }

        return (int) $_GET[$name];
    }
    
    /**
     * Return positive int value
     *
     * @param  string $name of param
     * @param  int $default value to return
     * @return int positive value
     */
    public static function getPositiveInt(string $name, ?int $default = null): ?int
    {
        $param = self::getInt($name,$default);

        if ($param !== null && $param <= 0) {
            throw new Exception("Le paramètre $name dans l'url n'est pas un entier positif");
        }
        return $param;
    }
}
