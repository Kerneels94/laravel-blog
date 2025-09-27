@extends('layouts.base')

@section('title', 'Forgot Password')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center mb-6">Forgot password</h2>

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
            <button
                onclick="resetPassword"
                id="forgotPassword"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 cursor-pointer">
                Reset passwword
            </button>
        </form>
    </div>
</div>

<script>
    const resetPasswordButton = document.getElementById("forgotPassword");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    async function resetPassword(e) {
        e.preventDefault();

        const response = await fetch("/forgot-password", {
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

    resetPasswordButton.addEventListener("click", resetPassword); 

</script>

@endsection
