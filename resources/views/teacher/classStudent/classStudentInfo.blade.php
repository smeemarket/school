@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('classStudent'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('classStudent') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <legend>Class Student</legend>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Student Attend Class Name</th>
                    <th>Request Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classStudent as $item)
                    <tr>
                        <td>{{ $item->class_student_id }}</td>
                        <td>{{ $item['name'] }}</td>{{-- နှစ် နည်း ရ --}}
                        <td>{{ $item->class_name }}</td>
                        <td>{{ $item['created_at'] }}</td>
                        <td>
                            <a href=""><button class="btn btn-sm btn-success">Accept</button></a>
                            <a href=""><button class="btn btn-sm btn-warning">Student Full</button></a>
                            <a href=""><button class="btn btn-sm btn-danger">Reject</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
