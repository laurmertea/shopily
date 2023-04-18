<?php

use App\Core\App;

function sanitizeXSS() {
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $_REQUEST = (array)$_POST + (array)$_GET + (array)$_REQUEST;
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
}

function sanitize($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function onlyAlphanumeric($string)
{
    return (! preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $string)) ? false : true;
}

function minLength($string, $minLength = null)
{
    $minLength ??= (App::get('appConfig'))['minLength'];

    return (strlen($string) < $minLength) ? false : true;
}

function filterEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
}
