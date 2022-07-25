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

    public function getNameByName(string $name)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM name WHERE name = :name");
        $query->execute(['name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function createName(string $name)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT name (name) VALUES (:name)");
        $query->execute(['name' => $name]);
    }

    public function getTaskId()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM task ORDER BY task_id DESC LIMIT 1");
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function createNameTask(int $name_id, int $task_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT nametask (name_id, task_id) VALUES (:name_id, :task_id)");
        $query->execute(['name_id' => $name_id, 'task_id' => $task_id]);
    }

    public function getEmailByEmail(string $email)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM email WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function createEmail(string $email)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT email (email) VALUES (:email)");
        $query->execute(['email' => $email]);
    }

    public function createEmailTask(int $email_id, int $task_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT emailtask (email_id, task_id) VALUES (:email_id, :task_id)");
        $query->execute(['email_id' => $email_id, 'task_id' => $task_id]);
    }

    public function getMessageByMessage()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM task");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNameByMessage()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM name");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getEmailByMessage()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM email");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getEmailTaskByMessage()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM emailtask");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNameTaskByMessage()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM nameltask");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllByMessage()
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        task.task_id,
        task.task,
        nametask.name_id,
        nametask.task_id,
        emailtask.email_id,
        emailtask.task_id,
        name.name_id,
        name.name,
        email.email_id,
        email.email
        FROM task
        LEFT JOIN nametask
        ON  task.task_id = nametask.task_id
        LEFT JOIN name
        ON nametask.name_id = name.name_id
        LEFT JOIN emailtask
        ON task.task_id = emailtask.task_id
        LEFT JOIN email
        ON emailtask.email_id = email.email_id"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllTasksByTask(){
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM task"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

//    public function getTask($limit, $count){
//        $db = Db::getDb();
//        $query = $db->query(
//            "SELECT * FROM task LIMIT $limit, $count"
//        );
//        return $query->fetchAll(\PDO::FETCH_ASSOC);
//    }

    public function getTask($limit, $count)
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        task.task_id,
        task.task,
        nametask.name_id,
        nametask.task_id,
        emailtask.email_id,
        emailtask.task_id,
        name.name_id,
        name.name,
        email.email_id,
        email.email
        FROM task
        LEFT JOIN nametask
        ON  task.task_id = nametask.task_id
        LEFT JOIN name
        ON nametask.name_id = name.name_id
        LEFT JOIN emailtask
        ON task.task_id = emailtask.task_id
        LEFT JOIN email
        ON emailtask.email_id = email.email_id 
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }


public function getAdminCheck()
{
    $db = Db::getDb();
    $query = $db->query("SELECT * FROM users");
    return $query->fetchAll(\PDO::FETCH_ASSOC);
}

    /**
     * Получаем все поля по task_id
     * @return mixed
     */
    public function getByMessageTaskId(int $id)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT     
        task.task_id,
        task.task,
        nametask.name_id,
        nametask.task_id,
        emailtask.email_id,
        emailtask.task_id,
        name.name_id,
        name.name,
        email.email_id,
        email.email
        FROM task
        LEFT JOIN nametask
        ON  task.task_id = nametask.task_id
        LEFT JOIN name
        ON nametask.name_id = name.name_id
        LEFT JOIN emailtask
        ON task.task_id = emailtask.task_id
        LEFT JOIN email
        ON emailtask.email_id = email.email_id 
        WHERE task.task_id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}

//       n.name_id,
//       n.name,
//       et.email_id,
//       et.task_id,
//       e.email_id,
//       e.email
//email.email_id,
//        email.email