<?php


namespace App\Models;


use Core\Db;

class Users
{
    /**
     * @param string $name
     * @return mixed
     */
    public function getUserByName(string $name): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM users WHERE name = :name");
        $query->execute(['name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $name
     */
    public function createUser(string $name)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT users (name) VALUES (:name)");
        $query->execute(['name' => $name]);
    }

    /**
     * @param mixed $user
     * @param int $id
     * @return mixed
     */
    public function updateUser(mixed $user, int $id): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE users SET name = :name WHERE name_id = $id");
        $query->execute(['name' => $user]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param mixed $name
     * @return array
     */
    public function getNameIdByName(mixed $name): array
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM users WHERE name = :name");
        $query->execute(['name' => $name]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}