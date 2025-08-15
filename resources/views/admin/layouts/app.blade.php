<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS BKPSDM Sorong Selatan</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white shadow-lg flex flex-col justify-between">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-8">CMS BKPSDM</h1>
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('announcements.index') }}" class="flex items-center space-x-2 p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span>Pengumuman</span>
                </a>
                <a href="{{ route('leaders.index') }}" class="flex items-center space-x-2 p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-user-tie w-5"></i>
                    <span>Pimpinan</span>
                </a>
                <a href="{{ route('settings.index') }}" class="flex items-center space-x-2 p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fas fa-cogs w-5"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>
        </div>
        <div class="p-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-2 p-3 rounded-lg text-gray-300 hover:bg-red-600 hover:text-white transition duration-200">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto">
        <header class="bg-white shadow-md p-6 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-2xl font-semibold text-gray-800">
                @yield('page-title', 'Dashboard')
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="User Avatar" class="w-10 h-10 rounded-full">
            </div>
        </header>

        <main class="p-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
