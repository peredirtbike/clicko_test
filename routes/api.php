<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CourseController as CourseV1;
use App\Http\Controllers\Api\V1\StudentController as StudentV1;
use App\Http\Controllers\Api\V1\DocumentController as DocumentV1;
use App\Http\Controllers\Api\V1\CategoryController as CategoryV1;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('v1/courses', CourseV1::class)
      ->only(['index','store','show','update','destroy']);
      Route::post('courses/{course}/students', 'CourseController@addStudent');


Route::apiResource('v1/students', StudentV1::class)
      ->only(['index','store','show','update','destroy']);

Route::apiResource('v1/documents', DocumentV1::class)
      ->only(['index','store','show','destroy']);
      Route::post('v1/documents/{document}', [DocumentV1::class, 'update'])->name('documents.update');


Route::apiResource('v1/categories', CategoryV1::class)
      ->only(['index','store','destroy']);


