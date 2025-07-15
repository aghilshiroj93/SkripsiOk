<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8">
    <h1 class="text-3xl font-bold mb-4">Selamat Datang di Dashboard, {{ Auth::user()->name }}</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
    </form>
</body>
</html>
