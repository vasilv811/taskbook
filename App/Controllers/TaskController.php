<?php


namespace App\Controllers;


use App\Models\Tasks;
use Core\Http\Request;

class TaskController
{
    /**
     * @var \App\Models\Tasks
     */
    private Tasks $tasks;

    public function __construct(Tasks $tasks)
{
    $this->tasks = $tasks;
}

public function taskStatus(Request $request){

}

}