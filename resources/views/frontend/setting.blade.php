@extends('template/index')
@section('content')

<section class="max-w-4xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Profile Settings</h1>
    <form action="{{ route('usersetting.update', $setting->id)}}" enctype="multipart/form-data" method="POST"> <!-- Perbarui method menjadi POST -->
        @csrf
        @method('PUT') <!-- Tambahkan method PUT -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Username</label>
                <input id="nama_kategori" type="text" name="username" value="{{ old('username') ?? $setting->username }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Email</label>
                <input id="nama_kategori" type="email" name="email" value="{{ old('email') ?? $setting->email }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Nama Lengkap</label>
                <input id="nama_kategori" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') ?? $setting->nama_lengkap }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Alamat</label>
                <input id="nama_kategori" type="text" name="alamat" value="{{ old('alamat') ?? $setting->alamat }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-6">
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-600 rounded-md hover:bg-indigo-400 focus:outline-none focus:bg-gray-600">Submit</button>
                <a href="{{ route('home.index') }}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Back</a>
        </div>
    </form>
</section>
@endsection