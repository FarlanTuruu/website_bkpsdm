@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-gray-900 flex items-center justify-center p-4 md:p-8">
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-blue-700 to-blue-900"></div>

    <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden md:p-10 p-6">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Daftar Akun Baru</h1>
            <p class="text-gray-500">Bergabung dengan kami sekarang. Gratis dan mudah!</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input id="name" type="text" class="form-input w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                <input id="email" type="email" class="form-input w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                <input id="password" type="password" class="form-input w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-50- @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                <input id="password-confirm" type="password" class="form-input w-full px-4 py-2 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-6">
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 transition duration-300 shadow-lg">
                    Daftar
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600">
            Sudah punya akun? <a class="text-blue-600 hover:text-blue-700 font-medium" href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
