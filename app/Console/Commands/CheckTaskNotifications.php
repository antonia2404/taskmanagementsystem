<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\TaskNotificationLog;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskDueNotification;
use App\Notifications\TaskExpiredNotification;
use Carbon\Carbon;

class CheckTaskNotifications extends Command
{
     protected $signature = 'tasks:check-notifications';
    protected $description = 'Check for due and expired tasks and send notifications';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
    $now = Carbon::now();

    // Get tasks due tomorrow
    $dueTasks = Task::where('due_date', $now->copy()->addDay()->toDateString())
        ->where('status', 'pending')
        ->get();

    // Get expired tasks
    $expiredTasks = Task::where('due_date', '<', $now->toDateString())
        ->where('status', 'pending')
        ->get();

    // Process due tasks
    foreach ($dueTasks as $task) {
        if (!$this->notificationAlreadySent($task->id, 'due')) {
            $task->user->notify(new TaskDueNotification($task));
            $this->logNotification($task->id, 'due');
        }
    }

    // Process expired tasks
    foreach ($expiredTasks as $task) {
        if (!$this->notificationAlreadySent($task->id, 'expired')) {
            $task->user->notify(new TaskExpiredNotification($task));
            $this->logNotification($task->id, 'expired');
        }
    }

    $this->info('Notifications sent for due and expired tasks.');
}
    /**
     * Check if a notification has already been sent for a task.
     *
     * @param int $taskId
     * @param string $type
     * @return bool
     */
    protected function notificationAlreadySent($taskId, $type)
    {
        return TaskNotificationLog::where('task_id', $taskId)
            ->where('notification_type', $type)
            ->exists();
    }

    /**
     * Log that a notification has been sent for a task.
     *
     * @param int $taskId
     * @param string $type
     * @return void
     */
    protected function logNotification($taskId, $type)
    {
        TaskNotificationLog::create([
            'task_id' => $taskId,
            'notification_type' => $type,
        ]);
    }
}
