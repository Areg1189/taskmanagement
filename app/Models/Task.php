<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'title', 'deadline', 'description', 'status',
    ];



    public function developers()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    public function assign()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeNotAssigned($query)
    {
        return $query->where('user_id', null);
    }
}
