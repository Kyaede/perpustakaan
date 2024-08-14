@extends('template/index')
@extends('template/backend/header')
@section('content2')
@include('template/backend/mobilenav')
<div class="container mx-auto">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <div class="flex justify-center min-h-screen dark::bg-gray-900">
        <div class="col-span-12">
            <a href=""><button class="bg-indigo-600 text-white py-2 px-8 rounded-lg position-relative" onclick="printPage()">Print All</button></a>
            <script>
                function printPage() {
                    window.print();
                }
            </script>
            <div class="overflow-auto lg:overflow-visible ">
                <table class="table text-gray-400 border-separate space-y-6 text-sm">
                    <thead class="1bg-gray-800 text-gray-500">
                        <tr>
                            <th class="p-3">Id</th>
                            <th class="p-3 text-left">User Id</th>
                            <th class="p-3 text-left">Buku Id</th>
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-left">Return Date</th>
                            <th class="p-3 text-left">Denda</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3">Print Row</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjam as $pinjams)
                        @php
                        // Hitung selisih hari
                        $tanggal_peminjaman = new DateTime($pinjams->tanggal_peminjaman);
                        $tanggal_pengembalian = new DateTime($pinjams->tanggal_pengembalian);
                        $selisih_hari = $tanggal_peminjaman->diff($tanggal_pengembalian)->days;
                        $tarif_denda = 2000;
                    
                        // Jika lebih dari 3 hari, berikan denda
                        $denda = ($selisih_hari > 3) ? ($selisih_hari - 3) * $tarif_denda : 0;
                    @endphp
                    
                        <tr class="bg-gray-800">
                            <td class="p-3">
                                <div class="flex align-items-center">
                                    <div class="ml-3">
                                        <div class="font-bold">{{ $pinjams->peminjaman_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                {{ $pinjams->user_id }}
                            </td>
                            <td class="p-3 font-bold">
                                {{ $pinjams->buku_id }}
                            </td>
                            <td class="p-3">
                                {{ $pinjams->tanggal_peminjaman }}
                            </td>
                            <td class="p-3">
                                {{ $pinjams->tanggal_pengembalian }}
                            </td>
                            <td class="p-3">
                                {{ $denda }}
                            </td>
                            <td class="p-3">
                                <span class="bg-green-400 text-gray-50 rounded-md px-2">{{ $pinjams->status_peminjaman }}</span>
                            </td>
                            <td class="p-3 ">
                                <a href="{{ route('laporan.edit',['laporan' => $pinjams->peminjaman_id]) }}" class="text-gray-400 hover:text-gray-100  mx-2">
                                    <i class="material-icons-outlined text-base">edit</i>
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $pinjam->links() }}
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

        tr td:nth-child(n+8),
        tr th:nth-child(n+8) {
            border-radius: 0 .625rem .625rem 0;
        }

        tr td:nth-child(1),
        tr th:nth-child(1) {
            border-radius: .625rem 0 0 .625rem;
        }
    </style>
</div>
@endsection