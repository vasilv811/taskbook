<?php


namespace App\Controllers;


use App\Models\Emails;
use App\Models\Tasks;
use App\Models\Users;
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
    private Users $users;
    private Emails $emails;

    /**
     * SetMessageController constructor.
     * @param Tasks $tasks
     * @param Validator $validator
     */
    public function __construct(
        Tasks $tasks,
        Users $users,
        Emails $emails,
        Validator $validator
    ) {
        $this->tasks = $tasks;
        $this->validator = $validator;
        $this->users = $users;
        $this->emails = $emails;
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
        $userArr = $this->users->getUserByUsers($user);
        if (!$userArr) {
            $this->users->createUser($user);
            $userArr = $this->users->getUserByUsers($user);
        }
        $this->tasks->createUserIdByTasks($userArr['name_id']);
        $emailArr = $this->emails->getEmailByEmails($email);
        if (!$emailArr) {
            $this->emails->createEmail($email);
            $emailArr = $this->emails->getEmailByEmails($email);
        }
        $this->tasks->createEmailTask($emailArr['email_id']);
        return new JsonResponse(['success' => 'Задача добавлена']);
    }
}