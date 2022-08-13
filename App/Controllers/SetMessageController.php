<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Core\Validator;

class SetMessageController
{
    /**
     * @var Tasks
     */
    private Tasks $tasks;
    /**
     * @var Validator
     */
    private Validator $validator;

    /**
     * SetMessageController constructor.
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
     * @return JsonResponse
     */
    public function setMessage(Request $request): JsonResponse
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
        if (!$userArr) {
            $this->tasks->createUser($user);
            $userArr = $this->tasks->getUserByUsers($user);
        }
        $this->tasks->createUserIdByTasks($userArr['name_id']);
        $emailArr = $this->tasks->getEmailByEmails($email);
        if (!$emailArr) {
            $this->tasks->createEmail($email);
            $emailArr = $this->tasks->getEmailByEmails($email);
        }
        $this->tasks->createEmailTask($emailArr['email_id']);
        return new JsonResponse(['success' => 'Задача добавлена']);
    }
}