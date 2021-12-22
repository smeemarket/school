@extends('layouts.adminDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('sendNotification') }}" method="POST">
            @csrf
            <legend class="text-center mb-3">Send Notification</legend>
            <div class="form-group">
                <label>Message</label>
                <textarea rows="5" type="text" class="form-control" placeholder="Enter your message"
                    name="message"></textarea>
                {{-- @if ($errors->has('courseTitle'))
                <p style="color: red">{{ $errors->first('courseTitle') }}</p>
                @endif --}}
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
@endsection
