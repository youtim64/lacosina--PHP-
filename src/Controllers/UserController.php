<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'User.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Affiche le formulaire d'inscription
    public function inscription()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'inscription.php';
    }

    // Enregistre le nouvel utilisateur en base
    public function enregistrer()
    {
        $identifiant = trim($_POST['identifiant'] ?? '');
        $mail = trim($_POST['mail'] ?? '');
        $pwd = $_POST['pwd'] ?? '';

        if ($identifiant === '' || $mail === '' || $pwd === '') {
            $erreur = "Tous les champs sont obligatoires.";
            require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'inscription.php';
            return;
        }

        // Identifiant déjà utilisé ?
        if ($this->userModel->findByIdentifiant($identifiant)) {
            $erreur = "Cet identifiant est déjà utilisé.";
            require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'inscription.php';
            return;
        }

        // Encodage du mot de passe
        $hash = password_hash($pwd, PASSWORD_DEFAULT);

        if ($this->userModel->add($identifiant, $mail, $hash)) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'enregistrement.php';
            return;
        }

        echo "Erreur lors de l'enregistrement de l'utilisateur.";
    }

    // Affiche le formulaire de connexion
    public function connexion()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'connexion.php';
    }

    // Vérifie l'identifiant et le mot de passe
    public function verifieConnexion()
    {
        // 1. Récupération des données du formulaire
        $identifiant = trim($_POST['identifiant'] ?? '');
        $pwd = $_POST['pwd'] ?? '';

        // 2. Requête de vérification de l'identifiant
        $user = $this->userModel->findByIdentifiant($identifiant);

        // 3. Existence de l'utilisateur + vérification du mot de passe
        if ($user && password_verify($pwd, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id'          => $user['id'],
                'identifiant' => $user['identifiant'],
                'mail'        => $user['mail'],
                'isAdmin'     => $user['isAdmin'],
            ];

            header('Location: ?c=home');
            exit;
        }

        // Échec : on réaffiche le formulaire avec un message
        $erreur = "Identifiant ou mot de passe incorrect.";
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'connexion.php';
    }

    // Supprime la session puis redirige vers l'accueil
    public function deconnexion()
    {
        $_SESSION = [];
        session_destroy();

        header('Location: ?c=home');
        exit;
    }

    // Affiche le profil de l'utilisateur connecté
    public function profil()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?c=User&a=connexion');
            exit;
        }

        $user = $_SESSION['user'];
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'User' . DIRECTORY_SEPARATOR . 'profil.php';
    }
}