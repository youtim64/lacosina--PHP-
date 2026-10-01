<?php 
 
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'RecetteController.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'contactController.php';
 
// chargement du header 
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Views' . 
DIRECTORY_SEPARATOR . 'header.php'; 
 
    $route = isset($_GET['c']) ? $_GET['c'] : 'home';
    $action = isset($_GET['a']) ? $_GET['a'] : null;

    switch ($route) {
        case 'home':
            require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'homeController.php';
            break;

        case 'Recette':
            $recetteController = new RecetteController();
            $action = $action ?? 'lister';
            if (in_array($action, ['ajouter', 'enregistrer', 'lister'], true)) {
                $recetteController->$action();
            } else {
                echo "Action non trouvée";
            }
            break;

        case 'Contact':
            $contactController = new ContactController();
            $action = $action ?? 'ajouter';
            if (in_array($action, ['ajouter', 'enregistrer'], true)) {
                $contactController->$action();
            } else {
                echo "Action non trouvée";
            }
            break;

        case 'recettes':
            (new RecetteController())->ajouter();
            break;
        case 'liste':
            (new RecetteController())->lister();
            break;
        case 'enregistrer':
            (new RecetteController())->enregistrer();
            break;
        case 'contact':
            (new ContactController())->ajouter();
            break;
        case 'enregistrer_contact':
            (new ContactController())->enregistrer();
            break;
        default:
            echo "Page non trouvée";
    }
 
// chargement du footer
require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Views' .
DIRECTORY_SEPARATOR . 'footer.php';