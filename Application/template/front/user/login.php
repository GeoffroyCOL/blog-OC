<?php $title = "Connexion"; ?>

<h2>Connexion</h2>

<?php if (isset($messageError)) : ?>
    <p><?php escHtml($messageError); ?> </p>
<?php endif; ?>

<form method="POST">
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Connexion</button>
</form>