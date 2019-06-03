<?php


namespace App\Contracts;


use App\Models\Task;

interface TaskInterface{

    public function index(array $data, $user);

    public function store(array $data, Task $task, $user);

    public function update(array $data, Task $task, $user);

    public function attach(array $data, Task $task);

    public function developerTask($user, int $page = 1);

    public function managerTask($user, $status = 'assign', int $page = 1);


}
