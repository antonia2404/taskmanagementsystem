# Task Management System

## Description

The Task Management System is a web application designed to help users efficiently manage their tasks. Users can create, update, and categorize tasks, as well as track their progress through different stages. User authentication and authorization features ensure that tasks are securely managed, and each user has personalized access to their tasks.

## Features

-   User authentication and authorization.
-   Task CRUD operations.
-   Categorization of tasks (e.g., personal, work).
-   Task status update (e.g., pending, in progress, completed).
-   Due date notifications.

## Installation

### Prerequisites

-   PHP >= 8.0
-   Composer
-   Node.js and NPM
-   Xampp

### Steps

1. Clone the project
2. Navigate to the project's root directory using terminal
3. Create .env file - cp .env.example .env
   Update the .env file with your database credentials
4. Execute composer install
5. Execute npm install
6. Set application key - php artisan key:generate --ansi
7. Execute migrations - php artisan migrate
8. Start vite server - npm run dev
9. Start Artisan server - php artisan serve

### Usage

Register a new user or log in with existing credentials.
Create, view, edit, or delete tasks from the task management interface.
Categorize your tasks and update their status as they progress.
View an overview of your tasks on the dashboard, including a breakdown by status.
Receive notifications for tasks nearing their due date and mark them as read.
(-php artisan tasks:check-notifications and refresh for notification to appear)
