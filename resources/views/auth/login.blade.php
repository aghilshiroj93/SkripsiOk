<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .school-bg {
      background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #93c5fd 100%);
      background-size: cover;
      background-attachment: fixed;
    }
    .login-card {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    .login-card:hover {
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
    .input-field {
      transition: all 0.3s ease;
      border: 1px solid #d1d5db;
    }
    .input-field:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .school-logo-container {
      background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen school-bg p-4">
  <div class="login-card bg-white rounded-2xl overflow-hidden w-full max-w-4xl flex flex-col md:flex-row">
    
    <!-- Left (Logo Sekolah) -->
    <div class="school-logo-container md:w-2/5 flex items-center justify-center p-8">
      <div class="text-center">
        <img src="{{ asset('images/sma1.png') }}" alt="Logo Sekolah" class="w-48 mx-auto mb-4 rounded-lg shadow-md"/>
        <h1 class="text-2xl font-bold text-white">SMA NEGERI 1</h1>
        <p class="text-blue-100">Sekolah Unggulan Berprestasi</p>
      </div>
    </div>

    <!-- Right (Form Login) -->
    <form method="POST" action="/login" class="md:w-3/5 p-10 bg-white flex flex-col justify-center">
      @csrf

      <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Selamat Datang</h2>
      <p class="text-gray-500 text-center mb-8">Silakan masuk ke akun Anda</p>

      @if ($errors->any())
        <div class="text-red-600 text-sm mb-4 bg-red-50 p-3 rounded-lg text-center border border-red-100">
          {{ $errors->first() }}
        </div>
      @endif

      <div class="mb-5">
        <label class="block text-sm font-medium text-gray-700 mb-2">Email / NIS</label>
        <input type="text" name="email" required placeholder="Masukkan Email atau NIS"
          class="input-field w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
        <input type="password" name="password" required placeholder="Masukkan Password"
          class="input-field w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg">
        Masuk
      </button>

      <div class="mt-8 text-center">
        <p class="text-xs text-gray-500">
          Login siswa menggunakan NIS yang telah diberikan
        </p>
        <p class="text-xs text-gray-400 mt-2">
          © 2025 SMA Negeri 1 Paiton. All rights reserved.
        </p>
      </div>
    </form>
  </div>
</body>
</html>