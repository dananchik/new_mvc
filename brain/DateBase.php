<?php


namespace brain;


use PDO;
use PDOException;

class DateBase
{
    protected $pdo;

    public function __construct()
    {
        $db = require_once 'config/db.php';
        $this->pdo = $this->connect($db, 'mysql');

    }

    protected function connect($db, $dr)
    {
        $driver = 'mysql';
        $dsn = $driver . ':dbname=' . $db['db'] . ';host=' . $db['host'] . ';';
        $user = $db['user'];
        $password = $db['pasw'];
        try {
            return new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            return new PDOException('ошибка бд');
        }
    }

    public function query($sql, $params = null)
    {
        $stmt = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        if ($stmt->execute()) {
            return true;
        }
        return false;


    }
    public function querySelect($sql, $params = null)
    {
        $stmt = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
        return false;


    }

}