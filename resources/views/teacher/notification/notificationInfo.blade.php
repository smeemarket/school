@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        {{-- @if (Session::has('news'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('news') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif --}}

        <legend class="text-center mb-3">Notification</legend>
        <button class="btn btn-sm btn-success float-right mb-4">Download CSV</button>
        {{ $notification->links() }}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sender Name</th>
                    <th>Message</th>
                    <th>Send Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notification as $item)
                    <tr>
                        <td>{{ $item->notification_id }}</td>
                        <td>{{ $item['sender'] }}</td>{{-- နှစ် နည်း ရ --}}
                        <td>{{ $item->message }}</td>
                        <td>{{ $item->send_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
