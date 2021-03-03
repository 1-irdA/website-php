<?php

namespace App\Model;

use DateTime;

class Log
{
    private $id;

    private $date;

    private $action;

    /**
     * Get the value of date
     */ 
    public function getDate(): ?DateTime
    {
        return new DateTime($this->date);
    }

    /**
     * Get the value of action
     */ 
    public function getAction(): ?string
    {
        return $this->action;
    }
}