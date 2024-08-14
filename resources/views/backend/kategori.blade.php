@extends('template/index')
@extends('template/backend/header')
@section('content2')
@include('template/backend/mobilenav')
<div class="container mx-auto">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <div class="flex min-h-screen dark::bg-gray-900 lg:ml-16">
        <div class="col-span-12">
            <a href="{{ route('kategori.create') }}"><button class="text-white bg-indigo-600 py-2 px-8 rounded-lg position-relative">New Data</button></a>
            <div class="overflow-auto lg:overflow-visible ">
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="text-gray-500">
                        <tr>
                            <th class="p-3">Id</th>
                            <th class="p-3 text-left pr-[845px]">Kategori</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $kategoris)
                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <div class="ml-3">
                                        <div class="font-bold">{{ $kategoris->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3 font-bold">
                                {{ $kategoris->nama_kategori }}
                            </td>
                            <td class="p-3 ">
                                <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                                    <i class="material-icons-outlined text-base">visibility</i>
                                </a>
                                <a href="{{ route('kategori.edit',$kategoris->id) }}" class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="material-icons-outlined text-base">edit</i>
                                </a>
                                <form action="{{ route('kategori.destroy', $kategoris->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-gray-100 ml-2">
                                        <i class="material-icons-round text-base">delete_outline</i>
                                    </button>
                                </form>
                                
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $kategori->links() }}
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

        tr td:nth-child(n+3),
        tr th:nth-child(n+3) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
@endsection