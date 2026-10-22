<h1>Recettes</h1>

<div class="row">
    <?php foreach (($recipes ?? []) as $recipe) : ?>
        <div class="col-4 p-2">
            <div class="recipe card" data-id="<?php echo $recipe['id']; ?>">
                <div class="card-body">
                    <img class="card-img-top"
                        src="<?php echo !empty($recipe['image']) ? $recipe['image'] : 'upload/no_image.png'; ?>"
                        alt="<?php echo $recipe['titre']; ?>">
                    <h2 class="card-title">
                        <?php echo $recipe['titre']; ?>
                    </h2>
                    <p class="card-text">
                        <?php echo $recipe['description']; ?>
                    </p>
                    Auteur :
                    <a href="mailto:<?php echo $recipe['auteur']; ?>">
                        <?php echo $recipe['auteur']; ?>
                    </a>
                    
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<a href="?c=home" class="btn btn-primary">Retour à l'accueil</a>