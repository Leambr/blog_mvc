<?php

namespace App\Model\Entity;

use App\Model\Entity\BaseEntity;

class CommentPost extends BaseEntity
{
    private string $content;
    private string $author;
    private datetime $createdAt;
    private int $reactionsCount;
    private int $userId;
    private int $commentPostId;

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
        return $this->creadtedAt->format('Y-m-d H:i:s');
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

    public function getCommentPostId()
    {
        return $this->commentPostId;
    }

    public function setCommentPostId($commentPostId)
    {
        $this->commentPostId = $commentPostId;
        return $this;
    }
}