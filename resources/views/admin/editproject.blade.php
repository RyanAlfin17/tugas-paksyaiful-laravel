@extends('admin.admin')
@section('title', 'editproject')
@section('content-title', 'Edit Project') <!-- Update the content title -->

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
                        <form action="{{ route('updateproject', ['id' => $project->id]) }}" enctype="multipart/form-data"
                            method="POST"> <!-- Update the form action and pass the project ID -->
                            @csrf
                            <input type="hidden" name="siswa_id" value="{{ $project->siswa->id }}">
                            <div class="form-group">
                                <label for="project_name">Project Name</label>
                                <input class="form-control" type="text" name="project_name" id=""
                                    value="{{ $project->project_name }}"> <!-- Prefill with existing project name -->
                            </div>
                            <div class="form-group">
                                <label for="project_date">Project Date</label>
                                <input class="form-control" type="date" name="project_date" id=""
                                    value="{{ $project->project_date }}"> <!-- Prefill with existing project date -->
                            </div>
                            <div class="form-group">
                                <label for="photo">Project Photo</label>
                                <input class="form-control" type="file" name="photo" id="">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                                <!-- Change the button text to "Update" -->
                                <button class="btn btn-danger" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
