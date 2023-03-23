<?php

namespace App\Core\Db;

use PDO;
use PDOException;

class Connection
{
    /**
     * Return a new PDO instance of a database connection using the provided configuration
     * or die with an Exception message.
     *
     * @param array $dbConfig
     * @return PDO|null
     * 
     * @SuppressWarnings(PHPMD.ExitExpression)
     * @SuppressWarnings(PHPMD.DevelopmentCodeFragment)
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public static function make(array $dbConfig): ?PDO
    {
        try {
            return new PDO(
                "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}", 
                $dbConfig['user'], 
                $dbConfig['password'],
                $dbConfig['options']
            );
        } catch(PDOException $e) {
            die(formattedMessage('Could not connect to database!', $e->getMessage()));
        }
    }
}
