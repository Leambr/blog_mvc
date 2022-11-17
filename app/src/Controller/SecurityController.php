<?php

namespace App\Controller;

use App\Model\Factory\PDOFactory;
use App\Model\Manager\UserManager;
use App\Route\Route;

class SecurityController extends Controller
{
    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        $formUsername = $_POST['username'] = "toto";
        $formPwd = $_POST['password'] = "toto";

        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUsername);

        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }

        if ($user->passwordMatch($formPwd)) {

            $this->render(
                "user/showUsers.php",
                [
                    "message" => "je suis un message"
                ],
                "titre de la page"
            );
        }

        header("Location: /?error=notfound");
        exit;
    }
}
