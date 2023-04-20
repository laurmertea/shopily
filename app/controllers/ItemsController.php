<?php

namespace App\Controllers;

use App\Core\App;
use App\Item;
use App\ItemsList;

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

    public function create($id)
    {
        return view('items/create', compact('id'));
    }

    public function add()
    {
        if (! isset($_POST)) {
            $this->errors['add_item'] = "! Please fill the add item form";
            return view("index", getErrors($this->errors));
        }

        $session = getSession();
        $data = [];
        $data['title'] = sanitize($_POST['title']);
        $data['description'] = sanitize($_POST['description']);
        $data['list_id'] = sanitize($_POST['list_id']);

        if (!(App::get('db'))->selectWhere('lists', ['id' => $_POST['list_id']], 'App\\ItemsList')) {
            $session->message = "Doesn't exist.";
            return (new PagesController)->home();
        }

        if ((App::get('db'))->selectWhere('lists', ['id' => $_POST['list_id']], 'App\\ItemsList')[0]->user_id !== userId()) {
            $session->message = "Not allowed.";
            return (new PagesController)->home();
        }

        if ($this->errors) return view("index", getErrors($this->errors));

        $this->store($data);

        return true;
    }

    public function update()
    {
        $session = getSession();

        if (! isset($_POST)) {
            $session->message = "Nothing to update.";
            return (new PagesController)->home();
        }

        if (! count(Item::find($_POST['id']))) {
            $session->message = "Item doesn't exist.";
            return (new PagesController)->home();
        }

        $currentListId = Item::find($_POST['id'])[0]->list_id;

        if ((App::get('db'))->selectWhere('lists', ['id' => $currentListId], 'App\\ItemsList')[0]->user_id !== userId()) {
            $session->message = "Not allowed.";
            return (new PagesController)->home();
        }

        $data = [];

        foreach ($_POST as $key => $value) {
            if ($key == 'id') continue;
            $data[$key] = validate($value);
        }

        if (! array_key_exists('completed', $_POST)) {
            $data['completed'] = 0;
        } else {
            $data['completed'] = 1;
        }

        (App::get('db'))->updateById('items', $data, validate($_POST['id']));

        $session = getSession();
        $session->message = "Item updated successfully.";
        App::bind('session', $session);

        if ((ItemsList::find($currentListId))[0]->completed != (self::updateStatus($currentListId))) {
            // TODO: Needs update for count
            //new ItemsListsController->update();
        }

        redirect();
    }

    private function updateStatus($id)
    {
        return (count((new ItemsList)->items($id)) == (new ItemsList)->count('completed', $id));
    }

    public function delete()
    {
        $session = getSession();

        if (! isset($_POST)) {
            $session->message = "Nothing to delete.";
            return (new PagesController)->home();
        }

        $_POST['id'] = validate($_POST['id']);

        if (! count(Item::find($_POST['id']))) {
            $session->message = "Item doesn't exist.";
            return (new PagesController)->home();
        }

        if((App::get('db'))->selectWhere('lists', ['id' => Item::find($_POST['id'])[0]->list_id], 'App\\ItemsList')[0]->user_id !== userId()) {
            $session->message = "Not allowed.";
            return (new PagesController)->home();
        }

        (App::get('db'))->delete('items', [
            'id' => intval($_POST['id'])
        ]);

        $session->message = "Item removed successfully.";
        App::bind('session', $session);

        redirect();
    }

}