@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('news'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('news') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <legend class="text-center mb-3">Requested Course List</legend>
        {{ $news->links() }}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Request Course Title</th>
                    <th>Request course Details</th>
                    <th>Request Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->course_request_id }}</td>
                        <td>{{ $item['name'] }}</td>{{-- နှစ် နည်း ရ --}}
                        <td>{{ $item->course_request_title }}</td>
                        <td>{{ $item->course_request_details }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
