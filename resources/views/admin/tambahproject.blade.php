@extends('admin.admin')
@section('title', 'tambahproject')
@section('content-title', 'Tambah Project')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-header">
                        <a href="{{ route('resource.index') }}" class="btn btn-info">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('resource.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                            <div class="form-group">
                                <label for="project_name">Project Name</label>
                                <input class="form-control" type="text" name="project_name" id="">
                            </div>
                            <div class="form-group">
                                <label for="project_date">Project Date</label>
                                <input class="form-control" type="date" name="project_date" id="">
                            </div>
                            <div class="form-group">
                                <label for="photo">Project Photo</label>
                                <input class="form-control" type="file" name="photo" id="">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                                <button class="btn btn-danger" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
