<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassStudent;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // teacher list
    public function index()
    {
        $teacher = User::where('role', 'teacher')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        // dd($teacher->toArray());

        $count = ClassStudent::select('teacher_id', DB::raw('COUNT(class_students.teacher_id) as studentCount'))
            ->groupBy('class_students.teacher_id')
            ->get();
        // dd($count->toArray());

        // if (empty($count->toArray())) {
        //     $status = null;
        // }
        // dd($status);

        return view('admin.teacher.list')->with(['teacher' => $teacher, 'count' => $count]);
    }

    // student list
    public function studentList()
    {
        $student = User::where('role', 'student')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $count = ClassStudent::select('student_id', DB::raw('COUNT(class_students.student_id) as classCount'))
            ->groupBy('class_students.student_id')
            ->get();
        // dd($count->toArray());

        return view('admin.student.list')->with(['student' => $student, 'count' => $count]);
    }

    // notification
    public function sendNotification()
    {
        return view('admin.notification.notification');
    }

    // send noti
    public function sendNoti(Request $request)
    {
        $user_id = auth()->user()->id;
        $sender_name = auth()->user()->name;

        $data = [
            'user_id' => $user_id,
            'sender' => $sender_name,
            'message' => $request->message,
            'send_date' => Carbon::now(),
        ];

        // dd($data);
        Notification::create($data);
        return back()->with('success', 'Notification Sent');
    }

    // add admin
    public function addAdmin()
    {
        return view('admin.addAdmin.create');
    }

    public function createAdminAccount(Request $request)
    {
        $validator = $this->checkCreateAdminValidation($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'date_of_birth' => $request->dateOfBirth,
            'name' => $request->name,
            'phone_number_one' => $request->phone,
            'region' => $request->region,
            'town' => $request->town,
            'address' => $request->address,
            'status' => 0,
            'role' => 'admin',
        ];

        User::create($data);
        return back()->with('createSuccess', 'New admin account was created successfully');
    }

    // admin account list
    public function adminAccountList()
    {
        $admin = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.addAdmin.list')->with('admin', $admin);
    }

    private function checkCreateAdminValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'phone' => 'required',
            'region' => 'required',
            'town' => 'required',
            'address' => 'required',
        ]);
        return $validator;

    }
}
