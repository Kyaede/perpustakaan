@extends('template/index')

@section('content')

<!-- component -->
<section class="max-w-4xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Peminjaman Baru</h1>
    <form action="{{ route('pinjambuku.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
    
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
        <!-- Input tersembunyi untuk user_id -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label class="text-white dark:text-gray-200" for="buku_id">Judul Buku</label>
                <select id="buku_id" name="buku_id" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @foreach ($buku as $item)
                        <option value="{{ $item->buku_id }}">{{ $item->judul }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="tanggal_peminjaman">Tanggal Peminjaman</label>
                <input id="tanggal_peminjaman" type="date" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <select id="status_peminjaman" name="status_peminjaman" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                <option value="diPinjam">Dipinjam</option>
            </select>
        </div>
    
        <div class="flex justify-end mt-6 gap-6">
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-600 rounded-md hover:bg-indigo-400 focus:outline-none focus:bg-gray-600">Submit</button>
                <a href="{{ route('home.index') }}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Back</a>
        </div>
    </form>
    
</section>
@endsection
