<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(["resources/css/app.css", "resources/js/app.js"])

    <title>@yield('title', 'My App')</title>
</head>
<body class="antialiased bg-gray-100 text-gray-900">
    
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    @if ($location == "home")
        <div class="min-h-screen bg-gray-50">

        <section class="bg-white shadow-sm py-12 mb-8">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl font-extrabold text-gray-900">Welcome to My Blog</h1>
                <p class="mt-4 text-lg text-gray-600">Discover articles, stories, and insights from different authors.</p>
                <div class="mt-6 flex justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Register
                    </a>
                    <a id="loginButton" href="{{ route('login') }}" class="cursor-pointer px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Login
                    </a>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Latest Blogs</h2>

            @php
                $blogs = [
                    ["title" => "The Future of Web Development", "excerpt" => "Exploring the latest trends in modern web development and frameworks.", "author" => "John Doe"],
                    ["title" => "Mastering Laravel Blade", "excerpt" => "A deep dive into Laravel Blade templating for clean and dynamic UI.", "author" => "Jane Smith"],
                    ["title" => "TailwindCSS Tips & Tricks", "excerpt" => "How to speed up your styling process with Tailwind.", "author" => "Alex Brown"],
                    ["title" => "Getting Started with Go", "excerpt" => "Why Go is becoming a popular language for backend development.", "author" => "Chris Evans"],
                ];
            @endphp

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($blogs as $blog)
                    <article class="bg-white shadow-md rounded-lg p-5 hover:shadow-lg transition">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $blog['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $blog['excerpt'] }}</p>
                        <div class="text-sm text-gray-500">By {{ $blog['author'] }}</div>
                    </article>
                @endforeach
            </div>
        </section>

    </div>
    @endif
</body>
</html>