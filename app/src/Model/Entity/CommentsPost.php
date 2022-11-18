<?php

namespace App\Model\Entity;

use App\Model\Entity\BaseEntity;
use DateTime;

class CommentsPost extends BaseEntity
{
    private ?string $content = null;
    private ?string $author = null;
    private ?DateTime $createdAt = null;
    private ?int $reactionsCount = null;
    private ?int $userId = null;
    private ?int $postId = null;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    public function setcreatedAt($date)
    {
        $this->createdAt = new \DateTime($date);
        return $this;
    }

    public function getReactionsCount()
    {
        return $this->reactionsCount;
    }

    public function setReactionsCount($reactionsCount)
    {
        $this->reactionsCount = $reactionsCount;
        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
        return $this;
    }
}
