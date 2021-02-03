<?php $title = "Connexion"; ?>

<section>
    <form method="POST">
        <div class="mb-3">
            <label for="pseudo" class="form-label fw-bold mb-0">Pseudo</label>
            <input class="form-control" type="text" name="pseudo" id="pseudo">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label fw-bold mb-0">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <div class="text-end mt-4">
            <button class="text-uppercase btn btn-primary" type="submit">Connexion</button>
        </div>
    </form>
</section>