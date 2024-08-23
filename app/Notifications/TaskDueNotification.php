<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskDueNotification extends Notification
{
use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Determine which channels the notification will be sent on.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // Use database channel
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'task_name' => $this->task->name,
            'message' => 'Your task "' . $this->task->name . '" is due tomorrow.',
        ];
    }
}
