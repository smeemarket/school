<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    // teacher list
    public function index()
    {
        $teacher = User::where('role', 'teacher')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        // dd($teacher->toArray());
        return view('admin.teacher.list')->with('teacher', $teacher);
    }

    // student list
    public function studentList()
    {
        $student = User::where('role', 'student')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('admin.student.list')->with('student', $student);
    }

    // notification
    public function sendNotification()
    {
        return view('admin.notification.notification');
    }

    // add admin
    public function addAdmin()
    {
        return view('admin.addAdmin.create');
    }
}
