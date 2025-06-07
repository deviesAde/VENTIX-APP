@extends('layouts.organizer')

@section('title', 'Event Saya')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Event</h2>
        <a href="{{ route('organizer.events.create') }}" class="bg-[#FF9898] hover:bg-[#FF7A7A] text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Buat Event Baru
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach([
                        ['id' => 1, 'name' => 'Konser Jazz Night', 'date' => '2023-07-15', 'location' => 'Jakarta', 'tickets' => '450/500', 'status' => 'Aktif', 'status_color' => 'green'],
                        ['id' => 2, 'name' => 'Tech Conference 2023', 'date' => '2023-08-22', 'location' => 'Bandung', 'tickets' => '320/500', 'status' => 'Aktif', 'status_color' => 'green'],
                        ['id' => 3, 'name' => 'Food Festival', 'date' => '2023-09-05', 'location' => 'Surabaya', 'tickets' => '180/300', 'status' => 'Aktif', 'status_color' => 'green'],
                        ['id' => 4, 'name' => 'Art Exhibition', 'date' => '2023-06-10', 'location' => 'Yogyakarta', 'tickets' => '120/200', 'status' => 'Selesai', 'status_color' => 'blue'],
                        ['id' => 5, 'name' => 'Music Festival', 'date' => '2023-10-12', 'location' => 'Bali', 'tickets' => '0/1000', 'status' => 'Draft', 'status_color' => 'yellow']
                    ] as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-[#FFD586] rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $event['name'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ date('d M Y', strtotime($event['date'])) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $event['location'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $event['tickets'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $event['status_color'] }}-100 text-{{ $event['status_color'] }}-800">
                                {{ $event['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="#" class="text-[#FF9898] hover:text-[#FF7A7A] mr-3"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
