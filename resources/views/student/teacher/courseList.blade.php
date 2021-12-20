@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif
    <div class="container-fluid mt-3">
        <legend class="text-center">
            Courses
        </legend>
        <button class="btn btn-sm btn-secondary float-right" onclick="goBack()">Back</button>
        {{ $course->links() }}
        <div class="row">
            @foreach ($course as $item)
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Course Title - <b>{{ $item->course_title }}</b></h5>
                            <p class="card-text">{{ $item->course_explanation }}
                            </p>
                            <p>Teacher - {{ $item->name }}</p>
                            <a href="{{ route('lookCourse', $item->course_id) }}"
                                class="btn btn-sm btn-info float-right">Classes by this course</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
