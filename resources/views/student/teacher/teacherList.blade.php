@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container-fluid mt-3">
        <legend class="text-center">Teachers</legend>
        {{ $teacher->links() }}
        <div class="row">
            @foreach ($teacher as $item)
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">Phone - {{ $item->phone_number_one }}
                            </p>
                            <p class="card-text">Address - <b>{{ $item->region }}</b>
                            </p>
                            <p>Courses - {{ $item->courses }}</p>

                            <a href="{{ route('studentCourse', $item->id) }}" class="btn btn-sm btn-info float-right">Courses
                                by this teacher</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
