@extends('layouts.adminDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-5">
        {{-- @if (Session::has('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif --}}

        <div class="card">
            <div class="card-header text-center">

                <span>Teacher Information</span>
                <span>
                    <a href="{{ route('teacher') }}" class="btn btn-sm btn-dark float-right">Back</a>
                </span>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->gender }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->phone_number_one }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Region</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->region }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Town</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->town }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" readonly name="" id="" class="form-control-plaintext"
                            value="{{ $teacher->address }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
