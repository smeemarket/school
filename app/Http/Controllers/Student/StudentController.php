<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassStudent;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // direct course page
    public function index()
    {
        // $courses = Course::orderBy('created_at', 'desc')->get();
        $course = Course::select('courses.*', 'users.name')
            ->join('users', 'users.id', 'courses.user_id')
            ->orderBy('courses.created_at', 'desc')
            ->paginate(2);
        // dd($course->toArray());
        return view('student.course.list')->with('course', $course);
    }

    // look course
    public function lookCourse($course_id)
    {
        $id = Auth::user()->id;
        $courseData = Course::select('courses.*', 'users.name', 'users.id')
            ->join('users', 'users.id', 'courses.user_id')
            ->where('courses.course_id', $course_id)
            ->get();
        // dd($courseData->toArray());

        $relatedClass = Course::select('classes.*')
            ->join('classes', 'classes.course_id', 'courses.course_id')
        // ->leftJoin('class_students', 'class_students.class_id', 'classes.class_id')
        // ->where('class_students.student_id', $id)
            ->where('classes.course_id', $course_id)
            ->get();
        // dd($relatedClass->toArray());
        return view('student.course.lookCourse')->with(['courseData' => $courseData, 'relatedClass' => $relatedClass]);
    }

    // enroll class
    public function enrollClass($class_id, $teacher_id)
    {
        // dd('class - ' . $class_id, 'course - ' . $course_id, 'user - ' . $name);
        $data = [
            'class_id' => $class_id,
            'student_id' => auth()->user()->id,
            'teacher_id' => $teacher_id,
            'status' => 1,
        ];
        ClassStudent::create($data);
        return back()->with(['classAttendSuccess' => 'Enroll Success..']);
    }

    // class list
    public function studentClassList()
    {
        $id = auth()->user()->id;
        // dd($id);
        // $data = ClassStudent::where('student_id', $id)->get();
        // dd($data->toArray());

        $class = Classes::select('classes.*', 'users.name', 'users.id')
            ->orderBy('classes.class_id', 'desc')
            ->join('users', 'users.id', 'classes.user_id')
            ->paginate(2);
        // dd($class[12]->class_id);
        // dd($class->toArray());

        // $status = ClassStudent::where('student_id', $id)->get();
        // dd($status->toArray());

        return view('student.class.classList')->with(['class' => $class]);
    }

    // look class information
    public function lookClassInformation($class_id)
    {
        $class = Classes::where('class_id', $class_id)->get();

        $id = auth()->user()->id;
        $attend_status = Classes::leftJoin('class_students', 'class_students.class_id', 'classes.class_id')
            ->where('class_students.class_id', $class_id)
            ->where('class_students.student_id', $id)
            ->select('class_students.status')
            ->get();
        if (empty($attend_status[0])) {
            $status = null;
        } else {
            $status = $attend_status[0]['status'];
        }
        // dd($attend_status->toArray());
        // dd($status);
        return view('student.class.lookClassInformation')->with(['class' => $class, 'status' => $status]);
    }

    // teacher list
    public function teacherList()
    {
        $teacher = User::select('users.*', DB::raw('COUNT(courses.course_id) as courses'))
            ->orderBy('users.created_at', 'desc')
            ->where('users.role', 'teacher')
            ->join('courses', 'courses.user_id', 'users.id')
            ->groupBy('courses.user_id')
            ->paginate(2);
        // dd($teacher->toArray());

        return view('student.teacher.teacherList')->with(['teacher' => $teacher]);
    }

    // course list by teacher
    public function studentCourseList($teacher_id)
    {
        // $name = User::where('id', $teacher_id)->name()->get();
        $course = Course::where('user_id', $teacher_id)
            ->join('users', 'users.id', 'courses.user_id')
            ->paginate(2);
        return view('student.teacher.courseList')->with(['course' => $course]);
    }
}
