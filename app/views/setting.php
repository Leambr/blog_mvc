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
    <?php
        $adminManagement = 'Devenir Admin';
        if ($currentUser->getAdmin() == true) {
            $adminManagement = 'Ne plus être admin';
        }
    ?>
    <form action="/setting/adminManagement" method="POST">
        <button type="submit"><?= $adminManagement ?></button>
    </form>
    <br>
</header>
<main>
    <?php if (isset($errorMessage)) :
        foreach ($errorMessage as $error): ?>
            <span><?= $error ?></span><br>
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
                                    <td class="admin"><?= htmlspecialchars($admin) ?></td>
                                    <td class="admin">
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