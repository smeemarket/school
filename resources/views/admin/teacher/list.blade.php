@extends('layouts.adminDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        {{-- @if (Session::has('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif --}}

        <legend>Teacher List</legend>
        {{ $teacher->links() }}
        <button class="btn btn-sm btn-success mb-3 float-right">Download CSV</button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Student Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teacher as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item['name'] }}</td>{{-- နှစ် နည်း ရ --}}
                        <td>{{ $item->email }}</td>
                        <td>{{ $item['gender'] }}</td>
                        <td>{{ $item->phone_number_one }}</td>
                        <td></td>
                        <td>
                            <a href="" class="btn btn-sm btn-secondary">More Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
