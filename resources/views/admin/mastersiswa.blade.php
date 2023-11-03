@extends('admin.admin')
@section('title', 'mastersiswa')
@section('content-title')



    <h1>Master Siswa</h1>
    <a href="{{ route('tambahsiswa') }}" class="btn btn-primary">Tambah Siswa</a>

    @if (Session::has('message'))
        <div class="alert alert-danger">
            {{ Session::get('message') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tentang</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswaList as $siswa)
                <tr>
                    <td>{{ $siswa->name }}</td>
                    <td>{{ $siswa->about }}</td>
                    <td><img src="{{ asset('storage/photos/' . $siswa->photo) }}" alt="{{ $siswa->name }}" width="50%">
                    </td>
                    <td>
                        <a href="{{ route('editsiswa', $siswa->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('deletesiswa', $siswa->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
