// Écoute le chargement du DOM
document.addEventListener('DOMContentLoaded', () => {

    // Sélection du profil identifiant (contenu modifiable)
    let profil_identifiant = document.getElementById('profil_identifiant');
    // Sélection du profil mail (contenu modifiable)
    let profil_mail = document.getElementById('profil_mail');
    // Sélection du bouton de modification
    let modifier_profil = document.getElementById('bouton_modifier_profil');

    // Ce fichier est chargé sur toutes les pages : on s'arrête si on n'est pas sur le profil
    if (!profil_identifiant || !profil_mail || !modifier_profil) {
        return;
    }

    // Affiche le bouton de modification lorsque l'identifiant est modifié
    profil_identifiant.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none');
    });

    // Affiche le bouton de modification lorsque le mail est modifié
    profil_mail.addEventListener('input', (event) => {
        modifier_profil.classList.remove('d-none');
    });

});