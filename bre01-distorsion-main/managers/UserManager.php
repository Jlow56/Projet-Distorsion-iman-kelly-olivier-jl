<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class UserManager extends AbstractManager
{
    public function findOne(int $id) : User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $mediaManager = new MediaManager();

        if($result["image_id"] !== null)
        {
            $media = $mediaManager->findOne($result["image_id"]);
            $user = new User($result["username"], $result["password"], $result["role"], $media);
        }
        else
        {
            $user = new User($result["username"], $result["password"], $result["role"]);
        }

        $user->setId($result["id"]);

        return $user;
    }

    public function findByUsername(string $username) : ? User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE username=:username');
        $parameters = [
            "username" => $username
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $user = new User($result["username"], $result["password"], $result["role"]);
            $user->setId($result["id"]);

            return $user;
        }

        return null;
    }

    public function create(User $user) : void
    {
        $query = $this->db->prepare('INSERT INTO users (id, username, password, role) VALUES (NULL, :username, :password, :role)');
        $parameters = [
            "username" => $user->getUsername(),
            "password" => $user->getPassword(),
            "role" => $user->getRole()
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());
    }
}