<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'user_id', 'status', 'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function isDueSoon()
    {
        return $this->due_date && Carbon::now()->diffInDays($this->due_date, false) == 1;
    }

    public function isOverdue()
    {
        return $this->due_date && Carbon::now()->isAfter($this->due_date);
    }
}
