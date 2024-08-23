@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h3>My Tasks</h3>
            <a href="{{ route('tasks.create') }}" class="btn btn-success">Create Task</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ ucfirst($task->category) }}</td>
                            <td>
                                @php
                                    $statusClass = match($task->status) {
                                        'pending' => 'bg-warning text-dark',
                                        'in progress' => 'bg-primary text-white',
                                        'completed' => 'bg-success text-white',
                                        default => 'bg-secondary text-white',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($task->status) }}</span>
                            </td>
                            <td>{{ $task->created_at->format('Y-m-d') }}</td>
                            <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
