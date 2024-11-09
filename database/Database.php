<?php
require __DIR__ . '/config.php';

class Database
{
    private $host = DB_HOST;
    private $dbName = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $options = OPTIONS;
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName", 
                $this->user, 
                $this->pass, 
                $this->options
            );
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage() . $e->getCode();
        }
    }

    public function get_connection()
    {
        return $this->pdo;
    }

    public function query_select_all($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_select($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function queryExecute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}