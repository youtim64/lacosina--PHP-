<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Contact.php';

class ContactController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact();
    }

    public function ajouter()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Contact' . DIRECTORY_SEPARATOR . 'ajout.php';
    }

    public function enregistrer()
    {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $description = $_POST['description'];

        if (!$this->contactModel->add($nom, $email, $description)) {
            echo "Erreur lors de l'enregistrement du contact.";
            return;
        }

        $destinataire = 'contact@monsite.fr';
        $sujet = 'Nouveau message de contact';
        $message = "Nom : $nom\nEmail : $email\n\nMessage :\n$description";
        $headers = "From: hatim.bougrini@etu.unilim.fr\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        mail($destinataire, $sujet, $message, $headers);

        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Contact' . DIRECTORY_SEPARATOR . 'enregistrer.php';
    }
}
