@extends('template/index')
@section('content')
<div class="container mx-auto">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <div class="flex justify-center min-h-screen dark::bg-gray-900">
        <div class="col-span-12">
            {{-- <a href="{{ route('buku.create') }}"><button class="bg-indigo-600 text-white py-2 px-8 rounded-lg position-relative">New Data</button></a> --}}
            <div class="overflow-auto lg:overflow-visible ">
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="1bg-gray-800 text-gray-500">
                        <tr>
                            <th class="p-3">Id</th>
                            <th class="p-3 text-left">Title</th>
                            <th class="p-3 text-left">Author</th>
                            <th class="p-3 text-left">Penerbit</th>
                            <th class="p-3 text-left">Tahun Terbit</th>
                            <th class="p-3 text-left">Qty</th>
                            <th class="p-3">Make Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $bukus)
                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <div class="ml-3">
                                        <div class="font-bold">{{ $bukus->buku_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                {{ $bukus->judul }}
                            </td>
                            <td class="p-3 font-bold">
                                {{ $bukus->penulis }}
                            </td>
                            <td class="p-3">
                                {{ $bukus->penerbit }}
                            </td>
                            <td class="p-3">
                                <span class="bg-green-400 text-gray-50 rounded-md px-2">{{ $bukus->tahun_terbit }}</span>
                            </td>
                            <td class="p-3">
                                <span class="bg-green-400 text-gray-50 rounded-md px-2">{{ $bukus->jumlah_tersedia }}</span>
                            </td>
                            <td class="p-3 ">
                                <a href="{{ route('review.create')}}" class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="material-icons-outlined text-base">edit</i>
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $buku->links() }}
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

        tr td:nth-child(n+7),
        tr th:nth-child(n+7) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
@endsection