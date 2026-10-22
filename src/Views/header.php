<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cosina</title>
    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./src/Views/js/recipes.js" defer></script>
    <script src="./src/Views/js/users.js" defer></script>
</head>
<body>
    <!-- menu de navigation -->
    <?php $userConnecte = $_SESSION['user'] ?? null; ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href='?c=home'>Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='?c=Recette&a=lister'>Recettes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='?c=Contact&a=ajouter'>Contact</a>
            </li>
            <?php if ($userConnecte) : ?>
                <li class="nav-item dropdown border-start ms-2 ps-2">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bienvenue <?php echo htmlspecialchars($userConnecte['identifiant']); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?c=User&a=profil">Mon profil</a></li>
                        <li><a class="dropdown-item" href="?c=Recette&a=ajouter">Ajouter une recette</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav">
            <?php if ($userConnecte) : ?>
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href='?c=User&a=deconnexion'>Déconnexion</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="btn btn-outline-dark" href='?c=User&a=inscription'>Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-dark" href='?c=User&a=connexion'>Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- corps de la page -->
    <div class="container w-75 m-auto">