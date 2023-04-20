<?php

namespace App\Controllers;

use App\Core\App;

class ItemsListsController
{
    private $required = [
        'title' => 'title'
    ];
    private $errors = [];

    private static function getAllLists()
    {
        return (App::get('db'))->selectWhere('lists', ['user_id' => userId()], 'App\\ItemsList');
    }

    public function index()
    {
        $lists = self::getAllLists();
        return view('lists/index', compact('lists'));
    }

    private static function findById($id)
    {
        foreach (self::getAllLists() as $list) {
            if ($list->id === $id) return $list;
        }

        return false;
    }

    public function show(string $id)
    {
        $list = self::findById($id);
        if ($list !== false) {
            $list->items = (App::get('db'))->selectWhere('items', ['list_id' => $list->id], 'App\\Item');
            return view('lists/show', compact('list'));
        }

        $session = getSession();
        $session->message = "Nothing to show.";
        redirect();
    }

    public function create()
    {
        return view('lists/create');
    }

    public function add()
    {
        if (! isset($_POST)) {
            $this->errors['add_list'] = "! Please fill the add list form";
        }

        if ($_POST['title'] === '') {
            $this->errors['add_list'] = "! Please fill the new list title";
        }

        if ($this->errors) return view("lists/create", getErrors($this->errors));

        $data = [];
        $data['title'] = sanitize($_POST['title']);

        if (isset($_POST['description'])) {
            $data['description'] = sanitize($_POST['description']);
        }

        $this->store($data);

        return true;
    }

    public function store(array $data)
    {
        (App::get('db'))->insert('lists', [
            'title' => $data['title'],
            'user_id' => userId(),
            'description' => ($data['description']) ?? '',
            'completed' => 0
        ]);

        $session = getSession();
        $session->message = "List created successfully.";
        App::bind('session', $session);

        redirect();
    }

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
