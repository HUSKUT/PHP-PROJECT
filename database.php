<?php

namespace database;

use Exception;
use Helpers\DataHelper;
use PDO;
use PDOException;
require 'Helpers/DataHelper.php';

class database
{

    private static $_instance; // No type hinting because it's a static property

    private array $result;
    private String | null $table;

    private String | null $lastQuery;
    private PDO | null $conn;


    public static function getInstance(): database
    {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function __construct()
    {
        try {
            $conn = new PDO("sqlite:db.sqlite", null, null, array(PDO::ATTR_PERSISTENT => true));
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    private function __clone() { }

    public function exec() : array
    {
        return $this->result;

    }

    public function table(String $table): database
    {
        $this->table = $table;
        return $this;
    }

    public function where(String $column, String $operator, String | int $value): database
    {
        $statement = $this->conn->prepare("SELECT * FROM $this->table WHERE $column $operator :values");
        $statement->bindParam(':values', $value, PDO::PARAM_STR); // TODO: int?????????????
        $statement->execute();

        $this->result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $this;
    }

    public function update(array $data) : database
    {
        unset($data['table_name']);
        unset($data['database_id']);

        $data = DataHelper::stringify_data($data);

        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_values($data));

        $id = $this->result[0]['id'];

        $statement = $this->conn->prepare("UPDATE $this->table SET $columns = :values WHERE id= $id");
        $statement->bindParam(':values', $values, PDO::PARAM_STR);
        var_dump($statement);
        $statement->execute();

        return $this;
    }

    public function insert(array $data): database
    {
        unset($data['database_id']);
        unset($data['table_name']);

        $data = DataHelper::stringify_data($data);

        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_values($data));

        $statement = $this->conn->prepare("INSERT INTO $this->table ($columns) VALUES ($values)");
        $statement->execute();

        return $this;
    }

    public function close(): void
    {
        $this->conn = null;
    }
}