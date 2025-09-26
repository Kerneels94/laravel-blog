@extends('layouts.base')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Login to Your Account</h2>

        <form class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" 
                       class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                       class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300" required>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <a href="" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <button
                onclick="loginUser"
                id="loginButton"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Login
            </button>
        </form>
{{-- 
        <p class="text-sm text-gray-600 text-center mt-4">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </p> --}}
    </div>
</div>

<script>
    const loginButton = document.getElementById("loginButton");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    async function loginUser(e) {
        e.preventDefault();

        const response = await fetch("/login-user", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: "same-origin",
            body: JSON.stringify({
                email: email.value,
                password: password.value
        })});

        const data = await response.json();

        if(data.status === 200) {
            window.location.href = "/login";
        }
    }

    loginButton.addEventListener("click", loginUser); 

</script>

@endsection
