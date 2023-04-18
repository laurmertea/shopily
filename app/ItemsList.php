<?php

namespace App;

use App\Core\App;

class ItemsList
{
    public $id, $title, $description, $count, $created_on, $modified_on;
    public $completed = false;

    public static function find($id)
    {
        return (App::get('db'))->selectWhere('lists', ['id' => $id], 'App\\ItemsList');
    }

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

    public function items(int $id)
    {
        return (App::get('db'))->selectWhere('items', ['list_id' => $id], 'App\\Item');
    }

    public function count($property, $id)
    {
        return count(array_filter(self::items($id), function($value) use ($property) { return $value->$property == 1; }));
    }
}
