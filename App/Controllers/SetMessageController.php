<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Core\Http\Response;
use Core\Validator;

class SetMessageController
{
    private Tasks $tasks;
    private Validator $validator;

    /**
     * SetContactsController constructor.
     * @param Tasks $tasks
     * @param Validator $validator
     */
    public function __construct(
        Tasks $tasks,
        Validator $validator
    ) {
        $this->tasks = $tasks;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function setMessage(Request $request): Response
    {
        $postParam = $request->getPostParam();
        $user = $postParam['user'] ?? null;
        $email = $postParam['email'] ?? null;
        $message = $postParam['task'] ?? null;
        $status = $postParam['status'] ?? null;
        if (!$this->validator->isValidName($user)) {
            return new JsonResponse(['error' => "Name введен некорректно", 'post' => $_POST]);
        }
        if (!$this->validator->isValidEmail($email)) {
            return new JsonResponse(['error' => 'Email введен некорректно']);
        }
        if ($message === null) {
            return new JsonResponse(['error' => 'Напишите задачу']);
        }
        $this->tasks->createMessage($message, $status);

        $userArr = $this->tasks->getUserByUsers($user);
//        $taskArr = $this->tasks->getTaskId();

        if (!$userArr) {
            $this->tasks->createUser($user);
            $userArr = $this->tasks->getUserByUsers($user);
            $this->tasks->createUserIdByTasks($userArr['name_id']);
        }else{
            $this->tasks->createUserIdByTasks($userArr['name_id']);
        }

        $emailArr = $this->tasks->getEmailByEmails($email);
        if (!$emailArr) {
            $this->tasks->createEmail($email);
            $emailArr = $this->tasks->getEmailByEmails($email);
            $this->tasks->createEmailTask($emailArr['email_id']);
        }else{
            $this->tasks->createEmailTask($emailArr['email_id']);
        }
        return new JsonResponse(['success' => 'Задача добавлена']);



        die;
        $phoneArray = $this->tasks->createMessage($message);
        if ($phoneArray) {
            return new JsonResponse(['error' => 'Телефон уже существует в базе данных, введите другой телефон']);
        }
        //Получение email и создание если его нет
        $emailArray = $this->contacts->getEmailByEmail($email);

        if (!$emailArray) {
            $this->contacts->createEmail($email);
            $emailArray = $this->contacts->getEmailByEmail($email);
        }
        //Создание телефона в базе
        $this->contacts->createPhone($emailArray['id_email'], $phone);
        return new JsonResponse(['success' => 'Телефон добавлен в базу данных']);
    }
}