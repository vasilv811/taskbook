<?php


namespace App\Models;


use Core\Db;

class Users
{
    /**
     * @param string $name
     * @return mixed
     */
    public function getUserByUsers(string $name): mixed
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
}