<div class="block1">
    <?php if (isset($errorMessage)) : ?>
        <span><?= $errorMessage ?></span>
    <?php endif ?>
    <form class="form" action="/login" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username"><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password"><br>
        <button type="submit" name="valider">Valider</button>
    </form>
    <button type="button">
        <a href="/signUp">S'inscrire</a>
    </button>
</div>