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
        <legend>Course List</legend>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Explanation</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course as $item)
                    <tr>
                        <td>{{ $item->course_id }}</td>
                        <td>{{ $item['course_title'] }}</td>{{-- နှစ် နည်း ရ --}}
                        <td>{{ $item->course_explanation }}</td>
                        <td>{{ $item->course_details }}</td>
                        <td>
                            <a href="{{ route('updatePage', $item['course_id']) }}"><button
                                    class="btn btn-sm btn-secondary">Update</button></a>
                            <a href="{{ route('deleteCourse', $item->course_id) }}"><button
                                    class="btn btn-sm btn-danger">Delete</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
