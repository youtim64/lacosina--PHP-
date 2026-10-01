<h1>Formulaire de contact</h1>
<p>Merci de remplir ce formulaire pour nous contacter.</p>
<form action="?c=Contact&a=enregistrer" method="post">
    <div class="mb-3">
        <label for="nom" class="form-label">Formulaire de contact</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Votre Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary" id="Enregistrer">Enregistrer</button>
    </div>
</form>