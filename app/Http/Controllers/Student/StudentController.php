<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\ClassStudent;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    // direct course page
    public function index()
    {
        // $courses = Course::orderBy('created_at', 'desc')->get();
        $courses = Course::select('courses.*', 'users.name')
            ->join('users', 'users.id', 'courses.user_id')
            ->where('users.role', 'teacher')
            ->orderBy('courses.created_at', 'desc')
            ->paginate(3);
        // dd($courses->toArray());
        return view('student.course.list')->with('course', $courses);
    }

    // look course
    public function lookCourse($course_id)
    {
        $courseData = Course::select('courses.*', 'users.name')
            ->join('users', 'users.id', 'courses.user_id')
            ->where('users.role', 'teacher')
            ->where('courses.course_id', $course_id)
            ->get();
        // dd($courseData->toArray());

        $relatedClass = Course::select('classes.*')
            ->join('classes', 'classes.course_id', 'courses.course_id')
            ->leftJoin('users', 'users.id', 'courses.user_id')
            ->where('users.role', 'teacher')
            ->where('classes.course_id', $course_id)
            ->get();
        // dd($relatedClass->toArray());

        return view('student.course.lookCourse')->with(['courseData' => $courseData, 'relatedClass' => $relatedClass]);
    }

    // class list
    public function studentClassList()
    {
        $class = Course::select('courses.*', 'classes.*', 'users.name')
            ->join('classes', 'classes.course_id', 'courses.course_id')
            ->join('users', 'users.id', 'courses.user_id')
            ->where('users.role', 'teacher')
            ->paginate(2);
        // dd($class->toArray());

        return view('student.class.classList')->with('class', $class);
    }

    // enroll class
    public function enrollClass($class_id,$teacher_id)
    {
        // dd('class - ' . $class_id, 'course - ' . $course_id, 'user - ' . $name);
        $data = [
            'class_id' =>$class_id,
            'student_id'=>auth()->user()->id,
            'teacher_id' =>$teacher_id,
            'status'=>0
        ];
        ClassStudent::create($data);
        return back()->with('classAttendSuccess','Enroll Success..');
    }
}
