<?php

namespace App\Core\Db;

use PDO;
use Exception;
use PDOException;

/**
 * @SuppressWarnings(PHPMD.ExitExpression)
 * @SuppressWarnings(PHPMD.DevelopmentCodeFragment)
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class QueryBuilder
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function selectWhere($table, $params, $intoClass = null)
    {
        $sql = sprintf(
            'SELECT * from %s WHERE %s = %s',
            $table,
            implode(' = :', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute($params);
        } catch (Exception $e) {
            die("Whoops, something went wrong! {$e->getMessage()}");
        }

        if ($intoClass) return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectAll($table, $intoClass = null)
    {
        $statement = $this->db->prepare("SELECT * from {$table}");
        
        try {
            $statement->execute();
        } catch (PDOException $e) {
            die(formattedMessage('Could not query the table!', $e->getMessage()));
        }

        if ($intoClass) return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($table, $params)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute($params);
        } catch (Exception $e) {
            die("Whoops, something went wrong! {$e->getMessage()}");
        }

        return true;
    }

    public function delete($table, $params)
    {
        $sql = sprintf(
            'DELETE from %s WHERE %s = %s',
            $table,
            implode(', ', array_keys($params)),
            ':' . implode(', :', array_keys($params))
        );
        
        try {
            $statement = $this->db->prepare($sql);
            $statement->execute($params);
        } catch (Exception $e) {
            die("Whoops, something went wrong! {$e->getMessage()}");
        }

        return true;
    }
}
