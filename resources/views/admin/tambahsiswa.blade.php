    @extends('admin.admin')
    @section('title', 'tambahiswa')
    @section('content-title')

        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="./css/mastersiswa/tambahsiswa.css">
        </head>
        <h1>Tambah Data Siswa</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('storesiswa') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="about">Tentang:</label>
                <textarea name="about" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Foto:</label>
                <input type="file" name="photo" class="form-control-file" accept="image/*">
            </div>
            <a href="{{ route('mastersiswa') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>

        </form>

    @endsection
