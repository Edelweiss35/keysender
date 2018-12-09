<?php

namespace App\Models;

class Groups
{
    public $limit = 5;
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getDetails($id)
    {
        $stmt = 'SELECT * from groups WHERE id = ?';
        $stmt = $this->pdo->prepare($stmt);
        $stmt->execute([$id]);
        return $stmt->fetchObject();
    }

    public function add($name, $sku)
    {
        $stmt = $this->pdo->prepare('INSERT INTO groups(name, shop_sku) VALUES (?, ?)');
        $result = $stmt->execute([$name, $sku]);
        if ($result === false) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return $result;
    }

    public function page($page)
    {
        $limit = $this->limit;
        $offset = $limit * ($page - 1);
        $stmt = "SELECT * FROM groups ORDER BY created_at LIMIT $limit OFFSET $offset";
        return $this->pdo->query($stmt)->fetchAll(\PDO::FETCH_OBJ);
    }
}