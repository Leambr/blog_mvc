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
        $userManager = new UserManager(new PDOFactory());
        $currentUser = unserialize($_SESSION['user']);
        if ($currentUser->getAdmin() == false){
            $currentUser->setAdmin('1');
        } else {
            $currentUser->setAdmin('0');
        }
        $userManager->update($currentUser);
        $_SESSION['user'] = serialize($currentUser);
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
                $this->setting(['Tu as vraiment essayé de te supprimer ?']);
                exit();
            }
            $userManager = new UserManager(new PDOFactory());
            $userManager->delete($id);
            http_response_code(302);
        }
        header("Location: /setting");
        exit();
    }
}