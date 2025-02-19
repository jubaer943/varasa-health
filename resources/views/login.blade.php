@extends('master')
@section('content')
    <div class="authentication">
        <div>
            <div>
                <img src="assets/images/auth image.png" alt="authentication bg image">
            </div>
        </div>


        <form action="{{ url('login') }}" method="POST">
            @csrf
            <img src="assets/images/auth logo.png" alt="Logo">
            <h1>Sign In</h1>

            <!-- Display errors -->



            <!-- Email field -->
            <div>
                <label for="Email">Email</label>
                <input type="email" name="email" id="Email" placeholder="nazmulhoque@gmail.com" required autofocus>
            </div>

            <!-- Password field -->
            <div class="Password">
                <label for="Password">Password</label>
                <input type="password" name="password" id="Password" placeholder="*********" required>
                <i class="fa-solid fa-eye-slash"></i>
            </div>

            <!-- Remember me section -->
            <div class="Remember-section">
                <div>
                    <input type="checkbox" name="remember" id="Remember">
                    <label for="Remember">Remember me</label>
                </div>
                <a href="ForgetPassword.html">Forgot Password?</a>
            </div>

            <!-- Submit button -->
            <button type="submit" class="submit-btn">Log In</button>
        </form>
    </div>
@endsection
