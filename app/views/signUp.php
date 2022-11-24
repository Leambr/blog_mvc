<div class="block1">
    <?php if (isset($errorMessage)) : ?>
        <span class="error"><?= $errorMessage ?></span>
    <?php endif ?>
    <form class="form" action="/signUp" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input id="username" type="text" name="username"><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password"><br>
        <button type="submit">S'inscire</button>
    </form>
    <button type="button">
        <a href="/login">Déjà un compte ? Se connecter</a>
    </button>
</div>