@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('updateSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- course form open --}}
        <form action="{{ route('updateTeacherProfile') }}" method="POST">
            @csrf
            <legend class="text-center mb-3">Profile</legend>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter your name" name="name"
                    value="{{ old('name', $profileData->name) }}">
                @if ($errors->has('name'))
                    <p style="color: red">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email"
                    value="{{ old('email', $profileData->email) }}">
                @if ($errors->has('email'))
                    <p style="color: red">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>DOB</label>
                <input type="date" class="form-control" placeholder="Enter your date of birth" name="dateOfBirth"
                    value="{{ old('dateOfBirth', $profileData->date_of_birth) }}">
                @if ($errors->has('dateOfBirth'))
                    <p style="color: red">{{ $errors->first('dateOfBirth') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="gender" id="">
                    @if ($profileData->gender == 'male')
                        @if (old('gender') == 'male')
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        @elseif (old('gender') == 'female')
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                        @else
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        @endif
                    @elseif ($profileData->gender == 'female')
                        @if (old('gender') == 'male')
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        @elseif (old('gender') == 'female')
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                        @else
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                        @endif
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label>Primary Phone Number</label>
                <input type="number" class="form-control" placeholder="Enter your phone number" name="phoneNumberOne"
                    value="{{ old('phoneNumberOne', $profileData->phone_number_one) }}">
                @if ($errors->has('phoneNumberOne'))
                    <p style="color: red">{{ $errors->first('phoneNumberOne') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Secondary Phone Number</label>
                <input type="number" class="form-control" placeholder="Enter your another phone number"
                    name="phoneNumberTwo" value="{{ old('phoneNumberTwo', $profileData->phone_number_two) }}">
                @if ($errors->has('phoneNumberTwo'))
                    <p style="color: red">{{ $errors->first('phoneNumberTwo') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Region</label>
                <input type="text" class="form-control" placeholder="Enter your region" name="region"
                    value="{{ old('region', $profileData->region) }}">
                @if ($errors->has('region'))
                    <p style="color: red">{{ $errors->first('region') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Town</label>
                <input type="text" class="form-control" placeholder="Enter your town" name="town"
                    value="{{ old('town', $profileData->town) }}">
                @if ($errors->has('town'))
                    <p style="color: red">{{ $errors->first('town') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter your address" name="address"
                    value="{{ old('address', $profileData->address) }}">
                @if ($errors->has('address'))
                    <p style="color: red">{{ $errors->first('address') }}</p>
                @endif
            </div>
            <a href="{{ route('changePassword') }}">Change Password</a><br>

            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
        {{-- course form end --}}
    </div>
@endsection
