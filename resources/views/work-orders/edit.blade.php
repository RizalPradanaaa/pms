<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Work Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('work-orders.update', $workOrder->id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="nomor_wo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Work Order
                        </label>
                        <input type="text" name="nomor_wo" id="nomor_wo" value="{{ $workOrder->nomor_wo }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Otomatis" readonly>
                    </div>

                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Produk
                        </label>
                        <input type="text" name="nama_produk" id="nama_produk" value="{{ $workOrder->nama_produk }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Masukkan Nama Produk" required>
                    </div>

                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jumlah
                        </label>
                        <input type="number" name="jumlah" id="jumlah" value="{{ $workOrder->jumlah }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Masukkan Jumlah" required>
                    </div>

                    <div>
                        <label for="tenggat_waktu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tenggat Waktu Produksi
                        </label>
                        <input type="date" name="tenggat_waktu" id="tenggat_waktu" value="{{ $workOrder->tenggat_waktu }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               required>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </label>
                        <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                            <option value="Pending" {{ $workOrder->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ $workOrder->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ $workOrder->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Canceled" {{ $workOrder->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>

                    <div>
                        <label for="operator_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pilih Operator
                        </label>
                        <select name="operator_id" id="operator_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                            @foreach ($operator as $item)
                                <option value="{{ $item->id }}" {{ $workOrder->operator_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 flex justify-end gap-4 mt-6">
                        <a href="{{ route('work-orders.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memperbarui Data',
                    html: '{!! implode('<br>', $errors->all()) !!}'
                });
            @endif
        });
    </script>
</x-app-layout>
