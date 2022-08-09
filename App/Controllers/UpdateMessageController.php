<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\JsonResponse;
use Core\Http\Request;
use Core\Validator;

class UpdateMessageController
{
    /**
     * @var \App\Models\Tasks
     */
    private Tasks $tasks;
    /**
     * @var \Core\Validator
     */
    private Validator $validator;

    public function __construct(Tasks $tasks, Validator $validator)
{
    $this->tasks = $tasks;
    $this->validator = $validator;
}

public function chengeMessage(Request $request){
    $postParam = $request->getPostParam();
    $user = $postParam['user'] ?? null;
    $email = $postParam['email'] ?? null;
    $message = $postParam['task'] ?? null;
    $status = $postParam['status'] ?? null;
    $id = $postParam['id'] ?? null;
    $id = explode('&', $id);
    $id = ['task_id' => $id[0], 'users_id' => $id[1], 'email_id' => $id[2]];
//    return new JsonResponse($id);

    if (!$this->validator->isValidName($user)) {
        return new JsonResponse(['error' => "Name введен некорректно", 'post' => $_POST]);
    }
    if (!$this->validator->isValidEmail($email)) {
        return new JsonResponse(['error' => 'Email введен некорректно']);
    }
    if ($message === null) {
        return new JsonResponse(['error' => 'Напишите задачу']);
    }
    $this->tasks->updateMessageText($message, $status, $id['task_id']);
    $this->tasks->updateMessageUser($user, $id['users_id']);
    $this->tasks->updateMessageEmail($email, $id['email_id']);

    return new JsonResponse(['success' => 'Задача изменена']);
}

}