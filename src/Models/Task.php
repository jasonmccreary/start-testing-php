<?php

namespace StartTestingPHP\Models;

class Task {

    private $note;

    public function __construct($note)
    {
        $this->note = $note;
    }

    public function getNote()
    {
        return $this->note;
    }
}