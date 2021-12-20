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

        $relatedClass = Course::select('classes.*', 'class_students.status', 'class_students.student_id')
            ->join('classes', 'classes.course_id', 'courses.course_id')
            ->leftJoin('class_students', 'class_students.class_id', 'classes.class_id')
            // ->where('class_students.student_id', '!=', $id)
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
        $class = Classes::select('classes.*', 'users.name', 'users.id', 'class_students.status')
            ->orderBy('classes.class_id', 'desc')
            ->join('users', 'users.id', 'classes.user_id')
            ->rightJoin('class_students', 'classes.class_id', 'class_students.class_id')
        // ->where('class_students.student_id','==',$id)
            ->paginate(2);
        // dd($class[12]->class_id);
        // dd($class->toArray());

        return view('student.class.classList')->with('class', $class);
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
