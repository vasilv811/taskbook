<?php


namespace App\Controllers;


use App\Models\Emails;
use App\Models\Tasks;
use App\Models\Users;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Core\Validator;

class UpdateMessageController
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
     * UpdateMessageController constructor.
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
    public function changeMessage(Request $request): JsonResponse
    {
        if ($_SESSION['admin'] === false){
            return new JsonResponse(['error' => 'Вы не можете редактировать запись т.к. не являетесь администратором']);
        }
        $post = $request->getPostParam();
        $user = trim($post['user']) ?? null;
        $email = trim($post['email']) ?? null;
        $text = $post['text'] ?? null;
        $status = ($this->validator->isValidStatus($post['status'])) ? $post['status'] : null;
        $id = $post['id'] ?? null;
        $id = explode('&', $id);
        $id = ['task_id' => $id[0], 'users_id' => $id[1], 'email_id' => $id[2]];
        if (!$this->validator->isValidName($user)) {
            return new JsonResponse(['error' => "Name введен некорректно", 'post' => $_POST]);
        }
        if (!$this->validator->isValidEmail($email)) {
            return new JsonResponse(['error' => 'Email введен некорректно']);
        }
        if ($text === null) {
            return new JsonResponse(['error' => 'Напишите задачу']);
        }
        $this->tasks->updateText($text, $status, $id['task_id']);
        $this->users->updateUser($user, $id['users_id']);
        $this->emails->updateEmail($email, $id['email_id']);
        return new JsonResponse(['success' => 'Задача изменена']);
    }

}