<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Dosen') }}
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

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 " >
                <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">NID</label>
                        <input type="text" name="nid" value="{{ old('nid', $dosen->nid) }}"
                            class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}"
                            class="border rounded w-full px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('nid', $dosen->alamat) }}"
                            class="border rounded w-full px-3 py-2">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
