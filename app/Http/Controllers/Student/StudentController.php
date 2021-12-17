<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;

class StudentController extends Controller
{
    public function index()
    {
        // $courses = Course::orderBy('created_at', 'desc')->get();
        $courses = Course::select('courses.*', 'users.name')
            ->join('users', 'users.id', 'courses.user_id')
            ->where('users.role','teacher')
            ->orderBy('courses.created_at', 'desc')
            ->get();
        // dd($courses->toArray());
        return view('student.course.list')->with('course', $courses);
    }
}
