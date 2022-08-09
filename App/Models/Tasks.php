<?php


namespace App\Models;


use Core\Db;

class Tasks
{

    public function createMessage(string $message, $status)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT tasks (text, status) VALUES (:text, :status)");
        $query->execute(['text' => $message, 'status' => $status]);
    }

    public function getUserByUsers(string $name)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM users WHERE name = :name");
        $query->execute(['name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function createUser(string $name)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT users (name) VALUES (:name)");
        $query->execute(['name' => $name]);
    }

//    public function getLastIdByTasks(){
//        $db = Db::getDb();
//        $query = $db->query("SELECT * FROM tasks ORDER BY task_id DESC LIMIT 1");
//        return $query->fetch(\PDO::FETCH_ASSOC);
//    }

    public function getTaskId()
    {
        $db = Db::getDb();
        $query = $db->query("SELECT * FROM tasks ORDER BY task_id DESC LIMIT 1");
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function createUserIdByTasks(int $user_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET users_id = :user_id ORDER BY task_id DESC LIMIT 1");
        $query->execute(['user_id' => $user_id]);
    }

    public function getEmailByEmails(string $email)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM emails WHERE address = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getUserIdByUsers(string $name)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM users WHERE name = :name");
        $query->execute(['name' => $name]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getTasksByUserId(int $user_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM tasks WHERE users_id = :user_id");
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createEmail(string $email)
    {
        $db = Db::getDb();
        $query = $db->prepare("INSERT emails (address) VALUES (:email)");
        $query->execute(['email' => $email]);
    }

    public function createEmailTask(int $email_id)
    {
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET email_id = :email_id ORDER BY task_id DESC LIMIT 1");
        $query->execute(['email_id' => $email_id]);
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

    public function getAllUserByTask(){
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    public function getAllUserCountByTask($nameId){
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE users_id = $nameId"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    public function getAllEmailCountByTask($emailId){
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE email_id = $emailId"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    public function getAllTaskCompleteCountByTask(){
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE status = 'finished'"
        );
        return $query->fetchAll(\PDO::FETCH_NUM);
    }

    public function getAllTaskNotCompleteCountByTask(){
        $db = Db::getDb();
        $query = $db->query(
            "SELECT COUNT(*) FROM tasks WHERE status = 'nonFinished'"
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

public function getTaskUserPag($limit, int $count, $nameId){
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

    public function getTaskEmailPag($limit, int $count, $emailId){
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

    public function getCompleteTaskPag($limit, int $count){
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

    public function getNotCompleteTaskPag($limit, int $count){
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

    public function getNameIdByName($name)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM users WHERE name = :name");
        $query->execute(['name' => $name]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

//    public function getEmailIdByEmails($email)
//    {
//        $db = Db::getDb();
//        $query = $db->prepare("SELECT * FROM emails WHERE address = :email");
//        $query->execute(['email' => $email]);
//        return $query->fetchAll(\PDO::FETCH_ASSOC);
//    }

    public function getEmailIdByEmails($email)
    {
        $db = Db::getDb();
        $query = $db->prepare("SELECT * FROM emails WHERE address = :email");
        $query->execute(['email' => $email]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

public function getAdminCheck()
{
    $db = Db::getDb();
    $query = $db->query("SELECT * FROM admins");
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
        WHERE task_id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function taskStatus(){

    }

    public function updateMessageText($text, $status, $id){
        $db = Db::getDb();
        $query = $db->prepare("UPDATE tasks SET text = :text, status = :status WHERE task_id = $id");
        $query->execute(['text' => $text, 'status' => $status]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateMessageUser($user, $id,){
        $db = Db::getDb();
        $query = $db->prepare("UPDATE users SET name = :name WHERE name_id = $id");
        $query->execute(['name' => $user]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateMessageEmail($email, $id,){
        $db = Db::getDb();
        $query = $db->prepare("UPDATE emails SET address = :address WHERE email_id = $id");
        $query->execute(['address' => $email]);
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