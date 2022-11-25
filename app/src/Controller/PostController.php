<?php

namespace App\Controller;

use App\Model\Factory\PDOFactory;
use App\Model\Manager\PostManager;
use App\Route\Route;
use App\Model\Entity\Post;

class PostController extends Controller
{
    #[Route('/', 'homePage', ['GET'])]
    public function home($error = [])
    {
        $postManager = new PostManager(new PDOFactory());
        $posts = $postManager->getAllPost();
        $user = unserialize($_SESSION['user']);
        $name = $user->getUsername();

        $this->render('index.php', 'Timeline', 'index.css', ['posts' => $posts, 'user' => $user, 'name' => $name, 'errorMessage' => $error]);
        exit();
    }

    #[Route('/post', 'newPost', ['POST'])]
    public function newPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = null;
            $user = unserialize($_SESSION['user']);
            $author = $user->getUsername();
            $userId = $user->getId();
            $profilePicture = $user->getProfilePicture();

            if ($_FILES['fileToUpload']['name']) {
                $fileName = $this->uuid() . '.' . strtolower(pathinfo($_FILES["fileToUpload"]['name'],PATHINFO_EXTENSION));
                $isSaved = $this->saveFile($fileName);
                if ($isSaved[0] === 'error'){
                    $this->home($isSaved);
                    exit();
                }

                $file = $fileName;
            }
            $args = [...$_POST, 'author' => $author, 'profile_picture' => $profilePicture, 'user_id' => $userId, 'file' => $file];
            $postManager = new PostManager(new PDOFactory());
            $post = new Post($args);
            $postManager->insert($post);
            http_response_code(302);
        }
        header("Location: /");
        exit();
    }

    #[Route('/post/delete', 'deletePost', ['POST'])]
    public function deletePost()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $postId = $_POST["postId"];
            if ($postId) {
                $postManager = new PostManager(new PDOFactory());
                $postManager->delete($postId);
                http_response_code(302);
            }
        }
        header("Location: /");
        exit();
    }

    #[Route('/post/patch', 'patchPost', ['POST'])]
    public function patchPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postManager = new PostManager(new PDOFactory());
            $post = new Post($_POST);
            $postManager->update($post);
            http_response_code(302);
        }
        header("Location: /");
        exit();
    }


}
