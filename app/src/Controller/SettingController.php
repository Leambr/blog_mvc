<?php

namespace App\Controller;

use App\Model\Factory\PDOFactory;
use App\Model\Manager\UserManager;
use App\Route\Route;
use App\Model\Entity\User;

class SettingController extends Controller
{
    #[Route('/setting', 'setting', ['GET'])]
    public function setting($error = [])
    {
        $userManager = new UserManager(new PDOFactory());
        $users = $userManager->getAllUsers();
        $currentUser = unserialize($_SESSION['user']);
        $name = $currentUser->getUsername();
        $this->render('setting.php', 'Setting', 'setting.css', ['users' => $users, 'currentUser' => $currentUser, 'name' => $name, 'errorMessage' => $error]);
        exit();
    }

    #[Route('/setting/adminManagement', 'admin', ['POST'])]
    public function adminManagement()
    {
        $id = $_POST["id"];
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getUserById($id);
        if ($user->getAdmin() == false){
            $user->setAdmin('1');
        } else {
            $user->setAdmin('0');
        }
        $userManager->update($user);

        $currentUser = unserialize($_SESSION['user']);
        if ($currentUser->getId() == $id) {
            $_SESSION['user'] = serialize($user);
        }

        http_response_code(302);
        header("Location: /setting");
        exit();
    }

    #[Route('/setting/deleteUser', 'deleteUser', ['POST'])]
    public function deleteUser()
    {
        $currentUser = unserialize($_SESSION['user']);
        $id = $_POST['userId'];
        if ($id) {
            if ($currentUser->getId() == $id) {
                $this->setting(['delete' => 'Tu as vraiment essayé de te supprimer ?']);
                exit();
            }
            $userManager = new UserManager(new PDOFactory());
            $userManager->delete($id);
            http_response_code(302);
        }
        header("Location: /setting");
        exit();
    }

    #[Route('/setting/updateUser', 'updateUser', ['POST'])]
    public function updateUser()
    {
        $id = $_POST["id"];
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getUserById($id);

        if ($_POST['userName'] != null) {
            $name = $_POST['userName'];
            $existName = $userManager->getUserByName($name);
            if ($existName) {
                $this->setting(['update' => 'le Nom est déjà pris']);
                exit();
            }
            $user->setUsername($name);
        }
        if ($_POST['oldPassword'] != null && $_POST['newPassword'] != null) {
            $oldPassword = $_POST['oldPassword'];
            $newPassword = $_POST['newPassword'];
            if (!$user->verifyPassword($oldPassword)) {
                $this->setting(['update' => 'Mot de passe incorrect']);
                exit();
            }
            $user->setPassword($newPassword, true);
        }
        $userManager->update($user);

        $_SESSION['user'] = serialize($user);

        http_response_code(302);
        header("Location: /setting");
        exit();
    }
}