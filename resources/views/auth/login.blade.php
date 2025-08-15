@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-gray-900 flex items-center justify-center p-4 md:p-8">
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-blue-700 to-blue-900"></div>

    <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden md:p-10 p-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h1>
            <p class="text-gray-500">Selamat datang kembali! Silakan masukkan detail Anda.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                <input id="email" type="email" class="form-input w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                <input id="password" type="password" class="form-input w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input class="form-checkbox h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm text-gray-900" for="remember">
                        Ingat Saya
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-700 font-medium" href="{{ route('password.request') }}">
                        Lupa Kata Sandi Anda?
                    </a>
                @endif
            </div>

            <div class="mb-6">
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 transition duration-300 shadow-lg">
                    Masuk
                </button>
            </div>
        </form>

        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600">
                Belum punya akun? <a class="text-blue-600 hover:text-blue-700 font-medium" href="{{ route('register') }}">Daftar sekarang</a>
            </p>
        @endif
    </div>
</div>
@endsection
