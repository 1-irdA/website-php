<?php

namespace App;

use DateTime;

class Utils
{

    public static function getMyAge(): int
    {
        $birth = new DateTime('14-03-2000');
        $now = new DateTime('now');
        $years = $now->diff($birth, true);
        return $years->y;
    }
}
