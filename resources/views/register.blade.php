@extends('layouts.base')

@section('title', 'Register')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Create an Account</h2>

        <form class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300">
            </div>

            <button type="submit"
                onclick="registerUser"
                id="registerUser"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Register
            </button>
        </form>

        {{-- <p class="text-sm text-gray-600 text-center mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p> --}}
    </div>
</div>

<script>
    const registerUserButton = document.getElementById("registerUser");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    async function registerUser(e) {
        e.preventDefault();

        const response = await fetch("/register-user", {
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
    }

    registerUserButton.addEventListener("click", registerUser); 

</script>
@endsection
