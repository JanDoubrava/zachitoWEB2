@extends('layouts.app')

@section('title', 'Obnovení hesla')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Obnovení hesla</h2>
            <p class="mt-2 text-sm text-gray-600">
                Zadejte svůj email a my vám zašleme odkaz pro obnovení hesla
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Odeslat odkaz pro obnovení hesla
                </button>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('admin.login') }}" 
                   class="text-sm text-indigo-600 hover:text-indigo-500">
                    Zpět na přihlášení
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 