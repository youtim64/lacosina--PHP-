<h1><?php echo $recipe['titre']; ?></h1>
<div class="d-flex">
    <img class="rounded w-25 img-fluid"
         src="<?php echo !empty($recipe['image']) ? $recipe['image'] : 'upload\no_image.png'; ?>"
         alt="<?php echo $recipe['titre']; ?>">
    <div class="ms-3">
        <p>Description : <?php echo $recipe['description']; ?></p>
        <p>Auteur : <a href="mailto:<?php echo $recipe['auteur']; ?>"><?php echo $recipe['auteur']; ?></a></p>
    </div>
</div>
<br>
<?php if (isset($_SESSION['user'])) : ?>
    <a class="btn btn-primary" href="?c=Recette&a=modifier&id=<?php echo $recipe['id']; ?>">Modifier la recette</a>
<?php endif; ?>
<a class="btn btn-primary" href="?c=Recette">Retour à la liste des recettes</a>
