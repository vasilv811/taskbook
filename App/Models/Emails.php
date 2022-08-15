<?php


namespace App\Models;


use Core\Db;

class Emails
{
    /**
     * @param string $email
     * @return mixed
     */
    public function getEmailByEmails(string $email): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM emails WHERE address = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $email
     */
    public function createEmail(string $email)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT emails (address) VALUES (:email)");
        $query->execute(['email' => $email]);
    }
}