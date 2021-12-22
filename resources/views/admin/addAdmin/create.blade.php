@extends('layouts.adminDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('createSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a href="{{ route('adminAccountList') }}" class="btn btn-sm btn-outline-dark">Admin Account List</a>
        <legend class="text-center mb-3">Add Admin Account</legend>

        <form action="{{ route('createAdminAccount') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name"
                    value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p style="color: red">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email"
                    value="{{ old('email') }}">
            </div>
            @if ($errors->has('email'))
                <p style="color: red">{{ $errors->first('email') }}</p>
            @endif
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter password" name="password"
                    value="{{ old('password') }}">
            </div>
            @if ($errors->has('password'))
                <p style="color: red">{{ $errors->first('password') }}</p>
            @endif
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    @if (old('gender') == 'male')
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                    @elseif (old('gender') == 'female')
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                    @else
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    @endif
                </select>
                @if ($errors->has('gender'))
                    <p style="color: red">{{ $errors->first('gender') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control" placeholder="Enter your date of birth" name="dateOfBirth"
                    value="{{ old('dateOfBirth') }}">
            </div>
            @if ($errors->has('dateOfBirth'))
                <p style="color: red">{{ $errors->first('dateOfBirth') }}</p>
            @endif
            <div class="form-group">
                <label>Phone Number</label>
                <input type="number" class="form-control" placeholder="Enter your phone number" name="phone"
                    value="{{ old('phone') }}">
            </div>
            @if ($errors->has('phone'))
                <p style="color: red">{{ $errors->first('phone') }}</p>
            @endif
            <div class="form-group">
                <label>Region</label>
                <input type="text" class="form-control" placeholder="Enter your region" name="region"
                    value="{{ old('region') }}">
            </div>
            @if ($errors->has('region'))
                <p style="color: red">{{ $errors->first('region') }}</p>
            @endif
            <div class="form-group">
                <label>Town</label>
                <input type="text" class="form-control" placeholder="Enter your town" name="town"
                    value="{{ old('town') }}">
            </div>
            @if ($errors->has('town'))
                <p style="color: red">{{ $errors->first('town') }}</p>
            @endif
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter your address" name="address"
                    value="{{ old('address') }}">
            </div>
            @if ($errors->has('address'))
                <p style="color: red">{{ $errors->first('address') }}</p>
            @endif

            <button type="submit" class="btn btn-sm btn-primary mt-2">Create Account</button>
        </form>
        {{-- course form end --}}
    </div>
@endsection
