@extends('template/index')

@section('content')

<!-- component -->
<section class="max-w-4xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Edit Buku</h1>
    <form action="{{ route('buku.update', $buku->buku_id)}}" enctype="multipart/form-data" method="POST"> <!-- Perbarui method menjadi POST -->
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
                <label class="text-white dark:text-gray-200" for="nama_kategori">Title</label>
                <input id="nama_kategori" type="text" name="nama_kategori" value="{{ old('judul') ?? $buku->judul }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Author</label>
                <input id="nama_kategori" type="text" name="nama_kategori" value="{{ old('penulis') ?? $buku->penulis }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Penerbit</label>
                <input id="nama_kategori" type="text" name="nama_kategori" value="{{ old('penerbit') ?? $buku->penerbit }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Tahun Terbit</label>
                <input id="nama_kategori" type="text" name="nama_kategori" value="{{ old('tahun_terbit') ?? $buku->tahun_terbit }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Qty</label>
                <input id="nama_kategori" type="text" name="nama_kategori" value="{{ old('jumlah_tersedia') ?? $buku->jumlah_tersedia }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-6">
            <button type="submit" 
                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-600 rounded-md hover:bg-indigo-400 focus:outline-none focus:bg-gray-600">Submit</button>
                <a href="{{ route('buku.index') }}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">
                    Back
                </a>
        </div>
    </form>
</section>
@endsection
