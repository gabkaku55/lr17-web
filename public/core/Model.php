<?php
class Model
{
    protected static $pdo = null;
    protected static $table = null;
    protected array $attributes = [];
    public function __construct(PDO $pdo, $table, $data = null)
    {
        static::$pdo = $pdo;
        if (!static::$table) 
            {
            static::$table = $table;
        }
        $sql = "SHOW COLUMNS FROM `" . static::$table . "`";
        $stmt = $pdo->query($sql);
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($columns as $column) 
            {
            $field = $column['Field'];
            $this->attributes[$field] = null;
        }
        if ($data) 
            {
            foreach ($data as $key => $value) 
                {
                if (array_key_exists($key, $this->attributes)) 
                    {
                    $this->attributes[$key] = $value;
                }
            }
        }
    }
    protected static function init(PDO $pdo, $table)
    {
        if (!static::$pdo) static::$pdo = $pdo;
        if (!static::$table && $table) static::$table = $table;
    }
    protected static function createInstance(PDO $pdo, $table)
    {
        return new static($pdo, $table);
    }
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->attributes)) 
            {
            $this->attributes[$name] = $value;
        }
    }
    public static function all(PDO $pdo, $table = null)
    {
        static::init($pdo, $table);
        $sql = "SELECT * FROM `" . static::$table . "`";
        $stmt = static::$pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $models = [];
        foreach ($rows as $row) 
            {
            $model = static::createInstance(static::$pdo, static::$table);
            foreach ($row as $key => $value) 
                {
                $model->attributes[$key] = $value;
            }
            $models[] = $model;
        }
        return $models;
    }
    public static function find(PDO $pdo, $id, $table = null)
    {
        static::init($pdo, $table);
        $sql = "SELECT * FROM `" . static::$table . "` WHERE id = :id LIMIT 1";
        $stmt = static::$pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        $model = static::createInstance(static::$pdo, static::$table);
        foreach ($row as $key => $value) 
            {
            $model->attributes[$key] = $value;
        }
        return $model;
    }
    public static function insert(PDO $pdo, $data, $table = null)
    {
        static::init($pdo, $table);
        $columns = implode(', ', array_map(fn($c) => "`$c`", array_keys($data)));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO `" . static::$table . "` ($columns) VALUES ($placeholders)";
        $stmt = static::$pdo->prepare($sql);
        foreach ($data as $key => $value) 
            {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }
    public function update($data)
    {
        $set = [];
        foreach ($data as $key => $value) 
            {
            $set[] = "`$key` = :$key";
        }
        $set = implode(', ', $set);
        $sql = "UPDATE `" . static::$table . "` SET $set WHERE id = :id";
        $stmt = static::$pdo->prepare($sql);
        $stmt->bindValue(':id', $this->attributes['id']);
        foreach ($data as $key => $value) 
            {
            $stmt->bindValue(":$key", $value);
        }
        $success = $stmt->execute();
        if ($success) 
            {
            foreach ($data as $key => $value) 
                {
                if (array_key_exists($key, $this->attributes)) 
                    {
                    $this->attributes[$key] = $value;
                }
            }
        }
        return $success;
    }
    public function delete()
    {
        $sql = "DELETE FROM `" . static::$table . "` WHERE id = :id";
        $stmt = static::$pdo->prepare($sql);
        $stmt->bindValue(':id', $this->attributes['id']);
        return $stmt->execute();
    }
 public function hasMany($className, $foreignKey)
{
    $sql = "SELECT * FROM " . $className::$table . " WHERE `$foreignKey` = :id";
    $stmt = static::$pdo->prepare($sql);
    $stmt->bindValue(':id', $this->attributes['id']);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $models = [];
    foreach ($rows as $row) {
        $model = new $className(static::$pdo, $className::$table);
        foreach ($row as $key => $value) {
            $model->$key = $value;
        }
        $models[] = $model;
    }

    return $models;
}

}
