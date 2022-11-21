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
    private PDO $conn;
    private string $columns;
    private string $tableName;
 
    public function __construct()
    {
        $this->config = Provider::get('CONFIG');
        $this->setParams();
        $this->connect();
    }

    // Изменение данных в базе
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

    // Запись данных в базу
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

    public function delete(int $id): int
    {
        //
    }

    // Определяем Таблицу с которым работаем
    public function setTable(string $tableName): void
    {
        if (isset($tableName) && (empty($this->tableName) || $this->tableName != $tableName)) {
            $this->tableName = $tableName;
            $this->setColumns();
        }
    }

    private function setParams(): void
    {
        $this->host = $this->config->get('DB_HOST');
        $this->user = $this->config->get('DB_USER');
        $this->db = $this->config->get('DB_NAME');
        $this->pass = $this->config->get('DB_PASS');
        $this->prefix = $this->config->get('DB_PREFIX');
    }

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

    // Сформируем имя таблице 
    private function getTableName(): string
    {
        return $this->tableName ? ($this->prefix ? $this->prefix . '_' . $this->tableName : $this->tableName) : '';
    }

    // Определяем всех имя полей
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