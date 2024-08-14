@extends('template/index')
@section('content')

<section class="max-w-4xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Ulasan Baru</h1>
    <form action="{{ route('review.store') }}" enctype="multipart/form-data" method="POST"> <!-- Perbarui aksi menjadi route untuk menyimpan kategori baru -->
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
                <label class="text-white dark:text-gray-200" for="nama_kategori">Review</label>
                <input id="penerbit" type="text" name="review" value="{{ old('review') }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="text-white dark:text-gray-200" for="nama_kategori">Rating 1-10</label>
                <input id="tahun_terbit" type="text" name="rating" value="{{ old('rating') }}"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-6">
            <button type="submit" 
                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-indigo-600 rounded-md hover:bg-indigo-400 focus:outline-none focus:bg-gray-600">Submit</button>
                    <a href="{{ route('home.index') }}" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Back</a>
        </div>
    </form>
</section>

<div class="container mx-auto">
    <h1 class="text-3xl text-center font-bold p-8 mt-10 text-gray-900">ALL REVIEW</h1>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <div class="flex justify-center min-h-screen dark::bg-gray-900">
        <div class="col-span-12">
            <div class="overflow-auto lg:overflow-visible ">
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="1bg-gray-800 text-gray-500">
                        <tr>
                            <th class="p-3">Id</th>
                            <th class="p-3 text-left">User Id</th>
                            <th class="p-3 text-left">Buku Id</th>
                            <th class="p-3 text-left pr-[580px]">Review</th>
                            <th class="p-3 text-left">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($review as $item)
                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <div class="ml-3">
                                        <div class="font-bold">{{ $item->ulasan_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                {{ $item->user_id }}
                            </td>
                            <td class="p-3">
                                {{ $item->buku_id }}
                            </td>
                            <td class="p-3 font-bold">
                                {{ $item->review }}
                            </td>
                            <td class="p-3">
                                <span class="bg-green-400 text-gray-50 rounded-md px-2">{{ $item->rating }}</span>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $review->links() }}
            </div>
        </div>
    </div>
    <style>
        .table {
            border-spacing: 0 15px;
        }

        i {
            font-size: 1rem !important;
        }

        .table tr {
            border-radius: 20px;
        }

        tr td:nth-child(n+5),
        tr th:nth-child(n+5) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
@endsection