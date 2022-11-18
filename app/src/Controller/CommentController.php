<?php

namespace App\Controller;

use App\Route\Route;
use App\Model\Factory\PDOFactory;
use App\Model\Manager\CommentsPostManager;
use App\Model\Entity\CommentsPost;


class CommentController extends Controller
{
    #[Route('/comment/{id}', 'comment', ['GET'])]
    public function getComment(int $id)
    {
        $commentsPostManager = new CommentsPostManager(new PDOFactory());
        $commentsPost = $commentsPostManager->getByPostId($id);

        echo json_encode($commentsPost);
        exit();
    }

    #[Route('/newComment', 'newComment', ['POST'])]
    public function newComment()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = unserialize($_SESSION['user'] ?? "");
            if (!$user) {
                http_response_code(404);
                throw new \Exception('pas de user');
            }


            $author = $user->getUsername();
            $userId = $user->getId();
            $postId = $_POST['id'];
            $content = $_POST['content'];
            $args = ['post_id' => $postId, 'content' => $content, 'author' => $author, 'user_id' => $userId];
            $commentsPost = new CommentsPost($args);
            $commentsPostManager = new CommentsPostManager(new PDOFactory());
            $commentsPostManager->insert($commentsPost);
            http_response_code(302);
        }
        exit();
    }
}
