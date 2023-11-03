@extends('admin.admin')
@section('title', 'masterproject')
@section('content-title', 'Tambah Project')

@section('content')


    @if (Session::has('message'))
        <div class="alert alert-danger">
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-header">
                        <h4>Data Siswa</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </thead>
                            @foreach ($siswas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" onclick="show({{ $item->id }})"><i
                                                class="fas fa-folder-open"></i></a>
                                        <a class="btn btn-sm btn-primary" href="{{ route('tambahproject', $item->id) }}"><i
                                                class="fas fa-plus"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-header">
                        <h4>Data Project</h4>
                    </div>
                    <div class="card-body" id="resource">
                        <p class="text-center">Silahkan Pilih Data Siswa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function show(id) {
            $.get('resource/' + id, function(data) {
                $('#resource').html(data);
            })
        }
    </script>
@endsection
