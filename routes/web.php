<?php

use App\Mail\TeacherResponseMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// original
Route::get('/', function () {
    return view('welcome');
});

// mail testing
Route::get('sendMail', function () {
    $data = [
        'message' => 'Hello this is testing mail',
    ];
    Mail::to('mr.sawminoo@gmail.com')->send(new TeacherResponseMail($data));
});

// middleware
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('teacher');
        } elseif (Auth::user()->role == 'teacher') {
            return redirect()->route('teacherCourse');
        } elseif (Auth::user()->role == 'student') {
            return redirect()->route('studentCourseList');
        }
    }
})->name('dashboard');

// admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'adminCheck'], function () {
    // teacher
    Route::get('teacherList', 'AdminController@index')->name('teacher');

    // student
    Route::get('studentList', 'AdminController@studentList')->name('student');

    // notification
    Route::get('sendNotification', 'AdminController@sendNotification')->name('sendNotification');
    Route::post('sendNotification', 'AdminController@sendNoti')->name('sendNotification');

    // add admin
    Route::get('addAdmin', 'AdminController@addAdmin')->name('addAdmin');
    Route::post('createAdminAccount','AdminController@createAdminAccount')->name('createAdminAccount');
    Route::get('adminAccountList','AdminController@adminAccountList')->name('adminAccountList');
});

// teacher
Route::group(['prefix' => 'teacher', 'namespace' => 'Teacher', 'middleware' => 'teacherCheck'], function () {
    // course
    Route::get('course', 'TeacherController@course')->name('teacherCourse');
    Route::get('courseList', 'TeacherController@courseList')->name('courseList');
    Route::post('createCourse', 'TeacherController@createCourse')->name('createCourse');
    Route::get('deleteCourse/{course_id}', 'TeacherController@deleteCourse')->name('deleteCourse');
    Route::get('updatePage/{course_id}', 'TeacherController@updatePage')->name('updatePage');
    Route::post('courseUpdate/{course_id}', 'TeacherController@courseUpdate')->name('courseUpdate');

    // class
    Route::get('class', 'TeacherController@classInfo')->name('teacherClass');
    Route::post('createClass', 'TeacherController@createClass')->name('createClass');
    Route::get('classList', 'TeacherController@classList')->name('classList');
    Route::get('deleteClass/{class_id}', 'TeacherController@deleteClass')->name('deleteClass');
    Route::get('updateClassPage/{class_id}', 'TeacherController@updateClassPage')->name('updateClassPage');
    Route::post('updateClass/{class_id}', 'TeacherController@updateClass')->name('updateClass');

    // class student
    Route::get('classStudent', 'TeacherController@classStudentInfo')->name('teacherClassStudent');
    Route::get('changeStatus/{class_student_id}/{status}', 'TeacherController@changeStatus')->name('changeStatus');

    // profile
    Route::get('profile', 'TeacherController@profileInfo')->name('teacherProfile');
    Route::post('updateProfile', 'TeacherController@updateProfile')->name('updateProfile');
    Route::get('changePassword', 'TeacherController@changePasswordForm')->name('changePassword');
    Route::post('changePassword', 'TeacherController@changePassword')->name('changePassword');

    // news
    Route::get('news', 'TeacherController@newsInfo')->name('teacherNews');

    // notification
    Route::get('notification', 'TeacherController@notificationInfo')->name('teacherNotification');
});

// student
Route::group(['prefix' => 'student', 'namespace' => 'Student', 'middleware' => 'studentCheck'], function () {
    // course
    Route::get('courseList', 'StudentController@index')->name('studentCourseList');
    Route::get('lookCourse/{course_id}', 'StudentController@lookCourse')->name('lookCourse');
    Route::get('enrollClass/{class_id}/{teacher_id}', 'StudentController@enrollClass')->name('enrollClass');

    // class
    Route::get('classList', 'StudentController@studentClassList')->name('studentClassList');
    Route::get('lookClassInformation/{class_id}', 'StudentController@lookClassInformation')->name('lookClassInformation');

    // teacher
    Route::get('teacherList', 'StudentController@teacherList')->name('teacherList');
    Route::get('courseList/{teacher_id}', 'StudentController@studentCourseList')->name('studentCourse');

    // profile
    Route::get('profile', 'StudentController@profileInfo')->name('studentProfile');
    Route::post('updateProfile', 'StudentController@updateProfile')->name('updateProfile');
    Route::get('changePassword', 'StudentController@changePasswordForm')->name('changePassword');
    Route::post('changePassword', 'StudentController@changePassword')->name('changePassword');

    // course request
    Route::get('courseRequest', 'StudentController@courseRequest')->name('courseRequest');
    Route::post('requestCourse', 'StudentController@requestCourse')->name('requestCourse');

});
