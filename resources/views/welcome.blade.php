@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column min-vh-100">
    <div class="text-center mt-5 mb-4">
        <h1 class="display-4">Welcome to Task Manager</h1>
        <p class="lead">Your ultimate tool to manage tasks effectively.</p>

        <div class="mt-4">
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Login</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
            @endguest
        </div>
    </div>

    <!-- Adding the image -->
    <div class="text-center">
        <img src="{{ asset('images/taskpic.png') }}" alt="Task Picture" class="img-fluid custom-img">
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Organize Your Tasks</h5>
                        <p class="card-text">Easily categorize and prioritize your tasks to stay on top of your workload.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Track Progress</h5>
                        <p class="card-text">Monitor the status of each task to ensure you're meeting your deadlines.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Collaborate Effectively</h5>
                        <p class="card-text">Work together with your team by sharing tasks and tracking progress.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .custom-img {
        max-width: 100%;
        height: auto; /* Maintain aspect ratio */
        max-height: 50vh; /* Limit the height to 50% of viewport height */
    }
    .min-vh-100 {
        min-height: 100vh;
    }
</style>
