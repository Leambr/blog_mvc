<?php

namespace App\Model\Manager;

use App\Model\Entity\Post;

class CommentReactionManager extends Manager
{
    public function insert(CommentReactionManager $CommentReaction)
    {
        $newCommentReaction = 
            'INSERT INTO `CommentReactionManager` (`content`, `user_id`, `comments_post_id`)
            VALUES(:content, :userId, :commentsPostId)';
        
        $query = $this->pdo->prepare($newCommentReaction);
        $query->bindValue(':content', $CommentReaction->getContent());
        $query->bindValue(':userId', $CommentReaction->getUserId());
        $query->bindValue(':commentsPostId', $CommentReaction->getCommentsPostId());
        $query->execute();
    }

    public function update(CommentReactionManager $CommentReaction): bool
    {
        $update = 
            'UPDATE `CommentReactionManager`
            SET `content`= :content
            WHERE `id` = :id';

        $query = $pdo->prepare($update);
        $query->bindValue(':content', $CommentReaction->getContent());
        $query->bindValue(':id', $CommentReaction->getId());

        return $query->execute();
    }

    public function delete($id)
    {
        $delete = "DELETE FROM `CommentReactionManager` WHERE `id` = :id";
        $query = $this->pdo->prepare($delete);
        $query->bindValue(':id', $id);

        return $query->execute();
    }    
}
