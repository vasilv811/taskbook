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
        $name = $postParam['name'] ?? null;
        $email = $postParam['email'] ?? null;
        $message = $postParam['message'] ?? null;
        if (!$this->validator->isValidName($name)) {
            return new JsonResponse(['error' => 'Name введен некорректно']);
        }
        if (!$this->validator->isValidEmail($email)) {
            return new JsonResponse(['error' => 'Email введен некорректно']);
        }
        $this->tasks->createMessage($message);
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