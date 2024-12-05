<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

    <!-- Include your CSS file -->
    <link href="{{ asset('css/Auth/style.css') }}" rel="stylesheet">

    <!-- Include FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body class="font-sans antialiased">

    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="form-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <div class="form-container">
                            <div class="form-icon"><i class="fas fa-user"></i></div>
                            <h3 class="title">Login</h3>
                            <form method="POST" action="{{ route('login') }}" class="form-horizontal">
                                @csrf
                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email" class="d-block">Email</label>
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email address" required autofocus autocomplete="username" />
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="d-block">Password</label>
                                    <x-text-input id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                                </div>

                                <div class="remember-forgot">
                                    <!-- Remember Me -->
                                    <div class="form-group">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                                        </label>
                                    </div>

                                    <div class="form-group flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                            {{ ('Forgot your password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                    <button type="submit" class="btn btn-default">Login</button>
                            </form>
                            @if (Route::has('register'))
                            <button type="submit" class="btn1 btn-default1"><a href="{{ route('register') }}">Register</a></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-guest-layout>

</body>

</html>