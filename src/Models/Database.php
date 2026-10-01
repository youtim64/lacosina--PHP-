<?php

class Database
{
    private $host = 'localhost';
    private $dbName = 'lacosina';
    private $username = 'root';
    private $password = '';
    private $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die('Erreur de connexion : ' . $exception->getMessage());
        }

        return $this->connection;
    }
}