<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskNotificationLog extends Model
{
    use HasFactory;
    protected $fillable = ['task_id', 'notification_type'];
    protected $table = 'task_notification_logs';
}
