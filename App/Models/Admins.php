<?php


namespace App\Models;


use Core\Db;

class Admins
{
    /**
     * @param string $login
     * @param $password
     * @return bool
     */
    public function getAdmins(string $login, $password): bool
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM admins WHERE login = :login AND password = :password");
        $query->execute(['login' => $login, 'password' => $password]);
        return (bool)$query->fetchAll(\PDO::FETCH_ASSOC);
    }

}