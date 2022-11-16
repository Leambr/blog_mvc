<?php

namespace App\Model\Manager;

use App\Model\Entity\Post;

class PostManager extends Manager
{
    public function getAllPost(): array
    {
        $selectArticles =
            'SELECT * FROM `articles` AS a ORDER BY `created_at` DESC
            LEFT JOIN `comments_post` AS cp ON a.post_id = cp.post_id
            LEFT JOIN `comments_reaction` AS cr ON cp.comments_post_id = cr.comments_post_id
            ';
        $query = $this->pdo->query($selectArticles);
        $articles = [];
        while ($result = $query->fetchAll(\PDO::FETCH_ASSOC)) {
            $articles[] = new Post($result);
        }
        return $articles;
    }

    public function insert(Post $post)
    {
        $newArticle = 
            'INSERT INTO `articles` (`title`, `content`, `user_id`)
            VALUES(:title, :content, :userId)';
        
        $query = $this->pdo->prepare($newArticle);
        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':userId', $post->getUserId());
        $query->execute();
    }

    public function update(Post $post): bool
    {
        $updateArticle = 
            'UPDATE `articles`
            SET `title` = :title, `content`= :content
            WHERE `id` = :article_id';

        $query = $pdo->prepare($updateArticle);
        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':article_id', $post->$getId());

        return $query->execute();
    }

    public function delete($id)
    {
        $deleteArticle = "DELETE FROM `articles` WHERE `id` = :id";
        $query = $this->pdo->prepare($deleteArticle);
        $query->bindValue(':id', $id);

        return $query->execute();
    }    
}
