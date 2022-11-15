<?php

namespace App\Model\Entity;

use App\Model\Entity\BaseEntity;

class CommentReaction extends BaseEntity
{
    private string $content;
    private datetime $createdAt;
    private int $userId;
    private int $commentId;

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
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