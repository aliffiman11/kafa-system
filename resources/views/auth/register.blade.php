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
                            <h3 class="title">Register</h3>
                            <form method="POST" action="{{ route('register') }}" class="form-horizontal">
                                @csrf

                                <!-- Name Address -->
                                <div class="form-group">
                                    <label for="name" class="d-block">Name</label>
                                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" placeholder="Full Name" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email" class="d-block">Email</label>
                                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email address" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="d-block">Password</label>
                                    <x-text-input id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="d-block">Confirm Password</label>
                                    <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="password_confirmation" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                    <button type="submit" class="btn btn-default">Register</button>
                            </form>
                            @if (Route::has('register'))
                            <button type="submit" class="btn1 btn-default1"><a href="{{ route('login') }}">Login</a></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-guest-layout>

</body>

</html>