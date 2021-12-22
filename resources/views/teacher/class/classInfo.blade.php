@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <div class="container mt-3">
        @if (Session::has('courseSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('courseSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('createClassSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('createClassSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- course form open --}}
        <form action="{{ route('createClass') }}" method="POST">
            @csrf
            <legend class="text-center mb-3">Create Class</legend>
            <div class="form-group">
                <label for="">Course Title</label>
                <select name="courseId" id="" class="form-control">
                    @foreach ($course as $item)
                        @if (old('courseId') == $item->course_id)
                            <option value="{{ $item->course_id }}" selected>{{ $item->course_title }}</option>
                        @else
                            <option value="{{ $item->course_id }}">{{ $item->course_title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Class Name</label>
                <input type="text" class="form-control" placeholder="Enter Class Name..." name="className"
                    value="{{ old('className') }}">
                @if ($errors->has('className'))
                    <p style="color: red">{{ $errors->first('className') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Class Fee</label>
                <input type="number" class="form-control" placeholder="Enter Class Fee..." name="fee"
                    value="{{ old('fee') }}">
                @if ($errors->has('fee'))
                    <p style="color: red">{{ $errors->first('fee') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Start Time</label>
                <input type="time" class="form-control" placeholder="Enter Start Time..." name="startTime"
                    value="{{ old('startTime') }}">
                @if ($errors->has('startTime'))
                    <p style="color: red">{{ $errors->first('startTime') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>End Time</label>
                <input type="time" class="form-control" placeholder="Enter End Time..." name="endTime"
                    value="{{ old('endTime') }}">
                @if ($errors->has('endTime'))
                    <p style="color: red">{{ $errors->first('endTime') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" class="form-control" placeholder="Enter Start Date..." name="startDate"
                    value="{{ old('startDate') }}">
                @if ($errors->has('startDate'))
                    <p style="color: red">{{ $errors->first('startDate') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" class="form-control" placeholder="Enter End Date..." name="endDate"
                    value="{{ old('endDate') }}">
                @if ($errors->has('endDate'))
                    <p style="color: red">{{ $errors->first('endDate') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="">Class Type</label>
                <select name="classType" id="" class="form-control">
                    @if (old('classType') == 'weekday')
                        <option value="weekday" selected>Weekday Class</option>
                        <option value="weekend">Weekend Class</option>
                    @elseif (old('classType') == 'weekend')
                        <option value="weekday">Weekday Class</option>
                        <option value="weekend" selected>Weekend Class</option>
                    @else
                        <option value="weekday">Weekday Class</option>
                        <option value="weekend">Weekend Class</option>
                    @endif
                </select>
            </div>
            <div class="form-check form-check-inline">
                @if (old('mon') == 'check')
                    <input type="checkbox" class="form-check-input" name="mon" id="mon" value='check' checked />
                @else
                    <input type="checkbox" class="form-check-input" name="mon" id="mon" value='check' />
                @endif
                <label for="mon" class="form-check-label mr-3">Mon</label>

                @if (old('tue') == 'check')
                    <input type="checkbox" class="form-check-input" name="tue" id="tue" value='check' checked>
                @else
                    <input type="checkbox" class="form-check-input" name="tue" id="tue" value='check'>
                @endif
                <label for="tue" class="form-check-label mr-3">Tue</label>

                @if (old('wed') == 'check')
                    <input type="checkbox" class="form-check-input" name="wed" id="wed" value='check' checked>
                @else
                    <input type="checkbox" class="form-check-input" name="wed" id="wed" value='check'>
                @endif
                <label for="wed" class="form-check-label mr-3">Wed</label>

                @if (old('thu') == 'check')
                    <input type="checkbox" class="form-check-input" name="thu" id="thu" value='check' checked>
                @else
                    <input type="checkbox" class="form-check-input" name="thu" id="thu" value='check'>
                @endif
                <label for="thu" class="form-check-label mr-3">Thu</label>

                @if (old('fri') == 'check')
                    <input type="checkbox" class="form-check-input" name="fri" id="fri" value='check' checked>
                @else
                    <input type="checkbox" class="form-check-input" name="fri" id="fri" value='check'>
                @endif
                <label for="fri" class="form-check-label mr-3">Fri</label>

                @if (old('sat') == 'check')
                    <input type="checkbox" class="form-check-input" name="sat" id="sat" value='check' checked>
                @else
                    <input type="checkbox" class="form-check-input" name="sat" id="sat" value='check'>
                @endif
                <label for="sat" class="form-check-label mr-3">Sat</label>

                @if (old('sun') == 'check')
                    <input type="checkbox" class="form-check-input" name="sun" id="sun" value='check' checked>
                @else
                    <input type="checkbox" class="form-check-input" name="sun" id="sun" value='check'>
                @endif
                <label for="sun" class="form-check-label mr-3">Sun</label>

            </div><br><br>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        {{-- course form end --}}
    </div>
@endsection
