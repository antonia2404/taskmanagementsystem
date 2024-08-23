<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Notification;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Dashboard route now pointing to the TaskController's index method
// Dashboard route
Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Resource routes for tasks and categories
Route::resource('tasks', TaskController::class)->middleware('auth');

Route::get('/notifications/mark-all-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('notifications.markAllRead')->middleware('auth');
