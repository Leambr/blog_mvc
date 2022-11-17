<?php

namespace App\Model\Manager;

use App\Model\Entity\CommentPost;

class CommentsPostManager extends Manager
{

    public function getByPostId($postId)
    {
        $query = 'SELECT * FROM `comments_post` WHERE `post_id` = :postId';
        $query = $this->pdo->prepare($query);
        $query->bindValue(':postId', $postId);
        $query->execute();
        $commentsPost = [];
        while ($result = $query->fetch(\PDO::FETCH_ASSOC)) {
            $commentsPost[] = new CommentsPost($result);
        }
        return $commentsPost;
    }

    public function insert(CommentsPost $commentsPost)
    {
        $newCommentsPost = 
            'INSERT INTO `comments_post` (`content`, `user_id`, `post_id`)
            VALUES(:content, :userId, :postId)';
        
        $query = $this->pdo->prepare($newCommentsPost);
        $query->bindValue(':content', $commentsPost->getContent());
        $query->bindValue(':userId', $commentsPost->getUserId());
        $query->bindValue('PostId', $commentsPost->getPostId());
        $query->execute();
    }

    public function update(CommentsPost $commentsPost): bool
    {
        $update = 
            'UPDATE `comments_post`
            SET `content`= :content
            WHERE `id` = :id';

        $query = $pdo->prepare($update);
        $query->bindValue(':content', $commentsPost->getContent());
        $query->bindValue(':id', $commentsPost->getId());

        return $query->execute();
    }

    public function delete($id)
    {
        $delete = "DELETE FROM `comments_post` WHERE `id` = :id";
        $query = $this->pdo->prepare($delete);
        $query->bindValue(':id', $id);

        return $query->execute();
    }    
}