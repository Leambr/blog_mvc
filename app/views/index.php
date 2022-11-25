<header>
    <h2>
        <?php if (isset($name)) { ?>
            <img class="profilPic" src="img/<?= $user->getProfilePicture()?>" style="border: 1px solid black; border-radius: 50%; object-fit: cover; width: 40px; height: 40px;">
            <?= htmlspecialchars($name);
        } else {
            echo 'My Name is Nobody';
        } ?>
    </h2>
    <form action="/signOut" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
    <br>
    <form action="/setting" method="GET">
        <button type="submit">Setting</button>
    </form>
    <h3>Nouveau Post</h3>
    <?php if (isset($errorMessage)) :
        foreach ($errorMessage as $error): ?>
            <span class="error"><?= $error ?></span><br>
        <?php endforeach;
    endif ?>
    <form class="newPostForm" method="POST" action="/post" enctype="multipart/form-data" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 300px">
        <label for="title">Titre</label><br>
        <input id="title" type="text" name="title"><br>
        <label for="contentInput">Article</label><br>
        <textarea id="contentInput" name="content" type="text"></textarea><br>
        <div id="depose">Déposez vos images ou cliquez pour choisir</div>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg, image/png, image/gif, image/jpg">
        <div class="bloc" id="preview"></div>
        <button class="submit" type="submit">Envoyer</button>
    </form>
</header>
<main>
    <h3> Actu </h3>
    <?php if (isset($posts)) :
        foreach ($posts as $post) : ?>
            <div class="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
                <img class="profilPic" src="img/<?= $post->getProfilePicture()?>" style="border: 1px solid black; border-radius: 50%; object-fit: cover; width: 40px; height: 40px;">
                <span class="author"><?= htmlspecialchars($post->getAuthor()) ?></span><br>
                <span class="title"><?= htmlspecialchars($post->getTitle()) ?></span><br>
                <span class="content"><?= htmlspecialchars($post->getContent()) ?></span><br>
                <?php if ($post->getFile() !== null):?>
                    <img class="file" src="img/<?= $post->getFile()?>" alt="" style="max-width: 300px; max-height: 200px; padding: 10px;">
                    <br>
                <?php endif ?>
                <span class="date"><?= $post->getCreatedAt() ?></span>
                <?php if ($post->getUserId() === $user->getId() || $user->getAdmin() == true) : ?>
                    <form class="deleteArticle" action="/post/delete" method="POST" style="margin-top: 10px">
                        <input type="hidden" name="postId" value="<?= $post->getId() ?>">
                        <button type="submit">Supprimer</button>
                    </form>

                    <button class="modify" style="margin-top: 10px">Modifier</button>
                    <form class="modifyForm" action="/post/patch" method="POST">
                        <input class="title" type="text" name="title" value="<?= htmlspecialchars($post->getTitle()) ?>" /><br>
                        <textarea name="content" value="<?= $post->getContent() ?>"><?= htmlspecialchars($post->getContent()) ?></textarea>
                        <input type="hidden" name="id" value="<?= $post->getId() ?>">
                        <button type="submit">Valider</button>
                    </form>
                <?php endif; ?>

                <button class="seeComments">Commentaires</button>
                <form class="commentForm" action="/newComment" method="POST">
                    <textarea name="content"></textarea>
                    <input type="hidden" name="id" value="<?= $post->getId() ?>">
                    <button type="submit">Valider</button>
                </form>
                <section class="section">

                </section>
            </div>
        <?php endforeach;
    else :
        echo 'Aucun articles';
    endif; ?>
</main>
<footer>
    <script src="script/index.js?<?php echo time(); ?>"></script>
</footer>