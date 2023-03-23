<?php

return [

    /**
     * Host name
     */
    'host' => 'localhost',
    
    /**
     * Database name
     */
    'dbname' => 'shopily',

    /**
     * Database admin username
     */
    'user' => 'root',

    /**
     * Database admin password
     */
    'password' => '',

    /**
     * PDO options array
     * 
     * PDO::ATTR_ERRMODE - PDO error reporting attribute 
     * which sets the way errors are handled.
     * 
     * Set to PDO::ERRMODE_EXCEPTION so it'll throw exceptions 
     * and stop the scripts for dev environment.
     * Remove it for live environment so that PDO throws no exceptions or warnings, 
     * and just return false.
     */
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];
