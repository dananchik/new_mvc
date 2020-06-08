<?php

namespace brain;

use brain\DateBase;


abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new DateBase();
    }
}