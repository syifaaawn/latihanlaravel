<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Matakuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

             @if(session('success'))
            @php
                $isDelete = str_contains(session('success'), 'hapus');
            @endphp

            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                x-transition
                class="mb-4 p-4 text-center text-black rounded-2xl border border-white/20
                    shadow-md backdrop-blur-lg 
                    {{ $isDelete ? 'bg-red-700/50' : 'bg-green-400/40' }}"
            >
                <p class="font-semibold text-base tracking-wide drop-shadow-md">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        @if ($errors->any())
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 4000)"
                x-transition
                class="mb-4 p-4 text-center text-gray rounded-2xl border border-white/20
                    shadow-md backdrop-blur-lg bg-red-400/40"
            >
                <ul class="list-disc list-inside inline-block text-left text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            {{-- Form Tambah Matakuliah --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="font-semibold text-lg mb-4">Tambah Matakuliah</h3>
                <form method="POST" action="{{ route('matakuliah.store') }}" class="space-y-4">
                    @csrf
                    <input type="text" name="matkul" placeholder="Matakuliah"
                        class="border-gray-300 text-black rounded-md w-full">

                    <input type="text" name="deskripsi" placeholder="Deskripsi"
                        class="border-gray-300  text-black rounded-md w-full">

                    <button type="submit"
                            class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700"  >
                        Simpan
                    </button>
                </form>
            </div>
        </div>


             {{-- List Matakuliah --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100" style="text-align: center">
                <h3 class="font-semibold text-lg mb-4">List Matakuliah</h3>
                <table class="table-auto w-full border">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 w-16 text-center">No</th>
                            <th class="px-4 py-2">Matakuliah</th>
                            <th class="px-4 py-2">Deskripsi</th>
                            

                            <th class="px-4 py-2 w-40 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $matkul)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $matkul->matkul }}</td>
                            <td class="border px-4 py-2">{{ $matkul->deskripsi }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('matakuliah.edit', $matkul->id) }}"
                                class="inline-block px-3 py-1 bg-gray-700 text-white rounded">Edit</a>

                                <form action="{{ route('matakuliah.destroy', $matkul->id) }}"
                                    method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Hapus data ini?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </div>
</x-app-layout>
