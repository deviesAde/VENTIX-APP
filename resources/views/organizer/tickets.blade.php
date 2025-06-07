@extends('layouts.organizer')

@section('title', 'Manajemen Stok Tiket')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Stok Tiket</h2>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600">Event:</span>
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                <option>Konser Jazz Night</option>
                <option>Festival Teknologi</option>
                <option>Pameran Seni Modern</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Tiket</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Tersedia</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Awal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">Early Bird</div>
                        <div class="text-gray-500 text-sm">Berlaku sampai 15 Juli 2023</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">Rp 150.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">85</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">15</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">100</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-[#FF9898] hover:text-[#FF7A7A] font-medium" onclick="openAddStockModal('Early Bird')">
                            Tambah Stok
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">Regular</div>
                        <div class="text-gray-500 text-sm">Berlaku sampai 30 Juli 2023</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">Rp 250.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">120</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">80</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">200</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-[#FF9898] hover:text-[#FF7A7A] font-medium" onclick="openAddStockModal('Regular')">
                            Tambah Stok
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">VIP</div>
                        <div class="text-gray-500 text-sm">Berlaku sampai 30 Juli 2023</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">Rp 500.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">45</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">50</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-[#FF9898] hover:text-[#FF7A7A] font-medium" onclick="openAddStockModal('VIP')">
                            Tambah Stok
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Stok -->
    <div id="addStockModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Tambah Stok Tiket</h3>
                <button onclick="closeAddStockModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Jenis Tiket</label>
                    <input type="text" id="ticketType" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Jumlah Stok Tambahan</label>
                    <input type="number" id="additionalStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" placeholder="Masukkan jumlah">
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <button onclick="closeAddStockModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button onclick="submitAdditionalStock()" class="px-4 py-2 bg-[#FF9898] hover:bg-[#FF7A7A] text-white rounded-lg">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function openAddStockModal(ticketType) {
        document.getElementById('ticketType').value = ticketType;
        document.getElementById('addStockModal').classList.remove('hidden');
    }

    function closeAddStockModal() {
        document.getElementById('addStockModal').classList.add('hidden');
        document.getElementById('additionalStock').value = '';
    }

    function submitAdditionalStock() {
        const ticketType = document.getElementById('ticketType').value;
        const additionalStock = document.getElementById('additionalStock').value;

        if (!additionalStock || isNaN(additionalStock) {
            alert('Masukkan jumlah stok yang valid');
            return;
        }

        // Di sini biasanya ada AJAX request untuk menyimpan ke database
        alert(`Berhasil menambahkan ${additionalStock} stok untuk tiket ${ticketType}`);
        closeAddStockModal();

        // Di aplikasi nyata, Anda akan memperbarui tabel setelah sukses
    }
</script>
@endsection
@endsection
