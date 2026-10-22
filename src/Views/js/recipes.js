// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    // Sélectionne toutes les recettes avec la classe 'recipe'
    let recipes = document.querySelectorAll('.recipe');

    // Ajoute un écouteur d'événements sur chaque recette
    recipes.forEach(recipe => {

        // Transforme le curseur en pointer
        recipe.style.cursor = 'pointer';

        recipe.addEventListener('mouseover', () => {
            recipe.style.backgroundColor = 'lightgray'; // Fond gris lorsque la souris passe dessus
        });

        recipe.addEventListener('mouseout', () => {
            recipe.style.backgroundColor = ''; // Retire le fond gris lorsque la souris sort
        });

        recipe.addEventListener('click', (event) => {
            event.preventDefault(); // Empêche le comportement par défaut
            let recipeId = recipe.dataset.id; // Récupère l'ID de la recette
            window.open(`?c=Recette&a=detail&id=${recipeId}`, '_self'); // Ouvre le détail dans l'onglet courant
        });

    });
});