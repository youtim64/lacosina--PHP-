<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Database.php';

class User
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function findAll()
    {
        $query = "SELECT * FROM users";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findByIdentifiant($identifiant)
    {
        $query = "SELECT * FROM users WHERE identifiant = :identifiant";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':identifiant', $identifiant);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // $password doit déjà être haché (password_hash)
    public function add($identifiant, $mail, $password)
    {
        $query = "INSERT INTO users (identifiant, mail, password) VALUES (:identifiant, :mail, :password)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':identifiant', $identifiant);
        $statement->bindParam(':mail', $mail);
        $statement->bindParam(':password', $password);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
}