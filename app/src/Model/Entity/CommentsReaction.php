<?php

namespace App\Model\Entity;

use App\Model\Entity\BaseEntity;
use DateTime;

class CommentsReaction extends BaseEntity
{
    private string $content;
    private string $author;
    private DateTime $createdAt;
    private int $userId;
    private int $commentsPostId;

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

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCommentsPostId()
    {
        return $this->commentsPostId;
    }

    public function setCommentsPostId($commentsPostId)
    {
        $this->commentsPostId = $commentsPostId;
        return $this;
    }
}
