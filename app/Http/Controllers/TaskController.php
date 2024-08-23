<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\TaskDueNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function dashboard()
{
    $tasks = Task::where('user_id', Auth::id())->get();
    $pendingTasksCount = $tasks->where('status', 'pending')->count();
    $inProgressTasksCount = $tasks->where('status', 'in progress')->count();
    $completedTasksCount = $tasks->where('status', 'completed')->count();
    $allTasks = $tasks->sortByDesc('created_at');

    return view('dashboard', compact('pendingTasksCount', 'inProgressTasksCount', 'completedTasksCount', 'allTasks'));
}

    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = ['personal', 'work', 'other'];
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:personal,work,other',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'name' => $request->name,
            'category' => $request->category,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $categories = ['personal', 'work', 'other'];
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:personal,work,other',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in progress,completed',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
