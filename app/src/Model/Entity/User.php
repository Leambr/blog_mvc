<?php

namespace App\Model\Entity;

use App\Model\Entity\BaseEntity;

class User extends BaseEntity
{

    private ?string $profilePicture = null;
    private ?string $username = null;
    private ?string $password = null;
    private ?string $admin = null;


    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password, bool $hash = false)
    {
        if ($hash) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        $this->password = $password;
        return $this;
    }
    public function verifyPassword($plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin(string $admin)
    {
        $this->admin = $admin;
        return $this;
    }
}