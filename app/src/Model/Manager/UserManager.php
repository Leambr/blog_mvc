<?php

namespace App\Model\Manager;

use App\Model\Entity\User;

class UserManager extends Manager
{

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        $query = $this->pdo->query("SELECT * FROM User");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function getUserById($id): ?User
    {
        $query = $this->pdo->prepare(
            "SELECT *
            FROM `users`
            WHERE `id` = :id"
        );
        $query->bindValue(':id', $id);
        $query->execute();
        $user = $query->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function getUserByName($userName): ?User
    {
        $query =
            'SELECT *
        FROM `users`
        WHERE `username` = :userName';

        $db = $this->pdo->prepare($query);
        $db->bindValue(':userName', $userName);
        $db->execute();

        $user = $db->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function insert(User $user): User
    {

        $user->setPassword($user->getPassword(), true);
        $newUser =
            "INSERT INTO `users` (`username`, `password`)
            VALUES(:userName, :password)";

        $query = $this->pdo->prepare($newUser);
        $query->bindValue(':userName', $user->getUserName());
        $query->bindValue(':password', $user->getPassword());
        $query->execute();

        return $this->getUserById($this->pdo->lastInsertId());
    }

    public function update(User $user): bool
    {

        $user->setPassword($user->getPassword(), true);
        $updateUser =
            'UPDATE `users`
            SET `username` = :userName, , `password` = :password
            WHERE `id` = :id';

        $query = $this->pdo->prepare($updateUser);
        $query->bindValue(':userName', $user->getUserName());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':id', $user->getId());

        return $query->execute();
    }

    public function delete($id)
    {
        $deleteUser = "DELETE FROM `users` WHERE `id` = :id";
        $query = $this->pdo->prepare($deleteUser);
        $query->bindValue(':id', $id);

        return $query->execute();
    }
}
