<?php

namespace App\Controllers;

use App\Core\App;

/**
 * @SuppressWarnings(PHPMD.Superglobals)
 */
class UsersController
{
    private $required = [
        'username' => 'user_register',
        'e-mail' => 'email',
        'first name' => 'first_name',
        'last name' => 'last_name',
        'password' => 'password_register',
        'password confirmation' => 'password_confirmation'
    ];
    private $errors = [];

    public function index()
    {
        $users = App::get('db')->selectAll('users');

        return view('users', compact('users'));
    }

    public function store(array $data)
    {
        (App::get('db'))->insert('users', [
            'username' => $data['username'],
            'password' => $data['password'],
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'email' => $data['email']
        ]);

        $session = getSession();
        $session->message = "Account created successfully. Please login!";
        App::bind('session', $session);
        
        redirect();
    }

    private function validUsername($username)
    {
        if (! minLength($username)) {
            $this->errors['user_register'] = "! Please enter a username longer than 6 characters";
            return false;
        }

        if (! onlyAlphanumeric($username)) {
            $this->errors['user_register'] = "! Please enter only alphanumeric characters";
            return false;
        }

        return true;
    }

    private function validPassword($password)
    {
        if (! minLength($password)) {
            $this->errors['password_register'] = "! Please enter a password longer than 6 characters";
            return false;
        }

        return true;
    }

    private function confirmPassword($password, $passwordConfirmation)
    {
        if ($password !== $passwordConfirmation) {
            $this->errors['password_confirmation'] = "! Passwords do no match";
            return view("index", getErrors($this->errors));
        }

        return true;
    }

    public function register()
    {
        if (! isset($_POST)) {
            $this->errors['user_register'] = "! Please fill the register form";
            return view("index", getErrors($this->errors));
        }

        foreach ($this->required as $fieldName => $requiredField) {
            if (! (array_key_exists($requiredField, $_POST))) 
                $this->errors[$requiredField] = "! Please fill the required {$fieldName} field";

            if ($_POST[$requiredField] === "") 
                $this->errors[$requiredField] = "! Please fill the required {$fieldName} field";
        }
        
        $data = [];
        $this->validUsername($data['username'] = sanitize($_POST['user_register']));
        $this->validPassword($password = sanitize($_POST['password_register']));
        $this->validPassword($passwordConfirmation = sanitize($_POST['password_confirmation']));
        $this->confirmPassword($password, $passwordConfirmation);

        $data['password'] = hashPassword($password);
        $data['email'] = filterEmail(sanitize($_POST['email']));
        $data['first_name'] = sanitize($_POST['first_name']);
        $data['last_name'] = sanitize($_POST['last_name']);

        if ($this->errors) return view("index", getErrors($this->errors));

        $this->store($data);

        return true;
    }

    private function emailLogin($email)
    {
        return (App::get('db'))->selectWhere('users', [
            'email' => $email
        ]);
    }

    private function usernameLogin($username)
    {
        return (App::get('db'))->selectWhere('users', [
            'username' => $username
        ]);
    }

    public function login()
    {
        if (! ($login = $_POST['user_login'])) 
            $this->errors['user_login'] = "! Please enter the username or the e-mail";
        
        if (! ($password = $_POST['password_login'])) 
            $this->errors['password_login'] = "! Please enter the password";

        if ($this->errors) return view("index", getErrors($this->errors));

        $data = (count(explode("@", $login)) > 1) ? $this->emailLogin($login) : $this->usernameLogin($login);

        if (! $data) {
            $this->errors['password_login'] = "! Wrong credentials";
            return view("index", getErrors($this->errors));
        }

        if (! password_verify($password, $data[0]->password)) {
            $this->errors['password_login'] = "! Wrong credentials";
            return view("index", getErrors($this->errors));
        }

        if ($this->errors) return view("index", getErrors($this->errors));

        $session = getSession();
        $session->username = $data[0]->username;
        $session->userId = $data[0]->id;
        $session->userType = $data[0]->type;
        $session->loggedIn = true;
        App::bind('session', $session);

        redirect();
    }

    public function logout()
    {
        $session = getSession();
        $session->destroy();

        redirect();       
    }
}