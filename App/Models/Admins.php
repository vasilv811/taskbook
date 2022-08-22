<?php


namespace App\Models;


use Core\Db;

class Admins
{

    public function getAdmins(string $login)
    {
        $db = Db::getDb();
//        $query = $db->prepare("SELECT * FROM admins WHERE login = :login AND password = :password");
        $query = $db->prepare("SELECT * FROM admins WHERE login = :login");
//        $query->execute(['login' => $login, 'password' => $password]);
        $query->execute(['login' => $login]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

}