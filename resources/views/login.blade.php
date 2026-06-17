@extends('master')
@section('content')
    <div class="authentication">
        <div>
            <div>
                <img src="assets/images/auth image.png" alt="authentication bg image">
            </div>
        </div>

        <!-- Check for email error -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <form action="{{ url('login') }}" method="POST">
            @csrf
            <img src="assets/images/auth logo.png" alt="Logo">
            <h1>Sign In</h1>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="text-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Email field -->
            <div>
                <label for="Email">Email</label>
                <input type="email" name="email" id="Email" placeholder="nazmulhoque@gmail.com" required autofocus>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password field -->
            <div class="Password">
                <label for="Password">Password</label>
                <input type="password" name="password" id="Password" placeholder="*********" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit button -->
            <button type="submit" class="submit-btn">Log In</button>
        </form>

    </div>
    @error('error')
        <div class="text-danger">{{ $message }}</div>
    @enderror
@endsection
