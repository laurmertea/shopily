<?php

namespace App;

class ItemsList
{
    public $id, $title, $description, $created_on, $modified_on;
    public $completed = false;

    public function complete()
    {
        $this->completed = true;
    }

    public function isComplete()
    {
        return $this->completed;
    }

    public function status()
    {
        return ($this->completed) ? 'complete' : 'incomplete';
    }

    public function toJson()
    {
        return json_encode($this);
    }
}
