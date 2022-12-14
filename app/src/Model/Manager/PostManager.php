<?php

namespace App\Model\Manager;

use App\Model\Entity\Post;

class PostManager extends Manager
{
    public function getAllPost(): array
    {
        $selectArticles = 'SELECT * FROM `posts` AS a ORDER BY `created_at` DESC';
        $query = $this->pdo->query($selectArticles);
        $articles = [];
        while ($result = $query->fetch(\PDO::FETCH_ASSOC)) {
            $articles[] = new Post($result);
        }
        return $articles;
    }

    public function insert(Post $post)
    {
        $newArticle =
            'INSERT INTO `posts` (`title`, `content`, `file`, `author`, `profile_picture`, `user_id`)
            VALUES(:title, :content, :file, :author, :picture, :userId)';

        $query = $this->pdo->prepare($newArticle);
        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':file', $post->getFile());
        $query->bindValue(':author', $post->getAuthor());
        $query->bindValue(':picture', $post->getProfilePicture());
        $query->bindValue(':userId', $post->getUserId());
        $query->execute();
    }

    public function update(Post $post): bool
    {
        $updatePost =
            'UPDATE `posts`
            SET `title` = :title, `content`= :content
            WHERE `id` = :post_id';

        $query = $this->pdo->prepare($updatePost);
        $query->bindValue(':title', $post->getTitle());
        $query->bindValue(':content', $post->getContent());
        $query->bindValue(':post_id', $post->getId());

        return $query->execute();
    }

    public function updateProfilePicture($id, $picture): bool
    {
        $updatePost =
            'UPDATE `posts`
            SET `profile_picture` = :picture
            WHERE `user_id` = :userId';

        $query = $this->pdo->prepare($updatePost);
        $query->bindValue(':picture', $picture);
        $query->bindValue(':userId', $id);

        return $query->execute();
    }

    public function delete($id)
    {
        $deletePost = "DELETE FROM `posts` WHERE `id` = :id";
        $query = $this->pdo->prepare($deletePost);
        $query->bindValue(':id', $id);

        return $query->execute();
    }
}
