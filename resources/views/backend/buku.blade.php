@extends('template/index')
@extends('template/backend/header')
@section('content2')
@include('template/backend/mobilenav')
<div class="container mx-auto">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <div class="flex justify-center min-h-screen dark::bg-gray-900">
        <div class="col-span-12">
            <a href="{{ route('buku.create') }}"><button class="bg-indigo-600 text-white py-2 px-8 rounded-lg position-relative">New Data</button></a>
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
                            <th class="p-3">Action</th>
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
                                <a href="#" class="text-gray-400 hover:text-gray-100 mr-2" onclick="openModal('{{ $bukus->buku_id }}')">
                                    <i class="material-icons-outlined text-base">visibility</i>
                                </a>
                                
                                <!-- Main modal -->
                                <div id="modal-{{ $bukus->buku_id }}" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Detail Buku
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-{{ $bukus->buku_id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                    Id : {{ $bukus->buku_id }}<br>
                                                    Title : {{ $bukus->judul }}<br>
                                                    Author : {{ $bukus->penulis }}<br>
                                                    Penerbit : {{ $bukus->penerbit }}<br>
                                                    Tahun Terbit : {{ $bukus->tahun_terbit }}<br>
                                                    Qty : {{ $bukus->jumlah_tersedia }}<br>
                                                    Di Tambahkan : {{ $bukus->created_at }}<br>
                                                    Di Ubah : {{ $bukus->updated_at }}
                                                </p>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 justify-end">
                                                <button data-modal-hide="modal-{{ $bukus->buku_id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button>
                                                {{-- <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <script>
                                    // JavaScript untuk menampilkan modal
                                    function openModal(modalId) {
                                        const modal = document.getElementById('modal-' + modalId);
                                        modal.classList.remove('hidden');
                                        centerModal(modalId); // Panggil fungsi centerModal saat modal ditampilkan
                                    }
                                
                                    // JavaScript untuk menutup modal saat tombol "Back" diklik
                                    document.querySelectorAll('[data-modal-hide]').forEach(button => {
                                        button.addEventListener('click', event => {
                                            const modalId = button.getAttribute('data-modal-hide');
                                            const modal = document.getElementById(modalId);
                                            modal.classList.add('hidden');
                                        });
                                    });
                                    
                                </script>

                                <a href="{{ route('buku.edit',['buku' => $bukus->buku_id]) }}" class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="material-icons-outlined text-base">edit</i>
                                </a>
                                <form action="{{ route('buku.destroy', $bukus->buku_id) }}" method="POST" style="display: inline;">
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