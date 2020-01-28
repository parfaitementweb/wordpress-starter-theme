@extends('layouts.master')

@section('content')

    <div class="w-full max-w-xs mx-auto">
        <form action="{{ site_url() }}/wp-admin/admin-post.php" method="post" class="bg-white shadow rounded-lg px-8 pt-6 pb-8 mb-4">

            @if($errors->has('failed'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $errors->first('failed') }}</span>
                    </span>
                </div>
            @endif

			<?php wp_nonce_field( \App\Login\LoginForm::name() ) ?>
            <input type="hidden" name="action" value="{{\App\Login\LoginForm::name()}}">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border {{ $errors->has('username') ? 'border-red-500 mb-1' : '' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Username"
                       value="{{ \App\Login\LoginForm::old('username') }}">
                @if($errors->has('password'))<p class="text-red-500 text-xs italic">{{$errors->first('username')}}</p>@endif
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border {{ $errors->has('password') ? 'border-red-500 mb-1' : '' }} rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" placeholder="****">
                @if($errors->has('password'))<p class="text-red-500 text-xs italic">{{$errors->first('password')}}</p>@endif
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>

@endsection