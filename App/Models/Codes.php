<?php

namespace App\Models;

class Codes
{
    /** @var \PDO */
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add($codes, $groupId, $usage)
    {
        $stmt = $this->pdo->prepare('INSERT INTO codes(group_id, code) VALUES (?, ?)');
        $result = $stmt->execute([$groupId, $code]);
        if ($result === false) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return $result;
    }
}