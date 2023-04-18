<?php

use App\Core\App;
use App\ItemsList;

function view($name, $data = null)
{
    $errors = [];

    if ($data) {
        if (is_array($data)) extract($data);
    }

    return require "app/views/{$name}.view.php";
}

function partial($name, $data = null)
{
    if ($data) extract($data);

    return require "app/views/partials/{$name}.php";
}

function hasMessage() {
    return isset((App::get('session'))->message);
}

function getMessage()
{
    $message = (App::get('session'))->message;
    unset((App::get('session'))->message);

    return $message;
}

function showHTMLMessage()
{
    echo "<div class='messages center green hide-in-5'>" . getMessage() . "</div>";
}

function getErrors($errors)
{
    return compact('errors');
}

function defaultTitle()
{
    return App::get('appConfig')['defaultTitle'];
}

function getSession()
{
    return App::get('session');
}

function isLoggedIn()
{
    return ((getSession())->loggedIn) ?? false;
}

function isAdmin()
{
    return ((getSession())->userType) ?? false;
}

function username()
{
    return ((getSession())->username) ?? false;
}

function userId()
{
    return ((getSession())->userId) ?? false;
}

/**
 * Return current date formatted Y-m-d
 * 
 * @return string
 */
function currentDate(): string
{
    return date("Y-m-d");
}

function redirect($path = "")
{
    header("Location: /{$path}");
}
