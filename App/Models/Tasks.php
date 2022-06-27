<?php


namespace App\Models;


use Core\Db;

class Tasks
{

    public function createMessage(string $message)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT task (task) VALUES (:task)");
        $query->execute(['task' => $message]);
    }


}