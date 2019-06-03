<?php

namespace App\Repositories;


use App\Contracts\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface
{
    private $paginate;

    public function __construct()
    {
        $this->paginate = config('task.paginate');
    }


    public function index(array $data, $user)
    {
        $page = isset($data['page']) ? $data['page'] : 1;
        $status = isset($data['status']) ? $data['status'] : null;
        if ($user->isDeveloper()) {
            return $this->developerTask($user, $page);
        } elseif ($user->isManager()) {
            return $this->managerTask($user, $status, $page);
        }
    }


    public function store(array $data, Task $task, $user)
    {
        $task->title = $data['title'];
        $task->deadline = $data['deadline'];
        $task->description = $data['description'];
        $task->save();
        if (isset($data['developers']) && is_array($data['developers'])) {
            $this->attach($data['developers'], $task);
            $task->user_id = $user->id;
            $task->save();
        }
    }

    public function update(array $data, Task $task, $user)
    {
        $task->title = $data['title'];
        $task->deadline = $data['deadline'];
        $task->description = $data['description'];
        $task->save();
        $task->developers()->detach();
        if (isset($data['developers']) && is_array($data['developers'])) {
            $this->attach($data['developers'], $task);
            $task->user_id = $user->id;
            $task->save();
        }else{
            $task->user_id = null;
            $task->save();
        }
    }


    public function attach(array $data, Task $task)
    {
        foreach ($data as $developer) {
            $task->developers()->attach($developer);
        }
    }


    public function developerTask($user, int $page = 1)
    {
        return $user->tasks()->paginate($this->paginate, ['*'], 'page', $page);
    }


    public function managerTask($user, $status = 'assign', int $page = 1)
    {
        if (!$status ||$status == 'assign') {
            return $user->assignTask()->paginate($this->paginate, ['*'], 'page',$page);
        } else {
            return Task::notAssigned()->paginate($this->paginate, ['*'], 'page', $page);
        }

    }

}
