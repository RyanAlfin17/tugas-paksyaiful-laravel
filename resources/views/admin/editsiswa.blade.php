@extends('admin.admin')
@section('title', 'editsiswa')
@section('content-title')

@section('content')

    <div class="container">
        <form method="POST" action="{{ route('updatesiswa', ['id' => $siswa->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $siswa->name }}">
                </div>
                <div class="col-md-6">
                    <label for="about" class="form-label">Tentang:</label>
                    <textarea id="about" name="about" rows="4" class="form-control">{{ $siswa->about }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="photo" class="form-label">Foto Lama:</label>
                    <img src="{{ asset('path_to_old_photo/' . $siswa->photo) }}" alt="Foto Lama" width="100">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="new_photo" class="form-label">Foto Baru:</label>
                    <input type="file" id="new_photo" name="new_photo" class="form-control-file" accept="image/*">
                </div>
            </div>
            <a href="{{ route('mastersiswa') }}" class="btn btn-secondary">Kembali ke Mastersiswa</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

@endsection
