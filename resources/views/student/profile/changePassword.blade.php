@extends('layouts.studentDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    {{-- <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-app-layout>
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-jet-section-border />
        @endif
    </x-app-layout>
    </div> --}}

    <div class="container mt-3">

        @include('student.profile.changePasswordError')

        <form action="{{ route('changePassword') }}" method="POST">
            @csrf
            <legend class="text-center mb-3">Change Password</legend>
            <div class="form-group">
                <label for="">Old Password</label>
                <input type="password" name="oldPassword" id="" class="form-control" value="{{ old('oldPassword') }}">
                @if ($errors->has('oldPassword'))
                    <p style="color: red">{{ $errors->first('oldPassword') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" name="newPassword" id="" class="form-control" value="{{ old('newPassword') }}">
                @if ($errors->has('newPassword'))
                    <p style="color: red">{{ $errors->first('newPassword') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="confirmPassword" id="" class="form-control"
                    value="{{ old('confirmPassword') }}">
                @if ($errors->has('confirmPassword'))
                    <p style="color: red">{{ $errors->first('confirmPassword') }}</p>
                @endif
            </div>
            <input type="submit" value="Change" class="btn btn-secondary mt-2">
        </form>
    </div>

@endsection
