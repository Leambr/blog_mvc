<header>
    <h2>
        <?php if (isset($name)) {
            echo htmlspecialchars($name);
        } else {
            echo 'My Name is Nobody';
        } ?>
    </h2>
    <form action="/signOut" method="POST">
        <button type="submit">Déconnexion</button>
    </form>
    <br>
    <form action="/" method="GET">
        <button type="submit">Timeline</button>
    </form>
    <br>
</header>
<main>
    <h3>changer les informations d'utilisateur</h3>
    <?php if (isset($errorMessage['update'])) :
        foreach ($errorMessage as $error): ?>
            <span class="error"><?= $error ?></span><br><br>
        <?php endforeach;
    endif; ?>
    <form id="updateUser" action="/setting/updateUser" method="POST">
        <label for="name">Nom d'utilisateur</label><br>
        <input id="name" type="text" name="userName"><br>
        <label for="old">Ancien mot de passe</label><br>
        <input id="old" type="password" name="oldPassword"><br>
        <label for="new">Nouveau mot de passe</label><br>
        <input id="new" type="password" name="newPassword"><br>
        <input type="hidden" name="id" value="<?= $currentUser->getId() ?>">
        <button type="submit">Valider</button>
    </form>
    <br>

    <h3>Gestionnaire des status</h3>
    <?php
        $adminManagement = 'Devenir Admin';
        if ($currentUser->getAdmin() == true) {
            $adminManagement = 'Ne plus être admin';
        }
    ?>
    <form action="/setting/adminManagement" method="POST">
        <input type="hidden" name="id" value="<?= $currentUser->getId() ?>">
        <button type="submit"><?= $adminManagement ?></button>
    </form>
    <br>
    <?php if (isset($errorMessage['delete'])) :
        foreach ($errorMessage as $error): ?>
            <span class="error"><?= $error ?></span><br><br>
        <?php endforeach;
    endif;
    if ($currentUser->getAdmin() == true): ?>
        <table class="user">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Admin</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <?php if (isset($users)):
                foreach ($users as $user):
                    $admin = 'Non admin';
                    if ($user->getAdmin() == true) {
                        $admin = 'Admin';
                    } ?>
                            <tbody>
                                    <td class="picture">$user->getProfilePicture()</td>
                                    <td class="name"><?= htmlspecialchars($user->getUserName()) ?></td>
                                    <td class="admin">
                                        <form action="/setting/adminManagement" method="POST">
                                            <label for=""><?= htmlspecialchars($admin) ?></label>
                                            <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                            <button type="submit">Changer de status</button>
                                        </form>
                                    </td>
                                    <td class="delete">
                                        <form class="deleteUser" action="/setting/deleteUser" method="POST">
                                            <input type="hidden" name="userId" value="<?= $user->getId() ?>">
                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </td>
                            </tbody>
                <?php endforeach;
            else :
                echo 'Aucun Utilisateur';
            endif; ?>
        </table>
    <?php endif; ?>
</main>