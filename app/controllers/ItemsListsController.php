<?php

namespace App\Controllers;

use App\Core\App;

class ItemsListsController
{
    public function index()
    {
        $lists = (App::get('db'))->selectWhere('lists', ['user_id' => userId()], 'App\\ItemsList');

        dd($lists);
    }

    public function store(array $data)
    {}

    public function update(array $data = [])
    {
        $session = getSession();

        if (! $data) {
            $session->message = "Nothing to update.";
            return (new PagesController)->home();
        }

        $data = [];

        dd($data);

    }
}