<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Recette.php';

class RecetteController
{
    private $recetteModel;

    public function __construct()
    {
        $this->recetteModel = new Recette();
    }

    private function exigerConnexion()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?c=User&a=connexion');
            exit;
        }
    }
    
    public function ajouter()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Recette' . DIRECTORY_SEPARATOR . 'ajout.php';
    }

    public function enregistrer()
    {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $auteur = $_POST['auteur'];

        // Gestion de l'image
        if (!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
            // Aucune image choisie : en modification on garde l'ancienne, en création on met null
            if (isset($_GET['id'])) {
                $recipe = $this->recetteModel->find($_GET['id']);
                $imagePath = $recipe['image'];
            } else {
                $imagePath = null;
            }
        } elseif ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName);
            $imagePath = 'upload/' . $fileName; // Chemin relatif pour la base de données
        } else {
            echo "Erreur lors de l'envoi de l'image.";
            return;
        }

        // Création ou modification (un seul appel exécuté)
        if (isset($_GET['id'])) {
            $ajoutOk = $this->recetteModel->update($_GET['id'], $titre, $description, $auteur, $imagePath);
        } else {
            $ajoutOk = $this->recetteModel->add($titre, $description, $auteur, $imagePath);
        }

        if ($ajoutOk) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Recette' . DIRECTORY_SEPARATOR . 'enregistrer.php';
            return;
        }

        echo "Erreur lors de l'enregistrement de la recette.";
    }

    public function lister()
    {
        $recipes = $this->recetteModel->findAll();

        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Recette' . DIRECTORY_SEPARATOR . 'liste.php';
    }

    public function detail($id)
    {
        $recipe = $this->recetteModel->find($id);

        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Recette' . DIRECTORY_SEPARATOR . 'detail.php';
    }

    public function modifier($id)
    {
        $recipe = $this->recetteModel->find($id);

        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Recette' . DIRECTORY_SEPARATOR . 'modif.php';
    }
}