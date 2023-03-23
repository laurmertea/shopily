<?php

namespace App\Controllers;

use App\Core\App;

class PagesController
{
    public function title($name = null)
    {
        $parts = [];
        array_push($parts, App::get('appConfig')['defaultTitle']);

        if ($name) {
            array_push($parts, App::get('appConfig')['separator']);
            array_push($parts, ucfirst($name));
        }
        return implode(" ", $parts);
    }

    public function home()
    {
        if (! isLoggedIn()) return view('index');

        $title = $this->title(__FUNCTION__);
        $lists = (App::get('db'))->selectWhere('lists', ['user_id' => userId()], 'App\\ItemsList');
        foreach ($lists as $list) {
            $list->items = (App::get('db'))->selectWhere('items', ['list_id' => $list->id], 'App\\Item');
        }

        App::bind('lists', $lists);
        
        return view('home', compact('title', 'lists'));
    }

    public function about()
    {
        $title = $this->title(__FUNCTION__);

        return view('about', compact('title'));
    }

    public function contact()
    {
        $title = $this->title(__FUNCTION__);

        return view('contact', compact('title'));
    }
}
