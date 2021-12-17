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
        @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('updateSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- course form open --}}
        <form action="{{ route('updateClass', $classData->class_id) }}" method="POST">
            @csrf
            <legend class="mb-3">Update Class</legend>
            <div class="form-group">
                <label for="">Course Title</label>
                <select name="courseId" class="form-control">
                    @foreach ($courseData as $item)
                        @if (old('courseId'))
                            @if (old('courseId') == $item->course_id)
                                {{ $selected = 'selected' }}
                            @else
                                {{ $selected = null }}
                            @endif
                        @else
                            @if ($classData->course_id == $item->course_id)
                                {{ $selected = 'selected' }}
                            @else
                                {{ $selected = null }}
                            @endif
                        @endif
                        <option value="{{ $item->course_id }}" {{ $selected }}>
                            {{ $item->course_title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Class Name</label>
                <input type="text" class="form-control" value="{{ old('className', $classData->class_name) }}"
                    name="className">
                @if ($errors->has('className'))
                    <p style="color: red">{{ $errors->first('className') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Class Fee</label>
                <input type="number" class="form-control" value="{{ old('fee', $classData->fee) }}" name="fee">
                @if ($errors->has('fee'))
                    <p style="color: red">{{ $errors->first('fee') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label>Start Time</label>
                <input type="time" class="form-control" value="{{ old('startTime', $classData->start_time) }}"
                    name="startTime">
            </div>
            <div class="form-group">
                <label>End Time</label>
                <input type="time" class="form-control" value="{{ old('endTime', $classData->end_time) }}"
                    name="endTime">
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" class="form-control" value="{{ old('startDate', $classData->start_date) }}"
                    name="startDate">
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" class="form-control" value="{{ old('endDate', $classData->end_date) }}"
                    name="endDate">
            </div>
            <div class="form-group">
                <label for="">Class Type</label>
                <select name="classType" id="" class="form-control">
                    @if ($classData->class_type == 'weekday')
                        @if (old('classType') == 'weekday')
                            <option value="weekday" selected>Weekday Class</option>
                            <option value="weekend">Weekend Class</option>
                        @elseif (old('classType') == 'weekend')
                            <option value="weekday">Weekday Class</option>
                            <option value="weekend" selected>Weekend Class</option>
                        @else
                            <option value="weekday" selected>Weekday Class</option>
                            <option value="weekend">Weekend Class</option>
                        @endif
                    @elseif ($classData->class_type == 'weekend')
                        @if (old('classType') == 'weekday')
                            <option value="weekday" selected>Weekday Class</option>
                            <option value="weekend">Weekend Class</option>
                        @elseif (old('classType') == 'weekend')
                            <option value="weekday">Weekday Class</option>
                            <option value="weekend" selected>Weekend Class</option>
                        @else
                            <option value="weekday">Weekday Class</option>
                            <option value="weekend" selected>Weekend Class</option>
                        @endif
                    @endif
                </select>
            </div>
            <div class="form-check form-check-inline">

                @if ($classData->monday == 1)
                    @if (old('mon') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="mon" id="mon" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="mon" id="mon" value='check' />
                    @endif
                @elseif ($classData->monday == 0)
                    @if (old('mon') == 'check')
                        <input type="checkbox" class="form-check-input" name="mon" id="mon" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="mon" id="mon" value='check' />
                    @endif
                @endif
                <label for="mon" class="form-check-label mr-3">Mon</label>

                @if ($classData->tuesday == 1)
                    @if (old('tue') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="tue" id="tue" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="tue" id="tue" value='check' />
                    @endif
                @elseif ($classData->tuesday == 0)
                    @if (old('tue') == 'check')
                        <input type="checkbox" class="form-check-input" name="tue" id="tue" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="tue" id="tue" value='check' />
                    @endif
                @endif
                <label for="tue" class="form-check-label mr-3">Tue</label>

                @if ($classData->wednesday == 1)
                    @if (old('wed') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="wed" id="wed" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="wed" id="wed" value='check' />
                    @endif
                @elseif ($classData->wednesday == 0)
                    @if (old('wed') == 'check')
                        <input type="checkbox" class="form-check-input" name="wed" id="wed" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="wed" id="wed" value='check' />
                    @endif
                @endif
                <label for="wed" class="form-check-label mr-3">Wed</label>

                @if ($classData->thursday == 1)
                    @if (old('thu') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="thu" id="thu" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="thu" id="thu" value='check' />
                    @endif
                @elseif ($classData->thursday == 0)
                    @if (old('thu') == 'check')
                        <input type="checkbox" class="form-check-input" name="thu" id="thu" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="thu" id="thu" value='check' />
                    @endif
                @endif
                <label for="thu" class="form-check-label mr-3">Thu</label>

                @if ($classData->friday == 1)
                    @if (old('fri') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="fri" id="fri" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="fri" id="fri" value='check' />
                    @endif
                @elseif ($classData->friday == 0)
                    @if (old('fri') == 'check')
                        <input type="checkbox" class="form-check-input" name="fri" id="fri" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="fri" id="fri" value='check' />
                    @endif
                @endif
                <label for="fri" class="form-check-label mr-3">Fri</label>

                @if ($classData->saturday == 1)
                    @if (old('sat') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="sat" id="sat" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="sat" id="sat" value='check' />
                    @endif
                @elseif ($classData->saturday == 0)
                    @if (old('sat') == 'check')
                        <input type="checkbox" class="form-check-input" name="sat" id="sat" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="sat" id="sat" value='check' />
                    @endif
                @endif
                <label for="sat" class="form-check-label mr-3">Sat</label>

                @if ($classData->sunday == 1)
                    @if (old('sun') == 'check' || empty(old()))
                        <input type="checkbox" class="form-check-input" name="sun" id="sun" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="sun" id="sun" value='check' />
                    @endif
                @elseif ($classData->sunday == 0)
                    @if (old('sun') == 'check')
                        <input type="checkbox" class="form-check-input" name="sun" id="sun" value='check' checked />
                    @else
                        <input type="checkbox" class="form-check-input" name="sun" id="sun" value='check' />
                    @endif
                @endif
                <label for="sun" class="form-check-label mr-3">Sun</label>


            </div><br><br>
            <button type="submit" class="btn btn-secondary">Update</button>
        </form>
        {{-- course form end --}}
    </div>
@endsection
