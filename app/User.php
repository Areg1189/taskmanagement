<?php

namespace App;

use App\Models\Role;
use App\Models\Task;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'user_id', 'id');
    }

    public function isManager()
    {
        return $this->role_id == 2;
    }

    public function isDeveloper()
    {
        return $this->role_id == 1;
    }

    public function scopeGetDevelopers($query, $search = '')
    {
        return $query->where('role_id', 1)->where('name', 'like', '%' . $search . '%');
    }

    public function scopeGetManagers($query)
    {
        return $query->where('role_id', 2);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user');
    }

    public function assignTask()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
}
