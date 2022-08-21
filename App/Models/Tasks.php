<?php


namespace App\Models;


use Core\Db;

class Tasks
{

    /**
     * @param $message
     * @param $status
     */
    public function createTask($message, $status)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT tasks (text, status) VALUES (:text, :status)");
        $query->execute(['text' => $message, 'status' => $status]);
    }

    /**
     * @param int $user_id
     */
    public function updateTasksByUserId(int $user_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET users_id = :user_id ORDER BY task_id DESC LIMIT 1");
        $query->execute(['user_id' => $user_id]);
    }


    /**
     * @param int $email_id
     */
    public function updateTasksByEmailId(int $email_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET email_id = :email_id ORDER BY task_id DESC LIMIT 1");
        $query->execute(['email_id' => $email_id]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTasksByTasksId(int $id): mixed
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
    public function updateText(mixed $text, string $status, int $id): mixed
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET text = :text, status = :status WHERE task_id = $id");
        $query->execute(['text' => $text, 'status' => $status]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $currentTask
     * @param string|null $filter
     * @param string|null $email
     * @param string|null $name
     * @param int $tasksPerPage
     * @return array
     */
    public function getPagePaginating(
        int $currentTask,
        string|null $filter,
        string|null $email,
        string|null $name,
        int $tasksPerPage = 3
    ): array {
        $join = 'LEFT JOIN users ON tasks.users_id = users.name_id LEFT JOIN emails ON tasks.email_id = emails.email_id';

        $queryCount = 'SELECT COUNT(*) FROM tasks ' . $join;

        $currentFilterExecute = [];
        if ($filter === 'completedTask') {
            $queryCount .= " WHERE status = :status";
            $currentFilterExecute['status'] = 'finished';
        }
        if ($filter === 'nonCompletedTask') {
            $queryCount .= " WHERE status = :status";
            $currentFilterExecute['status'] = 'nonFinished';
        }
        if ($email !== null) {
            $queryCount .= " WHERE address = :address";
            $currentFilterExecute['address'] = $email;
        }
        if ($name !== null) {
            $queryCount .= " WHERE name = :name";
            $currentFilterExecute['name'] = $name;
        }
        $db = Db::getDb();
        $queryCountTask = $db->prepare("$queryCount");
        $queryCountTask->execute($currentFilterExecute);
        $queryCountTask = $queryCountTask->fetchAll(\PDO::FETCH_NUM);
        $queryCountTask = $queryCountTask[0];

        $queryTask = $db->prepare(
            str_replace('COUNT(*)', '*', $queryCount) . ' LIMIT ' . $currentTask . ',' . $tasksPerPage
        );
        $queryTask->execute($currentFilterExecute);
        $queryTask = $queryTask->fetchAll(\PDO::FETCH_ASSOC);
        $queryTask['count'] = $queryCountTask[0];

        return $queryTask;
    }

}