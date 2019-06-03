<?php

namespace App\Policies;

use App\Models\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;


    public function create(User $user)
    {
        return $user->isManager();
    }

    public function seeNoteAssigned(User $user)
    {
        return $user->isManager();
    }

    public function edit(User $user, Task $task)
    {
        return $user->isManager() && ($task->user_id == $user->id || $task->user_id == null);
    }
    public function changeStatus(User $user)
    {
        return $user->isDeveloper();
    }
}
