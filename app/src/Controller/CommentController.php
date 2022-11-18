<?php

namespace App\Controller;

use App\Route\Route;
use App\Model\Factory\PDOFactory;
use App\Model\Manager\CommentsPostManager;


class CommentController extends Controller
{
    #[Route('/comment/{id}', 'comment', ['GET'])]
    public function getComment(int $id)
    {
        $commentsPostManager = new CommentsPostManager(new PDOFactory());
        $commentsPost = $commentsPostManager->getByPostId($id);

        foreach ($commentsPost as $comment) {
        }
        echo json_encode(["id" => $commentsPost]);
        exit();
    }
}
