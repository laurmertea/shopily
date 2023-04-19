<?php

namespace App;

use App\Core\App;

class ItemsList extends Model
{
    public $id, $title, $description, $count, $created_on, $modified_on;

    public static function find($id)
    {
        return (App::get('db'))->selectWhere('lists', ['id' => $id], 'App\\ItemsList');
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
