<?php

namespace App\Controller;

use App\Model\Factory\PDOFactory;
use App\Model\Manager\PostManager;
use App\Route\Route;

class PostController extends Controller
{
    #[Route('/', 'homePage', ['GET'])]
    public function home()
    {
        $postManager = new PostManager(new PDOFactory());
        $posts = $postManager->getAllPost();

        $this->render('index.php', 'Timeline', 'index.css', [$posts]);
        exit();
    }

    #[Route('/post', 'newPost', ['POST'])]
    public function newPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
        $postManager = new PostManager(new PDOFactory());
    }
}
