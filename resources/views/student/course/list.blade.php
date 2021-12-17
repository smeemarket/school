@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container-fluid mt-3">
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
                            <a href="#" class="btn btn-sm btn-success float-right">Enroll</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
