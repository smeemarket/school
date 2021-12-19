@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container-fluid mt-3">
        {{ $class->links() }}
        @if (Session::has('classAttendSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('classAttendSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            @foreach ($class as $item)
                <div class="col-md-6 mt-3 float-left">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->class_name }}</h5>
                            <hr>
                            <p class="card-text">{{ $item->fee }}
                            </p>
                            <p>Class Type : <b>{{ $item->class_type }}</b></p>
                            <p>Time : {{ $item->start_date }} ~ {{ $item->end_date }}</p>
                            <p>Teacher - {{ $item->name }}</p>
                            <a href="{{ route('enrollClass', [$item->class_id,$item->user_id]) }}"
                                class="btn btn-sm btn-secondary float-right">Enroll</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
