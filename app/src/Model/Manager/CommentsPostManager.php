<?php

namespace App\Model\Manager;

use App\Model\Entity\Post;

class CommentsPostManager extends Manager
{
    public function insert(CommentsPostManager $commentsPost)
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

    public function update(CommentsPostManager $commentsPost): bool
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
