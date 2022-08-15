<?php


namespace App\Models;


use Core\Db;

class Tasks
{


    /**
     * @param $message
     * @param $status
     */
    public function createMessage($message, $status)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT tasks (text, status) VALUES (:text, :status)");
        $query->execute(['text' => $message, 'status' => $status]);
    }

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

    /**
     * @param int $user_id
     */
    public function createUserIdByTasks(int $user_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET users_id = :user_id ORDER BY task_id DESC LIMIT 1");
        $query->execute(['user_id' => $user_id]);
    }

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

//    /**
//     * @param string $name
//     * @return mixed
//     */
//    public function getUserIdByUsers(string $name): mixed
//    {
//        $db = Db::getDb();
//        $query = $db->prepare("SELECT * FROM users WHERE name = :name");
//        $query->execute(['name' => $name]);
//        return $query->fetch(\PDO::FETCH_ASSOC);
//    }

    /**
     * @param int $user_id
     * @return array
     */
    public function getTasksByUserId(int $user_id): array
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM tasks WHERE users_id = :user_id");
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
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

    /**
     * @param int $email_id
     */
    public function createEmailTask(int $email_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET email_id = :email_id ORDER BY task_id DESC LIMIT 1");
        $query->execute(['email_id' => $email_id]);
    }

    /**
     * @return array
     */
    public function getUserIdByUsers(string $name): array
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

    /**
     * @return array
     */
    public function getAllUserByTask(): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @param int $nameId
     * @return array
     */
    public function getAllUserCountByTask(int $nameId): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE users_id = $nameId"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @return array
     */
    public function getAllStatusFinishedByTask(): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE status = 'finished'"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @return array
     */
    public function getAllStatusNonFinishedByTask(): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE status = 'nonFinished'"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @param int $emailId
     * @return array
     */
    public function getAllEmailCountByTask(int $emailId): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE email_id = $emailId"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @return array
     */
    public function getAllTaskCompleteCountByTask(): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE status = 'finished'"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @return array
     */
    public function getAllTaskNotCompleteCountByTask(): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE status = 'nonFinished'"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    /**
     * @param int $limit
     * @param int $count
     * @return array
     */
    public function getTask(int $limit, int $count): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * @param int $limit
     * @param int $count
     * @param int $emailId
     * @return array
     */
    public function getTaskEmail(int $limit, int $count, int $emailId): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
WHERE tasks.email_id = $emailId
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @param int $userId
     * @return array
     */
    public function getTaskUser(int $limit, int $count, int $userId): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
WHERE tasks.users_id = $userId
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @param int $nameId
     * @return array
     */
    public function getTaskUserPag(int $limit, int $count, int $nameId): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE tasks.users_id = $nameId
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @return array
     */
    public function getTaskStatusFinishedPag(int $limit, int $count): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE tasks.status = 'finished'
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @return array
     */
    public function getTaskStatusNonFinishedPag(int $limit, int $count): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE tasks.status = 'nonFinished'
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @param int $emailId
     * @return array
     */
    public function getTaskEmailPag(int $limit, int $count, int $emailId): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE tasks.email_id = $emailId
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @return array
     */
    public function getCompleteTaskPag(int $limit, int $count): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE tasks.status = 'finished'
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $limit
     * @param int $count
     * @return array
     */
    public function getNotCompleteTaskPag(int $limit, int $count): array
    {
        $db = Db::getDb();
        $query = $db->query(
            "SELECT 
        tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE tasks.status = 'nonFinished'
        LIMIT $limit, $count"
        );
        return $query->fetchAll(\PDO::FETCH_ASSOC);
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

    /**
     * @param mixed $email
     * @return array
     */
    public function getEmailIdByEmails(mixed $email): array
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM emails WHERE address = :email");
        $query->execute(['email' => $email]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMessageByTaskId(int $id): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare(
            "SELECT
         tasks.users_id,
        tasks.text,
        tasks.email_id,
        tasks.task_id,
        tasks.status,
        users.name_id,
        users.name,
        emails.email_id,
        emails.address
        FROM tasks
        LEFT JOIN users
        ON  tasks.users_id = users.name_id
        LEFT JOIN emails
        ON tasks.email_id = emails.email_id
        WHERE task_id = :id"
        );
        $query->execute(['id' => $id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param mixed $text
     * @param string $status
     * @param int $id
     * @return mixed
     */
    public function updateMessageText(mixed $text, string $status, int $id): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET text = :text, status = :status WHERE task_id = $id");
        $query->execute(['text' => $text, 'status' => $status]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param mixed $user
     * @param int $id
     * @return mixed
     */
    public function updateMessageUser(mixed $user, int $id): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE users SET name = :name WHERE name_id = $id");
        $query->execute(['name' => $user]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param mixed $email
     * @param int $id
     * @return mixed
     */
    public function updateMessageEmail(mixed $email, int $id): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE emails SET address = :address WHERE email_id = $id");
        $query->execute(['address' => $email]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * @param string $login
     * @param $password
     * @return bool
     */
    public function getAdmins(string $login, $password):bool
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM admins WHERE login = :login AND password = :password");
        $query->execute(['login'=>$login, 'password'=>$password]);
        return (bool)$query->fetchAll(\PDO::FETCH_ASSOC);
    }


}