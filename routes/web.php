<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('adminDashboard');
        } elseif (Auth::user()->role == 'teacher') {
            return redirect()->route('teacherCourse');
        } elseif (Auth::user()->role == 'student') {
            return redirect()->route('studentCourseList');
        }
    }
})->name('dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'adminCheck'], function () {
    Route::get('dashboard', 'AdminController@index')->name('adminDashboard');
});

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
    Route::get('changeStatus/{class_student_id}/{status}','TeacherController@changeStatus')->name('changeStatus');

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

Route::group(['prefix' => 'student', 'namespace' => 'Student', 'middleware' => 'studentCheck'], function () {
    // course
    Route::get('courseList', 'StudentController@index')->name('studentCourseList');
    Route::get('lookCourse/{course_id}','StudentController@lookCourse')->name('lookCourse');
    Route::get('enrollClass/{class_id}/{teacher_id}', 'StudentController@enrollClass')->name('enrollClass');

    // class
    Route::get('classList','StudentController@studentClassList')->name('studentClassList');

    // teacher
    Route::get('teacherList','StudentController@teacherList')->name('teacherList');
    Route::get('courseList/{teacher_id}','StudentController@studentCourseList')->name('studentCourse');
});
