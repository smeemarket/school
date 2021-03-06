@extends('layouts.adminDesign')

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

        <legend class="text-center mb-3">Admin Account List</legend>
        <button class="btn btn-sm btn-success float-right mb-4">Download CSV</button><a href="{{ route('addAdmin') }}"
            class="btn btn-sm btn-primary">Back</a>
        {{-- {{ $admin->links() }} --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Region</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item['name'] }}</td>{{-- နှစ် နည်း ရ --}}
                        <td>{{ $item->email }}</td>
                        <td>{{ $item['gender'] }}</td>
                        <td>{{ $item->phone_number_one }}</td>
                        <td>{{ $item->region }}</td>
                        <td>
                            <a href="{{ route('deleteAdminAccount', $item->id) }}"
                                class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
