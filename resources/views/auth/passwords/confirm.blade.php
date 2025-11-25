@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">
            
            <!-- Card Header -->
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                {{ __('Confirm Password') }}
            </h2>
            
            <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                {{ __('Please confirm your password before continuing.') }}
            </div>

            <!-- Form Body -->
            <div class="mt-8">
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Password') }}
                        </label>
                        <div class="mt-1">
                            <input id="password" type="password" 
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 text-gray-900 dark:text-white rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700
                                @error('password') border-red-500 ring-red-500 @enderror" 
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <p class="mt-2 text-sm text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button & Forgot Link -->
                    <div class="flex flex-col space-y-4 pt-2">
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out shadow-md hover:shadow-lg">
                            {{ __('Confirm Password') }}
                        </button>

                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-150 ease-in-out" 
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
