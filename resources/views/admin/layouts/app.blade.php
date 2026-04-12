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
<body class="bg-gray-100 min-h-screen">
    <div class="md:hidden fixed top-0 inset-x-0 z-40 bg-gray-900 text-white px-4 py-3 flex items-center justify-between shadow-lg">
        <h1 class="text-base font-semibold">CMS BKPSDM</h1>
        <button id="openSidebarBtn" type="button" class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-gray-800 hover:bg-gray-700 transition duration-200" aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

    <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white shadow-lg flex flex-col justify-between transform -translate-x-full transition-transform duration-300 md:translate-x-0">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold">CMS BKPSDM</h1>
                <button id="closeSidebarBtn" type="button" class="md:hidden inline-flex items-center justify-center w-8 h-8 rounded-md bg-gray-700 hover:bg-gray-600 transition duration-200" aria-label="Tutup menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="space-y-2">
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
                <a href="{{ route('whatsapp.index') }}" class="flex items-center space-x-2 p-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                    <i class="fab fa-whatsapp w-5"></i>
                    <span>WhatsApp Gateway</span>
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

    <div class="min-h-screen md:ml-64">
        <header class="hidden md:flex bg-white shadow-md px-6 py-4 justify-between items-center sticky top-0 z-30">
            <h2 class="text-2xl font-semibold text-gray-800">
                @yield('page-title', 'Dashboard')
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="User Avatar" class="w-10 h-10 rounded-full">
            </div>
        </header>

        <main class="pt-20 md:pt-6 px-4 pb-6 md:px-6">
            <h2 class="md:hidden text-xl font-semibold text-gray-800 mb-4">
                @yield('page-title', 'Dashboard')
            </h2>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('warning') }}</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtn = document.getElementById('openSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            if (openBtn) {
                openBtn.addEventListener('click', openSidebar);
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 768) {
                    overlay.classList.add('hidden');
                    sidebar.classList.remove('-translate-x-full');
                    document.body.classList.remove('overflow-hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });
    </script>

</body>
</html>
