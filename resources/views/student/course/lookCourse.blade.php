@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">

        <div class="row">
            @foreach ($courseData as $item)
                <div class="col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <Legend>Teacher - {{ $item->name }}</Legend>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->course_title }}</h5>
                            <p class="card-text">{{ $item->course_explanation }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="btn btn-sm btn-primary mt-2" onclick="goBack()">Back</button>
        <br>
        <hr width="30%">
        <div class="row">
            @if (empty($relatedClass->toArray()))
                <div class="col-12">
                    <legend>Related Classes</legend>
                    <p style="color:red">There is no related class for this course.</p>
                </div>
            @else
                <div class="col-12">
                    @if (Session::has('classAttendSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('classAttendSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <legend>Related Classes</legend>
                    @foreach ($relatedClass as $item)
                        <div class="col-md-6 mt-3 float-left">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->class_name }}</h5>
                                    <hr>
                                    <p class="card-text">Fee - <b>{{ $item->fee }}</b>
                                    </p>
                                    <p>Class Type : <b>{{ $item->class_type }}</b></p>
                                    <p>Time : <b>{{ $item->start_date }} ~ {{ $item->end_date }}</b></p>
                                    @if ($item->status == 0)
                                        <a href="{{ route('enrollClass', [$item->class_id, $item->id]) }}"
                                            class="btn btn-sm btn-success float-right">Enroll</a>
                                    @elseif ($item->status == 2)
                                        <p class="text-success">You can join the class.</p>
                                    @elseif ($item->status == 3)
                                        <p class="text-info">Student full...</p>
                                    @elseif ($item->status == 4)
                                        <p class="text-danger">Teacher rejected this class.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
