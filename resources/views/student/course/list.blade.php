@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container-fluid mt-3">
            {{ $course->links() }}

        <div class="row">
            @foreach ($course as $item)
                <div class="col-sm-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->course_title }}</h5>
                            <p class="card-text">{{ $item->course_explanation }}
                            </p>
                            <p class="card-text">Teacher - <b>{{ $item->name }}</b>
                            </p>
                            <a href="{{ route('lookCourse',$item->course_id) }}" class="btn btn-sm btn-info float-right">Look Info</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
