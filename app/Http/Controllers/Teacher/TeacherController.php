<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function course()
    {
        return view('teacher.course.courseInfo');
    }

    public function courseList()
    {
        $id = auth()->user()->id;
        $courseData = Course::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        //    dd($courseData->toArray());
        return view('teacher.course.courseList')->with(['course' => $courseData]);
    }

    // course create
    public function createCourse(Request $request)
    {
        $validator = $this->requestCourseValidation($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        // dd(auth()->user()->id);
        $data = $this->getCourseData($request, 'create');
        Course::create($data);
        return back()->with('courseSuccess', 'Course Create Success...');
    }

    public function deleteCourse($course_id)
    {
        Course::where('course_id', $course_id)->delete();
        return back()->with(['deleteSuccess' => 'Course Deleted!']);
    }

    public function updatePage($course_id)
    {
        $courseData = Course::where('course_id', $course_id)->first();
        return view('teacher.course.updateCourse')->with(['courseData' => $courseData]);
    }

    public function courseUpdate($course_id, Request $request)
    {
        $validator = $this->requestCourseValidation($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($course_id, $request->all());
        $courseData = $this->getCourseData($request, 'update');
        Course::where('course_id', $course_id)->update($courseData);
        return redirect()->route('courseList')->with(['updateSuccess' => 'Course Updated!']);
    }

    public function classInfo()
    {
        $id = auth()->user()->id;
        $course = Course::where('user_id', $id)->get();
        // dd($course->toArray());
        return view('teacher.class.classInfo')->with(['course' => $course]);
    }

    // create class
    public function createClass(Request $request)
    {
        $validator = $this->requestClassValidation($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request->all());
        $classData = $this->getClassData($request, 'create');
        // dd($classData);
        Classes::create($classData);
        return back()->with('createClassSuccess', 'Class Created Success...');
    }

    // class list
    public function classList()
    {
        $id = auth()->user()->id;
        $classData = Classes::select('classes.*', 'courses.course_title')
            ->join('courses', 'classes.course_id', 'courses.course_id')
            ->where('classes.user_id', $id)
            ->where('courses.user_id', $id)
            ->orderBy('classes.created_at', 'desc')
            ->get();
        // dd($classData->toArray());
        return view('teacher.class.classList')->with('classData', $classData);
    }

    // delete class
    public function deleteClass($class_id)
    {
        Classes::where('class_id', $class_id)->delete();
        return back()->with('deleteSuccess', 'Class Deleted!');
    }

    // update class page
    public function updateClassPage($class_id)
    {
        $id = auth()->user()->id;
        $courseData = Course::where('user_id', $id)->get();

        $classData = Classes::select('classes.*', 'courses.course_title')
            ->where('class_id', $class_id)
            ->join('courses', 'courses.course_id', 'classes.course_id')
            ->first();
        // $classData->check = 'checking';
        // dd($classData->toArray());
        // dd($classData->course_id);
        // dd($courseData->toArray());
        return view('teacher.class.updateClass')->with(['classData' => $classData, 'courseData' => $courseData]);
    }

    // update class
    public function updateClass($class_id, Request $request)
    {
        $validator = $this->requestClassValidation($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $class = $this->getClassData($request, 'update');
        $class['class_id'] = $class_id;

        Classes::where('class_id', $class_id)->update($class);

        $id = auth()->user()->id;
        $classData = Classes::select('classes.*', 'courses.course_title')
            ->join('courses', 'classes.course_id', 'courses.course_id')
            ->where('classes.user_id', $id)
            ->where('classes.class_id', $class_id)
            ->first();
        // dd($classData->toArray());
        return redirect()->route('classList')->with(['updateSuccess' => 'Class Updated!', 'classData' => $classData]);
    }

    public function classStudentInfo()
    {
        return view('teacher.classStudent.classStudentInfo');
    }

    // profile
    public function profileInfo()
    {
        $id = auth()->user()->id;
        $profileData = User::where('id', $id)->first();
        // dd($profileData->toArray());
        return view('teacher.profile.profileInfo')->with('profileData', $profileData);
    }

    // update profile
    public function updateProfile(Request $request)
    {
        $validator = $this->requestUserProfileValidation($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request->all());
        $id = auth()->user()->id;
        $profileData = $this->getUserProfileData($request);
        // dd($profileData);
        User::where('id', $id)->update($profileData);
        return back()->with('updateSuccess', 'Your Profile Successfully Updated...');
    }

    // change password page
    public function changePasswordForm()
    {
        return view('teacher.profile.changePassword');
    }

    // change password
    public function changePassword(Request $request)
    {
        // dd($request->all());
        $validator = $this->changeProfilePassword($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $db_password = auth()->user()->password;
        $old_password = $request->oldPassword;
        $new_password = $request->newPassword;
        $confirm_password = $request->confirmPassword;

        if (Hash::check($old_password, $db_password)) {
            if (strlen($new_password) >= 8 && strlen($confirm_password) >= 8) {
                if ($new_password == $confirm_password) {
                    $id = auth()->user()->id;
                    $newPassword = [
                        'password' => Hash::make($new_password),
                    ];
                    User::where('id', $id)->update($newPassword);
                    return back(); // auto logout 
                } else {
                    return back()->with('notSameBoth', 'Change password do not match. Try Again!');
                }
            } else {
                return back()->with('errorLength', 'Change password must be minimum 8 characters. Try Again!');
            }
        } else {
            return back()->with('notMatch', 'Old password do not match. Try Again!');
        }
    }

    public function newsInfo()
    {
        return view('teacher.news.newsInfo');
    }

    public function notificationInfo()
    {
        return view('teacher.notification.notificationInfo');
    }

    // change profile password
    private function changeProfilePassword($request)
    {
        $data = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);
        return $data;
    }

    // request user profile validation
    private function requestUserProfileValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'dateOfBirth' => 'required',
            'phoneNumberOne' => 'required',
            'phoneNumberTwo' => 'required',
            'region' => 'required',
            'town' => 'required',
            'address' => 'required',
        ]);
        return $validator;
    }

    // get user profile data
    private function getUserProfileData($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'date_of_birth' => $request->dateOfBirth,
            'phone_number_one' => $request->phoneNumberOne,
            'phone_number_two' => $request->phoneNumberTwo,
            'region' => $request->region,
            'town' => $request->town,
            'address' => $request->address,
        ];
        return $data;
    }

    // request class validation
    private function requestClassValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'className' => 'required',
            'fee' => 'required',
            'startDate' => 'required',
            'endDate' => 'required|after:startDate',
            'startTime' => 'required',
            'endTime' => 'required|after:startTime',
        ], [
            'className.required' => 'Class name needed',
            'fee.required' => 'Class fee needed',
            'startTime.required' => 'Start time needed',
            'endTime.required' => 'End time needed',
            'endTime.after' => 'End time must be greater than start time',
            'startDate.required' => 'Start date needed',
            'startDate.after' => 'End date must be greater than start date',
        ]);
        return $validator;
    }

    // request course validation
    private function requestCourseValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'courseTitle' => 'required',
            'courseExplanation' => 'required',
            'courseDetails' => 'required',
        ], [
            'courseTitle.required' => 'Course Title Is Needed!',
            'courseExplanation.required' => 'Course Explanation Is Needed!',
            'courseDetails.required' => 'Course Details Is Needed!',
        ]);
        return $validator;
    }

    // get course data from client (createCourse)
    private function getCourseData($request, $status)
    {
        if ($status == 'create') {
            $response = [
                'user_id' => auth()->user()->id,
                'course_title' => $request->courseTitle,
                'course_explanation' => $request->courseExplanation,
                'course_details' => $request->courseDetails,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        } else if ($status == 'update') {
            $response = [
                'course_title' => $request->courseTitle,
                'course_explanation' => $request->courseExplanation,
                'course_details' => $request->courseDetails,
                'updated_at' => Carbon::now(),
            ];
        }
        return $response;
    }

    // get class data
    private function getClassData($request, $status)
    {
        $data = [];
        if (isset($request->courseId)) {
            $data['course_id'] = $request->courseId;
        }
        if (isset($request->className)) {
            $data['class_name'] = $request->className;
        }
        if (isset($request->fee)) {
            $data['fee'] = $request->fee;
        }
        if (isset($request->startDate)) {
            $data['start_date'] = $request->startDate;
        }
        if (isset($request->endDate)) {
            $data['end_date'] = $request->endDate;
        }
        if (isset($request->startTime)) {
            $data['start_time'] = $request->startTime;
        }
        if (isset($request->endTime)) {
            $data['end_time'] = $request->endTime;
        }
        if (isset($request->classType)) {
            $data['class_type'] = $request->classType;
        }
        if ($request->mon == 'check') {
            // $data['check'] = 'check';
            $data['monday'] = 1;
        } else {
            // $data['check'] = 'un';
            $data['monday'] = 0;
        }
        if ($request->tue == 'check') {
            $data['tuesday'] = 1;
        } else {
            $data['tuesday'] = 0;
        }
        if ($request->wed == 'check') {
            $data['wednesday'] = 1;
        } else {
            $data['wednesday'] = 0;
        }
        if ($request->thu == 'check') {
            $data['thursday'] = 1;
        } else {
            $data['thursday'] = 0;
        }
        if ($request->fri == 'check') {
            $data['friday'] = 1;
        } else {
            $data['friday'] = 0;
        }
        if ($request->sat == 'check') {
            $data['saturday'] = 1;
        } else {
            $data['saturday'] = 0;
        }
        if ($request->sun == 'check') {
            $data['sunday'] = 1;
        } else {
            $data['sunday'] = 0;
        }
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
