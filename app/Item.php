<?php

namespace App;

use App\Core\App;

class Item extends Model
{
    public $id, $title, $description, $created_on, $modified_on;

    public static function find($id)
    {
        return (App::get('db'))->selectWhere('items', ['id' => $id], 'App\\Item');
    }
}
