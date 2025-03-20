<?php
require_once 'config/Database.php';
/**
 * Base Model Class
 *
 * Provides common database operations and serves as a foundation
 * for all model classes in the MVC application.
 */
class Model
{
    protected $table;
    protected $primaryKey = 'id';
    protected $db;

    /**
     * Constructor
     *
     * @param string $table The database table associated with this model
     */
    public function __construct($table = null)
    {
        $this->db = Database::getInstance();
        // If table name is provided, use it; otherwise use lowercase class name
        if ($table) {
            $this->table = $table;
        } else {
            // Convert CamelCase class name to snake_case table name
            $className = get_class($this);

            $tableName = strtolower(
                preg_replace('/(?<!^)[A-Z]/', '_$0', $className)
            );

            // Append 's' if not already ending in 's'
            if (substr($tableName, -1) !== 's') {
                $tableName .= 's';
            }

            $this->table = $tableName;}
    }

    /**
     * Find record by primary key
     *
     * @param int $id The primary key value
     * @return array|null The fetched record or null if not found
     */
    public function find($id)
    {
        //dd($id);
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            //dd($stmt->fetch(PDO::FETCH_ASSOC));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in find(): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get all records from the table
     *
     * @param string $orderBy Column to order by
     * @param string $order Sort order (ASC or DESC)
     * @return array Array of records
     */
    public function all($orderBy = null, $order = 'ASC')
    {
        try {
            $sql = "SELECT * FROM {$this->table}";

            if ($orderBy) {
                $sql .= " ORDER BY {$orderBy} {$order}";
            }

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in all(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Create a new record
     *
     * @param array $data Associative array of column => value pairs
     * @return int|bool The last inserted ID or false on failure
     */
    public function create($data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
            $stmt = $this->db->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $result = $stmt->execute();
            if ($result) {
                // Success
                return $this->db->lastInsertId();
            } else {
                // Failure: let's see the actual error
                $errorInfo = $stmt->errorInfo();
                // Log or inspect $errorInfo
                error_log('Insert failed: ' . print_r($errorInfo, true));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Database error in create(): " . $e->getMessage());
            return false;
        }
    }


    /**
     * Update an existing record
     *
     * @param int $id The primary key value
     * @param array $data Associative array of column => value pairs
     * @return bool Success or failure
     */
    public function update($id, $data)
    {
        try {
            $setClause = '';

            foreach (array_keys($data) as $key) {
                $setClause .= "{$key} = :{$key}, ";
            }

            $setClause = rtrim($setClause, ', ');

            $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':id', $id);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error in update(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete a record
     *
     * @param int $id The primary key value
     * @return bool Success or failure
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error in delete(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Find records by specific field value
     *
     * @param string $field The field name
     * @param mixed $value The value to search for
     * @return array Array of matching records
     */
    public function where($field, $value)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$field} = :value");
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in where(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Custom query execution
     *
     * @param string $sql SQL query to execute
     * @param array $params Parameters for the query
     * @param bool $fetchAll Whether to fetch all results or just one
     * @return mixed Query results or false on failure
     */
    public function query($sql, $params = [], $fetchAll = true)
    {
        try {
            $stmt = $this->db->prepare($sql);

            foreach ($params as $key => $value) {
                if (is_int($key)) {
                    $stmt->bindValue($key + 1, $value);
                } else {
                    $stmt->bindValue(":{$key}", $value);
                }
            }

            $stmt->execute();

            if ($fetchAll) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            error_log("Database error in query(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Count records in the table
     *
     * @param string $condition Optional WHERE condition
     * @param array $params Parameters for the condition
     * @return int The count result
     */
    public function count($condition = '', $params = [])
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM {$this->table}";

            if ($condition) {
                $sql .= " WHERE {$condition}";
            }

            $stmt = $this->db->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['count'];
        } catch (PDOException $e) {
            error_log("Database error in count(): " . $e->getMessage());
            return 0;
        }
    }
    
    
}