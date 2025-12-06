<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Navigation Menu') }}
        </h2>
    </x-slot>

    <div x-data="navPage()" x-cloak class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 dark:text-green-900 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Tambah --}}
            <div class="mb-6">
                <button @click="openCreateModal()"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Menu
                </button>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4 text-gray-800 dark:text-white">
                        Daftar Navigation Menu
                    </h3>

                    <table class="table-auto w-full border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-white">
                            <tr>
                                <th class="px-4 py-2 w-16 text-center">Pos</th>
                                <th class="px-4 py-2">Label</th>
                                <th class="px-4 py-2">URL</th>
                                <th class="px-4 py-2 text-center w-24">Status</th>
                                <th class="px-4 py-2 text-center w-40">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td class="border px-4 py-2 text-center text-gray-800 dark:text-white">
                                    {{ $item->position }}
                                </td>
                                <td class="border px-4 py-2 text-gray-800 dark:text-white">
                                    {{ $item->label }}
                                </td>
                                <td class="border px-4 py-2 text-gray-800 dark:text-white">
                                    {{ $item->url }}
                                </td>

                                <td class="border px-4 py-2 text-center">
                                    <span class="px-4 py-1 rounded text-white {{ $item->status ? 'bg-green-600' : 'bg-red-600' }}">
                                        {{ $item->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                <td class="border px-4 py-2 text-center">
                                    {{-- EDIT --}}
                                    <button @click='openEditModal(@json($item))'
                                        class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Edit
                                    </button>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.landing.navigation.destroy', $item->id) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Hapus menu ini?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- MODAL CREATE --}}
        <div x-show="showCreate" x-cloak
            class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
            x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-96 shadow-lg">

                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Tambah Menu Navigasi
                </h2>

                <form method="POST" action="{{ route('admin.landing.navigation.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">Label</label>
                        <input type="text" name="label"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">URL</label>
                        <input type="text" name="url"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">Position</label>
                        <input type="number" name="position"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">Status</label>
                        <select name="status"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="showCreate=false"
                            class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Batal
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div x-show="showEdit" x-cloak
            class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
            x-transition>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-96 shadow-lg">

                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">
                    Edit Menu
                </h2>

                <form method="POST" :action="'/admin/landing/navigation/' + editData.id" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">Label</label>
                        <input type="text" name="label" x-model="editData.label"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">URL</label>
                        <input type="text" name="url" x-model="editData.url"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">Position</label>
                        <input type="number" name="position" x-model="editData.position"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block mb-1 text-gray-800 dark:text-white">Status</label>
                        <select name="status" x-model="editData.status"
                            class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="closeEditModal()"
                            class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                            Batal
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- ALPINE CONTROLLER --}}
    <script>
        function navPage() {
            return {
                showCreate: false,
                showEdit: false,
                editData: {},

                openCreateModal() {
                    this.editData = {};
                    this.showCreate = true;
                },

                openEditModal(item) {
                    this.editData = {
                        id: item.id,
                        label: item.label,
                        url: item.url,
                        position: item.position,
                        status: item.status,
                    };
                    this.showEdit = true;
                },

                closeEditModal() {
                    this.showEdit = false;
                    this.editData = {};
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

</x-app-layout>
