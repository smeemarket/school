@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('courseSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('courseSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- course form open --}}
        <form action="{{ route('createCourse') }}" method="POST">
            @csrf
            <legend class="text-center mb-3">Create Course</legend>
            <div class="form-group">
                <label>Course Title</label>
                <input type="text" class="form-control" placeholder="Enter course title" name="courseTitle"
                    value="{{ old('courseTitle') }}">
                @if ($errors->has('courseTitle'))
                    <p style="color: red">{{ $errors->first('courseTitle') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Course Explanation</label>
                <textarea name="courseExplanation" id="" rows="3" class="form-control"
                    placeholder="Enter course explanation">{{ old('courseExplanation') }}</textarea>
                @if ($errors->has('courseExplanation'))
                    <p style="color: red">{{ $errors->first('courseExplanation') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Course Details</label>
                <textarea name="courseDetails" id="" rows="5" class="form-control"
                    placeholder="Enter course details">{{ old('courseDetails') }}</textarea>
                @if ($errors->has('courseDetails'))
                    <p style="color: red">{{ $errors->first('courseDetails') }}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        {{-- course form end --}}
    </div>
@endsection
