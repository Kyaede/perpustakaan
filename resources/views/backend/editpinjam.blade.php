@extends('template/index')

@section('content')

<!-- component -->
<section class="max-w-4xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Edit Data Peminjaman</h1>
    <form action="{{ route('pinjam.update', $pinjam->peminjaman_id)}}" enctype="multipart/form-data" method="POST"> <!-- Perbarui method menjadi POST -->
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
                <label class="text-white dark:text-gray-200" for="user_id">Nama Pengguna</label>
                <select id="user_id" name="user_id" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $pinjam->user_id ? 'selected' : '' }}>{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="buku_id">Judul Buku</label>
                <select id="buku_id" name="buku_id" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @foreach ($buku as $item)
                        <option value="{{ $item->buku_id }}" {{ $item->buku_id == $pinjam->buku_id ? 'selected' : '' }}>{{ $item->judul }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Tanggal Peminjaman</label>
                <input id="nama_kategori" type="date" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman') ?? $pinjam->tanggal_peminjaman }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Tanggal Pengembalian</label>
                <input id="nama_kategori" type="date" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') ?? $pinjam->tanggal_pengembalian }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="status_peminjaman">Status</label>
                <select id="status_peminjaman" name="status_peminjaman" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <option value="Dipinjam" {{ $pinjam->status_peminjaman == 'diPinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ $pinjam->status_peminjaman == 'diKembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            
        </div>

        <div class="flex justify-end mt-6 gap-6">
            <button type="submit" 
                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-600 rounded-md hover:bg-indigo-400 focus:outline-none focus:bg-gray-600">Submit</button>
                <a href="{{ route('pinjam.index') }}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">
                    Back
                </a>
        </div>
    </form>
</section>
@endsection
