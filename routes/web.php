<?php

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

// Attendance
Route::get('/attendance', 'AttendanceController@create')->name('attendance.create');
Route::post('/attendance', 'AttendanceController@store')->name('attendance.store');

// Employee
Route::get('employees/salary', 'EmployeeController@salary')->name('employee.salary');
Route::get('employees/{id}/attendance', 'EmployeeController@attendance')->name('employee.attendance');