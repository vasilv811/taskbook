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
    /**
     * @var Users
     */
    private Users $users;
    /**
     * @var Emails
     */
    private Emails $emails;

    /**
     * SetMessageController constructor.
     * @param Tasks $tasks
     * @param Users $users
     * @param Emails $emails
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
        $address = $postParam['email'] ?? null;
        $message = $postParam['task'] ?? null;
        $status = $postParam['status'] ?? null;
        if (!$this->validator->isValidName($user)) {
            return new JsonResponse(['error' => "Name введен некорректно", 'post' => $_POST]);
        }
        if (!$this->validator->isValidEmail($address)) {
            return new JsonResponse(['error' => 'Email введен некорректно']);
        }
        if ($message === null) {
            return new JsonResponse(['error' => 'Напишите задачу']);
        }
        $this->tasks->createTask($message, $status);
        $userArr = $this->users->getUserByName($user);
        if (!$userArr) {
            $this->users->createUser($user);
            $userArr = $this->users->getUserByName($user);
        }
        $this->tasks->updateTasksByUserId($userArr['name_id']);
        $emailArr = $this->emails->getEmailByAddress($address);
        if (!$emailArr) {
            $this->emails->createEmail($address);
            $emailArr = $this->emails->getEmailByAddress($address);
        }
        $this->tasks->createEmailTask($emailArr['email_id']);
        return new JsonResponse(['success' => 'Задача добавлена']);
    }
}