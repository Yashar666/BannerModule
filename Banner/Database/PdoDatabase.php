<?php

/**
 * @package Banner\Database\PdoDatabase
 */

namespace Banner\Database;

use Banner\Provider;
use PDO;

class PdoDatabase implements Database {
    /**
    * Database Credentials
    * @var string $host
    * @var string $user
    * @var string $db
    * @var string $pass
    * @var string $prefix
    */

    /**
    * @var PDO $conn
    * @var string $columns
    * @var string $tableName
    */
    private PDO $conn;
    private string $columns;
    private string $tableName;

    /**
    * Connect & set params proccess
    */
    public function __construct()
    {
        $this->config = Provider::get('CONFIG');
        $this->setParams();
        $this->connect();
    }

    /**
    * Update record
    * @param string[] $where
    * @param string[] $options
    * @return bool
    */
    public function update(array $where = [], array $options = []): bool
    {
        if (empty($options) || empty($where)) {
            return false;
        }

        $updateFields = '';
        foreach ($options as $field => $option) {
            $updateFields .= $field . '=' . (is_array($option) ? end($option) : $this->conn->quote($option)) . ', ';
        }
        $updateFields = rtrim($updateFields, ', ');

        $whereFields = '';
        foreach ($where as $field => $value) {
            $whereFields .= $field . '=' . $this->conn->quote($value) . ' AND ';
        }
        $whereFields = rtrim($whereFields, ' AND ');

        try {
            $this->conn->query('UPDATE ' . $this->getTableName() . ' SET ' . $updateFields . ' WHERE ' . $whereFields);
            return true;
        } catch (Exception $e) {
            trigger_error("Update query failed: " . $e->getMessage());
        }
    }

    /**
    * Insert data to database
    * @param string[] $options
    * @return bool
    */
    public function insert(array $options = []): bool
    {
        if (empty($options)) {
            return false;
        }
        
        $fields = implode(', ', array_keys($options));
        $values = '';
        foreach ($options as $option) {
            $values .= $this->conn->quote($option) . ', ';
        }
        $values = rtrim($values, ', ');

        try {
            $this->conn->query('INSERT INTO ' . $this->getTableName() . ' (' . $fields . ') VALUES (' . $values . ')');
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            trigger_error("Insert query failed: " . $e->getMessage());
        }
    }

    /**
    * Delete record
    * @param int $id
    * @return bool
    */
    public function delete(int $id): bool
    {
        /**
        * @todo Delete record proccess
        */
    }

    /**
    * Set table name which uses
    * @param string $tableName
    * @return void
    */
    public function setTable(string $tableName): void
    {
        if (isset($tableName) && (empty($this->tableName) || $this->tableName != $tableName)) {
            $this->tableName = $tableName;
            $this->setColumns();
        }
    }

    /**
    * Set database credentials
    * @return void
    */
    private function setParams(): void
    {
        $this->host = $this->config->get('DB_HOST');
        $this->user = $this->config->get('DB_USER');
        $this->db = $this->config->get('DB_NAME');
        $this->pass = $this->config->get('DB_PASS');
        $this->prefix = $this->config->get('DB_PREFIX');
    }

    /**
    * Connect to database with PDO
    * @return void
    */
    private function connect(): void
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=utf8', $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            trigger_error('ERROR: ' . $e->getMessage()); 
            exit;
        }
    }

    /**
    * Get table real name
    * @return string
    */
    private function getTableName(): string
    {
        return $this->tableName ? ($this->prefix ? $this->prefix . '_' . $this->tableName : $this->tableName) : '';
    }

    /**
    * Set all fields names
    * @return void
    */
    private function setColumns(): void
    {
        $table = $this->getTableName();
        if ($table) {
            $stmt = $this->conn->query('DESCRIBE ' . $table);
            $this->columns = '';
            foreach ($stmt as $field) {
                $this->columns .= $field['Field'] . ', '; 
            }
            $this->columns = rtrim($this->columns, ', ');
        }
    }
}