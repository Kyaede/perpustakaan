@extends('template/index')
@section('content')
<!-- component -->
<div class="py-28">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <img class="hidden lg:block lg:w-1/2 bg-cover" src="{{ url('../storage/img/logo.jpg') }}" alt="">
        <div class="w-full p-8 lg:w-1/2">
            <h2 class="text-2xl font-bold text-gray-700 text-center">LOUVRE</h2>
            <p class="text-xl text-gray-600 text-center"></p>
            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 lg:w-1/4"></span>
                <a href="#" class="text-xs text-center text-gray-500 uppercase">Login</a>
                <span class="border-b w-1/5 lg:w-1/4"></span>
            </div>
            <form action="{{ route('loginProses') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                    <input
                        class="bg-gray-200 text-gray-700 @error('email')is-invalid @enderror focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                        type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <label class="block text-gray-700 @error('password')is-invalid @enderror text-sm font-bold mb-2">Password</label>
                        {{-- <a href="#" class="text-xs text-gray-500">Forget Password?</a> --}}
                    </div>
                    <input
                        class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                        type="password" name="password" value="{{ old('password') }}">
                </div>
                <div class="mt-8">
                    <button type="submit"
                        class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Login</button>
                </div>
            </form>
            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 md:w-1/4"></span>
                <a href="{{ route('register') }}" class="text-xs text-gray-500 uppercase">or sign up</a>
                <span class="border-b w-1/5 md:w-1/4"></span>
            </div>
        </div>
    </div>
</div>
@endsection