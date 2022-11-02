<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected static function booted()
    {
        parent::booted();
        static::creating(function (Task $task) {
            $task->creator()->associate(auth()->user());
        });
    }

    protected $fillable  = ["title"];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class);
    }
}
