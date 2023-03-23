<?php

namespace App\Controllers;

use App\Core\App;

class ItemsController
{
    private $required = [
        'title' => 'title',
        'description' => 'description',
        'completed' => 'completed',
        'list_id' => 'list_id'
    ];
    private $errors = [];

    public function store(array $data)
    {
        (App::get('db'))->insert('items', [
            'title' => $data['title'],
            'description' => $data['description'],
            'list_id' => $data['list_id'],
            'completed' => 0
        ]);

        $session = getSession();
        $session->message = "Item added successfully.";
        App::bind('session', $session);

        redirect();
    }    

    public function add()
    {
        if (! isset($_POST)) {
            $this->errors['add_item'] = "! Please fill the add item form";
            return view("index", getErrors($this->errors));
        }

        $data = [];
        $data['title'] = sanitize($_POST['title']);
        $data['description'] = sanitize($_POST['description']);
        $data['list_id'] = sanitize($_POST['list_id']);

        if ($this->errors) return view("index", getErrors($this->errors));

        $this->store($data);

        return true;
    }

    public function delete()
    {
        if (isset($_POST)) {
            (App::get('db'))->delete('items', [
                'id' => sanitize($_POST['id'])
            ]);
    
            $session = getSession();
            $session->message = "Item removed successfully.";
            App::bind('session', $session);
    
            redirect();
        }

        return true;
    }

}