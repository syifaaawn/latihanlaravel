<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Mahasiswa</h1>
    <form method="POST" action="/mahasiswa">
        @csrf
        <input type="text" name="nama" placeholder="Nama"><br>
        <input type="text" name="nim" placeholder="NIM"><br>
        <input type="text" name="jurusan" placeholder="Jurusan"><br>

        <button type="submit">Simpan</button>
    </form>

    <h2>List Mahasiswa</h2>
    <ul>
        @foreach($data as $mhs)
            <li>{{ $mhs->nama }} - {{ $mhs->nim }} - {{ $mhs->jurusan }}</li>
        @endforeach
    </ul>
</body>
</html>
