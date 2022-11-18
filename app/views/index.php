<header>
    <h2>
        <?php if (isset($name)) {
            echo $name;
        } else {
            echo 'My Name is Nobody';
        } ?>
    </h2>
    <form action="/signOut" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
    <h3>Nouveau Post</h3>
    <form class="newPostForm" method="POST" action="/post" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 300px">
        <label for="title">Titre</label><br>
        <input id="title" type="text" name="title"><br>
        <label for="contentInput">Article</label><br>
        <textarea id="contentInput" name="content" type="text"></textarea><br>
        <button class="submit" type="submit">Envoyer</button>
    </form>
</header>
<main>
    <h3> Actu </h3>
    <?php if (isset($posts)) :
        foreach ($posts as $post) : ?>
            <div class="article" style="margin-top:20px; border: solid 1px black; padding: 10px; width: 500px">
                <span class="author"><?= $post->getAuthor() ?></span><br>
                <span class="title"><?= $post->getTitle() ?></span><br>
                <span class="content"><?= $post->getContent() ?></span><br>
                <?php if ($post->getUserId() === $user->getId() || $user->getAdmin() == true) : ?>
                    <form class="deleteArticle" action="/post/delete" method="POST" style="margin-top: 10px">
                        <input type="hidden" name="postId" value="<?= $post->getId() ?>">
                        <button type="submit">Supprimer</button>
                    </form>

                    <button class="modify" style="margin-top: 10px">Modifier</button>
                    <form class="modifyForm" action="/post/patch" method="POST">
                        <input class="title" type="text" name="title" value="<?= $post->getTitle() ?>" /><br>
                        <textarea name="content" value="<?= $post->getContent() ?>"><?= $post->getContent() ?></textarea>
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