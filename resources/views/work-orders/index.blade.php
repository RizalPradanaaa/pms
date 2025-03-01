<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Work Orders') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <form method="GET" action="{{ route('work-orders.index') }}" class="flex items-center gap-2">
                            <select name="status" id="status"
                                class="pl-3 pr-8 py-2 rounded-md bg-gray-50 dark:bg-gray-700 text-sm text-gray-700 dark:text-gray-300 border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Semua Status</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Canceled" {{ request('status') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                                class="px-3 py-2 rounded-md bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Tanggal">

                            <button type="submit"
                                class="flex items-center p-2 bg-blue-600 border border-transparent rounded-md text-white hover:bg-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35M16 11a5 5 0 11-10 0 5 5 0 0110 0z" />
                                </svg>
                            </button>
                        </form>


                        <a href="{{ route('work-orders.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-black text-white text-xs font-semibold uppercase rounded-md hover:bg-slate-700 transition">
                            Tambah
                        </a>
                    </div>



                    <table class="w-full min-w-full border-collapse">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                @foreach(['No.','No. WO', 'Nama Produk', 'Jumlah', 'Tenggat Waktu','Status', 'Aksi'] as $heading)
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                        {{ $heading }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                        {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $item->nomor_wo }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $item->nama_produk }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $item->jumlah }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($item->tenggat_waktu)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $item->status }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 flex space-x-2">
                                        <a href="{{ route('work-orders.edit', $item->id) }}"
                                           class="text-blue-600 hover:text-blue-800 transition">
                                            Edit
                                        </a>
                                        <button type="button"
                                                class="text-red-600 hover:text-red-800 transition"
                                                onclick="confirmDelete({{ $item->id }})">
                                            Hapus
                                        </button>
                                        <form id="delete-form-{{ $item->id }}"
                                              action="{{ route('work-orders.destroy', $item->id) }}"
                                              method="POST"
                                              class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100 text-center">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus!',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>
