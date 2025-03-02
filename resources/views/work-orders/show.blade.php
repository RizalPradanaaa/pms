<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Work Order Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label for="nomor_wo" class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                            Nomor Work Order :
                        </label>
                        <input type="text" name="nomor_wo" id="nomor_wo" value="{{ $workOrder->nomor_wo }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 text-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed"
                               placeholder="Otomatis" readonly>
                    </div>
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Produk :
                        </label>
                        <input type="text" name="nama_produk" id="nama_produk" value="{{ $workOrder->nama_produk }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 text-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed"
                               readonly>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jumlah :
                        </label>
                        <input type="number" name="jumlah" id="jumlah" value="{{ $workOrder->jumlah }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 text-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed"
                             readonly>
                    </div>
                    <div>
                        <label for="tenggat_waktu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tenggat Waktu Produksi :
                        </label>
                        <input type="date" name="tenggat_waktu" id="tenggat_waktu" value="{{ $workOrder->tenggat_waktu }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 text-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed"
                               readonly>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status :
                        </label>
                        <input type="text" name="status" id="status" value="{{ $workOrder->status }}"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 text-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed"
                               readonly>
                    </div>
                    <div>
                        <label for="nama_operator" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Operator :
                        </label>
                        <input type="text" name="nama_operator" id="nama_operator" value="{{ $workOrder->operator->name }}"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-200 text-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 cursor-not-allowed"
                               readonly>
                    </div>







                    <div class="col-span-2 flex justify-end gap-4 mt-6">
                        <a href="{{ route('work-orders.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Riwayat Perubahan Status -->
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Riwayat Perubahan Status</h2>
                    <div class="border-l-2 border-blue-500 pl-4">
                        @foreach($workOrder->statusLogs as $log)
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-500',
                                    'In Progress' => 'bg-blue-500',
                                    'Completed' => 'bg-green-500',
                                    'Canceled' => 'bg-red-500',
                                ];
                                $color = $statusColors[$log->status_baru] ?? 'bg-gray-500';
                            @endphp

                        <div class="relative mb-6">

                            <div class="absolute -left-6 top-4 w-4 h-4 {{ $color }} rounded-full"></div>
                            <div class="ml-6">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $log->created_at->format('H:i d-m-Y') }}
                                    </span>
                                    <span class="px-2 py-1 text-xs font-semibold {{ $color }} text-white rounded-md">
                                        {{ $log->status_baru }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    Status : {{ $log->status_lama }} ➡️ {{ $log->status_baru }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Quantity Perubahan : {{ $log->quantity_selesai ?? '-' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Keterangan : {{ $log->keterangan ?? '-' }}
                                </p>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
