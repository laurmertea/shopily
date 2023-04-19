<?php

namespace App;

use App\Core\App;

class Model
{
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

    public function toggle()
    {
        $this->completed = !$this->completed;
    }

    public function toJson()
    {
        return json_encode($this);
    }
}
