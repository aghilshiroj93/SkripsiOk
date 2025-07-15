<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .school-bg {
            background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
        .school-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }
        .register-form {
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body class="school-bg flex items-center justify-center h-screen">
    <form method="POST" action="/register" class="register-form p-8 w-96 relative z-10">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Daftar Akun</h2>

        @if ($errors->any())
            <div class="text-red-600 mb-4 text-center bg-red-100 p-2 rounded">{{ $errors->first() }}</div>
        @endif

        <div class="mb-4">
            <input type="text" name="name" placeholder="Nama Lengkap"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                required>
        </div>

        <div class="mb-4">
            <input type="email" name="email" placeholder="Email"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                required>
        </div>

        <div class="mb-4">
            <input type="password" name="password" placeholder="Password"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                required>
        </div>

        <div class="mb-6">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                required>
        </div>

        <button type="submit"
            class="w-full bg-green-600 text-white p-3 rounded-lg hover:bg-green-700 transition duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            Daftar Sekarang
        </button>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="/login" class="text-green-600 hover:text-green-800 font-medium transition duration-200">
                Masuk disini
            </a>
        </p>
    </form>
</body>
</html>
