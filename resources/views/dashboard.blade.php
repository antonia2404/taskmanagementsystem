@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Dashboard</h3>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Pending Tasks</h5>
                        <p class="card-text">{{ $pendingTasksCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">In Progress Tasks</h5>
                        <p class="card-text">{{ $inProgressTasksCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Completed Tasks</h5>
                        <p class="card-text">{{ $completedTasksCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Tasks Table -->
        <div class="mb-4">
            <h4 class="mb-3">All Tasks</h4>
            <div class="table-responsive bg-white p-3 rounded shadow-sm">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Due Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($allTasks as $task)
                        @php
                            $statusClass = match($task->status) {
                                'pending' => 'bg-warning text-dark',
                                'in progress' => 'bg-primary text-white',
                                'completed' => 'bg-success text-white',
                                default => 'bg-secondary text-white',
                            };
                        @endphp
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{{ ucfirst($task->category) }}</td>
                            <td>
                                <span class="badge {{ $statusClass }}">{{ ucfirst($task->status) }}</span>
                            </td>
                            <td>{{ $task->created_at->format('Y-m-d') }}</td>
                            <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
