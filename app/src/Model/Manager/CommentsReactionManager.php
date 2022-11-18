<?php

namespace App\Model\Manager;

use App\Model\Entity\CommentsReaction;

class CommentsReactionManager extends Manager
{

    public function getByPostId($commentsPostId)
    {
        $query = 'SELECT * FROM `comments_reaction` WHERE `comments_post_id` = :commentsPostId';
        $query = $this->pdo->prepare($query);
        $query->bindValue(':commentsPostId', $commentsPostId);
        $query->execute();
        $commentsReaction = [];
        while ($result = $query->fetch(\PDO::FETCH_ASSOC)) {
            $commentsReaction[] = new CommentsReaction($result);
        }
        return $commentsReaction;
    }

    public function insert(CommentsReaction $CommentsReaction)
    {
        $newCommentsReaction =
            'INSERT INTO `comments_reaction` (`content`, `author`, `user_id`, `comments_post_id`)
            VALUES(:content, :author, :userId, :commentsPostId)';

        $query = $this->pdo->prepare($newCommentsReaction);
        $query->bindValue(':content', $CommentsReaction->getContent());
        $query->bindValue(':author', $CommentsReaction->getAuthor());
        $query->bindValue(':userId', $CommentsReaction->getUserId());
        $query->bindValue(':commentsPostId', $CommentsReaction->getCommentsPostId());
        $query->execute();
    }

    public function update(CommentsReaction $CommentsReaction): bool
    {
        $update =
            'UPDATE `comments_reaction`
            SET `content`= :content
            WHERE `id` = :id';

        $query = $this->pdo->prepare($update);
        $query->bindValue(':content', $CommentsReaction->getContent());
        $query->bindValue(':id', $CommentsReaction->getId());

        return $query->execute();
    }

    public function delete($id)
    {
        $delete = "DELETE FROM `comments_reaction` WHERE `id` = :id";
        $query = $this->pdo->prepare($delete);
        $query->bindValue(':id', $id);

        return $query->execute();
    }
}
