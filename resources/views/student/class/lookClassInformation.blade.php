@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">

        <div class="row">
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header text-center">
                        <legend class="text-center mb-3">Class Title - {{ $class[0]->class_name }}</Legend>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Class Fee - {{ $class[0]->fee }}</h5>
                        <p class="card-text">Start Time - {{ $class[0]->start_time }} : {{ $class[0]->end_time }}
                        </p>
                        <p class="card-text">Start Date - {{ $class[0]->start_date }} : {{ $class[0]->end_date }}
                        </p>
                        <p class="card-text">Class Type - {{ $class[0]->class_type }}
                        </p>
                        @if ($status == 2)
                            <p class="text-success">You can join the class.</p>
                        @elseif ($status == 3)
                            <p class="text-info">Student full...</p>
                        @elseif ($status == 4)
                            <p class="text-danger">Teacher rejected this class.</p>
                        @elseif ($status == 1)
                            <p class="text-warning">Wait teacher response.</p>
                        @elseif ($status == null)
                            <a href="{{ route('enrollClass', [$class[0]->class_id, $class[0]->user_id]) }}"
                                class="btn btn-sm btn-success float-right">Enroll</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-sm btn-primary mt-2" onclick="goBack()">Back</button>
    </div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
