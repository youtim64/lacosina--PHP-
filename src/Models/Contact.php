<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Database.php';

class Contact
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function findAll()
    {
        $query = "SELECT * FROM contact";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = "SELECT * FROM contact WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function add($nom, $email, $description)
    {
        $query = "INSERT INTO contact (nom, email, description) VALUES (:nom, :email, :description)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':description', $description);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function delete($id)
    {
        $query = "DELETE FROM contact WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
}