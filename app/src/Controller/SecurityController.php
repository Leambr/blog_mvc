<?php

namespace App\Controller;

use App\Model\Factory\PDOFactory;
use App\Model\Manager\UserManager;
use App\Model\Entity\User;
use App\Route\Route;

class SecurityController extends Controller
{
    #[Route('/login', name: "login", methods: ["GET", "POST"])]
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->render('login.php', 'login', 'login.css');
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $userManager = new UserManager(new PDOFactory());
                $user = $userManager->getUserByName($username);

                if ($user && $user->verifyPassword($password)) {
                    $_SESSION['user'] = $user;
                    http_response_code(302);
                    header("Location: /");
                    exit();
                }

                $this->render('login.php', 'Login', 'login.css', ['errorMessage' => "Nom d'utilisateur ou mot de passe incorect"]);
            }
        }
    }

    #[ROUTE('/signUp', name: "signup", methods: ["GET", "POST"])]
    public function signUp()
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->render('signUp.php', 'Sign Up', 'signUp.css');
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];

                $userManager = new UserManager(new PDOFactory());
                $user = $userManager->getUserByName($username);
                if (!isset($user)) {
                    $user = new User($_POST);
                    $user = $userManager->insert($user);
                    $_SESSION['user'] = $user;
                    http_response_code(302);
                    header("Location: /");
                    exit();
                }
                $this->render('signUp.php', 'Sign Up', 'signUp.css', ['errorMessage' => 'Cet utilisateur existe déjà']);
            }
        }
    }
}
