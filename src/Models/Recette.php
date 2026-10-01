<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Database.php';

class Recette
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function findAll()
    {
        $query = "SELECT * FROM recettes";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = "SELECT * FROM recettes WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function findBy(array $params)
    {
        $allowedColumns = ['id', 'titre', 'description', 'auteur'];
        $conditions = [];

        foreach (array_keys($params) as $key) {
            if (!in_array($key, $allowedColumns, true)) {
                throw new InvalidArgumentException("Critère de recherche invalide : $key");
            }

            $conditions[] = "$key = :$key";
        }

        $query = "SELECT * FROM recettes";
        if ($conditions) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $statement = $this->connection->prepare($query);
        foreach ($params as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($titre, $description, $auteur)
    {
        $query = "INSERT INTO recettes (titre, description, auteur) VALUES (:titre, :description, :auteur)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':auteur', $auteur);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    public function update($id, $titre, $description, $auteur)
    {
        $query = "UPDATE recettes SET titre = :titre, description = :description, auteur = :auteur WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':auteur', $auteur);

        return $statement->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM recettes WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
}