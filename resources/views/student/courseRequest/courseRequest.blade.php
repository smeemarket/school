@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('requestSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('requestSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('requestCourse') }}" method="POST">
            @csrf
            <legend class="mb-4 text-center">Course Request</legend>
            <div class="form-group">
                <label>Request Course Title</label>
                <input type="text" class="form-control" name="courseRequestTitle" value="{{ old('courseRequestTitle') }}">
                @if ($errors->has('courseRequestTitle'))
                    <p style="color: red">{{ $errors->first('courseRequestTitle') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Requset Course Details</label>
                <textarea name="courseRequestDetails" id="" rows="3" class="form-control">{{ old('courseRequestDetails') }}</textarea>
            </div>
            @if ($errors->has('courseRequestDetails'))
                <p style="color: red">{{ $errors->first('courseRequestDetails') }}</p>
            @endif

            <button type="submit" class="btn btn-primary mt-2">Request</button>
        </form>
    </div>
@endsection
