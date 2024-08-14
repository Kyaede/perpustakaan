@extends('template/index')
@extends('template/backend/header')
@section('content2')
@include('template/backend/mobilenav')
<div class="container mx-auto">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <div class="flex justify-center min-h-screen dark::bg-gray-900">
        <div class="col-span-12">
            <a href="{{ route('ulasan.create') }}"><button class="bg-indigo-600 text-white py-2 px-8 rounded-lg position-relative">New Data</button></a>
            <div class="overflow-auto lg:overflow-visible ">
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="1bg-gray-800 text-gray-500">
                        <tr>
                            <th class="p-3">Id</th>
                            <th class="p-3 text-left">User Id</th>
                            <th class="p-3 text-left">Buku Id</th>
                            <th class="p-3 text-left">Review</th>
                            <th class="p-3 text-left">Rating</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($review as $reviews)
                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <div class="ml-3">
                                        <div class="font-bold">{{ $reviews->ulasan_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                {{ $reviews->user_id }}
                            </td>
                            <td class="p-3">
                                {{ $reviews->buku_id }}
                            </td>
                            <td class="p-3 font-bold">
                                {{ $reviews->review }}
                            </td>
                            <td class="p-3">
                                <span class="bg-green-400 text-gray-50 rounded-md px-2">{{ $reviews->rating }}</span>
                            </td>
                            <td class="p-3 ">
                                <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                                    <i class="material-icons-outlined text-base">visibility</i>
                                </a>
                                <a href="{{ route('ulasan.edit',['ulasan' => $reviews->ulasan_id]) }}" class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="material-icons-outlined text-base">edit</i>
                                </a>
                                <form action="{{ route('ulasan.destroy', $reviews->ulasan_id) }}" method="POST" style="display: inline;">
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

        tr td:nth-child(n+6),
        tr th:nth-child(n+6) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
@endsection