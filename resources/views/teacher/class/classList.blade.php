@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('updateSuccess'))
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                {{ Session::get('updateSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <legend>Class List</legend>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course-Title</th>
                    <th>Class-Name</th>
                    <th>Class-Fee</th>
                    <th>Start-Date</th>
                    <th>End-Date</th>
                    <th>Class-Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classData as $item)
                    <tr>
                        <td>{{ $item->class_id }}</td>
                        <td>{{ $item->course_title }}</td>
                        <td>{{ $item->class_name }}</td>
                        <td>{{ $item->fee }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->end_date }}</td>
                        <td>{{ $item->class_type }}</td>
                        <td>
                            <a href="{{ route('updateClassPage',$item->class_id) }}"><button class="btn btn-sm btn-secondary">Update</button></a>
                            <a href="{{ route('deleteClass',$item->class_id) }}"><button class="btn btn-sm btn-danger">Delete</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
