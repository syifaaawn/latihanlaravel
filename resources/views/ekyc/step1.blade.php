<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
        <div class="text-xl font-semibold mb-4 text-center">EKYC - Langkah 1: Data Pribadi</div>

        @if (session('success'))
            <div class="bg-green-200 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-3 mb-4 rounded">
                <strong>Perhatian!</strong> Terdapat kesalahan pada input:
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ekyc.storeStep1') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $ekyc->nama ?? '') }}" class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $ekyc->nik ?? '') }}" class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $ekyc->tanggal_lahir ?? '') }}" class="w-full border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded-md p-2">{{ old('alamat', $ekyc->alamat ?? '') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Lanjut Step 2
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
