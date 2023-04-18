<?php

namespace App;
use App\Core\App;

class Item
{
    public $id, $title, $description, $created_on, $modified_on;
    public $completed = false;

    public static function find($id)
    {
        return (App::get('db'))->selectWhere('items', ['id' => $id], 'App\\Item');
    }

    public function complete()
    {
        $this->completed = true;
    }

    public function toggle()
    {
        $this->completed = !$this->completed;
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
